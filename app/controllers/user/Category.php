<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Base_Controller {

	public $module = 'user';	// defines the module
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
        $this->data['controller'] = site_url('user/category');
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


    public function all_categories_json() {
        $categories = $this->m_category->all_categories();
        echo $this->to_datatable_json_format($categories, 1, 1);
    }

    public function single_category($category_id=NULL) {
        if(!$category_id) echo false;
        echo json_encode($this->m_category->get_single_category($category_id));
    }
}
