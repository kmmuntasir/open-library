<?php

class M_author extends Ci_model {

    // Basic Functions

    public function all_authors() {
    	$this->db->select('author_name, author_id');
        return $this->db->get('author')->result();
    }

    public function get_single_author($author_id) {
        $this->db->where('author_id', $author_id);
        return $this->db->get('author')->row();
    }
}
?>