<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Base_Controller {

	public $module = 'admin';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        $this->__security($this->module);

        $this->load->model($this->module."/m_settings"); // Loading Model

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url($this->module.'/settings');
    }
    //====================================//

	public function index() {
        $data = $this->data;
        $data['page'] = 'settings';
        $data['subpage'] = 'app_settings';
        $data['page_title'] .= 'App Settings';
        $data['settings'] = $this->m_settings->all_settings();
        $data['content'] = 'v_settings.php';
        //$this->printer($data['settings']);
        $this->load->view($this->viewpath.'v_main', $data);
    }
    
    public function update_settings() {
        //$this->printer($_POST);
        $server = array();
        $server['server_url'] = $_POST['server_url'];
        $server['server_access_code'] = $_POST['remote_access_code'];
        unset($_POST['server_url']);
        unset($_POST['remote_access_code']);

        $settings = $_POST;
        $settings['server_access_code'] = $settings['local_access_code'];
        unset($settings['local_access_code']);

        // $this->printer($settings);
        // $this->printer($server);

        $status = $this->m_settings->update_settings($settings, $server);

        if($status) $this->redirect_msg($this->module.'/settings', 'Settings Saved Successfully', 'success');
        else $this->redirect_msg($this->module.'/settings', 'Something went wrong!', 'danger');
    }

    public function update_info() {
        // $this->printer($_POST);
        // $this->printer($_FILES, true);
        $old_settings = $this->m_settings->all_settings();
        $settings = $_POST;
        $flag = true;
        $total_error = '';


        // Uploading Logo and Favicon
        //=====================================================
        // Configuration for Logo Upload
        $config['upload_path']          = 'images/';
        $config['allowed_types']        = 'jpg|jpeg|png|bmp|gif|ico';
        $config['max_size']             = 10240;

        // Uploading Logo Image
        if($_FILES['institute_logo']['error'] == 0) {
            $upload = $this->__do_upload('institute_logo', $config);

            if(!$upload['error']) $settings['institute_logo'] = $upload['success']['file_name'];
            else {
                $flag = false;
                $total_error .= 'Logo Upload Error<br>'.$upload['error'];
            }
        }

        // Uploading Favicon
        if($_FILES['institute_favicon']['error'] == 0) {
            $upload = $this->__do_upload('institute_favicon', $config);

            if(!$upload['error']) $settings['institute_favicon'] = $upload['success']['file_name'];
            else {
                $flag = false;
                $total_error .= 'Favicon Upload Error<br>'.$upload['error'];
                if(isset($settings['institute_logo'])) unlink('images/'.$settings['institute_logo']);
            }
        }
        //=======================================================


        if($flag) {
            $status = $this->m_settings->update_info($settings);

            // Removing Old Logo
            if(isset($settings['institute_logo'])) unlink('images/'.$old_settings->institute_logo);
            // Removing Old Favicon
            if(isset($settings['institute_favicon'])) unlink('images/'.$old_settings->institute_favicon);

            if($status) $this->redirect_msg($this->module.'/settings', 'Information Saved Successfully', 'success');
            else $this->redirect_msg($this->module.'/settings', 'Something went wrong!', 'danger');
        }
        else $this->redirect_msg($this->module.'/settings', $total_error, 'danger');
    }
}
