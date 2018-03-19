<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publication extends Base_Controller {

	public $module = 'user';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        $this->__security($this->module);

        $this->load->model($this->module."/m_publication"); // Loading Model

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('user/publication');
    }
    //====================================//

	public function index() {
        $data = $this->data;
        $data['page'] = 'publications';
        $data['page_title'] .= 'Publications';
        //$data['publications'] = $this->m_publication->all_publications();
        $data['content'] = 'v_publications.php';
        $data['source'] = $this->data['controller'].'/all_publications_json';
        $this->load->view($this->viewpath.'v_main', $data);
	}

    public function all_publications_json() {
        $publications = $this->m_publication->all_publications();
        //$this->printer($publications);
        echo $this->to_datatable_json_format($publications, 1, 1);
    }

    public function single_publication($publication_id=NULL) {
        if(!$publication_id) echo false;
        echo json_encode($this->m_publication->get_single_publication($publication_id));
    }
}
