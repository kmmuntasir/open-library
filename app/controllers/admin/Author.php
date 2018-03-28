<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends Base_Controller {

	public $module = 'admin';	// defines the module
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
        $this->data['controller'] = site_url('admin/author');
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
        echo $this->to_datatable_json_format($authors, 1, 1);
    }

    public function add() {
        if($_POST['author_name'] == '') $this->redirect_msg('/admin/author', 'Pleae input an Author name', 'danger');
        if($this->m_author->check_for_existing_author($_POST['author_name'])) $this->redirect_msg('/admin/author', 'Same Author Already Exists', 'danger');

        $_POST['author_id'] = $this->m_author->new_id('author');
        $insert_id = $this->m_author->add_author($_POST);
        if($insert_id) $this->redirect_msg('/admin/author', 'Author Added Successfully', 'success');
        else $this->redirect_msg('/admin/author', 'Something went wrong!', 'danger');
    }

    public function single_author($author_id=NULL) {
        if(!$author_id) echo false;
        echo json_encode($this->m_author->get_single_author($author_id));
    }

    public function update($author_id=NULL) {
        if(!$author_id) redirect_msg('/admin/author');
        $aff = $this->m_author->update_author($author_id, $_POST);
        if($aff) $this->redirect_msg('/admin/author', 'Author Updated Successfully', 'success');
        else $this->redirect_msg('/admin/author', 'Something went wrong!', 'danger');
    }

    public function delete($author_id=NULL) {
        if(!$author_id) redirect_msg('/admin/author');
        $count = $this->m_author->check_author($author_id);
        if($count > 0) $this->redirect_msg('/admin/author', 'There are existing books from this author', 'danger');
        $aff = $this->m_author->delete_author($author_id);
        if($aff) $this->redirect_msg('/admin/author', 'Author Deleted Successfully', 'success');
        else $this->redirect_msg('/admin/author', 'Something went wrong!', 'danger');
    }
    
    public function merge($target_id=NULL) {
        if(!$target_id) die('No Target');
        if(!isset($_POST['merge_items'])) die('Invalid Data');

        $items = $_POST['merge_items'];
        $items = json_decode($items);

        $status = $this->m_author->merge($target_id, $items);
        if($status) echo 'success';
        else echo 'failed';
    }
}
