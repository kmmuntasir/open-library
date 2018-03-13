<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Base_Controller {

	public $module = 'user';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        $this->__security($this->module);

        $this->load->model($this->module."/m_profile"); // Loading Model

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('user/profile');
    }
    //====================================//

	public function index() {
        $data = $this->data;
        $data['page'] = 'user';
        $data['page_title'] .= 'Profile';
        $data['user'] = $this->m_profile->details();
        $code = $data['user']->user_library_code;
        //$code = $this->__unique_code(7);
        $data['barcode_url'] = $this->__barcode($code, 8, 6.00);
        $data['content'] = 'v_profile.php';
        //$this->printer($data['user'], true);
        $this->load->view($this->viewpath.'v_main', $data);
	}

    public function change_pass() {
    	$user_id = $this->session->userdata['user_id'];
    	$user = $this->m_profile->details();
    	if($user->user_pass != md5($_POST['old_pass'])) $this->redirect_msg(site_url('user/profile'), 'Incorrent Password', 'danger');
    	if($_POST['pass_1'] != $_POST['pass_2']) $this->redirect_msg(site_url('user/profile'), 'Passwords don\'t match', 'danger');
    	$status = $this->m_profile->update(array('user_pass'=>md5($_POST['pass_1'])));
    	if($status) $this->redirect_msg('user/profile', 'Successfully Updated Password', 'success');
        else $this->redirect_msg('user/profile', 'Something Went Wrong', 'danger');
    }

    public function new_code() {
        $user_id = $this->session->userdata['user_id'];
        $user = $this->m_profile->details();
        if($user->user_pass != md5($_POST['user_pass'])) $this->redirect_msg(site_url('user/profile'), 'Incorrent Password', 'danger');
        $flag = true;
        do {
            $new_code = $this->__unique_code($this->library_code_length);
            if(!$this->m_profile->check_library_code($new_code)) $flag = false;
        }while($flag);
        $status = $this->m_profile->update(array('user_library_code'=>$new_code));
        if($status) $this->redirect_msg('user/profile', 'Successfully Generated New Library Code<br />New Code is: '.$new_code, 'success');
        else echo $this->redirect_msg('user/profile', 'Something Went Wrong', 'danger');
    }

    public function print_view() {
        $data = $this->data;
        $data['page'] = 'user';
        $data['page_title'] .= 'Profile';
        $data['user'] = $this->m_profile->details();
        $code = $data['user']->user_library_code;
        //$code = $this->__unique_code(7);
        $data['barcode_url'] = $this->__barcode($code, 8, 6.00);
        $data['content'] = 'v_print_view.php';
        //$this->printer($data['user'], true);
        $this->load->view($this->viewpath.'v_print', $data);
    }

    
}
