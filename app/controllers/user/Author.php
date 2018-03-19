<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends Base_Controller {

	public $module = 'user';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        $this->__security($this->module);

        $this->load->model($this->module."/m_author"); // Loading Model

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('user/author');
    }
    //====================================//

	public function index() {
        $data = $this->data;
        $data['page'] = 'authors';
        $data['page_title'] .= 'Authors';
        //$data['authors'] = $this->m_author->all_authors();
        $data['content'] = 'v_authors.php';
        $data['source'] = $this->data['controller'].'/all_authors_json';
        $this->load->view($this->viewpath.'v_main', $data);
	}

    public function all_authors_json() {
        $authors = $this->m_author->all_authors();
        //$this->printer($authors);
        echo $this->to_datatable_json_format($authors, 1, 1);
    }

    public function single_author($author_id=NULL) {
        if(!$author_id) echo false;
        echo json_encode($this->m_author->get_single_author($author_id));
    }
}
