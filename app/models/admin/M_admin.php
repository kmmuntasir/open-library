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
    	return $this->db->get('manager')->row();
    }

    //=============================//
}
?>