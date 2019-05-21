<?php

class Base_Controller extends CI_Controller
{
    public $library_code_length = 8;
    public $sync_interval = 7; // value in seconds
    public $settings = NULL;
	 function __construct()
	 {
        parent::__construct();

        // Setting Timezone
        date_default_timezone_set("Asia/Dhaka");
        // loading libraries
        $this->load->library('session');

        // loading models (If necessary)
        $this->load->model("admin/m_admin");
        $this->load->model("admin/m_settings");
        $this->settings = $this->m_settings->all_settings();
        // Setting Branch Prefix 'm' for local server, 's' for remote server.
        $_SESSION['branch_prefix'] = $this->settings->application_role ? 's':'m';

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

    public function printer($arr, $exit_flag = false, $return_flag=false) { // for debug purpose
        $text  = '';
        $text .= '<pre>';
        $text .= print_r($arr, true);
        $text .= '</pre>';

        // $text = nl2br($text);

        if($return_flag) return $text;
        else echo $text;

        if($exit_flag) exit();
    }
    
    public function tabular($arr, $exit_flag=false, $display=true, $style=true, $attr='cellspacing="0" cellpadding="3" style="background-color: #fff; font-size: 10px; font-family: monaco, consolas"') {
        // if(!$style) $attr = '';
        $table = '';
        $css = '';
        if(is_array($arr) || is_object($arr)) {
            $first_row_flag=true;
            $css .= '<style type="text/css">'."\n";
            $css .= 'tbody > tr > td {border: none; border-right: solid 1px #999;}'."\n";
            $css .= 'td:first-child {border-left: solid 1px #999;}'."\n";
            $css .= 'thead > tr {background-color: #fff; color:#000;}'."\n";
            $css .= 'thead > tr > th {border: solid 1px #999;}'."\n";
            $css .= 'tr:last-child > td {border-bottom: solid 1px #999;}'."\n";
            $css .= 'tr {vertical-align: top;}'."\n";
            $css .= 'table {margin: 10 0; border-collapse: collapse;}'."\n";
            // $css .= 'th {position: sticky; position: -webkit-sticky; top: 0; z-index: 10;}'."\n";
            $css .= '</style>'."\n";
            $table .= "<table $attr>";
            $color_flag = true;
            foreach ($arr as $k => $row) {
                if($first_row_flag) {
                    if(is_array($row) || is_object($row)) {
                        $table .= '<thead><tr>';
                        foreach ($row as $key => $val) {
                            $table .= '<th>'.$key.'</th>';
                        }
                        $table .= '</tr></thead><tbody>';
                        $first_row_flag = false;
                    }
                    else $table .= '<td>'.$this->printer($row, false, true).'</td>';
                }

                if(is_array($row) || is_object($row)) {
                    $color = '';
                    if($color_flag && $style) $color = 'style="background-color: #eee;"';
                    $color_flag = !$color_flag;
                    $table .= "<tr $color>";
                    foreach ($row as $key => $val) {
                        // $table .= '<td>'.$val.'</td>';
                        $table .= '<td>';
                        // if(is_array($val) || is_object($val)) {
                            $table .= $this->printer($val, false, true);
                        // }
                        $table .= '</td>';
                    }
                    $table .= '</tr>';
                }
                else $table .= '<td>'.$this->printer($row, false, true).'</td>';
            }
            $table .= "</tbody></table>";
        }
        else $table .= $this->printer($arr, false, true);

        if($display) {
            if($style) echo $css;
            echo $table;
        }
        else return $table;

        if($exit_flag) exit();
    }
    
    public function __log() {
        if(isset($_SESSION['sync'])) return;
        if(get_class($this->ci) == 'Sync') {
            if(!isset($_SESSION['sync_on'])) return;
            unset($_SESSION['sync_on']);
        }

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
	    // return $CI->config->item('branch').'_'.$new_key;
        return $_SESSION['branch_prefix'].$new_key;
	}

    public function redirect_msg($url, $msg='', $type="success", $number=0, $prevent_logging=0) {
    	if(!$prevent_logging) $this->__log();
    	if($number==0) $this->session->set_flashdata(array('msg' => array(0=>array($msg, $type)), 'number' => 1));
    	else $this->session->set_flashdata(array('msg' => $msg, 'number' => $number));
    	redirect($url);
    }

    public function __set_barcode($code, $size=14, $factor=2.00) {
        $filepath = "";
        $orientation = "vertical";
        $code_type = "code128";
        $print = false;

        $this->generate_barcode($filepath, $code, $size, $orientation, $code_type, $print, $factor );
    }

    public function generate_barcode( $filepath="", $text="0", $size="20", $orientation="horizontal", $code_type="code128", $print=false, $SizeFactor=1 ) {
        /*
         *  Author  David S. Tufts
         *  Company davidscotttufts.com
         *  URL https://www.sourcecodester.com/tutorials/php/12310/php-simple-barcode-generator.html
         *    
         *  Date:   05/25/2003
         *  Usage:  <img src="/barcode.php?text=testing" alt="testing" />
         */
        $code_string = "";
        // Translate the $text into barcode the correct $code_type
        if ( in_array(strtolower($code_type), array("code128", "code128b")) ) {
            $chksum = 104;
            // Must not change order of array elements as the checksum depends on the array's key to validate final code
            $code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","\`"=>"111422","a"=>"121124","b"=>"121421","c"=>"141122","d"=>"141221","e"=>"112214","f"=>"112412","g"=>"122114","h"=>"122411","i"=>"142112","j"=>"142211","k"=>"241211","l"=>"221114","m"=>"413111","n"=>"241112","o"=>"134111","p"=>"111242","q"=>"121142","r"=>"121241","s"=>"114212","t"=>"124112","u"=>"124211","v"=>"411212","w"=>"421112","x"=>"421211","y"=>"212141","z"=>"214121","{"=>"412121","|"=>"111143","}"=>"111341","~"=>"131141","DEL"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","FNC 4"=>"114131","CODE A"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
            $code_keys = array_keys($code_array);
            $code_values = array_flip($code_keys);
            for ( $X = 1; $X <= strlen($text); $X++ ) {
                $activeKey = substr( $text, ($X-1), 1);
                $code_string .= $code_array[$activeKey];
                $chksum=($chksum + ($code_values[$activeKey] * $X));
            }
            $code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

            $code_string = "211214" . $code_string . "2331112";
        } elseif ( strtolower($code_type) == "code128a" ) {
            $chksum = 103;
            $text = strtoupper($text); // Code 128A doesn't support lower case
            // Must not change order of array elements as the checksum depends on the array's key to validate final code
            $code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","NUL"=>"111422","SOH"=>"121124","STX"=>"121421","ETX"=>"141122","EOT"=>"141221","ENQ"=>"112214","ACK"=>"112412","BEL"=>"122114","BS"=>"122411","HT"=>"142112","LF"=>"142211","VT"=>"241211","FF"=>"221114","CR"=>"413111","SO"=>"241112","SI"=>"134111","DLE"=>"111242","DC1"=>"121142","DC2"=>"121241","DC3"=>"114212","DC4"=>"124112","NAK"=>"124211","SYN"=>"411212","ETB"=>"421112","CAN"=>"421211","EM"=>"212141","SUB"=>"214121","ESC"=>"412121","FS"=>"111143","GS"=>"111341","RS"=>"131141","US"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","CODE B"=>"114131","FNC 4"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
            $code_keys = array_keys($code_array);
            $code_values = array_flip($code_keys);
            for ( $X = 1; $X <= strlen($text); $X++ ) {
                $activeKey = substr( $text, ($X-1), 1);
                $code_string .= $code_array[$activeKey];
                $chksum=($chksum + ($code_values[$activeKey] * $X));
            }
            $code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

            $code_string = "211412" . $code_string . "2331112";
        } elseif ( strtolower($code_type) == "code39" ) {
            $code_array = array("0"=>"111221211","1"=>"211211112","2"=>"112211112","3"=>"212211111","4"=>"111221112","5"=>"211221111","6"=>"112221111","7"=>"111211212","8"=>"211211211","9"=>"112211211","A"=>"211112112","B"=>"112112112","C"=>"212112111","D"=>"111122112","E"=>"211122111","F"=>"112122111","G"=>"111112212","H"=>"211112211","I"=>"112112211","J"=>"111122211","K"=>"211111122","L"=>"112111122","M"=>"212111121","N"=>"111121122","O"=>"211121121","P"=>"112121121","Q"=>"111111222","R"=>"211111221","S"=>"112111221","T"=>"111121221","U"=>"221111112","V"=>"122111112","W"=>"222111111","X"=>"121121112","Y"=>"221121111","Z"=>"122121111","-"=>"121111212","."=>"221111211"," "=>"122111211","$"=>"121212111","/"=>"121211121","+"=>"121112121","%"=>"111212121","*"=>"121121211");

            // Convert to uppercase
            $upper_text = strtoupper($text);

            for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
                $code_string .= $code_array[substr( $upper_text, ($X-1), 1)] . "1";
            }

            $code_string = "1211212111" . $code_string . "121121211";
        } elseif ( strtolower($code_type) == "code25" ) {
            $code_array1 = array("1","2","3","4","5","6","7","8","9","0");
            $code_array2 = array("3-1-1-1-3","1-3-1-1-3","3-3-1-1-1","1-1-3-1-3","3-1-3-1-1","1-3-3-1-1","1-1-1-3-3","3-1-1-3-1","1-3-1-3-1","1-1-3-3-1");

            for ( $X = 1; $X <= strlen($text); $X++ ) {
                for ( $Y = 0; $Y < count($code_array1); $Y++ ) {
                    if ( substr($text, ($X-1), 1) == $code_array1[$Y] )
                        $temp[$X] = $code_array2[$Y];
                }
            }

            for ( $X=1; $X<=strlen($text); $X+=2 ) {
                if ( isset($temp[$X]) && isset($temp[($X + 1)]) ) {
                    $temp1 = explode( "-", $temp[$X] );
                    $temp2 = explode( "-", $temp[($X + 1)] );
                    for ( $Y = 0; $Y < count($temp1); $Y++ )
                        $code_string .= $temp1[$Y] . $temp2[$Y];
                }
            }

            $code_string = "1111" . $code_string . "311";
        } elseif ( strtolower($code_type) == "codabar" ) {
            $code_array1 = array("1","2","3","4","5","6","7","8","9","0","-","$",":","/",".","+","A","B","C","D");
            $code_array2 = array("1111221","1112112","2211111","1121121","2111121","1211112","1211211","1221111","2112111","1111122","1112211","1122111","2111212","2121112","2121211","1121212","1122121","1212112","1112122","1112221");

            // Convert to uppercase
            $upper_text = strtoupper($text);

            for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
                for ( $Y = 0; $Y<count($code_array1); $Y++ ) {
                    if ( substr($upper_text, ($X-1), 1) == $code_array1[$Y] )
                        $code_string .= $code_array2[$Y] . "1";
                }
            }
            $code_string = "11221211" . $code_string . "1122121";
        }

        // Pad the edges of the barcode
        $code_length = 20;
        if ($print) {
            $text_height = 30;
        } else {
            $text_height = 0;
        }
        
        for ( $i=1; $i <= strlen($code_string); $i++ ){
            $code_length = $code_length + (integer)(substr($code_string,($i-1),1));
            }

        if ( strtolower($orientation) == "horizontal" ) {
            $img_width = $code_length*$SizeFactor;
            $img_height = $size;
        } else {
            $img_width = $size;
            $img_height = $code_length*$SizeFactor;
        }

        $image = imagecreate($img_width, $img_height + $text_height);
        $black = imagecolorallocate ($image, 0, 0, 0);
        $white = imagecolorallocate ($image, 255, 255, 255);

        imagefill( $image, 0, 0, $white );
        if ( $print ) {
            imagestring($image, 5, 31, $img_height, $text, $black );
        }

        $location = 10;
        for ( $position = 1 ; $position <= strlen($code_string); $position++ ) {
            $cur_size = $location + ( substr($code_string, ($position-1), 1) );
            if ( strtolower($orientation) == "horizontal" )
                imagefilledrectangle( $image, $location*$SizeFactor, 0, $cur_size*$SizeFactor, $img_height, ($position % 2 == 0 ? $white : $black) );
            else
                imagefilledrectangle( $image, 0, $location*$SizeFactor, $img_width, $cur_size*$SizeFactor, ($position % 2 == 0 ? $white : $black) );
            $location = $cur_size;
        }
        
        // Draw barcode to the screen or save in a file
        if ( $filepath=="" ) {
            header ('Content-type: image/png');
            imagepng($image);
            imagedestroy($image);
        } else {
            imagepng($image,$filepath);
            imagedestroy($image);       
        }
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

    // =============================== SMS Functions ===========================

    /*
    public function send_sms($to=NULL, $message=NULL) {
        if(!$this->settings->sms_sending_status) return 'SMS Sending Turned Off By Admin';
        
        // Returns 'success' if succeeded, returns API Reply if SMS is not sent.
        
        if(!$to || !$message) return 'Recipient and Message Text is Required';


        $sms = array();
        $sms['to']      = $to;
        $sms['message'] = $message;
        $sms['token']   = $this->settings->sms_access_token;

        // $this->printer($sms, true);

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$this->settings->sms_gateway_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($sms));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $api_reply = curl_exec($ch);

        $sms_stat = explode(':', $api_reply)[0];

        // $sms_stat = 'Ok';

        if($sms_stat == 'Ok') return 'success';
        else return $api_reply;
    }
    */

    public function insert_sms($to=NULL, $message=NULL) {
        if(empty($to) || empty($message)) return false;
        $sms = array();
        $sms['sms_id'] = $this->new_id('sms');
        $sms['sms_phone'] = $to;
        $sms['sms_text'] = $message;

        return $this->m_settings->insert_sms($sms);
    }

}

?>