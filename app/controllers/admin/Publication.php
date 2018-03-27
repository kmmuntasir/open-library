<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publication extends Base_Controller {

	public $module = 'admin';	// defines the module
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
        $this->data['controller'] = site_url('admin/publication');
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
        echo $this->to_datatable_json_format($publications, 1, 1);
    }

    public function add() {
        if($_POST['publication_name'] == '') $this->redirect_msg('/admin/publication', 'Pleae input a publication name', 'danger');
        if($this->m_publication->check_for_existing_publication($_POST['publication_name'])) $this->redirect_msg('/admin/publication', 'Same Publication Already Exists', 'danger');

        $_POST['publication_id'] = $this->m_publication->new_id('publication');
        $insert_id = $this->m_publication->add_publication($_POST);
        if($insert_id) $this->redirect_msg('/admin/publication', 'Publication Added Successfully', 'success');
        else $this->redirect_msg('/admin/publication', 'Something went wrong!', 'danger');
    }

    public function single_publication($publication_id=NULL) {
        if(!$publication_id) echo false;
        echo json_encode($this->m_publication->get_single_publication($publication_id));
    }

    public function update($publication_id=NULL) {
        if(!$publication_id) redirect_msg('/admin/publication');
        $aff = $this->m_publication->update_publication($publication_id, $_POST);
        if($aff) $this->redirect_msg('/admin/publication', 'Publication Updated Successfully', 'success');
        else $this->redirect_msg('/admin/publication', 'Something went wrong!', 'danger');
    }

    public function delete($publication_id=NULL) {
        if(!$publication_id) redirect_msg('/admin/publication');
        $count = $this->m_publication->check_publication($publication_id);
        if($count > 0) $this->redirect_msg('/admin/publication', 'There are existing books from this publication', 'danger');
        $aff = $this->m_publication->delete_publication($publication_id);
        if($aff) $this->redirect_msg('/admin/publication', 'Publication Deleted Successfully', 'success');
        else $this->redirect_msg('/admin/publication', 'Something went wrong!', 'danger');
    }
}
