<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sync extends Base_Controller {

    public $module = 'user';    // defines the module
    public $template = 'open_library';  // Current Template Name
    public $viewpath = '';
    public $server_url = "";
    public $server = "";
    public $local_url = "";
    public $access_code = '';
    //========================
    public $data = array();

    function __construct()
    {
        parent::__construct();

        //$this->__security($this->module);                         // Don't need any security for this controller.

        $this->load->model($this->module."/m_sync"); // Loading Model
        $this->load->model($this->module."/m_issue");

        $this->server = $this->m_sync->server_info();
        $this->access_code = $this->m_sync->access_code();
        $this->server_url = $this->server->server_url.'/user/sync/';
        $this->local_url = site_url().'/user/update_issue/';

        $this->data['controller'] = site_url('user/sync');
    }
    //====================================//

    public function index() {
        if($this->settings->application_role) die('0');
        $sync_limit = 10;
        $ret = true;
        if($this->server->server_sync_status && strtotime($this->server->server_last_connection) >= time()-($this->sync_interval*3)) exit(0);

        if($this->check_server_connection() == false) exit('0');
        echo 'check_server_connection: '.$ret.'<br>';

        if(!$this->lock_server($this->server->server_id)) exit('0');
        echo 'lock_server: '.$ret.'<br>';
        
        $ret = $this->fetch_queries($sync_limit);
        echo 'fetch_queries: '.$ret.'<br>';
        
        $ret &= $this->release();
        echo 'release: '.$ret.'<br>';
        
        $ret &= $this->confirm();
        echo 'confirm: '.$ret.'<br>';
        
        $ret &= $this->push_queries($sync_limit);
        echo 'push_queries: '.$ret.'<br>';
        
        if($ret) $this->update_server_connection_time($this->server->server_id);
        $this->unlock_server($this->server->server_id);

        echo $ret;
    }

    public function check_server_connection() {
        $response = $this->my_curl($this->server_url.'confirm_server_connection', array('access_code'=>$this->server->server_access_code));
        if($response == md5($this->server->server_access_code)) return true;
        return false;
    }

    public function fetch_queries($sync_limit=0) {
        if($sync_limit == 0) return false;
        // Fetching remote log and syncing
        $queries = $this->my_curl($this->server_url.'feed_queries/'.$sync_limit, array('access_code'=>$this->server->server_access_code));
        if($queries == false) return false; // No Server Connection
        if($queries == 'Invalid Access Code') return false;
        $queries = json_decode($queries, true);   // Fetching unsynced log entries
        if(count($queries) == 0) {
            //echo 'Nothing new to fetch from the remote server<br>';
            return true;
        }
        // // Fetched
        // echo 'Fetched<br>';
        // $this->printer($queries);
        $entry_ids = array();
        foreach($queries as $key=>$query) {
            array_push($entry_ids, $queries[$key]['log_entry_id']);
            unset($queries[$key]['log_id']);
            $this->db->trans_start();
            $this->db->query($query['log_query']); // Running log queries (applying changes into local server)
            $this->db->trans_complete();
            $queries[$key]['log_is_synced'] = 1;
        }
        $aff = $this->m_sync->add_log($queries);    // Adding queries in log entry
        if($aff) {
            $this->my_curl($this->server_url.'update_log_as_synced', array('access_code'=>$this->server->server_access_code, 'data'=>$entry_ids)); // Confirming remote server about the ids which has been synced
            return true;
        }
        return false;
    }

    public function push_queries($sync_limit=0) {
        if($sync_limit == 0) return false;
        // Pushing local log to remote server for syncing
        $queries = json_decode(json_encode($this->m_sync->feed_queries($sync_limit)), true);
        if(count($queries) == 0) {
            //echo 'Nothing new to push to the remote server<br>';
            return true;
        }
        // // Pushed
        // echo 'Pushed<br>';
        // $this->printer($queries);
        $entry_ids = array();
        foreach($queries as $key=>$query) {
            array_push($entry_ids, $queries[$key]['log_entry_id']);
            unset($queries[$key]['log_id']);
            $queries[$key]['log_is_synced'] = 1;
        }
        
        $reply = json_decode($this->my_file_get_contents($this->server_url.'receive_local_log', array('access_code'=>$this->server->server_access_code, 'data'=>$queries)), true); // Sending local log to remote server using file_get_contents
        
        if($reply == $entry_ids) {
            $this->update_log_as_synced($reply);
            return true;
        }
        return false;
    }
    
    /* ================================================================================= */

    public function confirm_server_connection() {
        $access_code = $_POST['access_code'];
        if(!$this->authenticate($access_code)) die('Invalid Access Code');
        echo md5($access_code);
    }

    public function feed_queries($sync_limit=0) {
        $access_code = $_POST['access_code'];
        if(!$this->authenticate($access_code)) die('Invalid Access Code');

        if($sync_limit == 0) exit();
        $queries = $this->m_sync->feed_queries($sync_limit);
        echo json_encode($queries);
        // $this->update_server_connection_time($this->server->server_id);
    }

    public function receive_local_log() {
        $curl_data  = json_decode($_POST['curl_data'], true);
        $access_code = $curl_data['access_code'];
        if(!$this->authenticate($access_code)) die('Invalid Access Code');

        $queries = $curl_data['data'];
        $entry_ids = array();
        foreach($queries as $key=>$query) {
            array_push($entry_ids, $queries[$key]['log_entry_id']);
            $this->db->trans_start();
            $this->db->query($query['log_query']); // Running log queries (applying changes into remote server)
            $this->db->trans_complete();
        }
        $aff = $this->m_sync->add_log($queries);    // Adding queries in log entry
        echo json_encode($entry_ids);
        $this->update_server_connection_time($this->server->server_id);
    }

    public function update_log_as_synced($local_sync_data=NULL) {
        if($local_sync_data == NULL) {
            $curl_data  = json_decode($_POST['curl_data'], true);
            $access_code = $curl_data['access_code'];
            if(!$this->authenticate($access_code)) die('Invalid Access Code');
            
            $entry_ids = $curl_data['data'];
            $this->update_server_connection_time($this->server->server_id);
        }
        else $entry_ids = $local_sync_data;
        $this->m_sync->update_log_as_synced($entry_ids);
    }

    public function release() {
        $issues = $this->m_issue->all_expired_confirmed_issue_requests();
        if(count($issues) == 0) {
            //echo 'No Expired Confirmed Issues<br>';
            return true;
        }
        foreach($issues as $key=>$issue) {
            $new['issue'] = array('issue_id' => $issue->issue_id ,'issue_status' => 8);
            $new['book'] = array('book_id' => $issue->book_id, 'book_available' => $issue->book_available+1);
            $reply = $this->my_curl($this->local_url.'update_issue', $new); // Updating issue through a different controller, because we need the log entry for update
            // if($reply) echo 'Released Issue '.$issue->issue_id.'<br>';
            // else echo 'Issue '.$issue->issue_id.' Failed to release<br>';
        }
        return true;
    }

    public function confirm() {
        // Check demands for availibility of books and confirming them
        $issues = $this->m_issue->all_demands();
        //$this->printer($issues);
        if(count($issues) > 0) {
            foreach($issues as $key=>$issue) {
                $book_available = $this->m_issue->book_availibility($issue->issue_book_id);
                if($book_available > 0) {
                    $new['issue'] = array('issue_id' => $issue->issue_id ,'issue_status' => 0);
                    $new['book'] = array('book_id' => $issue->issue_book_id, 'book_available' => $book_available-1);

                    $reply = $this->my_curl($this->local_url.'update_issue', $new); // Updating issue through a different controller.
                    if($reply) echo 'Confirmed Issue '.$issue->issue_id.'<br>';
                    else echo 'Issue '.$issue->issue_id.' Failed to confirm<br>';
                }
                else {
                    echo 'Book still unavailable for issue '. $issue->issue_id.'<br>';
                }
            }
        }

        // Check new requests to confirm them or converting them into demands
        $issues = $this->m_issue->all_new_issue_requests();
        if(count($issues) > 0) {
            foreach($issues as $key=>$issue) {
                if($issue->book_available > 0) {
                    $new['issue'] = array('issue_id' => $issue->issue_id ,'issue_status' => 0);
                    $new['book'] = array('book_id' => $issue->book_id, 'book_available' => $issue->book_available-1);
                }
                else {
                    $new['issue'] = array('issue_id' => $issue->issue_id ,'issue_status' => 6); // Converting into Demands
                    $new['book'] = array('book_id' => $issue->book_id);
                }
                $reply = $this->my_curl($this->local_url.'update_issue', $new); // Updating issue through a different controller.
                // if($reply) echo 'Confirmed Issue '.$issue->issue_id.'<br>';
                // else echo 'Issue '.$issue->issue_id.' Failed to confirm<br>';
            }
        }
        return true;
    }

    public function lock_server($server_id) {echo $this->m_sync->lock_server($server_id);}
    public function unlock_server($server_id) {echo $this->m_sync->unlock_server($server_id);}

    public function update_server_connection_time($server_id) {return $this->m_sync->update_server_connection_time($server_id);}

    public function last_sync_time($seconds = 0) {
        //echo $this->server->server_last_connection.'<br>';
        if($seconds) echo $this->time_elapsed_in_seconds($this->server->server_last_connection);
        else echo $this->time_elapsed_string($this->server->server_last_connection, true);
    }

    public function authenticate($access_code) {
        return $this->check_access_code($access_code);
    }

    public function check_access_code($access_code) {
        if($access_code == $this->access_code) return true;
        else return false;
    }
}
