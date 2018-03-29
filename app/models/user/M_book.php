<?php

class M_book extends Ci_model {

    // Basic Functions

    public function all_books() {
        $this->db->select('*');
        $this->db->join('publication', 'publication.publication_id = book.publication_id');
        return $this->db->get('book')->result();
    }

    public function all_books_json() {
        $selection = 'book_id, book_title, book_edition, book_isbn, publication.publication_id, publication_name, book_stock, book_available, book_url, book_url_unlocked';
        $this->db->select($selection)->join('publication', 'publication.publication_id = book.publication_id');
        return $this->db->get('book')->result();
    }

    public function get_single_book($book_id) {
        $this->db->select('*');
        $this->db->join('publication', 'publication.publication_id = book.publication_id');
        $this->db->where('book_id', $book_id);
        return $this->db->get('book')->row();
    }

    public function get_single_book_by_accession_no($book_copy_accession_no) {
        $this->db->join('book_copy', 'book.book_id = book_copy.book_id');
        $this->db->where('book_copy_accession_no', $book_copy_accession_no);
        return $this->db->get('book')->row();
    }

    public function book_authors($book_id) {
        $this->db->select('author.author_id, author.author_name');
        $this->db->join('book_author', 'book_author.book_id = book.book_id');
        $this->db->join('author', 'book_author.author_id = author.author_id');
        $this->db->where('book.book_id', $book_id);
        return $this->db->get('book')->result();
    }

    public function book_categories($book_id) {
        $this->db->select('category.category_id, category.category_name');
        $this->db->join('book_category', 'book_category.book_id = book.book_id');
        $this->db->join('category', 'book_category.category_id = category.category_id');
        $this->db->where('book.book_id', $book_id);
        return $this->db->get('book')->result();
    }

    public function all_books_by_author($author_id) {
        $this->db->join('book_author', 'book_author.author_id = author.author_id');
        $this->db->join('book', 'book_author.book_id = book.book_id');
        $this->db->join('publication', 'publication.publication_id = book.publication_id');
        $this->db->where('author.author_id', $author_id);
        return $this->db->get('author')->result();
    }

    public function all_books_by_publication($publication_id) {
        $this->db->join('publication', 'publication.publication_id = book.publication_id');
        $this->db->where('book.publication_id', $publication_id);
        return $this->db->get('book')->result();
    }

    public function all_books_by_category($category_id) {
        $this->db->join('book_category', 'book_category.category_id = category.category_id');
        $this->db->join('book', 'book_category.book_id = book.book_id');
        $this->db->join('publication', 'publication.publication_id = book.publication_id');
        $this->db->where('category.category_id', $category_id);
        return $this->db->get('category')->result();
    }

    public function get_all_copies($book_id) {
        $this->db->where('book_id', $book_id);
        $this->db->where('book_copy_is_deleted', 0);
        return $this->db->get('book_copy')->result();
    }

    public function get_single_copy($book_copy_accession_no) {
        $this->db->where('book_copy_accession_no', $book_copy_accession_no);
        return $this->db->get('book_copy')->row();
    }

    public function get_single_copy_details($book_copy_accession_no) {
        $this->db->select('*');
        $this->db->join('book', 'book.book_id = book_copy.book_id');
        $this->db->join('manager', 'manager.manager_id = book_copy.book_copy_manager_id');
        $this->db->join('publication', 'book.publication_id = publication.publication_id');
        $this->db->where('book_copy_accession_no', $book_copy_accession_no);
        return $this->db->get('book_copy')->row();
    }
    public function all_accession_numbers($book_id) {
        $this->db->select('book_copy_accession_no');
        $this->db->where('book_id', $book_id);
        return $this->db->get('book_copy')->result();
    }

    public function detect_single_available_copy($book_id) {
        $this->db->where('book_id', $book_id)->where('book_copy_status', 1)->where('book_copy_type', 1)->where('book_copy_is_deleted', 0)->limit(1);
        $result = $this->db->get('book_copy')->row();
        return $result->book_copy_accession_no;
    }

