<?php

class M_profile extends Ci_model {

    // Basic Functions

    public function details() {
        return $this->db->where('user_id', $this->session->userdata['user_id'])->get('user')->row();
    }

    public function update($user) {
    	$this->db->trans_start();
    	$this->db->where('user_id', $this->session->userdata['user_id'])->update('user', $user);
    	$this->db->trans_complete();
    	return $this->db->trans_status();
    }

    public function check_library_code($user_library_code) {
        return $this->db->where('user_library_code', $user_library_code)->get('user')->num_rows();
    }

}
?>