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
        $data['authors'] = $this->m_author->all_authors();
        $data['categories'] = $this->m_category->all_categories();
        $data['publications'] = $this->m_publication->all_publications();
        $data['content'] = 'v_books.php';
        $data['source'] = $this->data['controller'].'/all_books_json';
        // $this->printer($data, true);
        $this->load->view($this->viewpath.'v_main', $data);
	}

    public function all_books_json() {
        $books = $this->m_book->all_books_json();
        // $this->printer($books, true);
        ini_set('memory_limit', '-1');
        echo $this->book_to_datatable($books, 1, 1);
    }

    public function deleted_books() {
        $data = $this->data;
        $data['page'] = 'deleted_books';
        $data['page_title'] .= 'Deleted Books';
        $data['authors'] = $this->m_author->all_authors();
        $data['categories'] = $this->m_category->all_categories();
        $data['publications'] = $this->m_publication->all_publications();
        $data['content'] = 'v_books.php';
        $data['source'] = $this->data['controller'].'/all_deleted_books_json';
        // $this->printer($data, true);
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function all_deleted_books_json() {
        $books = $this->m_book->all_books_json(1);
        // $this->printer($books, true);
        ini_set('memory_limit', '-1');
        echo $this->book_to_datatable($books, 1, 1);
    }

    public function accession_list() {
        $data = $this->data;
        $data['page'] = 'accession_list';
        $data['page_title'] .= 'Accession List';
        $data['content'] = 'v_accession_list.php';
        $data['source'] = $this->data['controller'].'/accession_list_json';
        // $this->printer($data, true);
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function accession_list_json($is_deleted=0) {
        $book_copies = $this->m_book->accession_list_json($is_deleted);
        // echo $this->db->last_query();
        // $this->tabular($book_copies, true);

        ini_set('memory_limit', '-1');
        echo $this->to_datatable_json_format($book_copies, 1, 1);
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
            $book->deleted_copies = $this->m_book->get_all_deleted_copies($book_id);
            $book->book_add_date = date('M d, Y', strtotime($book->book_add_date));
            $book->timestamp = date('M d, Y', strtotime($book->timestamp));
            foreach($book->book_copies as $key => $copy) $book->book_copies[$key]->book_copy_date = date('M d, Y', strtotime($copy->book_copy_date));
            // $this->printer($book, true);
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

        // $book_duplicate = $this->m_book->check_book_title_edition($book['book_title'], $book['book_edition']);
        // if($book_duplicate) $this->redirect_msg('/admin/book', 'Same edition of this book already exists', 'danger');

        if($book['book_isbn'] != '') {
            $book_duplicate = $this->m_book->check_duplicate_isbn($book['book_isbn']);
            if($book_duplicate) $this->redirect_msg('/admin/book', 'Duplicate ISBN Number', 'danger');
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


        if($book['book_isbn'] != '') {
            $book_duplicate = $this->m_book->check_duplicate_isbn($book['book_isbn']);
            if($book_duplicate) {
                if($book_duplicate->book_id != $book_id) // Different entry with same ISBN
                    $this->redirect_msg('/admin/book', 'Duplicate ISBN Number', 'danger');
            }
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
        if(!$book_id) $this->redirect_msg('/admin/book', 'Invalid Book ID', 'danger');
        if($this->m_book->check_book_for_issue($book_id)) $this->redirect_msg('/admin/book', 'This book has incomplete issues with it.', 'danger');
        $aff = $this->m_book->delete_book($book_id);
        if($aff) $this->redirect_msg('/admin/book', 'Book Deleted Successfully', 'success');
        else $this->redirect_msg('/admin/book', 'Something went wrong!', 'danger');
    }

    public function restore($book_id=NULL) {
        if(!$book_id) $this->redirect_msg('/admin/book', 'Invalid Book ID', 'danger');
        // if($this->m_book->check_book_for_issue($book_id)) $this->redirect_msg('/admin/book', 'This book has incomplete issues with it.', 'danger');
        $aff = $this->m_book->restore_book($book_id);
        if($aff) $this->redirect_msg('/admin/book/deleted_books', 'Book Restored Successfully', 'success');
        else $this->redirect_msg('/admin/book/deleted_books', 'Something went wrong!', 'danger');
    }

    public function merge() {
        // $this->printer($_POST, true);
        $_POST['merge_book_id'] = explode(',', $_POST['merge_book_id']);
        $idx = array_search($_POST['merge_book_select'], $_POST['merge_book_id']);
        unset($_POST['merge_book_id'][$idx]);

        $master_id = $_POST['merge_book_select'];
        $slave_ids = $_POST['merge_book_id'];
        // $this->printer($master_id);
        // $this->printer($slave_ids);

        $status = $this->m_book->merge($master_id, $slave_ids);

        // var_dump($status);
        // exit();

        if($status) $this->redirect_msg('/admin/book', 'Books Merged Successfully', 'success');
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
        // $this->printer($_POST, true);
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
            $book_copy_single['book_copy_accession_no'] = $_SESSION['branch_prefix'].$acc;
            array_push($book_copy, $book_copy_single);
            ++$acc;
        }

        // $this->printer($_POST);
        // $this->printer($book_copy, true);

        $aff = $this->m_book->add_copy($book_copy, $_POST['book_copy_type']);
        if($aff) $this->redirect_msg('/admin/book', 'Copies Added Successfully', 'success');
        else $this->redirect_msg('/admin/book', 'Something went wrong!', 'danger');
    }

    public function move_copy() {
        if(!isset($_POST['book_id']) || !isset($_POST['book_copy_accession_no'])) 
            $this->redirect_msg('/admin/book', 'Book ID and Accession No. Required', 'danger');

        $book_copy = $this->m_book->get_single_book_by_accession_no($_POST['book_copy_accession_no']);
        if(!$book_copy) $this->redirect_msg('/admin/book', 'Invalid Accession No.', 'danger');

        if($book_copy->book_id == $_POST['book_id'])
            $this->redirect_msg('/admin/book', 'Cannot move to same book', 'danger');

        $book = $this->m_book->get_single_book($_POST['book_id']);
        if(!$book) $this->redirect_msg('/admin/book', 'Invalid Book ID', 'danger');

        // $this->printer($book);
        // $this->printer($book_copy, true);

        $new_copy = array();
        $new_copy['book_id'] = $_POST['book_id'];
        $new_copy['book_copy_manager_id'] = $this->session->admin_id;

        $source_book = array();
        $target_book = array();

        if($book_copy->book_copy_is_deleted == 0) {
            $source_book['book_stock'] = $book_copy->book_stock - 1;
            $target_book['book_stock'] = $book->book_stock + 1;
            if($book_copy->book_copy_type == 1 && $book_copy->book_copy_status == 1) { // Normal Available Copy
                $source_book['book_available'] = $book_copy->book_available - 1;
                $target_book['book_available'] = $book->book_available + 1;
            }
        }

        // $this->printer($new_copy);
        // $this->printer($source_book);
        // $this->printer($target_book, true);

        $status = $this->m_book->move_copy($new_copy, $_POST['book_copy_accession_no'], $source_book, $book_copy->book_id, $target_book, $_POST['book_id'], $book_copy->book_copy_is_deleted);
        if($status) $this->redirect_msg('/admin/book', 'Copy Moved Successfully', 'success');
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

    public function delete_copy_ajax($book_copy_accession_no) {
        if(!$book_copy_accession_no) exit("No Acc. no Found");

        $book = $this->m_book->get_single_copy_details($book_copy_accession_no);
        if($book->book_copy_status==0) exit( 'This copy is currently issued by someone');
        if($book->book_copy_is_deleted) exit( 'It\'s already a deleted copy');
        $status = $this->m_book->delete_copy($book_copy_accession_no, $book);
        if($status) echo 'success';
        else echo 'Something went wrong!';
    }

    public function restore_copy_ajax($book_copy_accession_no) {
        if(!$book_copy_accession_no) exit("No Acc. no Found");

        $book = $this->m_book->get_single_copy_details($book_copy_accession_no);
        if($book->book_copy_is_deleted != 1) exit( 'It\'s not a deleted copy');
        $status = $this->m_book->restore_copy($book_copy_accession_no, $book);
        if($status) echo 'success';
        else echo 'Something went wrong!';
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
                // array_push($json_data['data'][$i], json_encode($this->m_book->book_authors($book->book_id)));

                $authors = $this->m_book->book_authors($book->book_id);
                $delimiter = "";
                $authors_for_book = '';
                foreach ($authors as $key => $author) {
                    $authors_for_book .= $delimiter.$author->author_id."\t".$author->author_name;
                    $delimiter = "\n";
                }
                array_push($json_data['data'][$i], $authors_for_book);
                array_push($json_data['data'][$i], $book->book_edition);
                // array_push($json_data['data'][$i], $book->book_isbn);
                array_push($json_data['data'][$i], $book->publication_id."\t".$book->publication_name);
                array_push($json_data['data'][$i], $book->book_stock);
                array_push($json_data['data'][$i], $book->book_available);
                array_push($json_data['data'][$i], $read_flag);
                array_push($json_data['data'][$i], $book->book_url_unlocked);
                array_push($json_data['data'][$i], $book->book_id);
                
                ++$i;
            }
        }
        // $this->printer($json_data);
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

    /****************************** Import Function **************************/

    public function importer() {

        $total_count = 0;

        echo 'Starting Import<br>';

        $old_books = $this->m_book->old_books(1000);

        $new_books = array();

        echo count($old_books).'<br>';

        // $this->tabular($old_books, true);

        foreach ($old_books as $key => $book) {
            $authors = array();
            $categories = array();

            // echo $book->book_title.'<br>';

            // Processing Authors ======================================================

            $arr = explode('&', $book->book_author);
            foreach($arr as $author) {
                $author = trim($author);
                if($author == 'others' || $author == 'Others' || $author == 'other') continue;
                $author = $this->author_processor($author);
                if($author == '') continue;
                array_push($authors, $author);
            }
            // $this->printer($authors);
            // Author Ready

            // Processing Categories  ======================================================

            // Later
            array_push($categories, 'Other');

            // Constructing Book array =====================================================

            $new_book = array();

            // $new_book['']

            $new_book['book_id']            = $this->m_book->new_id('book');
            $new_book['book_isbn']          = '';
            $new_book['book_title']         = $book->book_title;
            // $new_book['publication_id']
            $new_book['book_add_date']      = date('Y-m-d H:i:s');
            $new_book['manager_id']         = $this->session->admin_id;
            $new_book['book_edition']       = $book->book_edition;
            $new_book['book_place_of_pub']  = $book->place_of_publication;
            $new_book['book_year_of_pub']   = $book->year_of_publication;
            $new_book['book_pages']         = $book->total_page_number;
            $new_book['book_status']        = 1;
            $new_book['book_remarks']       = $book->book_comments;
            $new_book['book_stock']         = 0;
            $new_book['book_available']     = 0;
            $new_book['book_url']           = '';
            $new_book['book_url_unlocked']  = 1;
            $new_book['is_deleted']         = 0;
            


            // $this->printer($new_book);

            $book_duplicate = $this->m_book->check_book_title_edition($new_book['book_title'], $new_book['book_edition']);


            if($book_duplicate) {
                // echo 'Duplicate Found - '.$book->book_title.'<br>';
                $this->add_old_copies($book->book_id, $book_duplicate->book_id);
                $this->m_book->flag_book($book->book_id);
                continue;
            }

            $publication_name = $book->book_publisher;

            $status = false;
            
            $status = $this->m_book->add_book($new_book, $publication_name, $authors, $categories);

            if($status) {
                // Book inserted, add copies now.
                // echo $new_book['book_id'].' - '.$book->book_id.'<br>';

                $this->add_old_copies($book->book_id, $new_book['book_id']);

                $this->m_book->flag_book($book->book_id);
                array_push($new_books, $new_book);
                $total_count++;
            }
        }

        echo $total_count.'<br>';
        // $this->tabular($new_books);
    }

    public function add_old_copies($book_id, $new_book_id) {
        $old_copies = $this->m_book->old_copies($book_id);

        $new_copies = array();
        $ref_copies = 0;


        $purchase_array = array("Purchase", "P", "pur", "purchase", "Purchase, Lost & replace", "purchase, Lost & replace", "p", " P", "PUrchase", "Parchage", "Purche", "Purched", "purche", "pUR", "Pur.", 'g', 'R', "Purchase (lost of cash memo)");
        $donation_array = array("Asia Foundation", "Asia foundation", "Donated", "Donation", "Gift", "gift", "Free", "AIBI", "Asia foundation, AIBI", "AF", "IST");
        $others_array   = array("Others", "--", "A", "No", "aF", "---", );

        foreach ($old_copies as $key => $copy) {
            $new_copy = array();

            $new_copy['book_id']                = $new_book_id;
            $new_copy['book_copy_accession_no'] = $_SESSION['branch_prefix'].$copy->copy_id;
            $new_copy['book_copy_status']       = 1;
            $new_copy['book_copy_type']         = $copy->copy_type - 1;
            $new_copy['book_copy_date']         = $copy->copy_date;
            $new_copy['book_copy_price']        = $copy->copy_price;
            $new_copy['book_copy_remarks']      = '';
            $new_copy['book_copy_manager_id']   = $this->session->admin_id;

            if($new_copy['book_copy_type'] == 0) $ref_copies++;


            if(array_search($copy->copy_source, $purchase_array) !== false)
                $new_copy['book_copy_source'] = 1;
            else if(array_search($copy->copy_source, $donation_array) !== false) {
                $new_copy['book_copy_remarks'] = $copy->copy_source;
                $new_copy['book_copy_source'] = 2;
            }
            else if(array_search($copy->copy_source, $others_array) !== false)
                $new_copy['book_copy_source'] = 3;
            else if($copy->copy_source == '') $new_copy['book_copy_source'] = 3;
            else {
                $new_copy['book_copy_remarks'] = $copy->copy_source;
                $new_copy['book_copy_source'] = 3;
            }
            array_push($new_copies, $new_copy);
        }



        // $this->tabular($old_copies);
        // $this->tabular($new_copies);
        // $this->printer($new_copies);

        $this->m_book->add_old_copies($new_book_id, $new_copies, $ref_copies);
    }

    public function categorize() {
        // echo 'Started Categorizing'.'<br>'.'<br>'.'<br>';

        // $skip = array();
        
        // $str = file_get_contents('string.txt');

        // // var_dump($str);

        // $arr = explode(' ', $str);

        // $arr = array_unique($arr);

        // foreach ($arr as $key => $word) {
        //     if(is_numeric($word)) unset($arr[$key]);
        // }

        // echo count($arr).'<br>';
        // $this->printer($arr);

            
        $purchase_array = array("Purchase", "P", "pur", "purchase", "Purchase, Lost & replace", "purchase, Lost & replace", "p", " P", "PUrchase", "Parchage", "Purche", "Purched", "purche", "pUR", "Pur.", 'g', 'R', "Purchase (lost of cash memo)");
        $donation_array = array("Asia Foundation", "Asia foundation", "Donated", "Donation", "Gift", "gift", "Free", "AIBI", "Asia foundation, AIBI", "AF", "IST");
        $others_array   = array("Others", "--", "A", "No", "aF", "---", );

        $copies = $this->db->get('lib_copy')->result();

        $arr = array();

        foreach ($copies as $key => $copy) {

            

            if(array_search($copy->copy_source, $purchase_array) !== false)
                $copy->copy_source = 1;
            else if(array_search($copy->copy_source, $donation_array) !== false) {
                $copy->copy_ac_no = $copy->copy_source;
                $copy->copy_source = 2;
            }
            else if(array_search($copy->copy_source, $others_array) !== false)
                $copy->copy_source = 3;
            else if($copy->copy_source == '') $copy->copy_source = 3;
            else {
                $copy->copy_ac_no = $copy->copy_source;
                $copy->copy_source = 3;
            }

        }

        $this->tabular($arr);

    }

    /* This function processes an author name
    *  It replaces any occurances of ",," or ", ," with a "," in a string
    *  It checks the first name of an author for a trailing period. If not
    *  found, it adds the period after the first name if the first name is
    *  an initial (less than 5 chars long).
    *  At last it concatenates the first name and last name with a space
    *  between them.
    *  Finally it capitalize each words of the name and returns the string.
    */

    function author_processor($author) {
        $author = str_replace(',,', ',', $author);
        $author = str_replace(', ,', ',', $author);
        $temp = explode(',', $author); // Seperating the first name and lastname
        foreach($temp as $key=>$t) $temp[$key] = trim($t); // Triming any begining or trailing whitespace
        if(count($temp) > 1) { // If existing both first name and last name
            if(trim($temp[0]) == '' || trim($temp[1]) == '') {
                $author = $temp[1].$temp[0]; // Concatenating
            }
            else {
                $lastchar = substr($temp[1], -1); // Checking for trailing period after initials
                if($lastchar != '.' && strlen($temp[1])<5) $temp[1] .= '.'; // Adding period
                $temp[1] = str_replace('. ', '.', $temp[1]); // Removing whitespace between two initial characters
                $author = $temp[1].' '.$temp[0]; // Concatenating with a space between them.
            }
        }
        else $author = $temp[0];
        return ucwords($author); // returning after capitalizing
    }
}
