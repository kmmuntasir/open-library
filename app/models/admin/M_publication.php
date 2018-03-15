<?php

class M_publication extends Ci_model {

    // Basic Functions

    public function all_publications() {
        $this->db->select('publication_name, publication_id');
        return $this->db->get('publication')->result();
    }

    public function get_single_publication($publication_id) {
        $this->db->where('publication_id', $publication_id);
        return $this->db->get('publication')->row();
    }

    public function add_publication($publication) {
        $this->db->insert('publication', $publication);
        return $this->db->insert_id();
    }

    public function update_publication($publication_id, $publication) {
        $this->db->where('publication_id', $publication_id);
        $this->db->update('publication', $publication);
        return $this->db->affected_rows();
    }

    public function delete_publication($publication_id) {
        $this->db->where('publication_id', $publication_id);
        $this->db->delete('publication');
        return $this->db->affected_rows();
    }

    public function check_publication($publication_id) {
        $this->db->where('publication_id', $publication_id);
        return $this->db->count_all_results('book');
    }

}
?>