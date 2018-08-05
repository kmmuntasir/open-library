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

    public function import($is_teacher = 0) {
        echo "Please wait, importing ...<br>";
        // $this->printer($_FILES, true);

        $flag = false;
        $total_error = '';
        $file_name = '';

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

        // exit($filepath);

        $users_arr = array();
        $file = fopen($filepath, "r");
        if($file) {
            if (!feof ($file)) {
                $str = fgets($file);
            }
            while (!feof ($file)){

                $str = fgets($file);
                $str_exp = explode(",", $str);

                if(count($str_exp) == 6) {
                    // $this->printer($str_exp);
                    $single_user = array();

                    $single_user['user_name']            = $str_exp[0];
                    $single_user['user_phone']           = $str_exp[1];
                    $single_user['user_email']           = $str_exp[2];
                    $single_user['user_dept']            = $str_exp[3];
                    $single_user['user_roll']            = (int)$str_exp[4];
                    $single_user['user_session']         = (int)$str_exp[5];

                    $single_user['user_username']        = $str_exp[3].$str_exp[4];
                    $single_user['user_pass']            = $this->__unique_code();

                    $single_user['user_id']              = $this->new_id('user');
                    $single_user['user_library_code']    = substr(md5($single_user['user_id']), 16);

                    $status = $this->m_user->add_user($single_user);

                    array_push($users_arr, $single_user);
                }

            }

            $this->printer($users_arr);


            fclose($file);
        }
        else echo 'Invalid Path';
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
        $this->load->view($this->viewpath.'v_main', $data);
	}

    public function all_teachers($deleted=0) {
        $teachers = $this->m_user->all_teachers($deleted);
        //$this->printer($teachers);
        ini_set('memory_limit', '-1');
        echo $teachers = $this->to_datatable_json_format($teachers, 10, 1);
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
        if($aff) $this->redirect_msg('/admin/user', 'User Updated Successfully', 'success');
        else $this->redirect_msg('/admin/user', 'Something went wrong!', 'danger');
    }

    public function delete($user_id=NULL) {
        if(!$user_id) redirect_msg('/admin/user');
        $count = $this->m_user->check_user_for_issue($user_id);
        if($count > 0) $this->redirect_msg('/admin/user', 'There are incomplete issues from this user', 'danger');
        if($status = $this->m_user->delete_user($user_id)) 
        	$this->redirect_msg('/admin/user', 'User Deactivated Successfully', 'success');
        else $this->redirect_msg('/admin/user', 'Something went wrong!', 'danger');
    }

    public function reactivate($user_id=NULL) {
        if(!$user_id) redirect_msg('/admin/user');
        if($status = $this->m_user->reactivate_user($user_id)) 
            $this->redirect_msg('/admin/user', 'User Reactivated Successfully', 'success');
        else $this->redirect_msg('/admin/user', 'Something went wrong!', 'danger');
    }
}
