<?php

class M_publication extends Ci_model {

    // Basic Functions

    public function all_publications() {
        return $this->db->get('publication')->result();
    }

    public function get_single_publication($publication_id) {
        $this->db->where('publication_id', $publication_id);
        return $this->db->get('publication')->row();
    }
}
?>