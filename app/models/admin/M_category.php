<?php

class M_category extends Ci_model {

    // Basic Functions

    public function all_categories() {
        $this->db->select('category_name, category_id');
        return $this->db->get('category')->result();
    }

    public function get_single_category($category_id) {
        $this->db->where('category_id', $category_id);
        return $this->db->get('category')->row();
    }

    public function add_category($category) {
        $this->db->insert('category', $category);
        return $this->db->insert_id();
    }

    public function update_category($category_id, $category) {
        $this->db->where('category_id', $category_id);
        $this->db->update('category', $category);
        return $this->db->affected_rows();
    }

    public function delete_category($category_id) {
        $this->db->where('category_id', $category_id);
        $this->db->delete('category');
        return $this->db->affected_rows();
    }

    public function check_category($category_id) {
        $this->db->where('category_id', $category_id);
        return $this->db->count_all_results('book_category');
    }

    public function check_for_existing_category($category_name) {
        $this->db->where('category_name', $category_name);
        return $this->db->count_all_results('category');
    }

}
?>