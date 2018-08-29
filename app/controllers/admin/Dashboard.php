<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Base_Controller {

	public $module = 'admin';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';

    public $backup_dir = 'backups/';
    public $upload_dir = 'uploads/';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        $this->__security($this->module);

        $this->load->model($this->module."/m_admin"); // Loading Model
        $this->load->model($this->module."/m_issue");
        $this->load->model($this->module."/m_sync");
        $this->load->model($this->module."/m_book");

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('admin/dashboard');
    }
    //====================================//

	public function index() {
            // $this->printer($_SESSION, true);
		$data = $this->data;
        $data['page'] = 'dashboard';
    	$data['page_title'] .= 'Dashboard';
        $data['source'] = site_url().'/admin/issue/issue_json/request';
        $data['data_page'] = 'request';

        $data['issues'] = $this->m_issue->all_issue_requests();
        
        $data['book_count'] = $this->m_book->count_books();
        $data['copy_count'] = $this->m_book->count_copies();
        $data['overdue_count'] = $this->m_issue->count_overdue_issues();
        $data['last_sync'] = $this->time_elapsed_string($this->m_sync->server_info()->server_last_connection, true);
        //$this->printer($data, true);
        $data['restore_action'] = $this->data['controller'].'/'.'restore';

        $data['content'] = 'v_dashboard.php';
    	$this->load->view($this->viewpath.'v_main', $data);
	}

    // ============================= Backup Functions =======================

    function backup() {
        if (!is_dir($this->backup_dir)) mkdir($this->backup_dir, 0777, TRUE);

        $filename = $this->backup_dir.'backup_'.'library'.'-'.date('Y-m-d_H-i-s').'.sql';
        $zipname  = $this->backup_dir.'backup_'.'library'.'-'.date('Y-m-d_H-i-s').'.zip';

        echo '<br>'.$filename.'<br>'.$zipname.'<br><br>';

        $this->backup_db($filename);

        $this->compress_and_remove($filename, $zipname);

        $this->load->helper('download');
        force_download($zipname, NULL);
    }

    function backup_db($filename, $clear_flag=true, $tables = '*') {
        // Cleaning Backup Dir first
        if($clear_flag) $this->clear_backup_dir($this->backup_dir);
        
        //get all of the tables
        if($tables == '*') $tables = $this->m_admin->fetch_all_tables();
        else $tables = is_array($tables) ? $tables : explode(',',$tables);

        // $this->printer($tables, true);

        $sql_text = "/*\n\nDate: ".date('Y-m-d H:i:s')."\n\n*/\n\n";
        $sql_text .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        
        //cycle through
        foreach($tables as $table) {
            $sql_text .= "-- ----------------------------\n";
            $sql_text .= "-- Table structure for `$table`\n";
            $sql_text .= "-- ----------------------------\n";

            // $num_fields = $this->m_admin->num_fields_in_table($table);
            $table_description = $this->m_admin->describe_table($table);
            $table_structure = $this->m_admin->table_structure($table);
            $num_rows = $this->m_admin->num_rows_in_table($table);

            $offset = 0;
            $limit = 1000;
            $fetch_flag = true;

            $sql_text.= 'DROP TABLE IF EXISTS `'.$table.'`;';

            $sql_text.= "\n".$table_structure.";\n\n";

            $sql_text .= "-- ----------------------------\n";
            $sql_text .= "-- Records of `$table`\n";
            $sql_text .= "-- ----------------------------\n";

            $this->append($sql_text, $filename);
            $sql_text = '';

            while($fetch_flag) {
                $table_data = $this->m_admin->fetch_table($table, $limit, $offset);
                $data_counter = 0;
                foreach ($table_data as $k => $row) {
                    $data_counter++;
                    $sql_text.= 'INSERT INTO `'.$table.'` VALUES (';
                    $delimiter = "";
                    $i = 0;
                    foreach ($row as $key => $col) {
                        $sql_text .= $delimiter;
                        if ($col === null) $sql_text .= 'null' ;
                        else {
                            $field_type = explode('(', $table_description[$i]->Type)[0];
                            if($field_type == "bit") $sql_text .= $col;
                            else {
                                $col = addslashes($col);
                                $col = str_replace("\n","\\n",$col);
                                $sql_text .= '"'.$col.'"';
                            }
                        }
                        $delimiter = ", ";
                        $i++;
                    }
                    $sql_text.= ");\n";
                }
                if($data_counter > 0) {
                    $this->append($sql_text, $filename);
                    $sql_text = '';
                    $offset += $limit;
                }
                else $fetch_flag = false;

            }
            $sql_text.="\n";
            $this->append($sql_text, $filename);
            $sql_text = '';
        }

        // echo '<h1>Saved Successfully</h1>';
        // echo '<strong>Filename: </strong>'.$filename.'<br><br>';


    }

    function append($string, $filename) {
        $handle = fopen($filename,'a+');
        fwrite($handle, $string);
        fclose($handle);
    }

    function compress_and_remove($filename, $zipname) {
        $this->load->library('zip');   
        $this->zip->compression_level = 9;
        $this->zip->read_file($filename);
        $compression_status = $this->zip->archive($zipname);

        if($compression_status) unlink($filename);
    }

    function clear_backup_dir($backup_dir) {
        $this->load->helper('file');
        delete_files($backup_dir, TRUE);
    }

    function extract_zip($zipname, $backup_dir) {
        $zip = new ZipArchive;
        if ($zip->open($zipname) === TRUE) {
            $zip->extractTo($backup_dir);
            $zip->close();
            unlink($zipname); // deletes the zip file. We no longer need it.
        }
    }

    function restore() {
        if(!$this->session->admin_type) exit('Admin Access Needed to Restore Backup');
        $client_file_name = 'backup_file';

        if(!isset($_FILES[$client_file_name])) exit('File Failed to Upload');

        if (!is_dir($this->backup_dir)) mkdir($this->backup_dir, 0777, TRUE);
        if (!is_dir($this->upload_dir)) mkdir($this->upload_dir, 0777, TRUE);
        $this->clear_backup_dir($this->upload_dir); // Clearing Upload Directory

        $safety_backup_filename = $this->backup_dir.'safety_backup_'.$this->db->database.'-'.date('Y-m-d_H-i-s').'.sql';


        $flag = false;
        $total_error = '';
        $file_name = '';

        //=====================================================
        // Configuration for Backup File Upload
        $config['upload_path']          = $this->upload_dir;
        $config['allowed_types']        = 'zip|sql';
        $config['max_size']             = 10240; // 10 Megabytes

        // Uploading Backup File
        if($_FILES[$client_file_name]['error'] == 0) {
            $upload = $this->__do_upload($client_file_name, $config);

            if(!$upload['error']) {
                $file_name = $upload['success']['file_name'];
                $flag = true;
            }
            else $total_error .= 'File Upload Error<br>'.$upload['error'];
        }
        if($flag) {
            // Upload Done, Start Restoring Process.
            $file_type = explode('/', $_FILES[$client_file_name]['type'])[1];
            if($file_type == 'zip') { // Zip Archive, needs to be extracted
                $this->extract_zip($this->upload_dir.$file_name, $this->upload_dir);
            }
            // In case of SQL files, we can directly import.

            $this->load->helper('directory');

            // --------------------- dir-----------Depth_LVL----Hidden_flag-------
            $map = directory_map($this->upload_dir,  1,   TRUE);

            if(count($map) != 1) echo 'Unauthorized Files Found. Please Upload Again.';
            else { // Found 1 File, now check the extension
                $found_file = $map[0];
                $ext = pathinfo($found_file, PATHINFO_EXTENSION);
                if($ext != 'SQL' && $ext != 'sql') echo 'Wrong Backup File / File Format';
                else { // SQL file found, now import.
                    rename($this->upload_dir.$found_file, $this->upload_dir."run.sql");
                    $found_file = "run.sql";
                    // Taking a backup of current system state.
                    $this->backup_db($safety_backup_filename);
                    echo 'Running SQL File: '.$found_file.'<br>';
                    $num_of_queries = $this->m_admin->run_sql_queries_one_by_one($this->upload_dir.$found_file);
                    if($num_of_queries) {
                        // $this->clear_backup_dir($this->upload_dir);
                        $this->clear_backup_dir($this->backup_dir); // Successful Restore, removing failsafe backup


                        echo 'Success! Total Number of Queries: '.$num_of_queries.'<br>';
                        echo 'success';

                        $this->redirect_msg('admin/login/logout', 'Success! Total Number of Queries: '.$num_of_queries.'<br>', 'success', 0, 1);
                    }
                    else { 
                        echo '<h4>Damaged/Wrong Backup File</h4><br>Attempting to Reverse to the Previous State of System...........<br>';
                        // Running Failsafe Restoration
                        $num_of_queries = $this->m_admin->run_sql_queries_one_by_one($safety_backup_filename);
                        if($num_of_queries) {
                            $this->clear_backup_dir($this->backup_dir); // Reversing Done
                            echo '<br>Successfully Reversed to the Previous State';
                        }
                        else {
                            echo '<br>Failed to Reverse. Failsafe Backup saved at: '.$safety_backup_filename;
                            echo '<h3>This is an emergency. Please contact your software developer and do not attempt to upload another backup file.</h3>';
                        }
                    }
                }
            }
            $this->clear_backup_dir($this->upload_dir); // Clearing Upload Directory
        }
        else echo $total_error;
    }

    function read_file_char_by_char($filename) {
        $file = fopen($this->backup_dir.$filename,"r");
        if($file) {
            while (! feof ($file)){
                echo fgetc($file);
            }
            fclose($file);
        }
    }

    function test() {

        $filepath = 'uploads/test.sql';
        $num_of_queries = $this->m_admin->run_sql_queries_one_by_one($filepath);

        echo $num_of_queries;

    }
}
