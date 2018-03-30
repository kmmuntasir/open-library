<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends Base_Controller {

	public $module = 'admin';	// defines the module
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
        $this->load->model($this->module."/m_issue");

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('admin/book');
    }
    //====================================//

	public function index() {
        $data = $this->data;
        $data['page'] = 'books';
        $data['page_title'] .= 'Books';
        //$data['books'] = $this->m_book->all_books();
        // foreach($data['books'] as $key => $book) {
        //     $data['books'][$key]->authors = $this->m_book->book_authors($book->book_id);
        // }
        $data['authors'] = $this->m_author->all_authors();
        $data['categories'] = $this->m_category->all_categories();
        $data['publications'] = $this->m_publication->all_publications();
        $data['content'] = 'v_books.php';
        $data['source'] = $this->data['controller'].'/all_books_json';
        //$this->printer($data['books'], true);
        $this->load->view($this->viewpath.'v_main', $data);
	}

    public function all_books_json() {
        $books = $this->m_book->all_books_json();
        //$this->printer($books, true);
        ini_set('memory_limit', '-1');
        echo $this->book_to_datatable($books, 1, 1);
    }

    public function book_by_filter_json($filter=NULL, $id=NULL) {
        if($filter == 1) $books = $this->m_book->all_books_by_author($id);
        else if($filter == 2) $books = $this->m_book->all_books_by_category($id);
        else if($filter == 3) $books = $this->m_book->all_books_by_publication($id);

        foreach($books as $key => $book) {
            $books[$key]->authors = $this->m_book->book_authors($book->book_id);
        }

        //$this->printer($books);
        echo $this->book_to_datatable($books, 1, 1);
    }


    public function book_by_filter($filter=NULL, $id=NULL) {
        if(!($filter && $id)) $this->redirect_msg('admin/book', 'No Filter Selected', 'danger');
        $data = $this->data;
        $data['page'] = 'books';
        $data['page_title'] .= 'Books by ';
        if($filter == 1) {
            //$data['books'] = $this->m_book->all_books_by_author($id);
            $data['page_title'] .= 'Author';
        }
        else if($filter == 2) {
            //$data['books'] = $this->m_book->all_books_by_category($id);
            $data['page_title'] .= 'Category';
        }
        else if($filter == 3) {
            //$data['books'] = $this->m_book->all_books_by_publication($id);
            $data['page_title'] .= 'Publication';
        }
        else $this->redirect_msg('admin/book', 'Wrong Filter', 'danger');

        $data['authors'] = $this->m_author->all_authors();
        $data['categories'] = $this->m_category->all_categories();
        $data['publications'] = $this->m_publication->all_publications();
        $data['content'] = 'v_books.php';
        $data['source'] = $this->data['controller'].'/book_by_filter_json/'.$filter.'/'.$id;
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
            $book->book_add_date = date('M d, Y', strtotime($book->book_add_date));
            $book->timestamp = date('M d, Y', strtotime($book->timestamp));
            foreach($book->book_copies as $key => $copy) $book->book_copies[$key]->book_copy_date = date('M d, Y', strtotime($copy->book_copy_date));
            //$this->printer($book, true);
            echo json_encode($book);
        }
        else echo false;
    }

    public function add() {
        $_POST['book_id'] = $this->m_book->new_id('book');
        $book = $_POST;
        unset($book['num_of_authors']);
        unset($book['num_of_categories']);
        unset($book['publication_name']);
        $book['manager_id'] = $this->session->admin_id;
        $book['book_add_date'] = date('Y-m-d H:i:s');

        $book_duplicate = $this->m_book->check_book_title_edition($book['book_title'], $book['book_edition']);
        if($book_duplicate) $this->redirect_msg('/admin/book', 'Same edition of this book already exists', 'danger');
        $book_duplicate = $this->m_book->check_duplicate_isbn($book['book_isbn']);
        if($book_duplicate) $this->redirect_msg('/admin/book', 'Duplicate ISBN Number', 'danger');

        $authors = $categories = array();
        $publication_name = $_POST['publication_name'];
        
        $num_of_authors = $_POST['num_of_authors']; // Processing Authors
        for($i=1; $i<=$num_of_authors; ++$i) {
            $field = 'author_'.$i;
            array_push($authors, $book[$field]);
            unset($book[$field]);
        }

        $num_of_categories = $_POST['num_of_categories']; // Processing Categories
        for($i=1; $i<=$num_of_categories; ++$i) {
            $field = 'category_'.$i;
            array_push($categories, $book[$field]);
            unset($book[$field]);
        }
        $status = $this->m_book->add_book($book, $publication_name, $authors, $categories);
        if($status) $this->redirect_msg('/admin/book', 'Book Added Successfully', 'success');
        else $this->redirect_msg('/admin/book', 'Something went wrong!', 'danger');
    }

    public function update($book_id=NULL) {
        if(!$book_id) redirect_msg('/admin/book');
        $book = $_POST;
        unset($book['num_of_authors']);
        unset($book['num_of_categories']);
        unset($book['publication_name']);

        $book_duplicate = $this->m_book->check_book_title_edition($book['book_title'], $book['book_edition']);
        if($book_duplicate) {
            if($book_duplicate->book_id != $book_id) // Different entry with same name and edition
                $this->redirect_msg('/admin/book', 'Same edition of this book already exists', 'danger');
        }
        $book_duplicate = $this->m_book->check_duplicate_isbn($book['book_isbn']);
        if($book_duplicate) {
            if($book_duplicate->book_id != $book_id) // Different entry with same ISBN
                $this->redirect_msg('/admin/book', 'Duplicate ISBN Number', 'danger');
        }

        $authors = $categories = array();
        $publication_name = $_POST['publication_name'];
        
        $num_of_authors = $_POST['num_of_authors']; // Processing Authors
        for($i=1; $i<=$num_of_authors; ++$i) {
            $field = 'author_'.$i;
            array_push($authors, $book[$field]);
            unset($book[$field]);
        }

        $num_of_categories = $_POST['num_of_categories']; // Processing Categories
        for($i=1; $i<=$num_of_categories; ++$i) {
            $field = 'category_'.$i;
            array_push($categories, $book[$field]);
            unset($book[$field]);
        }

        $status = $this->m_book->update_book($book_id, $book, $publication_name, $authors, $categories);
        if($status) $this->redirect_msg('/admin/book', 'Book Updated Successfully', 'success');
        else $this->redirect_msg('/admin/book', 'Something went wrong!', 'danger');
    }

    public function delete($book_id=NULL) {
        if(!$book_id) redirect_msg('/admin/book', 'Invalid Book ID', 'danger');
        if($this->m_book->check_book_for_issue($book_id)) redirect_msg('/admin/book', 'This book has incomplete issues with it.', 'danger');
        $aff = $this->m_book->delete_book($book_id);
        if($aff) $this->redirect_msg('/admin/book', 'Book Deleted Successfully', 'success');
        else $this->redirect_msg('/admin/book', 'Something went wrong!', 'danger');
    }

    public function copy() {
        $data = $this->data;
        $data['page'] = 'book_copy';
        $data['page_title'] .= 'Manage Book Copy';
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

    public function add_copy($book_id=NULL) {
        if(!$book_id) redirect_msg('/admin/book');
        if($this->m_book->check_book_existence($book_id) != 1) $this->redirect_msg('/admin/book', 'Invalid Book ID', 'danger');

        $book_copy_single = $_POST;
        unset($book_copy_single['book_copy_num']);
        $book_copy_single['book_copy_date'] = date('Y-m-d');
        $book_copy_single['book_id'] = $book_id;
        $book_copy_single['book_copy_manager_id'] = $this->session->admin_id;
        $book_copy_single['book_copy_status'] = 1;
        $acc = $_POST['book_copy_accession_no'];

        $book_copy = array();
        $i = $_POST['book_copy_num'];
        while($i--) {
            $book_copy_single['book_copy_accession_no'] = $this->config->item('branch').'_c_'.$acc;
            array_push($book_copy, $book_copy_single);
            ++$acc;
        }

        // $this->printer($_POST);
        // $this->printer($book_copy, true);

        $aff = $this->m_book->add_copy($book_copy, $_POST['book_copy_type']);
        if($aff) $this->redirect_msg('/admin/book', 'Copies Added Successfully', 'success');
        else $this->redirect_msg('/admin/book', 'Something went wrong!', 'danger');
    }

    public function update_copy($book_copy_accession_no) {
        if(!$book_copy_accession_no) redirect_msg('/admin/book');
        $aff = $this->m_book->update_copy($book_copy_accession_no, $_POST);
        if($aff) $this->redirect_msg('/admin/book', 'Copy Updated Successfully', 'success');
        else $this->redirect_msg('/admin/book', 'Something went wrong!', 'danger');
    }

    public function delete_copy($book_copy_accession_no) {
        if(!$book_copy_accession_no) redirect_msg('/admin/book');
        $book = $this->m_book->get_single_copy_details($book_copy_accession_no);
        if($book->book_copy_status==0) $this->redirect_msg('/admin/book', 'This copy is currently issued by someone', 'danger');
        if($book->book_copy_is_deleted) $this->redirect_msg('/admin/book', 'It\'s already a deleted copy', 'danger');
        $status = $this->m_book->delete_copy($book_copy_accession_no, $book);
        if($status) $this->redirect_msg('/admin/book', 'Copy Deleted Successfully', 'success');
        else $this->redirect_msg('/admin/book', 'Something went wrong!', 'danger');
    }

    public function delete_copy_range() {
        $aff = $this->m_book->delete_copy_range($_POST['book_id'], $_POST['book_copy_accession_no_1'], $_POST['book_copy_accession_no_2']);
        if($aff) $this->redirect_msg('/admin/book/copy', 'Copies Deleted Successfully', 'success');
        else $this->redirect_msg('/admin/book/copy', 'Something went wrong!', 'danger');
    }

    public function last_accession_number() {
        echo $this->m_book->last_accession_number();
    }

    public function book_to_datatable($books, $json_output = false, $test_multiplier=1) {
        $json_data = array('data' => array());
        $i=0;

        for($m = 0; $m < $test_multiplier; ++$m) {
            foreach($books as $key=>$book) {
                $json_data['data'][$i] = array();

                $read_flag = ($book->book_url != NULL && $book->book_url != '')?1:0;
                
                array_push($json_data['data'][$i], $book->book_id);
                array_push($json_data['data'][$i], $book->book_title);
                array_push($json_data['data'][$i], json_encode($this->m_book->book_authors($book->book_id)));
                array_push($json_data['data'][$i], $book->book_edition);
                array_push($json_data['data'][$i], $book->book_isbn);
                array_push($json_data['data'][$i], json_encode(array($book->publication_id, $book->publication_name)));
                array_push($json_data['data'][$i], $book->book_stock);
                array_push($json_data['data'][$i], $book->book_available);
                array_push($json_data['data'][$i], $read_flag);
                array_push($json_data['data'][$i], $book->book_url_unlocked);
                array_push($json_data['data'][$i], $book->book_id);
                
                ++$i;
            }
        }
        if($json_output) return json_encode($json_data);
        else return $json_data;
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
}
