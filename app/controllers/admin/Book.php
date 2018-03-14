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
        $data['books'] = $this->m_book->all_books();
        foreach($data['books'] as $key => $book) {
            $data['books'][$key]->authors = $this->m_book->book_authors($book->book_id);
        }
        $data['authors'] = $this->m_author->all_authors();
        $data['categories'] = $this->m_category->all_categories();
        $data['publications'] = $this->m_publication->all_publications();
        $data['content'] = 'v_books.php';
        //$this->printer($data['books'], true);
        $this->load->view($this->viewpath.'v_main', $data);
	}

    public function all_books_json() {
        $books = $this->m_book->all_books();

        $json_data = array();
        $json_data['data'] = array();
        $i = 0;
        foreach($books as $key => $book) {
            $book->authors = $this->m_book->book_authors($book->book_id);
            $json_data['data'][$i] = array();

            array_push($json_data['data'][$i], $book->book_id);

            $content = '<a style="color:#f00;" title="View Issue History for this Book" href="'.site_url().'/admin/issue/issue_by_book/'.$book->book_id.'">'.$book->book_title.'</a>';
            array_push($json_data['data'][$i], $content);

            $content = '';
            foreach($book->authors as $a_key => $author) {
              $content .= '<a title="View All Books by this Author" href="'.$this->data['controller'].'/book_by_filter/1/'.$author->author_id.'">'.$author->author_name.'</a><br />';
            }
            array_push($json_data['data'][$i], $content);

            array_push($json_data['data'][$i], $book->book_edition);

            array_push($json_data['data'][$i], $book->book_isbn);

            $content = '<a title="View All Books by this Publisher" href="'.$this->data['controller'].'/book_by_filter/3/'.$book->publication_id.'">'.$book->publication_name.'</a>';
            array_push($json_data['data'][$i], $content);

            array_push($json_data['data'][$i], $book->book_stock);

            array_push($json_data['data'][$i], $book->book_available);

            $content = '';
            if($book->book_url != NULL && $book->book_url != '') {
              $content = '<a target="_blank" href="'.site_url('user/book/read_online/'.$book->book_id).'" title="'.$book->book_url.'" class="btn btn-primary btn-xs">Read</a>';
            }
            array_push($json_data['data'][$i], $content);

            $content = '<a title="View Book Details" href="#" book_id="'.$book->book_id.'" class="view_book btn btn-xs btn-primary"><i class="fa fa-eye"></i></a><a title="Add Copies for this Book" href="#" book_id="'.$book->book_id.'" class="addCopy btn btn-xs btn-success"><i class="fa fa-copy"></i></a><a title="Edit Book Details" href="#" book_id="'.$book->book_id.'" class="edit edit_book btn btn-xs btn-info"><i class="fa fa-pencil"></i></a><a title="Delete Book" href="'.$this->data['controller'].'/delete/'.$book->book_id.'" class="delete btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
            array_push($json_data['data'][$i], $content);


                


            ++$i;
        }

        $this->printer($json_data);
        echo json_encode($json_data);
    }


    public function book_by_filter($filter=NULL, $id=NULL) {
        if(!($filter && $id)) $this->redirect_msg('admin/book', 'No Filter Selected', 'danger');
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
        else $this->redirect_msg('admin/book', 'Wrong Filter', 'danger');
        if($data['books'] != '') {
            foreach($data['books'] as $key => $book) {
                $data['books'][$key]->authors = $this->m_book->book_authors($book->book_id);
                //$data['books'][$key]->categories = $this->m_book->book_categories($book->book_id);
            }
        }
        else $this->redirect_msg('admin/book', 'Invalid ID', 'danger');
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
}
