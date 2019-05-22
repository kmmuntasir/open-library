<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restore extends Base_Controller {

	public $module = 'admin';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct() {

        parent::__construct();
        if(!(isset($_GET['bypass_security']) && $_GET['bypass_security'] == 1)) $this->__security($this->module);

        $this->load->model($this->module."/m_admin"); // Loading Model
        $this->load->model($this->module."/m_issue");
        $this->load->model($this->module."/m_sync");
        $this->load->model($this->module."/m_book");

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('restore');
    }

	public function index() {
		$data = $this->data;
        $data['page'] = 'Restore';
    	$data['page_title'] .= 'Restore DB';
        $data['restore_action'] = site_url('admin/dashboard/restore?bypass_security=1');

        $data['content'] = 'v_restore.php';
    	$this->load->view($this->viewpath.'v_main', $data);
	}
}
