<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Base_Controller {

	public $module = 'admin';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';

    public $upload_dir = 'uploads/';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        $this->__security($this->module);

        $this->load->model($this->module."/m_user"); // Loading Model

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('admin/user');
    }
    //====================================//

	public function index() {
        $this->students();
	}

    public function append($string, $filename) {
        $handle = fopen($filename,'a+');
        fwrite($handle, $string);
        fclose($handle);
    }

    public function clear_backup_dir($backup_dir) {
        $this->load->helper('file');
        delete_files($backup_dir, TRUE);
    }

	public function students($deleted=0) {
        $data = $this->data;
        $data['page'] = 'user';
        $data['page_title'] .= ($deleted) ? 'Deactivated Students' : 'Students';
        $data['content'] = 'v_student.php';

        $data['import_action'] = $this->data['controller'].'/import/0';
        $data['sample_file_link'] = $this->data['controller'].'/download_sample_file/0';

        $this->load->view($this->viewpath.'v_main', $data);
	}

    public function download_sample_file($is_teacher=0) {
        if($is_teacher != 0 && $is_teacher != 1) exit('Invalid Type');
        $filename = array('students', 'teachers');
        $file_absolute_url = 'docs/'.$filename[$is_teacher].'_list_sample.csv';
        $this->__download($file_absolute_url);
    }

    public function all_students($deleted=0) {
        $students = $this->m_user->all_students($deleted);
        //$this->printer($students);
        ini_set('memory_limit', '-1');
        echo $students = $this->to_datatable_json_format($students, 1, 1);
    }

	public function teachers($deleted=0) {
        $data = $this->data;
        $data['page'] = 'user';
        $data['page_title'] .= ($deleted) ? 'Deactivated Teachers' : 'Teachers';
        $data['content'] = 'v_teacher.php';


        $data['import_action'] = $this->data['controller'].'/import/1';
        $data['sample_file_link'] = $this->data['controller'].'/download_sample_file/1';

        $this->load->view($this->viewpath.'v_main', $data);
	}

    public function all_teachers($deleted=0) {
        $teachers = $this->m_user->all_teachers($deleted);
        //$this->printer($teachers);
        ini_set('memory_limit', '-1');
        echo $teachers = $this->to_datatable_json_format($teachers, 10, 1);
    }

    public function import($is_teacher = 0) {
        echo "Please wait, importing ...<br>";

        // $this->printer($_FILES, true);

        $user_type = array('students', 'teachers');

        $flag = false;
        $total_error = '';
        $file_name = '';

        $this->clear_backup_dir($this->upload_dir);

        //=====================================================
        // Configuration for Backup File Upload
        $config['upload_path']          = $this->upload_dir;
        $config['allowed_types']        = 'csv';
        $config['max_size']             = 10240; // 10 Megabytes

        // Uploading Backup File
        if($_FILES['csv_file']['error'] == 0) {
            $upload = $this->__do_upload('csv_file', $config);

            if(!$upload['error']) {
                $file_name = $upload['success']['file_name'];
                $flag = true;
            }
            else $total_error .= 'File Upload Error<br>'.$upload['error'];
        }

        //======== Upload Done, Start Importing Process =========

        $filepath  = $this->upload_dir.$file_name;
        $success_count = 0;
        $fail_count = 0;

        // exit($filepath);

        $users_arr = array();
        $export_arr = array();
        $file = fopen($filepath, "r");
        $fail_file_path = $this->upload_dir.'failed.csv';
        if($file) {
            if (!feof ($file)) {
                $str = fgets($file);
                $this->append($str, $fail_file_path);
            }
            while (!feof ($file)){

                $str = fgets($file);
                $str_exp = explode(",", $str);

                if(count($str_exp) == 6) {
                    // $this->printer($str_exp);
                    $single_fail_flag = false;
                    $single_user = array();
                    $single_export = array();
                    
                    $single_user['is_teacher']   = $is_teacher;

                    $single_user['user_id']              = $this->new_id('user');
                    $single_export['ID'] = $single_user['user_id'];

                    $single_user['user_name']            = trim($str_exp[0]);
                    $single_user['user_phone']           = $str_exp[1];
                    $single_user['user_email']           = $str_exp[2];
                    $single_user['user_dept']            = $str_exp[3];
                    $single_export['DEPT'] = $single_user['user_dept'];

                    if($is_teacher) {
                        $single_user['teacher_id']            = $str_exp[4];
                        $single_user['teacher_designation']   = $str_exp[5];
                    }
                    else {
                        $single_user['user_roll']            = (int)$str_exp[4];
                        $single_user['user_session']         = (int)$str_exp[5];

                        $single_export['Session'] = $single_user['user_session'];
                        $single_export['Roll'] = $single_user['user_roll'];
                    }

                    $single_export['Name'] = $single_user['user_name'];
                    $single_user['user_username']        = $str_exp[3].$str_exp[4].'_'.$single_user['user_id'];
                    $single_export['Username'] = $single_user['user_username'];
                    $single_export['Password'] = $this->__unique_code(8, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                    $single_user['user_pass']            = md5($single_export['Password']);

                    $single_user['user_library_code']    = substr(md5($single_user['user_id']), 16);


                    if(!$is_teacher) {
                        if($this->m_user->check_duplicate_student($single_user['user_dept'], $single_user['user_session'], $single_user['user_roll'])) {
                            $this->append($str, $fail_file_path);
                            $fail_count++;
                            $single_fail_flag = true;
                        }
                    }

                    if(!$single_fail_flag) {
                        $status = $this->m_user->add_user($single_user);
                        // $this->printer($this->db->last_query());

                        if($status) $success_count++;
                        else {
                            $this->append($str, $fail_file_path);
                            $fail_count++;
                        }

                        // $this->printer($single_user);

                        array_push($users_arr, $single_user);
                        array_push($export_arr, $single_export);

                        // $this->printer($single_user);
                        // $this->printer($single_export);
                    }
                }

            }
            fclose($file);
            echo "Fail: ". $fail_count.'<br>';
            echo "Success: ". $success_count.'<br>';

            unlink($filepath);

            if($fail_count == 0) {
                echo "Import Success";
                unlink($fail_file_path);
                echo "<h1 style='color:#f00;'>DON'T CLOSE THIS BROWSER PAGE!!!<br>This is the only time you can see this table. Please copy the following table and paste it to MS Word or any other word processing software to store and print.</h1>";
                $this->tabular($export_arr, false, true, true, 'cellspacing="0" cellpadding="10" style="background-color: #fff; font-size: 14px;" align="center"');
                // $this->redirect_msg('/admin/user/'.$user_type[$is_teacher], 'Imported Successfully', 'success');
            }
            else {
                if($success_count == 0) {
                    echo "Import Failed";
                    unlink($fail_file_path);
                    echo 'Import Failed';
                    // $this->redirect_msg('/admin/user/'.$user_type[$is_teacher], 'Import Failed', 'danger');
                }
                else {
                    $status_msg = "Import Partially Succeeded<br>Success Count: ".$success_count.'<br>';
                    $status_msg .= "Click below to download the failed user list...<br>";
                    echo $status_msg;
                    $fail_url = site_url('admin/user/download_failed_file');
                    echo '<a href="'.$fail_url.'">Download Failed File List</a>';
                    echo '<br><h3>Success List</h3>';
                echo "<h1 style='color:#f00;'>DON'T CLOSE THIS BROWSER PAGE!!!<br>This is the only time you can see this table. Please copy the following table and paste it to MS Word or any other word processing software to store and print.</h1>";
                    $this->tabular($export_arr, false, true, true, 'cellspacing="0" cellpadding="10" style="background-color: #fff; font-size: 14px;" align="center"');
                }
            }
        }
        else echo 'Invalid Path';
    }

    public function download_failed_file() {
        $fail_file_path = $this->upload_dir.'failed.csv';
        $this->__download($fail_file_path);
    }

    public function add($user_type = 'students') {
    	if($_POST['user_dept'] == 'nothing') $this->redirect_msg('/admin/user/'.$user_type, 'You must select a department!', 'danger');
    	if($_POST['user_pass_1'] != $_POST['user_pass_2']) $this->redirect_msg('/admin/user/'.$user_type, 'Passwords do not match!', 'danger');

    	if($this->m_user->user_handle_check($_POST['user_username']) > 0) $this->redirect_msg('/admin/user/'.$user_type, 'Username is not available', 'danger');

    	if($user_type == 'teachers') $_POST['is_teacher'] = 1;

        $_POST['user_pass'] = md5($_POST['user_pass_1']);
        unset($_POST['user_pass_1']);
        unset($_POST['user_pass_2']);

        $flag = true;
        do {
            $new_code = $this->__unique_code($this->library_code_length);
            if(!$this->m_user->check_library_code($new_code)) $flag = false;
        }while($flag);

        $_POST['user_library_code'] = $new_code;

        $_POST['user_id'] = $this->m_user->new_id('user');
    	//$this->printer($_POST, true);
        if($status = $this->m_user->add_user($_POST)) $this->redirect_msg('/admin/user/'.$user_type, 'User Added Successfully', 'success');
        else $this->redirect_msg('/admin/user/'.$user_type, 'Something went wrong!', 'danger');
    }

    public function single_user($user_id=NULL) {
        if(!$user_id) echo false;
        echo json_encode($this->m_user->get_single_user($user_id));
    }

    public function update($user_id=NULL) {
        if(!$user_id) redirect_msg('/admin/user');
        if($_POST['user_dept'] == 'nothing') $this->redirect_msg('/admin/user', 'You must select a department!', 'danger');
    	if($this->m_user->other_user_handle_check($user_id, $_POST['user_username']) > 0) $this->redirect_msg('/admin/user', 'Username is not available', 'danger');
    	if($_POST['user_pass_1'] != $_POST['user_pass_2']) $this->redirect_msg('/admin/user', 'Passwords do not match!', 'danger');
    	else if($_POST['user_pass_1'] != '') $_POST['user_pass'] = md5($_POST['user_pass_1']);
        unset($_POST['user_pass_1']);
        unset($_POST['user_pass_2']);

        //$this->printer($_POST, true);

        $aff = $this->m_user->update_user($user_id, $_POST);

        $user = $this->m_user->get_single_user($user_id);
        // $this->printer($user, true);
        if($user->is_teacher) $subpage = '/teachers';
        else $subpage = '/students';

        if($aff) $this->redirect_msg('/admin/user'.$subpage, 'User Updated Successfully', 'success');
        else $this->redirect_msg('/admin/user'.$subpage, 'Something went wrong!', 'danger');
    }

    public function delete($user_id=NULL) {
        if(!$user_id) redirect_msg('/admin/user');
        $count = $this->m_user->check_user_for_issue($user_id);
        if($count > 0) $this->redirect_msg('/admin/user', 'There are incomplete issues from this user', 'danger');


        $user = $this->m_user->get_single_user($user_id);
        if($user->is_teacher) $subpage = '/teachers';
        else $subpage = '/students';


        if($status = $this->m_user->delete_user($user_id)) 
        	$this->redirect_msg('/admin/user'.$subpage, 'User Deactivated Successfully', 'success');
        else $this->redirect_msg('/admin/user'.$subpage, 'Something went wrong!', 'danger');
    }

    public function reactivate($user_id=NULL) {
        if(!$user_id) redirect_msg('/admin/user');

        $user = $this->m_user->get_single_user($user_id);
        if($user->is_teacher) $subpage = '/teachers';
        else $subpage = '/students';

        if($status = $this->m_user->reactivate_user($user_id)) 
            $this->redirect_msg('/admin/user'.$subpage, 'User Reactivated Successfully', 'success');
        else $this->redirect_msg('/admin/user'.$subpage, 'Something went wrong!', 'danger');
    }
}
