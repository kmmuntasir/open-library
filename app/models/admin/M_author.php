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

    public function add_author($author) {
        $this->db->insert('author', $author);
        return $this->db->insert_id();
    }

    public function update_author($author_id, $author) {
        $this->db->where('author_id', $author_id);
        $this->db->update('author', $author);
        return $this->db->affected_rows();
    }

    public function delete_author($author_id) {
        $this->db->where('author_id', $author_id);
        $this->db->delete('author');
        return $this->db->affected_rows();
    }

    public function check_author($author_id) {
        $this->db->where('author_id', $author_id);
        return $this->db->count_all_results('book_author');
    }

    public function check_for_existing_author($author_name) {
        $this->db->where('author_name', $author_name);
        return $this->db->count_all_results('author');
    }

    public function merge($target_id, $items) {
        $this->db->trans_start();
        foreach($items as $item) {
            $this->db->where('author_id', $item)->update('book_author', array('author_id'=>$target_id));
            $this->db->where('author_id', $item)->delete('author');
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
?>