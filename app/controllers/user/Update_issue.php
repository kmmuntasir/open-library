<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_issue extends Base_Controller {

	public $module = 'user';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        //$this->__security($this->module);

        $this->load->model($this->module."/m_issue"); // Loading Model
        $this->load->model($this->module."/m_book");

        // $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        // $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        // $this->data['page_title'] = '';
        // $this->data['module'] = $this->module;
        // $this->data['page'] = '';
        // $this->data['controller'] = site_url('user/issue');
    }

    //====================================//

	public function index() {
        echo 'Hello';
	}

    public function update_issue() {
        $new = json_decode($_POST['curl_data'], true);
        if($this->m_issue->update_issue($new['book'], $new['issue'])) echo 1;
        else echo 0;
    }
}
