<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sync extends Base_Controller {

	public $module = 'admin';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        $this->__security($this->module);

        $this->load->model($this->module."/m_sync"); // Loading Model
        $this->load->model($this->module."/m_issue");

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('admin/sync');



        $this->server = $this->m_sync->server_info();
        $this->access_code = $this->m_sync->access_code();
        $this->server_url = $this->server->server_url.'/user/sync/';
        $this->local_url = site_url().'/user/update_issue/';
    }
    //====================================//

	public function index() {
        $data = $this->data;
        $data['page'] = 'sync';
        $data['page_title'] .= 'Sync';
        $data['sync_limit'] = 10;

        $data['content'] = 'v_sync.php';
        $this->load->view($this->viewpath.'v_main', $data);
	}

    public function is_sync_ready() {
        if($this->server->server_sync_status && strtotime($this->server->server_last_connection) >= time()-($this->sync_interval*3)) echo "no";
        else echo "yes";
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

    public function add_log() {
        $this->printer($_POST);
    }

    public function run_query() {
        if(!isset($_POST['query'])) exit('0');
        // echo $_POST['query'];
        echo $this->m_sync->run_query($_POST['query']);
    }
}
