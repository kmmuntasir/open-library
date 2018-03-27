<?php

class M_user extends Ci_model {

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

    public function login_check_user($username, $password) {
    	$this->db->where('user_username', $username);
    	$this->db->where('user_pass', $password);
        $this->db->where('is_deleted', 0);
    	return $this->db->get('user')->row();
    }

    public function check_duplicate_reset_code($user_password_reset_code) {
        return $this->db->select('COUNT(*) as count')->where('user_password_reset_code', $user_password_reset_code)->get('user')->row()->count;
    }

    public function check_username_email($user_username, $user_email) {
    	return $this->db->where('user_username', $user_username)->where('user_email', $user_email)->get('user')->row();
    }
    public function update_user($user, $user_id) {
        $this->db->trans_start();
        $this->db->where('user_id', $user_id)->update('user', $user);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function get_user_by_password_reset_code($user_password_reset_code) {
        return $this->db->where('user_password_reset_code', $user_password_reset_code)->get('user')->row();
    }

    //=============================//
}
?>