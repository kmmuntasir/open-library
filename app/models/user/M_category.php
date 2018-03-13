<?php

class M_category extends Ci_model {

    // Basic Functions

    public function all_categories() {
        return $this->db->get('category')->result();
    }

    public function get_single_category($category_id) {
        $this->db->where('category_id', $category_id);
        return $this->db->get('category')->row();
    }
}
?>