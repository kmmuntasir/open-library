<?php

class M_manager extends Ci_model {

    // Basic Functions

    public function all_managers() {
        $this->db->where('is_deleted', 0);
        return $this->db->get('manager')->result();
    }

    public function get_single_manager($manager_id) {
        $this->db->where('manager_id', $manager_id);
        return $this->db->get('manager')->row();
    }

    public function get_manager_by_username($manager_user) {
        $this->db->where('manager_user', $manager_user);
        return $this->db->get('manager')->row();
    }

    public function add_manager($manager) {
        $this->db->insert('manager', $manager);
        return $this->db->insert_id();
    }

    public function update_manager($manager_id, $manager) {
        $this->db->where('manager_id', $manager_id);
        $this->db->update('manager', $manager);
        return $this->db->affected_rows();
    }

    public function manager_handle_check($manager_user) {
        $this->db->where('manager_user', $manager_user);
        $result = $this->db->get('manager');
        return $result->num_rows();
    }

    public function delete_manager($manager_id) {
        $this->db->where('manager_id', $manager_id)->update('manager', array('is_deleted'=>1, 'manager_user'=>''));
        return $this->db->affected_rows();
    }
    
    public function check_manager($manager_id) {
        $this->db->where('manager_id', $manager_id);
        return $this->db->count_all_results('book');
    }
}
?>