    public function update_book($book_id, $book, $publication_name, $authors, $categories) {
        $this->db->trans_start();
        //Processing Publication
        $this->db->where('publication_name', $publication_name);
        $publication = $this->db->get('publication')->row();
        if($publication) $book['publication_id'] = $publication->publication_id;
        else {
            $pub_id = $this->new_id('publication');
            $this->db->insert('publication', array('publication_name'=>$publication_name, 'publication_id'=>$pub_id));
            $book['publication_id'] = $pub_id;
        }

        // Updating Book
        $this->db->where('book_id', $book_id);
        $this->db->update('book', $book);

        // Processing Authors
        $book_author = array();
        foreach($authors as $key => $author_name) {
            $this->db->where('author_name', $author_name);
            $author = $this->db->get('author')->row();
            if($author) array_push($book_author, array('book_id'=>$book_id, 'author_id'=>$author->author_id));
            else {
                $a_id = $this->new_id('author');
                $author = array('author_name' => $author_name, 'author_id'=>$a_id);
                $this->db->insert('author', $author);
                array_push($book_author, array('book_id'=>$book_id, 'author_id'=>$a_id));
            }
        }
        //Removing old Book-Author Relations
        $this->db->where('book_id', $book_id);
        $this->db->delete('book_author');
        //Inserting Book-Author Relations
        $this->db->insert_batch('book_author', $book_author);
        $book_author_aff = $this->db->affected_rows();

        //Processing Categories
        $book_category = array();
        foreach($categories as $key=>$category_name) {
            $this->db->where('category_name', $category_name);
            $category = $this->db->get('category')->row();
            if($category) array_push($book_category, array('book_id'=>$book_id, 'category_id'=>$category->category_id));
            else {
                $c_id = $this->new_id('category');
                $category = array('category_name' => $category_name, 'category_id'=>$c_id);
                $this->db->insert('category', $category);
                array_push($book_category, array('book_id'=>$book_id, 'category_id'=>$c_id));
            }
        }
        //Removing old Book-Category Relations
        $this->db->where('book_id', $book_id);
        $this->db->delete('book_category');
        //Inserting Book-Category Relations
        $this->db->insert_batch('book_category', $book_category);
        $book_category_aff = $this->db->affected_rows();
        $this->db->trans_complete();
        return ($this->db->trans_status())?1:0;
    }


    public function update_copy($book_copy_accession_no, $book_copy) {
        $this->db->trans_start();
        $book = $this->get_single_copy_details($book_copy_accession_no);

        $this->db->where('book_copy_accession_no', $book_copy_accession_no);
        $this->db->update('book_copy', $book_copy);
        $book_updated = array();
        $flag = false;
        if($aff = $this->db->affected_rows()) {
            if($book->book_copy_type == 0 && $book_copy['book_copy_type'] == 1) { // Updated from reference to normal copy
                $book_updated['book_available'] = $book->book_available + 1;
                $flag = true;
            }
            else if($book->book_copy_type == 1 && $book_copy['book_copy_type'] == 0) { // Updated from normal to reference copy
                $book_updated['book_available'] = $book->book_available - 1;
                $flag = true;
            }
            if($flag) $this->db->where('book_id', $book->book_id)->update('book', $book_updated);
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function book_url($book_id) {
        $book = $this->db->select('book_url')->where('book_id', $book_id)->get('book')->row();
        return ($book) ? $book->book_url: NULL;
    }

    public function update_book_url($book_id, $book_url) {
        $this->db->trans_start();
        $this->db->where('book_id', $book_id)->update('book', array('book_url'=>$book_url));
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function check_user_book_active_issue($book_id) {
        $this->db->select('issue_status');
        $this->db->where('issue_book_id', $book_id);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->group_start();
        $this->db->where('issue_status', 9);
        $this->db->or_where('issue_status', 6);
        $this->db->or_where('issue_status', 0);
        $this->db->or_where('issue_status', 1);
        $this->db->group_end();
        return $this->db->get('issue')->row();
    }

}
?>