<?php

class M_admin extends Ci_model {

    // Basic Functions

    // public function get_single_manager($manager_id) {
    //     $this->db->where('manager_id', $manager_id);
    //     return $this->db->get('manager')->row();
    // }

    // public function manager_handle_check($manager_user) {
    //     $this->db->where('manager_user', $manager_user);
    //     $result = $this->db->get('manager');
    //     return $result->num_rows();
    // }

    //login check functions //

    public function login_check_manager($username, $password) {
    	$this->db->where('manager_user', $username);
    	$this->db->where('manager_pass', $password);
        $this->db->where('is_deleted', 0);
    	return $this->db->get('manager')->row();
    }
    

    //========backup functions=====//

    function fetch_all_tables() {
        return $this->db->list_tables();
    }

    function fetch_table($table, $limit=1000, $offset=0) {
        $this->db->limit($limit, $offset);
        return $this->db->get($table)->result();
    }

    function table_structure($table) {
        $query = 'SHOW CREATE TABLE `'.$table.'`';
        $result = $this->db->query($query)->row();

        $structure = '';

        $i=1;
        foreach ($result as $key => $text) {
            if($i == 2) $structure = $text;
            $i++;
        }

        return $structure;
    }

    function describe_table($table) {
        $query = 'DESCRIBE '.$table;
        $result = $this->db->query($query)->result();

        return $result;
    }

    function num_rows_in_table($table) {
        return $this->db->get($table)->num_rows();
    }

    function num_fields_in_table($table) {
        return $this->db->get($table)->num_fields();
    }

    function run_sql_queries_one_by_one($sql_file_name) {
        $file = fopen($sql_file_name, "r");
        if($file) {
            $num_of_queries = 0;
            $query = '';
            $this->db->trans_start();
            while (!feof ($file)){
                $last_char = fgetc($file);
                $query .= $last_char;
                if($last_char == ';') { // One Query Found, now run it.
                    // echo $query.'<br>';
                    ++$num_of_queries;
                    $flag = $this->db->query($query);
                    if($flag == false) break;
                    $query = '';
                }
            }
            $this->db->trans_complete();

            if($this->db->trans_status()) return $num_of_queries;
            else return false;

            fclose($file);
        }
        else return false;
    }

    //=============================//
}
?>