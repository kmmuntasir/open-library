<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Base_Controller {

	public $module = 'admin';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        
        $this->load->model($this->module."/m_admin"); // Loading Model

        $this->viewpath = $this->module.'/'.$this->template.'/';    // Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('admin/login');
    }
    //====================================//

    public function index() {
    	if(!isset($_GET['url'])) $url = $this->module.'/dashboard';
  		else $url = $_GET['url'];

        $this->session->set_userdata('url_segment', $url);

    	if($this->__is_logged_in($this->module)) redirect($url);

    	$data = $this->data;
        $data['page'] = 'login';
        $data['page_title'] .= 'Library Admin Login';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function login_process() {
        extract($_POST);
    	$result = $this->m_admin->login_check_manager($username, md5($password));
        $url = $this->session->userdata('url_segment');
    	if($result) {
    		$temp = array('admin_id' => $result->manager_id, 'admin_type' => $result->is_admin, 'admin_name' =>$result->manager_name);
    		$this->session->set_userdata($temp);
            $this->session->unset_userdata('url_segment');
            if($url == '') $url = "admin/dashboard";
            // echo site_url($url).'<br>';
            // $this->printer($_SESSION, true);
    		redirect(site_url($url));
    	}
        $url = ($url != $this->module.'/dashboard') ? '?url='.$url : '';
        $this->redirect_msg(site_url($this->module.'/login'.$url), 'Invalid Username/Password', 'danger');
    }

    public function logout() {
    	$temp = array('admin_id', 'admin_type');
    	$this->session->unset_userdata($temp);
    	redirect(site_url($this->module.'/login'));
    }
}
