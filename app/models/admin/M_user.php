<?php

class M_user extends Ci_model {

    // Basic Functions

    public function all_users() {
    	$this->db->where('is_deleted', 0);
        return $this->db->get('user')->result();
    }

    public function all_students($deleted=0) {
        $this->db->select('user_id, user_name, user_username, user_dept, user_session, user_roll, user_email, user_phone');
        $this->db->select('user_id as id');
    	$this->db->where('is_deleted', $deleted);
        $this->db->where('is_teacher', 0);
        return $this->db->get('user')->result();
    }
    public function all_teachers($deleted=0) {
        $this->db->select('user_id, user_name, user_username, teacher_designation, user_dept, user_email, user_phone');
        $this->db->select('user_id as id');
    	$this->db->where('is_deleted', $deleted);
        $this->db->where('is_teacher', 1);
        return $this->db->get('user')->result();
    }

    public function get_single_user($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('user')->row();
    }

    public function add_user($user) {
    	$this->db->trans_start();
        $this->db->insert('user', $user);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function update_user($user_id, $user) {
    	$this->db->trans_start();
        $this->db->where('user_id', $user_id);
        $this->db->update('user', $user);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function delete_user($user_id) {
    	$this->db->trans_start();
        $this->db->where('user_id', $user_id)->update('user', array('is_deleted'=>1));
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function reactivate_user($user_id) {
        $this->db->trans_start();
        $this->db->where('user_id', $user_id)->update('user', array('is_deleted'=>0));
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function user_handle_check($user_username) {
        $this->db->where('user_username', $user_username);
        $result = $this->db->get('user');
        return $result->num_rows();
    }

    public function other_user_handle_check($user_id, $user_username) {
    	$result = $this->db->where('user_id !=', $user_id)->where('user_username', $user_username)->get('user');
        return $result->num_rows();
    }

    public function check_user_for_issue($user_id) {
    	$this->db->where('user_id', $user_id)->where('issue_status <', 3)->where('issue_status !=', 0);
    	return $this->db->get('issue')->num_rows();
    }
    
    public function check_library_code($user_library_code) {
        return $this->db->where('user_library_code', $user_library_code)->get('user')->num_rows();
    }

}
?>