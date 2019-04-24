<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Idprint extends Base_Controller {

	public $module = 'user';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        $this->load->model($this->module."/m_user"); // Loading Model
        $this->load->model($this->module."/m_profile"); // Loading Model

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('user/Idprint');
    }
    //====================================//

	// public function index() {
 //        $data = $this->data;
 //        $data['page'] = 'user';
 //        $data['page_title'] .= 'Profile';
 //        $data['user'] = $this->m_profile->details();
 //        $code = $data['user']->user_library_code;
 //        //$code = $this->__unique_code(7);
 //        $data['barcode_url'] = $this->__barcode($code, 14, 6);
 //        $data['content'] = 'v_profile.php';
 //        //$this->printer($data['user'], true);
 //        $this->load->view($this->viewpath.'v_main', $data);
	// }


    public function index() {
        $data = $this->data;
        $data['page'] = 'credential';
        $data['page_title'] .= 'Library User Credential';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function printview() {
        // $this->printer($_POST, true);
        extract($_POST);
        $result = $this->m_user->login_check_user($username, md5($password));
        if(!$result) $this->redirect_msg(site_url($this->module.'/Idprint'), 'Invalid Username/Password', 'danger');


        $data = $this->data;
        $data['page'] = 'idprint';
        $data['page_title'] .= 'Print ID Card';
        $data['user'] = $this->m_profile->details($result->user_id);
        $code = $data['user']->user_library_code;
        $data['barcode_url'] = $this->__barcode($code, 8, 6.00);
        $data['content'] = 'v_print_view.php';
        //$this->printer($data['user'], true);
        $this->load->view($this->viewpath.'v_print', $data);
        
    }

    
}
