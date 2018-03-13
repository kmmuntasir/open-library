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

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('admin/sync');
    }
    //====================================//

	public function index() {
        $data = $this->data;
        $data['page'] = 'sync';
        $data['page_title'] .= 'Sync';

        $data['content'] = 'v_sync.php';
        $this->load->view($this->viewpath.'v_main', $data);
	}
}
