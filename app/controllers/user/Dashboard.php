<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Base_Controller {

	public $module = 'user';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        $this->__security($this->module);

        $this->load->model($this->module."/m_user"); // Loading Model

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('user/dashboard');
    }
    //====================================//


	public function index() {
        // echo $this->__unique_code(12);
        // exit();
        redirect(site_url('user/issue'));
		// $data = $this->data;
  //       $data['page'] = 'dashboard';
  //   	$data['page_title'] .= 'Dashboard';

  //   	$data['content'] = 'v_dashboard.php';
  //   	$this->load->view($this->viewpath.'v_main', $data);
	}
}
