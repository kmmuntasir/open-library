<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends Base_Controller {

	public $module = 'user';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        $this->__security($this->module);

        $this->load->model($this->module."/m_book"); // Loading Model
        $this->load->model($this->module."/m_author");
        $this->load->model($this->module."/m_category");
        $this->load->model($this->module."/m_publication");

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('user/book');
    }
    //====================================//

	public function index() {
        $data = $this->data;
        $data['page'] = 'books';
        $data['page_title'] .= 'Books';
        $data['books'] = $this->m_book->all_books();
        foreach($data['books'] as $key => $book) {
            $data['books'][$key]->authors = $this->m_book->book_authors($book->book_id);
            //$data['books'][$key]->categories = $this->m_book->book_categories($book->book_id);
        }
        
        $data['content'] = 'v_books.php';
        //$this->printer($data['books'], true);
        $this->load->view($this->viewpath.'v_main', $data);
	}


    public function book_by_filter($filter=NULL, $id=NULL) {
        if(!($filter && $id)) $this->redirect_msg('user/book', 'No Filter Selected', 'danger');
        $data = $this->data;
        $data['page'] = 'books';
        $data['page_title'] .= 'Books by ';
        if($filter == 1) {
            $data['books'] = $this->m_book->all_books_by_author($id);
            $data['page_title'] .= 'Author';
        }
        else if($filter == 2) {
            $data['books'] = $this->m_book->all_books_by_category($id);
            $data['page_title'] .= 'Category';
        }
        else if($filter == 3) {
            $data['books'] = $this->m_book->all_books_by_publication($id);
            $data['page_title'] .= 'Publication';
        }
        else $this->redirect_msg('user/book', 'Wrong Filter', 'danger');
        if($data['books'] != '') {
            foreach($data['books'] as $key => $book) {
                $data['books'][$key]->authors = $this->m_book->book_authors($book->book_id);
                //$data['books'][$key]->categories = $this->m_book->book_categories($book->book_id);
            }
        }
        else $this->redirect_msg('user/book', 'Invalid ID', 'danger');
        $data['authors'] = $this->m_author->all_authors();
        $data['categories'] = $this->m_category->all_categories();
        $data['publications'] = $this->m_publication->all_publications();
        $data['content'] = 'v_books.php';
        //$this->printer($data['books'], true);
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function single_book($book_id=NULL) {
        if(!$book_id) echo false;
        $book = $this->m_book->get_single_book($book_id);
        if($book) {
            $book->authors = $this->m_book->book_authors($book->book_id);
            $book->categories = $this->m_book->book_categories($book->book_id);
            $book->book_copies = $this->m_book->get_all_copies($book_id);
            foreach($book->book_copies as $key => $copy) $book->book_copies[$key]->book_copy_date = date('M d, Y', strtotime($copy->book_copy_date));
            //$this->printer($book, true);
            echo json_encode($book);
        }
        else echo false;
    }

    public function copy() {
        $data = $this->data;
        $data['page'] = 'book_copy';
        $data['page_title'] .= 'Book Copy';
        $data['content'] = 'v_book_copy.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function copy_details($book_copy_accession_no=NULL) {
        if(!$book_copy_accession_no) echo 0;

        $book_copy = $this->m_book->get_single_copy_details($book_copy_accession_no);
        if($book_copy) {
            $book_copy->book_add_date = date('M d, Y', strtotime($book_copy->book_add_date));
            $book_copy->book_copy_date = date('M d, Y', strtotime($book_copy->book_copy_date));
            $book_copy->authors = $this->m_book->book_authors($book_copy->book_id);
            $book_copy->categories = $this->m_book->book_categories($book_copy->book_id);
            echo json_encode($book_copy);
        }
        else echo false;

        //$this->printer($book_copy);
    }

    public function read_online($book_id=NULL) {
        if(!$book_id) die('<center><h1>Sorry, Broken Link</h1></center>');
        $data = $this->data;
        if(!$data['book_url'] = $this->m_book->book_url($book_id)) die('<center><h1>Sorry, Invalid Book ID</h1></center>');
        $data['page'] = 'books';
        $data['page_title'] .= 'Read Online';
        //$this->printer($data, true);
        $this->load->view($this->viewpath.'/contents/v_book_read_online', $data);
    }

    public function update_book_url($book_id=NULL) {
        if(!$book_id) $this->redirect_msg('user/book', 'Invalid Book ID', 'danger');
        if(!($book = $this->m_book->get_single_book($book_id))) $this->redirect_msg('user/book', 'Invalid Book ID', 'danger');

        if($book->book_url_unlocked == 0) $this->redirect_msg('user/book', 'Online Reading URL for this book is locked', 'danger');


        //$this->printer($_POST, true);
        $status = $this->m_book->update_book_url($book_id, $_POST['book_url']);
        if($status) $this->redirect_msg('user/book', 'Successfully Updated Book URL for Book #'.$book_id, 'success');
        else $this->redirect_msg('user/book', 'Something Went Wrong', 'danger');
    }
}
