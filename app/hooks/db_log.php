<?php 
// Name of Class as mentioned in $hook['post_controller]

class Db_log {
    protected $ci;

    public function __construct()
    {
        global $CI;
        $this->ci = $CI;
    }
 
    // Name of function same as mentioned in Hooks Config
    function logQueries() {
        if(get_class($this->ci) == 'Sync') return;
        $CI = & get_instance();
        $queries = $CI->db->queries;
        
        foreach ($queries as $key => $query) {
            $query = str_replace(array("\r\n","\r","\n"),' ',trim($query));
            $arr = explode(' ', trim($query));
            $arr = $arr[0];
            $log_entry_id = $this->new_id('log');
            //echo $log_entry_id.' - '.$query.'<br/>';
            if($arr != "SELECT" && $arr != "select") {
                $CI->db->insert('log', array('log_entry_id' => "$log_entry_id", 'log_query' => "$query"));
            }
        }
    }


	public function new_id($table) {
        $CI = & get_instance();
	    $primary_key = $table.'_id';
        $result = $CI->db->select($primary_key)->order_by($primary_key, 'DESC')->limit(1)->get($table)->row();
	    if($result) {
	    	$arr = explode('_', $result->$primary_key);
	    	$new_key = $arr[count($arr)-1] + 1;
	    }
	    else $new_key = 1;
	    return $CI->config->item('branch').'_'.$new_key;
	}
 
}
