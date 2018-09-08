<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Base_Controller {

	public $module = 'user';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        
        $this->load->model($this->module."/m_user"); // Loading Model

        $this->viewpath = $this->module.'/'.$this->template.'/';    // Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('user/login');
    }
    //====================================//

    public function index() {
    	if(!isset($_GET['url'])) $url = $this->module.'/dashboard';
  		else $url = $_GET['url'];

        $this->session->set_userdata('url_segment', $url);

    	if($this->__is_logged_in($this->module)) redirect($url);

    	$data = $this->data;
        $data['page'] = 'login';
        $data['page_title'] .= 'Library User Login';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function login_process() {
        extract($_POST);
    	$result = $this->m_user->login_check_user($username, md5($password));
        $url = $this->session->userdata('url_segment');
    	if($result) {
    		$temp = array('user_id' => $result->user_id, 'user_type' => $result->is_teacher);
    		$this->session->set_userdata($temp);
            $this->session->unset_userdata('url_segment');
    		redirect(site_url($url));
    	}
        $url = ($url != $this->module.'/dashboard') ? '?url='.$url : '';
        $this->redirect_msg(site_url($this->module.'/login'.$url), 'Invalid Username/Password', 'danger');
    }

    public function logout() {
    	$temp = array('user_id', 'user_type');
    	$this->session->unset_userdata($temp);
    	redirect(site_url($this->module.'/login'));
    }

    public function request_password_reset() {
        $app_domain = $_SERVER['HTTP_HOST'];
        $admin_email = 'admin@'.$app_domain;
        if(!isset($_GET['url'])) $url = $this->module.'/dashboard';
  		else $url = $_GET['url'];

        $this->session->set_userdata('url_segment', $url);

        if($this->__is_logged_in($this->module)) redirect($url);
        

        if(!isset($_POST['user_username']) || !isset($_POST['user_email']))
            $this->redirect_msg(site_url($this->module.'/login'), 'Invalid Username/Email', 'danger');
        extract($_POST);
        if($user = $this->m_user->check_username_email($user_username, $user_email)) {
            do {
                $user_password_reset_code = $this->__unique_code(20, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
            }while($this->m_user->check_duplicate_reset_code($user_password_reset_code));
            $new_user['user_password_reset_code'] = $user_password_reset_code;
            if($stat = $this->m_user->update_user($new_user, $user->user_id)) {
                $reset_link = site_url($this->module.'/login/reset_password?reset_code='.$user_password_reset_code);
                $message = $this->password_reset_message($reset_link, $app_domain);                
                $this->__mail($admin_email, $user->user_email, 'Password reset link for '.$app_domain, $reset_link);
                $this->redirect_msg(site_url($this->module.'/login'), 'Successfully Requested for Password Reset<br>Please check your email for the password reset link<br>Don\'t forget to check your SPAM folder', 'success');
            }
            else $this->redirect_msg(site_url($this->module.'/login'), 'Something went wrong. Please try again later', 'danger');
            
        }
        else $this->redirect_msg(site_url($this->module.'/login'), 'Invalid Username/Email', 'danger');
    }

    public function reset_password() {
    	if(!isset($_GET['url'])) $url = $this->module.'/dashboard';
  		else $url = $_GET['url'];

        $this->session->set_userdata('url_segment', $url);

    	if($this->__is_logged_in($this->module)) redirect($url);

    	$data = $this->data;
        $data['page'] = 'set_new_password';
        $data['page_title'] .= 'Set a new password';

        if(!isset($_GET['reset_code'])) $this->redirect_msg(site_url($this->module.'/login'), 'Invalid Password Reset Code', 'danger');

        if($user = $this->m_user->get_user_by_password_reset_code($_GET['reset_code'])) {
            $data['user_password_reset_code'] = $user->user_password_reset_code;
            $this->load->view($this->viewpath.'v_main', $data);
        }
        else $this->redirect_msg(site_url($this->module.'/login'), 'Invalid Password Reset Code', 'danger');
    }

    public function reset_password_process($user_password_reset_code = false) {
        if(!$user_password_reset_code) $this->redirect_msg(site_url($this->module.'/login'), 'Invalid Password Reset Code', 'danger');
        if(!isset($_POST['pass_1']) || !isset($_POST['pass_2']))
            $this->redirect_msg(site_url($this->module.'/login/reset_password?reset_code='.$user_password_reset_code), 'Please fill out both password field', 'danger');
        if($user = $this->m_user->get_user_by_password_reset_code($user_password_reset_code)) {
            if($user->user_password_reset_code != $user_password_reset_code) $this->redirect_msg(site_url($this->module.'/login'), 'Invalid Password Reset Code', 'danger');
            if($_POST['pass_1'] != $_POST['pass_2'])
                $this->redirect_msg(site_url($this->module.'/login/reset_password?reset_code='.$user_password_reset_code), 'Passwords don\'t match', 'danger');
            $status = $this->m_user->update_user(array('user_pass'=>md5($_POST['pass_1']), 'user_password_reset_code'=>''), $user->user_id);
            if($status) $this->redirect_msg(site_url($this->module.'/login'), 'Successfully Changed Password<br>Please use your new password to log in from now on', 'success');
            else $this->redirect_msg(site_url($this->module.'/login/reset_password?reset_code='.$user_password_reset_code), 'Something went wrong. Please try again later', 'danger');
        }
        else $this->redirect_msg(site_url($this->module.'/login'), 'Invalid Password Reset Code', 'danger');
    }

    public function password_reset_message($reset_link, $app_domain) {
        $message = "<h1>Reset your password</h1><p>Recently you have requested for a password reset for your account at $app_domain. Please click the following link to reset the password.<br><br><a target='_blank' href='$reset_link'>Reset My Password</a></p>";
        return $message;
    }
}
