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

        $this->data['controller'] = site_url('user/sync');
    }
    //====================================//

    public function index() {
        echo 'Sync Page';
    }

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
    }

    public function receive_local_log() {
        if(!isset($_POST['access_code']) || !isset($_POST['queries'])) die('Invalid POST Data');
        $access_code = $_POST['access_code'];
        if(!$this->authenticate($access_code)) die('Invalid Access Code');

        if($this->settings->application_role == 1) $this->update_server_connection_time($this->server->server_id);

        $queries = $_POST['queries'];
        $entry_ids = array();
        foreach($queries as $key=>$query) {
            // Checking if this log entry is already synced before
            if($this->m_sync->is_already_synced($query['log_entry_id'])) {
                array_push($entry_ids, $queries[$key]['log_entry_id']);
                unset($queries[$key]);
            }
            else {
                unset($queries[$key]['log_id']);
                $res = $this->run_query($query['log_query']); // Running log queries (applying changes into remote server)
                if($res) {
                    $queries[$key]['log_is_synced'] = 1;
                    $aff = $this->m_sync->add_log($queries[$key]);    // Adding query in log entry
                    if($aff) array_push($entry_ids, $queries[$key]['log_entry_id']);
                }
            }
        }
        echo json_encode($entry_ids);
    }

    public function run_query($query=NULL) {
        if(!$query) return 0;
        return $this->m_sync->run_query($query);
    }

    public function update_log_as_synced($local_sync_data=NULL) {
        if($local_sync_data == NULL) {
            $access_code = $_POST['access_code'];
            if(!$this->authenticate($access_code)) die('Invalid Access Code');
            
            $entry_ids = $_POST['entry_ids'];
            $entry_ids = json_decode($entry_ids);
        }
        else $entry_ids = $local_sync_data;
        $this->m_sync->update_log_as_synced($entry_ids);
        $this->printer($entry_ids);
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

    public function lock_server($server_id) {return $this->m_sync->lock_server($server_id);}
    public function unlock_server($server_id) {return $this->m_sync->unlock_server($server_id);}

    public function update_server_connection_time($server_id) {
        if($this->settings->application_role == 1) $this->m_sync->update_server_connection_time($server_id);
        else echo $this->m_sync->update_server_connection_time($server_id);
    }

    public function last_sync_time($seconds = 0) {
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
