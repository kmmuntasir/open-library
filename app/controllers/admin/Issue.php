<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Issue extends Base_Controller {

	public $module = 'admin';	// defines the module
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
        $this->load->model($this->module."/m_user");

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('admin/issue');
    }

    //====================================//

	public function index() {
        $data = $this->data;
        $data['page'] = 'issue';
        $data['subpage'] = 'requests';
        $data['page_title'] .= 'Issue Requests';
        //$data['issues'] = $this->m_issue->all_issue_requests();
        $data['source'] = $this->data['controller'].'/issue_json/request';
        $data['data_page'] = 'request';
        
        //$this->printer($data, true);
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
                if($data_page == 'overdue' || $data_page == 'all_issues' || $data_page == 'issue_by_user' || $data_page == 'issue_by_book' || $data_page == 'issue_by_book_copy') {
                    $result = $this->calculate_fine($issue);
                    $issue->issue_overdue = $result['overdue'];
                    $issue->issue_fine = $result['fine'];
                    $issue->issue_status = $this->check_issue_status($issue);
                }
                $json_data['data'][$i] = array();
                
                array_push($json_data['data'][$i], $issue->issue_id);


                if($data_page != 'issue_by_user') {
                    if($issue->is_teacher) array_push($json_data['data'][$i], json_encode(array($issue->user_id, $issue->user_name, $issue->is_teacher)));
                    else array_push($json_data['data'][$i], json_encode(array($issue->user_id, $issue->user_name, $issue->is_teacher, $issue->user_dept, $issue->user_roll)));
                }


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
                    if($issue->issue_status != 0 && $issue->issue_status != 8 && $issue->issue_status != 6)
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
                if($data_page == 'all_issues' || $data_page == 'request' || $data_page == 'issue_by_user' || $data_page == 'issue_by_book' || $data_page == 'issue_by_book_copy')
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
                if($issue->issue_status == 9 || $issue->issue_status == 0 || $issue->issue_status == 6) {
                    $issue->issue_lend_user_code = $issue->issue_receive_user_code = $issue->issue_fine_user_code = $issue->issue_renew_user_code = '';
                }
                if(($issue->issue_status == 9 || $issue->issue_status == 0) && strtotime($issue->issue_auto_expire_datetime) < time()) {
                    $issue->issue_status = 8; // Expired
                }

                else if($issue->issue_status == 1 && strtotime($issue->issue_deadline) < time() && !$issue->is_teacher) {
                    $issue->issue_status = -1; // Overdue

                    $now = time(); 
                    $deadline = strtotime($issue->issue_deadline);
                    $datediff = $now - $deadline;

                    $diff = ceil($datediff / (60 * 60 * 24));

                    $issue->issue_overdue = $diff.' days';

                    $issue->issue_fine = ($issue->issue_total_fine > 0) ? $issue->issue_total_fine.'/=' : ($diff * $this->settings->issue_fine_per_day).'/=';
                }
                else if($issue->issue_status == 2) {
                    //Received without fine

                    $return = strtotime($issue->issue_return_datetime);
                    $deadline = strtotime($issue->issue_deadline);
                    $datediff = $return - $deadline;

                    $diff = ceil($datediff / (60 * 60 * 24));

                    $issue->issue_overdue = $diff.' days';

                    $issue->issue_fine = ($issue->issue_total_fine > 0) ? $issue->issue_total_fine.'/=' : ($diff * $this->settings->issue_fine_per_day).'/=';
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
                // $this->printer($issue, true);
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
        //$data['issues'] = $this->m_issue->all_active_issues();
        $data['content'] = 'v_issue.php';
        $data['source'] = $this->data['controller'].'/issue_json/active';
        $data['data_page'] = 'active';

        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function overdue() {
        $data = $this->data;
        $data['page'] = 'issue';
        $data['subpage'] = 'overdue';
        $data['page_title'] .= 'Overdue Issues';
        //$data['issues'] = $this->m_issue->all_overdue_issues();
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
        //$data['issues'] = $this->m_issue->all_completed_issues();
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

    public function add_issue() {
        $user = '';
        if(isset($_POST['secret_code_method_changer']) && $_POST['secret_code_method_changer'] == 'on') {
            // Process with PIN
            // Getting user by user pin
            $user = $this->m_issue->get_user_by_user_id($_POST['user_id']);
            if(!$user) $this->redirect_msg('/admin/issue', 'Invalid User ID', 'danger');
            if($user->user_pin != md5($_POST['user_pin'])) $this->redirect_msg('/admin/issue', 'Invalid PIN', 'danger');
            
        }
        else {
            // Process with Library Code
            if(!isset($_POST['user_library_code'])) $this->redirect_msg('/admin/issue', 'Library Code Not Found', 'danger');
            $user_library_code = $_POST['user_library_code'];
            // Getting user by user library code
            $user = $this->m_issue->get_user_by_user_library_code($user_library_code);
            if(!$user) $this->redirect_msg('/admin/issue', 'Invalid Library Code', 'danger');
        }
        // $this->printer($_POST, true);

        
        if($user->is_deleted) $this->redirect_msg('/admin/issue', 'This user is deactivated', 'danger');

        $msg = array();
        for($i=1; $i<=$_POST['num_of_books']; ++$i) {
            $field = 'book_'.$i;
            // Processing Single Book
            $book_copy_accession_no = $_POST[$field];
            $book_copy = $this->m_book->get_single_copy_details($book_copy_accession_no);
            if(!$book_copy) array_push($msg, array("Accession No. #$book_copy_accession_no Doesn't Exist)", "danger"));
            else if($this->m_issue->check_book_duplicate_issue($user->user_id, $book_copy->book_id))
                array_push($msg, array("A copy of this book is currently Issued to/Requested by you", "danger"));
            else if($book_copy->book_available == 0)
                array_push($msg, array("Accession No. #$book_copy_accession_no ($book_copy->book_title) is Not Available right now (All copies are lent out)", "danger"));
            else if($book_copy->book_copy_status==0) 
                array_push($msg, array("Accession No. #$book_copy_accession_no ($book_copy->book_title) is already issued to someone else", "danger"));
            else if($book_copy->book_copy_type==0) {
                if($user->is_teacher) {
                    // Create process for issuing reference copy to teachers.
                    if($this->issue_book($book_copy, $book_copy_accession_no, $user)) { 
                        array_push($msg, array("Accession No. #$book_copy_accession_no ($book_copy->book_title) Issued Successfully (Issue #".$issue['issue_id'].") until ".date('M d, Y h:i a', strtotime($issue['issue_deadline'])), "success"));
                    } 
                }
                else array_push($msg, array("Accession No. #$book_copy_accession_no ($book_copy->book_title) is a Reference Copy<br>Reference copies can only be issued by Teachers", "danger"));
            }
            else if($book_copy->book_copy_is_deleted==1) 
                array_push($msg, array("Accession No. #$book_copy_accession_no ($book_copy->book_title) is a Deleted Book", "danger"));
            else {   // Everything Clear, Proceed to issue the book
                if($this->issue_book($book_copy, $book_copy_accession_no, $user)) { 
                    array_push($msg, array("Accession No. #$book_copy_accession_no ($book_copy->book_title) Issued Successfully (Issue #".$issue['issue_id'].") until ".date('M d, Y h:i a', strtotime(date('Y-m-d 16:30:00', strtotime("+".$this->settings->issue_deadline." days")))), "success"));
                } 
            }
        }
        $this->redirect_msg('/admin/issue/active', $msg, '', count($msg));
    }

    public function issue_book($book_copy, $book_copy_accession_no, $user) {
        // Decrease book availability in book table
        $deduct = ($user->is_teacher && ($book_copy->book_copy_type==0))?0:1; // User is teacher and It's a reference copy
        $book = array('book_available'=>($book_copy->book_available - $deduct));
        $book_id = $book_copy->book_id;
        // Convert Book Copy Status -> Issued (0-issued, 1-available)
        $book_copy_new = array('book_copy_status' => 0);
        // Enter the issue
        $issue = array();
        $issue['issue_id'] = $this->m_issue->new_id('issue');
        $issue['issue_datetime'] = date('Y-m-d H:i:s');
        //$issue['issue_return_datetime'] = '';
        $issue['issue_deadline'] = date('Y-m-d 16:30:00', strtotime("+".$this->settings->issue_deadline." days"));
        //$issue['issue_auto_expire_datetime'] = date('Y-m-d 16:30:00', strtotime("+".$this->settings->issue_auto_expire_deadline." days"));
        $issue['issue_book_id'] = $book_id;
        $issue['issue_book_copy_accession_no'] = $book_copy_accession_no;
        $issue['user_id'] = $user->user_id;
        $issue['manager_id'] = $this->session->admin_id;
        // issue_status (0-confirmed (but not issued), 1-issued and Active, 2-returned (but not cleared fine, 3-completed, 8-expired, 9-requested )
        $issue['issue_status'] = 1;
        $issue['issue_lend_user_code'] = $this->__unique_code();
        $issue['issue_receive_user_code'] = $this->__unique_code();
        $issue['issue_receive_admin_code'] = $this->__unique_code();
        $issue['issue_fine_user_code'] = $this->__unique_code();
        $issue['issue_fine_admin_code'] = $this->__unique_code();
        $issue['issue_renew_user_code'] = $this->__unique_code();
        $issue['issue_remarks'] = '';

        if($status = $this->m_issue->add_issue($book, $book_id, $book_copy_new, $book_copy_accession_no, $issue)) return true;
        return false;
    }

    public function issue_by_user($user_id=NULL) {
        if(!$user_id) $this->redirect_msg('/admin/issue', 'Please Click on a Student name to get the issues', 'danger');
        $user = $this->m_user->get_single_user($user_id);
        $user_type = ($user->is_teacher)?'Teacher':'Student';
        $data = $this->data;
        $data['page'] = 'issue';
        $data['subpage'] = 'issue_by_user';
        $data['page_title'] .= $user_type.' Issue History';
        //$data['issues'] = $this->m_issue->all_issue_by_user($user_id);
        $data['user'] = $user->user_name.' (ID: '.$user_id.')';
        $data['source'] = $this->data['controller'].'/issue_json/issue_by_user/'.$user_id;
        $data['data_page'] = 'issue_by_user';

        //$this->printer($data, true);
        $data['content'] = 'v_issue.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function issue_by_book($book_id=NULL) {
        if(!$book_id) $this->redirect_msg('/admin/issue', 'Please Click on a Book name to get the issues', 'danger');
        
        $data = $this->data;
        $data['page'] = 'issue';
        $data['subpage'] = 'issue_by_book';
        $data['page_title'] .= 'Book Issue History';
        $data['book_title'] = $this->m_book->get_single_book($book_id)->book_title;
        $data['source'] = $this->data['controller'].'/issue_json/issue_by_book/'.$book_id;
        $data['data_page'] = 'issue_by_book';
        
        //$this->printer($data, true);
        $data['content'] = 'v_issue.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function issue_by_book_copy($book_copy_accession_no=NULL) {
        if(!$book_copy_accession_no) $this->redirect_msg('/admin/issue', 'Please Click on an Accession No. name to get the issues', 'danger');

        $data = $this->data;
        $data['page'] = 'issue';
        $data['subpage'] = 'issue_by_book_copy';
        $data['page_title'] .= 'Book Copy Issue History';
        $data['source'] = $this->data['controller'].'/issue_json/issue_by_book_copy/'.$book_copy_accession_no;
        $data['data_page'] = 'issue_by_book_copy';
        $book = $this->m_book->get_single_book_by_accession_no($book_copy_accession_no);
        $data['book'] = $book_copy_accession_no.' (#'.$book->book_id.' - '.$book->book_title.')';
        
        //$this->printer($data, true);
        $data['content'] = 'v_issue.php';
        $this->load->view($this->viewpath.'v_main', $data);
    }

    public function activate($issue_id=NULL) {
        if(isset($_POST['user_library_code'])) $user_library_code = $_POST['user_library_code'];
        else $user_library_code = NULL;
        if(isset($_POST['issue_book_copy_accession_no'])) 
            $issue_book_copy_accession_no = $_POST['issue_book_copy_accession_no'];
        else $issue_book_copy_accession_no = NULL;
        if(!($issue_id && $user_library_code && $issue_book_copy_accession_no)) die('ID, Library Code and Accession No. Required');

        $issue = $this->m_issue->get_single_issue($issue_id);
        //$this->printer($issue, true);
        if($issue) {
            if($issue->issue_status != 0) die('Issue is not ready to be activated');
            if($issue->user_library_code != $user_library_code) die('Wrong Library Code');
            if(!$this->m_book->check_book_id_accession_no($issue->book_id, $issue_book_copy_accession_no)) die('This Copy isn\'t a copy of the book of this issue request');

            $book_copy = $this->m_book->get_single_copy_details($issue_book_copy_accession_no);

            if(!$book_copy) echo("Accession No. #$issue_book_copy_accession_no Doesn't Exist");


            // else if($book_copy->book_available == 0)
            //     echo("Accession No. #$issue_book_copy_accession_no ($book_copy->book_title) is Not Available right now (All copies are lent out)");


            else if($book_copy->book_copy_status==0) 
                echo("Accession No. #$issue_book_copy_accession_no ($book_copy->book_title) is already issued to someone else");
            else if($book_copy->book_copy_type==0) 
                echo("Accession No. #$issue_book_copy_accession_no ($book_copy->book_title) is a Reference Copy");
            else if($book_copy->book_copy_is_deleted==1) 
                echo("Accession No. #$issue_book_copy_accession_no ($book_copy->book_title) is a Deleted Book");

            else { // Everything Clear, Proceed to issue the book
                $book_copy = array('book_copy_accession_no' => $issue_book_copy_accession_no, 'book_copy_status'=>0);
                $issue = array('manager_id' => $this->session->admin_id, 'issue_book_copy_accession_no'=>$issue_book_copy_accession_no, 'issue_status' => 1, 'issue_datetime'=>date('Y-m-d H:i:s'), 'issue_deadline' => date('Y-m-d 16:30:00', strtotime("+".$this->settings->issue_deadline." days")));
                $status = $this->m_issue->update_issue($issue_id, $issue, NULL, $book_copy);
                if($status) echo 'success';
                else echo 'Failure to Process';
            }
        }
        else echo 'No Issue Found With This ID';
    }

    public function receive($issue_id=NULL, $fine=0) {
        if(!$issue_id) die('No Issue ID is Provided');
        $issue = $this->m_issue->get_single_issue($issue_id);
        if($issue) {
            $book_copy_details = $this->m_book->get_single_copy_details($issue->issue_book_copy_accession_no);
            $deduct = ($book_copy_details->book_copy_type)?1:0;
            if($issue->issue_status == 1 && strtotime($issue->issue_deadline) < time() && !$issue->is_teacher) {
                // Overdue Issue
                $book = array('book_id' => $issue->book_id, 'book_available' => $issue->book_available + $deduct);
                $book_copy = array('book_copy_accession_no' => $issue->issue_book_copy_accession_no, 'book_copy_status'=>1);

                
                $diff = ceil((time() - strtotime($issue->issue_deadline)) / (60 * 60 * 24));
                $possible_fine = $diff * $this->settings->issue_fine_per_day;

                $issue_updated = array();
                $issue_updated['issue_id']= $issue_id;
                $issue_updated['issue_status']= (($fine)?3:2);
                $issue_updated['issue_total_fine']= $possible_fine;
                
                $issue_updated['issue_received_fine']= (($fine)?$possible_fine:0);
                $issue_updated['issue_return_datetime'] = date('Y-m-d H:i:s');

                //$this->printer($issue_updated, true);

                $status = $this->m_issue->update_issue($issue_id, $issue_updated, $book, $book_copy);

                // $this->printer($issue);
                // $this->printer($book);
                // $this->printer($book_copy);
                // $this->printer($issue_updated);

                if($status) {
                    echo 'success';
                    $msg = "Received Issue #".$issue_id." (".$issue->book_title.") with ".$this->settings->currency_before.$issue_updated['issue_received_fine'].$this->settings->currency_after." Fine . Thank You.";
                    $this->insert_sms($issue->user_phone, $msg);
                }
                else echo 'Failure to Process';
            }

            else if($issue->issue_status == 1) {
                // Active
                $book = array('book_id' => $issue->book_id, 'book_available' => $issue->book_available + $deduct);
                $book_copy = array('book_copy_accession_no' => $issue->issue_book_copy_accession_no, 'book_copy_status'=>1);
                $issue_updated = array('issue_id'=> $issue_id ,'issue_status'=> 3, 'issue_return_datetime'=>date('Y-m-d H:i:s'));
                $status = $this->m_issue->update_issue($issue_id, $issue_updated, $book, $book_copy);
                
                if($status) {
                    echo 'success';
                    $msg = "Recieved Issue #".$issue_id." (".$issue->book_title."). Thank You.";
                    $this->insert_sms($issue->user_phone, $msg);
                }
                else echo 'Failure to Process';
            }

            else if($issue->issue_status == 2) {
                // Fine to receive
                if($fine == 0) die('No Fine Provided');
                $issue_updated = array('issue_id'=> $issue_id ,'issue_status'=> 3);
                $issue_updated['issue_received_fine']= $issue->issue_total_fine;
                $status = $this->m_issue->update_issue($issue_id, $issue_updated);
                
                if($status) {
                    echo 'success';
                    $msg = "Recieved Total Fine ".$this->settings->currency_before.$issue->issue_total_fine.$this->settings->currency_after." for Issue #".$issue_id." (".$issue->book_title."). Thank You.";
                    $this->insert_sms($issue->user_phone, $msg);
                }
                else echo 'Failure to Process';
            } 
            else echo 'Issue is not ready to be received';
        }
        else echo 'No Issue Found With This ID';
    }

    public function renew($issue_id=NULL) {
        if(!$issue_id) $this->redirect_msg('admin/issue/active', 'Issue ID is required', 'danger');
        if(!isset($_POST['user_library_code'])) $this->redirect_msg('admin/issue/active', 'User Library Code is required', 'danger');
        $issue = $this->m_issue->get_single_issue($issue_id);
        if($issue) {
            // $this->printer($issue, true);
            if($issue->issue_status != 1) $this->redirect_msg('admin/issue/active', 'This issue isn\'t ready to be renewed', 'danger');
            if($_POST['user_library_code'] != $issue->user_library_code) $this->redirect_msg('admin/issue/active', 'Invalid User Library Code', 'danger');

            // Checking if there is any active demand for this book
            if($this->m_issue->check_book_for_demand($issue->book_id) && $issue->is_teacher == 0) $this->redirect_msg('admin/issue/active', 'This issue cannot be renewed because there are existing demands for this book.', 'danger');

            //Receiving the old issue.
            $issue_updated                              = array(
                                                            'issue_id'=> $issue_id, 
                                                            'issue_status'=> 3, 
                                                            'issue_return_datetime'=>date('Y-m-d H:i:s')
                                                        );
            //Creating new issue.
            $issue_new = array();
            $issue_new['issue_id'] = $this->m_issue->new_id('issue');
            $issue_new['issue_datetime']                = date('Y-m-d H:i:s');
            $issue_new['issue_deadline']                = date('Y-m-d 16:30:00', strtotime("+".$this->settings->issue_deadline." days"));
            $issue_new['issue_book_id']                 = $issue->issue_book_id;
            $issue_new['issue_book_copy_accession_no']  = $issue->issue_book_copy_accession_no;
            $issue_new['user_id']                       = $issue->user_id;
            $issue_new['manager_id']                    = $this->session->admin_id;
            $issue_new['issue_status']                  = 1;
            $issue_new['issue_lend_user_code']          = $this->__unique_code();
            $issue_new['issue_receive_user_code']       = $this->__unique_code();
            $issue_new['issue_receive_admin_code']      = $this->__unique_code();
            $issue_new['issue_fine_user_code']          = $this->__unique_code();
            $issue_new['issue_fine_admin_code']         = $this->__unique_code();
            $issue_new['issue_renew_user_code']         = $this->__unique_code();
            $issue_new['issue_remarks']                 = '';

            $status = $this->m_issue->renew_issue($issue_updated, $issue_new);

            // echo $status;
            // $this->printer($issue);
            // $this->printer($issue_updated);
            // $this->printer($issue_new, true);

            if($status) {
                $msg = "Renewed Issue #".$issue_id." (".$issue->book_title."). New Issue ID: #".$issue_new['issue_id'];
                $this->insert_sms($issue->user_phone, $msg);

                $this->redirect_msg('admin/issue/active', 'Successfully Renewed, New Issue ID: #'.$issue_new['issue_id'], 'success');
            }
            else $this->redirect_msg('admin/issue/active', 'Something went wrong', 'danger');
        }
        else $this->redirect_msg('admin/issue/active', 'Invalid Issue ID', 'danger');
    }

    public function delete($issue_id=NULL) {
        if(!$issue_id) $this->redirect_msg('admin/issue', 'Issue ID is required', 'danger');
        $issue = $this->m_issue->get_single_issue($issue_id);
        if($issue) {
            if($issue->issue_status == 0) $this->redirect_msg('admin/issue/', 'Confirmed Issue Cannot Be Deleted', 'danger');
            else if($issue->issue_status == 1) { // Book occupied, needs to release the book
                $book = array('book_id' => $issue->book_id, 'book_available' => $issue->book_available + 1);
                $book_copy = array('book_copy_accession_no' => $issue->issue_book_copy_accession_no, 'book_copy_status'=>1);
                $status = $this->m_issue->delete_issue($issue_id, $book);
            }
            else $status = $this->m_issue->delete_issue($issue_id); // Just delete the issue
            if($status) $this->redirect_msg('admin/issue/all', 'Successfully Deleted the Issue', 'success');
            else echo $this->redirect_msg('admin/issue/all', 'Something Went Wrong', 'danger');
        }
        else $this->redirect_msg('admin/issue/all', 'Invalid Issue ID', 'danger');
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


    public function issue_add_super_admin() {
        // $this->printer($_POST, true);
        $user_id = $_POST['user_id'];
        // Getting user by user library code
        $user = $this->m_issue->get_user_by_user_id($user_id);
        if(!$user) $this->redirect_msg('/admin/issue', 'Invalid User ID', 'danger');
        if($user->is_deleted) $this->redirect_msg('/admin/issue', 'This user is deactivated', 'danger');
        $msg = array();
        for($i=1; $i<=$_POST['num_of_books']; ++$i) {
            $field = 'book_'.$i;
            // Processing Single Book
            $book_copy_accession_no = $_POST[$field];
            $book_copy = $this->m_book->get_single_copy_details($book_copy_accession_no);
            if(!$book_copy) array_push($msg, array("Accession No. #$book_copy_accession_no Doesn't Exist)", "danger"));
            else if($this->m_issue->check_book_duplicate_issue($user->user_id, $book_copy->book_id))
                array_push($msg, array("A copy of this book is currently Issued to/Requested by you", "danger"));
            else if($book_copy->book_available == 0)
                array_push($msg, array("Accession No. #$book_copy_accession_no ($book_copy->book_title) is Not Available right now (All copies are lent out)", "danger"));
            else if($book_copy->book_copy_status==0) 
                array_push($msg, array("Accession No. #$book_copy_accession_no ($book_copy->book_title) is already issued to someone else", "danger"));
            else if($book_copy->book_copy_type==0) {
                if($user->is_teacher) {
                    // Create process for issuing reference copy to teachers.
                    if($this->issue_book($book_copy, $book_copy_accession_no, $user)) { 
                        array_push($msg, array("Accession No. #$book_copy_accession_no ($book_copy->book_title) Issued Successfully (Issue #".$issue['issue_id'].") until ".date('M d, Y h:i a', strtotime($issue['issue_deadline'])), "success"));
                    } 
                }
                else array_push($msg, array("Accession No. #$book_copy_accession_no ($book_copy->book_title) is a Reference Copy<br>Reference copies can only be issued by Teachers", "danger"));
            }
            else if($book_copy->book_copy_is_deleted==1) 
                array_push($msg, array("Accession No. #$book_copy_accession_no ($book_copy->book_title) is a Deleted Book", "danger"));
            else {   // Everything Clear, Proceed to issue the book
                if($this->issue_book($book_copy, $book_copy_accession_no, $user)) { 
                    array_push($msg, array("Accession No. #$book_copy_accession_no ($book_copy->book_title) Issued Successfully (Issue #".$issue['issue_id'].") until ".date('M d, Y h:i a', strtotime(date('Y-m-d 16:30:00', strtotime("+".$this->settings->issue_deadline." days")))), "success"));
                } 
            }
        }
        $this->redirect_msg('/admin/issue/active', $msg, '', count($msg));
    }
}
