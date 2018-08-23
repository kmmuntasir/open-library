<?php

class Base_Controller extends CI_Controller
{
    public $library_code_length = 10;
    public $sync_interval = 7; // value in seconds
    public $settings = NULL;
	 function __construct()
	 {
	 	parent::__construct();

		// Setting Timezone
	 	date_default_timezone_set("Asia/Dhaka");

		// loading models (If necessary)
	 	//$this->load->model("admin/m_admin");
         $this->load->model("admin/m_settings");
         $this->settings = $this->m_settings->all_settings();

        // loading libraries
	 	$this->load->library('session');
	 }

     public function __download($file_absolute_path=NULL) {
        if(!$file_absolute_path) exit('No Path Found');
        $this->load->helper('download');
        force_download($file_absolute_path, NULL);
     }

	 public function __is_logged_in($module) {
	 	if($module == 'user') return (($user_id = $this->session->user_id) == NULL) ? false : true;
	 	else return (($admin_id = $this->session->admin_id) == NULL) ? false : true;
	 }

	 public function __security($module) {
	 	if(!$this->__is_logged_in($module)) redirect(site_url($module.'/login?url='.$this->uri->uri_string));
	 }

	 public function __do_upload($field, $config) {
		/*
			__do_upload() is a custom function to avoid the problem of loading the same library multiple times in the same CI controller and keep the code clean. It uses the same $config array format of CI upload library. $field is the name of the input field of the desired file upload form. 
		*/
		$result = array();
		$file_name = md5(microtime(true).$_FILES[$field]['name']); // Generating a unique name using current microtime
        $ext = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION); // Extracting the filename extension from the original filename

        $file_name .= '.'.$ext;

        $config['file_name'] = $file_name;

        $this->load->library('upload');

        $this->upload->initialize($config); 

        if ( ! $this->upload->do_upload($field)) {
        	$result['error'] = $this->upload->display_errors();
        	return $result;
        }
        else {
        	$result['error'] = false;
        	$result['success'] = $this->upload->data();
        	return $result;

        }
    }



    /**
	 * Generate a random string, using a cryptographically secure 
	 * pseudorandom number generator (random_int)
	 * 
	 * For PHP 7, random_int is a PHP core function
	 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
	 * 
	 * @param int $length      How many characters do we want?
	 * @param string $keyspace A string of all possible characters
	 *                         to select from
	 * @return string
	*/
	public function __unique_code($length=8, $keyspace = '0123456789@#$%&abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
	{
	    $str = '';
	    $max = mb_strlen($keyspace, '8bit') - 1;
	    for ($i = 0; $i < $length; ++$i) {
	        $str .= $keyspace[random_int(0, $max)];
	    }
	    return $str;
	}

    public function printer($arr, $exit_flag = false) { // for debug purpose
        echo '<pre>';
        print_r($arr);
        echo '</pre>';

        if($exit_flag) exit();
    }
    
    public function __log() {
        if(isset($_SESSION['sync'])) return;
        if(get_class($this->ci) == 'Sync') return;


        // echo 'Started Base Logging<br>';


        $CI = & get_instance();
        $queries = $CI->db->queries;
        
        foreach ($queries as $key => $query) {
            $query = str_replace(array("\r\n","\r","\n"),' ',trim($query));
            $arr = explode(' ', trim($query));
            $arr = $arr[0];
            $log_entry_id = $this->new_id('log');
            if($arr != "SELECT" && $arr != "select") {
                $CI->db->insert('log', array('log_entry_id' => "$log_entry_id", 'log_query' => "$query"));
            }
        }
    }

	public function new_id($table) {
        $CI = & get_instance();

	    if($table == 'log') $primary_key = $table.'_id';
        else $primary_key = 'id';

        $result = $CI->db->select($primary_key)->order_by($primary_key, 'DESC')->limit(1)->get($table)->row();
        // $this->printer($result);
	    if($result) {
	    	// $arr = explode('_', $result->$primary_key);
	    	// $new_key = $arr[count($arr)-1] + 1;
            $new_key = $result->$primary_key + 1;
	    }
	    else $new_key = 1;
	    return $CI->config->item('branch').'_'.$new_key;
	}

    public function redirect_msg($url, $msg='', $type="success", $number=0, $prevent_logging=0) {
    	if(!$prevent_logging) $this->__log();
    	if($number==0) $this->session->set_flashdata(array('msg' => array(0=>array($msg, $type)), 'number' => 1));
    	else $this->session->set_flashdata(array('msg' => $msg, 'number' => $number));
    	redirect($url);
    }

    public function __set_barcode($code, $barHeight=14, $factor = 1.98)
    {
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        /*****************************/
        $barcodeOptions = array(
            'text' => $code,
            'drawText' => false,
            'barHeight'=> $barHeight, 
            'factor'=>$factor,
        );
        $rendererOptions = array();
        //generate barcode
        $renderer = Zend_Barcode::factory(
            'code128', 'image', $barcodeOptions, $rendererOptions
        )->render();
        /******************************/
    }

    public function __barcode($code, $height=14, $factor = 1.98) {
    	return site_url("barcode/generate?code=$code&height=$height&factor=$factor");
	}
	
	public function my_curl($url, $data) {
		$field_data = 'curl_data=';
		$field_data .= json_encode($data);
		
		$ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $field_data);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		return curl_exec( $ch );
	}

	public function my_file_get_contents($url, $data) {
        $data = array('curl_data'=>json_encode($data));
        $options = array(
                'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            )
        );

        $context  = stream_context_create($options);
        return file_get_contents($url, false, $context);
	}

    public function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'Year',
            'm' => 'Month',
            'w' => 'Week',
            'd' => 'Day',
            'h' => 'Hour',
            'i' => 'Minute',
            's' => 'Second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(' ', $string) . ' Ago' : 'Just now';
    }

    public function time_elapsed_in_seconds($datetime) {
        return (time() - strtotime($datetime));
    }

    public function __mail($from, $to, $subject, $message, $cc=NULL, $bcc=NULL) {
        $this->load->library('email');

        $this->email->from($from, 'Library Admin');
        $this->email->to($to);

        $this->email->subject($subject);
        $this->email->message($message);

        if($cc) $this->email->cc($cc);
        if($bcc) $this->email->bcc($bcc);

        $this->email->send();
    }

    public function to_datatable_json_format($data, $json_output = false, $test_multiplier=1) {
        $json_data = array('data' => array());
        $i=0;

        for($m = 0; $m < $test_multiplier; ++$m) {
            foreach($data as $key=>$row) {
                $json_data['data'][$i] = array();
                foreach ($row as $cell_key => $cell) {
                    array_push($json_data['data'][$i], $cell);
                }
                ++$i;
            }
        }
        if($json_output) return json_encode($json_data);
        else return $json_data;
    }

}

?>