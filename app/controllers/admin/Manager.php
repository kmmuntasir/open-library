<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends Base_Controller {

	public $module = 'admin';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        $this->__security($this->module);

        $this->load->model($this->module."/m_manager"); // Loading Model

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('admin/manager');
    }
    //====================================//

	public function index() {
		$data = $this->data;
        $data['page'] = 'managers';
    	$data['page_title'] .= 'Managers';
        $data['source'] = $this->data['controller'].'/all_managers_json';

        //$data['managers'] = $this->m_manager->all_managers();

        //$this->printer($data, true);

    	$data['content'] = 'v_managers.php';
    	$this->load->view($this->viewpath.'v_main', $data);
	}

    public function all_managers_json() {
        $managers = $this->m_manager->all_managers();
        //$this->printer($managers);
        echo $this->to_datatable_json_format($managers, 1, 1);
    }

    public function single_manager($manager_id=NULL) {
        if(!$manager_id) echo false;
        echo json_encode($this->m_manager->get_single_manager($manager_id));
    }

    public function add() {
        if($_POST['manager_pass_1'] != $_POST['manager_pass_2']) $this->redirect_msg('/admin/manager', 'Passwords do not match!', 'danger');
        $_POST['manager_id'] = $this->m_manager->new_id('manager');
        $_POST['manager_pass'] = md5($_POST['manager_pass_1']);
        unset($_POST['manager_pass_1']);
        unset($_POST['manager_pass_2']);

        if($this->m_manager->manager_handle_check($_POST['manager_user']) > 0) $this->redirect_msg('/admin/manager', 'Username "'.$_POST['manager_user'].'" is not available', 'danger');

        $insert_id = $this->m_manager->add_manager($_POST);
        if($insert_id) $this->redirect_msg('/admin/manager', 'Manager Added Successfully', 'success');
        else $this->redirect_msg('/admin/manager', 'Something went wrong!', 'danger');
    }

    public function update($manager_id=NULL) {
        if(!$manager_id) redirect_msg('/admin/manager');
        //$this->printer($_POST);

        if($_POST['manager_pass_1'] != $_POST['manager_pass_2']) $this->redirect_msg('/admin/manager', 'Passwords do not match!', 'danger');
        if($_POST['manager_pass_1'] == $_POST['manager_pass_2'] && $_POST['manager_pass_2'] != '') $_POST['manager_pass'] = md5($_POST['manager_pass_1']);
        unset($_POST['manager_pass_1']);
        unset($_POST['manager_pass_2']);

        if($this->m_manager->manager_handle_check($_POST['manager_user']) > 0 && $manager_id != $this->m_manager->get_manager_by_username($_POST['manager_user'])->manager_id) $this->redirect_msg('/admin/manager', 'Username "'.$_POST['manager_user'].'" is not available', 'danger');

        $aff = $this->m_manager->update_manager($manager_id, $_POST);
        if($aff) $this->redirect_msg('/admin/manager', 'Manager Updated Successfully', 'success');
        else $this->redirect_msg('/admin/manager', 'Something went wrong!', 'danger');
    }

    public function delete($manager_id=NULL) {
        if(!$manager_id) redirect_msg('/admin/manager');
        $count = $this->m_manager->check_manager($manager_id);
        if($count > 0) $this->redirect_msg('/admin/manager', 'There are existing books from this manager', 'danger');
        $aff = $this->m_manager->delete_manager($manager_id);
        if($aff) $this->redirect_msg('/admin/manager', 'Manager Deleted Successfully', 'success');
        else $this->redirect_msg('/admin/manager', 'Something went wrong!', 'danger');
    }
}
