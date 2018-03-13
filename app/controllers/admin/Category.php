<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Base_Controller {

	public $module = 'admin';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        $this->__security($this->module);

        $this->load->model($this->module."/m_category"); // Loading Model

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('admin/category');
    }
    //====================================//

	public function index() {
        $data = $this->data;
        $data['page'] = 'categories';
        $data['page_title'] .= 'Categories';
        $data['categories'] = $this->m_category->all_categories();
        $data['content'] = 'v_categories.php';
        $this->load->view($this->viewpath.'v_main', $data);
	}

    public function add() {
        $_POST['category_id'] = $this->m_category->new_id('category');
        $insert_id = $this->m_category->add_category($_POST);
        if($insert_id) $this->redirect_msg('/admin/category', 'Category Added Successfully', 'success');
        else $this->redirect_msg('/admin/category', 'Something went wrong!', 'danger');
    }

    public function single_category($category_id=NULL) {
        if(!$category_id) echo false;
        echo json_encode($this->m_category->get_single_category($category_id));
    }

    public function update($category_id=NULL) {
        if(!$category_id) redirect_msg('/admin/category');
        $aff = $this->m_category->update_category($category_id, $_POST);
        if($aff) $this->redirect_msg('/admin/category', 'Category Updated Successfully', 'success');
        else $this->redirect_msg('/admin/category', 'Something went wrong!', 'danger');
    }

    public function delete($category_id=NULL) {
        if(!$category_id) redirect_msg('/admin/category');
        $count = $this->m_category->check_category($category_id);
        if($count > 0) $this->redirect_msg('/admin/category', 'There are existing books from this category', 'danger');
        $aff = $this->m_category->delete_category($category_id);
        if($aff) $this->redirect_msg('/admin/category', 'Category Deleted Successfully', 'success');
        else $this->redirect_msg('/admin/category', 'Something went wrong!', 'danger');
    }
}
