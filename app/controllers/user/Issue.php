<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Issue extends Base_Controller {

	public $module = 'user';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        $this->__security($this->module);

        $this->load->model($this->module."/m_issue"); // Loading Model
        $this->load->model($this->module."/m_book");

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('user/issue');
    }

    //====================================//

	public function index() {
        // echo $this->session->user_id;
        // exit();
        $data = $this->data;
        $data['page'] = 'issue';
        $data['subpage'] = 'requests';
        $data['page_title'] .= 'Issue Requests';
        $data['source'] = $this->data['controller'].'/issue_json/request';
        $data['data_page'] = 'request';
        $data['content'] = 'v_issue.php';
        $this->load->view($this->viewpath.'v_main', $data);
	}

    public function issue_json($data_page = 'request', $id=NULL) {
        if($data_page == 'request') $issues = $this->m_issue->all_issue_requests();
        else if($data_page == 'active') $issues = $this->m_issue->all_active_issues();
        else if($data_page == 'overdue') $issues = $this->m_issue->all_overdue_issues();
        else if($data_page == 'completed') $issues = $this->m_issue->all_completed_issues();
        else if($data_page == 'all_issues') $issues = $this->m_issue->all_issues();
        else if($data_page == 'issue_by_user' && $id != NULL) $issues = $this->m_issue->all_issue_by_user($id);
        else if($data_page == 'issue_by_book' && $id != NULL) $issues = $this->m_issue->all_issue_by_book($id);
        else if($data_page == 'issue_by_book_copy' && $id != NULL) $issues = $this->m_issue->all_issue_by_book_copy($id);
        else $this->redirect_msg('/admin/issue', 'Something Went Wrong', 'danger');

        //$this->printer($issues, true);
        $json_data = array('data' => array());
        $i=0;
        $test_multiplier = 1;
        for($m = 0; $m < $test_multiplier; ++$m) {
            foreach($issues as $key=>$issue) {
                // $this->printer($issue);
                // echo $this->db->last_query();
                if($data_page == 'overdue' || $data_page == 'all_issues' || $data_page == 'issue_by_user' || $data_page == 'issue_by_book' || $data_page == 'issue_by_book_copy') {
                    $result = $this->calculate_fine($issue);
                    $issue->issue_overdue = $result['overdue'];
                    $issue->issue_fine = $result['fine'];
                    $issue->issue_status = $this->check_issue_status($issue);
                }
                $json_data['data'][$i] = array();
                
                array_push($json_data['data'][$i], $issue->issue_id);
                
                if($data_page == 'request')
                    array_push($json_data['data'][$i], json_encode(array($issue->book_id, $issue->book_title)));
                if($data_page == 'active' || $data_page == 'overdue' || $data_page == 'completed' || $data_page == 'all_issues' || $data_page == 'issue_by_user')
                    array_push($json_data['data'][$i], json_encode(array($issue->book_id, $issue->book_title, $issue->issue_book_copy_accession_no)));
                array_push($json_data['data'][$i], $this->datatables_datetime_formatter($issue->issue_datetime));
                if($data_page == 'request' || $data_page == 'all_issues' || $data_page == 'issue_by_user' || $data_page == 'issue_by_book' || $data_page == 'issue_by_book_copy') {
                    if($issue->issue_status == 0 || $issue->issue_status == 8) array_push($json_data['data'][$i], $this->datatables_datetime_formatter($issue->issue_auto_expire_datetime));
                    else array_push($json_data['data'][$i], '');
                }
                if($data_page == 'active' || $data_page == 'overdue' || $data_page == 'all_issues' || $data_page == 'issue_by_user' || $data_page == 'issue_by_book' || $data_page == 'issue_by_book_copy') {
                    if($issue->issue_status != 0 && $issue->issue_status != 8)
                        array_push($json_data['data'][$i], $this->datatables_datetime_formatter($issue->issue_deadline));
                    else array_push($json_data['data'][$i], '');
                }
                if($data_page == 'all_issues' || $data_page == 'issue_by_user' || $data_page == 'issue_by_book' || $data_page == 'issue_by_book_copy')
                    array_push($json_data['data'][$i], $issue->issue_fine);
                if($data_page == 'completed' || $data_page == 'all_issues' || $data_page == 'issue_by_user' || $data_page == 'issue_by_book' || $data_page == 'issue_by_book_copy') {
                    if($issue->issue_status == 2 || $issue->issue_status == 3)
                        array_push($json_data['data'][$i], $this->datatables_datetime_formatter($issue->issue_return_datetime));
                    else array_push($json_data['data'][$i], ''); 
                }
                if($data_page == 'overdue')
                    array_push($json_data['data'][$i], $issue->issue_fine);
                if($data_page == 'request' || $data_page == 'all_issues' || $data_page == 'issue_by_user' || $data_page == 'issue_by_book' || $data_page == 'issue_by_book_copy')
                    array_push($json_data['data'][$i], $issue->issue_status);
                array_push($json_data['data'][$i], $issue->issue_id);
                ++$i;
            }
        }
        //$this->printer($json_data, true);
        echo json_encode($json_data);
    }

    public function single_issue_details($issue_id=NULL) {
        if(!$issue_id) echo '';
        else {
            $issue = $this->m_issue->get_single_issue($issue_id);
            if($issue){
                if(($issue->issue_status == 9 || $issue->issue_status == 0) && strtotime($issue->issue_auto_expire_datetime) < time())
                    $issue->issue_status = 8; // Expired

                if($issue->issue_status == 1 && strtotime($issue->issue_deadline) < time()) {
                    $issue->issue_status = -1;

                    $now = time(); 
                    $deadline = strtotime($issue->issue_deadline);
                    $datediff = $now - $deadline;

                    $diff = ceil($datediff / (60 * 60 * 24));

                    $issue->issue_overdue = $diff.' days';

                    $issue->issue_fine = ($diff * $this->settings->issue_fine_per_day).'/=';
                }
                else{ 
                    $issue->issue_overdue = $issue->issue_fine = 'N/A';
                }
                if($issue->issue_datetime)
                    $issue->issue_datetime = date('M d, Y, H:i a', strtotime($issue->issue_datetime));
                if($issue->issue_return_datetime)
                    $issue->issue_return_datetime = date('M d, Y, H:i a', strtotime($issue->issue_return_datetime));
                if($issue->issue_auto_expire_datetime)
                    $issue->issue_auto_expire_datetime = date('M d, Y, H:i a', strtotime($issue->issue_auto_expire_datetime));
                if($issue->issue_deadline)
                    $issue->issue_deadline = date('M d, Y, H:i a', strtotime($issue->issue_deadline));

                echo json_encode($issue);
            }
            else echo '';
        }
    }

    public function active() {
        $data = $this->data;
        $data['page'] = 'issue';
        $data['subpage'] = 'active';
        $data['page_title'] .= 'Active Issues';
        $data['source'] = $this->data['controller'].'/issue_json/active';
        $data['data_page'] = 'active';
        
        $data['content'] = 'v_issue.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function overdue() {
        $data = $this->data;
        $data['page'] = 'issue';
        $data['subpage'] = 'overdue';
        $data['page_title'] .= 'Overdue Issues';
        $data['source'] = $this->data['controller'].'/issue_json/overdue';
        $data['data_page'] = 'overdue';
        
        $data['content'] = 'v_issue.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function completed() {
        $data = $this->data;
        $data['page'] = 'issue';
        $data['subpage'] = 'completed';
        $data['page_title'] .= 'Completed Issues';
        $data['source'] = $this->data['controller'].'/issue_json/completed';
        $data['data_page'] = 'completed';
        
        $data['content'] = 'v_issue.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function all() {
        $data = $this->data;
        $data['page'] = 'issue';
        $data['subpage'] = 'all';
        $data['page_title'] .= 'All Issues';
        $data['source'] = $this->data['controller'].'/issue_json/all_issues';
        $data['data_page'] = 'all_issues';
        
        $data['content'] = 'v_issue.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function add_issue($issue_form = 'issue_page', $code=0) {
        $num_of_books = ($issue_form == 'issue_page')?$_POST['num_of_books']:1;
        //$user_library_code = $_POST['user_library_code'];
        // Getting user by user library code
        // $user = $this->m_issue->get_user_by_user_library_code($user_library_code);
        // if(!$user) $this->redirect_msg('/user/issue', 'Invalid Library Code', 'danger');
        $msg = array();
        for($i=1; $i<=$num_of_books; ++$i) {
            $field = 'book_'.$i;
            // Processing Single Book
            $book_id =($code)? $code : strtok($_POST[$field], '-');
            $book = $this->m_book->get_single_book($book_id);
            if(!$book) array_push($msg, array("Book ID #$book_id Doesn't Exist)", "danger"));
            //Check if another copy of this book is already issued to this student;
            else if($this->m_issue->check_book_duplicate_issue($this->session->user_id, $book_id))
                array_push($msg, array("A copy of Book No. #$book_id ($book->book_title) is currently Issued to/Requested by you", "danger"));
            else if($book->book_available == 0) { // Book Not Available. Creating a Demand
                // Enter the issue
                $issue = array();
                $issue['issue_id'] = $this->m_issue->new_id('issue');
                $issue['issue_datetime'] = date('Y-m-d H:i:s');
                //$issue['issue_auto_expire_datetime'] = date('Y-m-d 16:30:00', strtotime("+".$this->settings->issue_auto_expire_deadline." days"));
                $issue['issue_book_id'] = $book_id;
                $issue['user_id'] = $this->session->user_id;
                // issue_status (0-confirmed (but not issued), 1-issued and Active, 2-returned (but not cleared fine, 3-completed, 6-Demanded, 8-expired, 9-requested )
                $issue['issue_status'] = 6;
                $issue['issue_lend_user_code'] = $this->__unique_code();
                $issue['issue_receive_user_code'] = $this->__unique_code();
                $issue['issue_receive_admin_code'] = $this->__unique_code();
                $issue['issue_fine_user_code'] = $this->__unique_code();
                $issue['issue_fine_admin_code'] = $this->__unique_code();
                $issue['issue_renew_user_code'] = $this->__unique_code();
                $issue['issue_remarks'] = '';
                if($status = $this->m_issue->add_issue($issue))
                    array_push($msg, array("Book No. #$book_id ($book->book_title) is not available right now. A Demand has been created for you (Issue #".$issue['issue_id'].").", "warning"));
            }
            else { // Everything Clear, Proceed to issue the book
                // Enter the issue
                $issue = array();
                $issue['issue_id'] = $this->m_issue->new_id('issue');
                $issue['issue_datetime'] = date('Y-m-d H:i:s');
                //$issue['issue_return_datetime'] = '';
                //$issue['issue_deadline'] = date('Y-m-d 16:30:00', strtotime("+".$this->settings->issue_deadline." days"));
                $issue['issue_auto_expire_datetime'] = date('Y-m-d 16:30:00', strtotime("+".$this->settings->issue_auto_expire_deadline." days"));
                $issue['issue_book_id'] = $book_id;
                $issue['user_id'] = $this->session->user_id;
                // issue_status (0-confirmed (but not issued), 1-issued and Active, 2-returned (but not cleared fine, 3-completed, 8-expired, 9-requested )
                $issue['issue_status'] = 9;
                $issue['issue_lend_user_code'] = $this->__unique_code();
                $issue['issue_receive_user_code'] = $this->__unique_code();
                $issue['issue_receive_admin_code'] = $this->__unique_code();
                $issue['issue_fine_user_code'] = $this->__unique_code();
                $issue['issue_fine_admin_code'] = $this->__unique_code();
                $issue['issue_renew_user_code'] = $this->__unique_code();
                $issue['issue_remarks'] = '';
                if($status = $this->m_issue->add_issue($issue))
                    array_push($msg, array("Book No. #$book_id ($book->book_title) Requested Successfully (Issue #".$issue['issue_id']."). Request will automatically expire at ".date('M d, Y h:i a', strtotime($issue['issue_auto_expire_datetime'])), "success"));
            }
        }
        //$this->printer($msg);
        $this->redirect_msg('/user/issue', $msg, '', count($msg));
    }

    public function issue_by_book($book_id=NULL) {
        if(!$book_id) $this->redirect_msg('/user/issue', 'Please Click on a Book name to get the issues', 'danger');
        $data = $this->data;
        $data['page'] = 'issue';
        $data['subpage'] = 'issue_by_book';
        $data['page_title'] .= 'Book Issue History';
        $data['book_title'] = $this->m_book->get_single_book($book_id)->book_title;
        $data['source'] = $this->data['controller'].'/issue_json/issue_by_book/'.$book_id;
        $data['data_page'] = 'issue_by_book';
        
        $data['content'] = 'v_issue.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function issue_by_book_copy($book_copy_accession_no=NULL) {
        if(!$book_copy_accession_no) $this->redirect_msg('/user/issue', 'Please Click on an Accession No. name to get the issues', 'danger');
        $data = $this->data;
        $data['page'] = 'issue';
        $data['subpage'] = 'issue_by_book_copy';
        $data['page_title'] .= 'Book Copy Issue History';
        $data['source'] = $this->data['controller'].'/issue_json/issue_by_book_copy/'.$book_copy_accession_no;
        $data['data_page'] = 'issue_by_book_copy';
        $book = $this->m_book->get_single_book_by_accession_no($book_copy_accession_no);
        $data['book'] = $book_copy_accession_no.' (#'.$book->book_id.' - '.$book->book_title.')';
        
        $data['content'] = 'v_issue.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function delete($issue_id=NULL) {
        if(!$issue_id) $this->redirect_msg('user/issue', 'Issue ID is required', 'danger');
        $issue = $this->m_issue->get_single_issue($issue_id);
        if($issue) {
            if($issue->user_id != $this->session->user_id) $this->redirect_msg('user/issue/all', 'You\'re a miserable wannabe hacker', 'danger');
            if($issue->issue_status == 0) { // Book occupied, needs to release the book
                $book = array('book_id' => $issue->book_id, 'book_available' => $issue->book_available + 1);
                $status = $this->m_issue->delete_issue($issue_id, $book);
            }
            else if($issue->issue_status == 9 || $issue->issue_status == 6) $status = $this->m_issue->delete_issue($issue_id); // Just delete the issue
            else $this->redirect_msg('user/issue/all', 'You can\'t Delete An Issue History', 'danger');
            if($status) $this->redirect_msg('user/issue/all', 'Successfully Deleted the Issue', 'success');
            else echo $this->redirect_msg('user/issue/all', 'Something Went Wrong', 'danger');
        }
        else $this->redirect_msg('user/issue/all', 'Invalid Issue ID', 'danger');
    }

    public function calculate_fine($issue) {
        $result = array();
        if(($issue->issue_status == 9 || $issue->issue_status == 0) && strtotime($issue->issue_auto_expire_datetime) < time()) {
            $result['overdue'] = 'N/A';         // Expired
            $result['fine'] = 'N/A';
            //echo 'Expired';
        }
        else if($issue->issue_status == 6) {
            $result['overdue'] = 'N/A';         // Demanded
            $result['fine'] = 'N/A';
            //echo 'Demanded';
        }
        else if($issue->issue_status == 9) {
            $result['overdue'] = 'N/A';         // Requested
            $result['fine'] = 'N/A';
            //echo 'Requested';
        }
        else if($issue->issue_status == 8) {
            $result['overdue'] = 'N/A';         // Expired
            $result['fine'] = 'N/A';
            //echo 'Expired';
        }
        else if($issue->issue_status == 0) {
            $result['overdue'] = 'N/A';         // Confirmed
            $result['fine'] = 'N/A';
            //echo 'Confirmed';
        }
        else if($issue->issue_status == 1) { 
            if(($deadline = strtotime($issue->issue_deadline)) < time() && !$issue->is_teacher) {
                $diff = ceil((time() - $deadline) / (60 * 60 * 24));
                $result['overdue'] = $diff.' days';
                $result['fine']    = $this->settings->currency_before.($diff * $this->settings->issue_fine_per_day).$this->settings->currency_after;   // Overdue
                //echo 'Overdue';
            }
            else {
                $result['overdue'] = 'N/A';     // Active
                $result['fine'] = 'N/A';
                //echo 'Active';
            }
        }
        else if($issue->issue_status == 2) {
            $result['overdue'] = 'N/A';         // Fine due
            $result['fine'] = $this->settings->currency_before.$issue->issue_total_fine.$this->settings->currency_after;
            //echo 'Fine Due';
        }
        else if($issue->issue_status == 3) {
            $result['overdue'] = 'N/A';         // Completed
            $result['fine'] = 'N/A';
            //echo 'Completed';
        }
        return $result;
    }

    public function check_issue_status($issue) {
        //var_dump($issue);
        if(($issue->issue_status == 9 || $issue->issue_status == 0) && strtotime($issue->issue_auto_expire_datetime) < time()) return 8; // Expired
        else if($issue->issue_status == 1 && strtotime($issue->issue_deadline) < time() && !$issue->is_teacher) return -1; // Overdue
        else return $issue->issue_status;
    }

    public function datatables_datetime_formatter($datetime) {
        return date('M d, Y', strtotime($datetime)).'<br>'.date('h:i a', strtotime($datetime));
    }
}
