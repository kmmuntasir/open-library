<?php

class M_book extends Ci_model {

    // Basic Functions

    public function all_books() {
        $this->db->select('*')->where('is_deleted', 0)->join('publication', 'publication.publication_id = book.publication_id');
        return $this->db->get('book')->result();
    }

    public function all_books_json($is_deleted=0) {
        // $selection = 'book_id, book_title, book_edition, book_isbn, publication.publication_id, publication_name, book_stock, book_available, book_url, book_url_unlocked';
        $selection = 'book_id, book_title, book_edition, publication.publication_id, publication_name, book_stock, book_available, book_url, book_url_unlocked';
        
        $this->db->select($selection)->where('is_deleted', $is_deleted)->join('publication', 'publication.publication_id = book.publication_id');
        return $this->db->get('book')->result();
    }

    // GROUP_CONCAT(author_name ORDER BY author_name ASC SEPARATOR ', ')

    public function accession_list_json($is_deleted=0) {
        $inner_query = "SELECT SUBSTR(book_copy_accession_no, 2) AS ac_no, `book_copy_date`, `book_title`, `book_edition`, `publication_name`, `book_copy_type`, `author_name` FROM `book_copy` JOIN `book` ON `book`.`book_id` = `book_copy`.`book_id` JOIN `publication` ON `book`.`publication_id` = `publication`.`publication_id` JOIN `book_author` ON `book`.`book_id` = `book_author`.`book_id` JOIN `author` ON `book_author`.`author_id` = `author`.`author_id` WHERE book_copy_is_deleted=0";

        $outer_select = "`ac_no`, `book_copy_date`, `book_title`, GROUP_CONCAT(DISTINCT author_name SEPARATOR ', ') AS author_name, `book_edition`, `publication_name`, IF(`book_copy_type`=0, 'Reference', '') as copy_type, ac_no as ac2";

        $outer_query = "SELECT $outer_select FROM ( $inner_query ) AS temp_table GROUP BY `ac_no`";
        return $this->db->query($outer_query)->result();
    }

    public function count_books() {
        return $this->db->select('COUNT(*) as count')->where('is_deleted', 0)->get('book')->row()->count;
    }

    public function count_copies() {
        return $this->db->select('COUNT(*) as count')->where('book_copy_is_deleted', 0)->get('book_copy')->row()->count;
    }

    public function get_single_book($book_id) {
        $this->db->select('*');
        $this->db->join('publication', 'publication.publication_id = book.publication_id');
        $this->db->join('manager', 'manager.manager_id = book.manager_id');
        $this->db->where('book_id', $book_id);
        return $this->db->get('book')->row();
    }

    public function get_single_book_by_accession_no($book_copy_accession_no) {
        $this->db->join('book_copy', 'book.book_id = book_copy.book_id');
        $this->db->where('book_copy_accession_no', $book_copy_accession_no);
        return $this->db->get('book')->row();
    }

    public function move_copy($book_copy, $book_copy_accession_no, $source_book, $source_book_id, $target_book, $target_book_id, $book_copy_is_deleted) {
        $this->db->trans_start();

        $this->db->where('book_copy_accession_no', $book_copy_accession_no);
        $this->db->update('book_copy', $book_copy);
        if($book_copy_is_deleted == 0) {
            $this->db->where('book_id', $source_book_id);
            $this->db->update('book', $source_book);
            $this->db->where('book_id', $target_book_id);
            $this->db->update('book', $target_book);
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
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

    public function all_books_by_category_list($category_id) {
        $query = "SELECT
    `ac_no`,
    `book_title`,
    GROUP_CONCAT(DISTINCT author_name SEPARATOR ', ') AS author_name,
    `book_edition`,
    `publication_name`,
             `book_year_of_pub`,
             `book_place_of_pub`,
    IF(`book_copy_type`=0, 'Reference', '') as copy_type,
             `book_pages`,
             `book_stock`
FROM (
         SELECT
             CAST(SUBSTR(book_copy_accession_no, 2) AS UNSIGNED ) AS ac_no,
             `book_copy_date`,
             `book_title`,
             `book_edition`,
             `publication_name`,
             `book_copy_type`,
             `author_name`,
             `category_id`,
             `book_year_of_pub`,
             `book_place_of_pub`,
             `book_pages`,
             `book_stock`,
             `book_available`
         FROM `book_copy`
                  JOIN `book` ON `book`.`book_id` = `book_copy`.`book_id`
                  JOIN `publication` ON `book`.`publication_id` = `publication`.`publication_id`
                  JOIN `book_author` ON `book`.`book_id` = `book_author`.`book_id`
                  JOIN `author` ON `book_author`.`author_id` = `author`.`author_id`
                  JOIN `book_category` ON `book_category`.`book_id` = `book_copy`.`book_id`
         WHERE book_copy_is_deleted=0 && category_id='$category_id'
) AS temp_table
GROUP BY `ac_no`
ORDER BY `ac_no` ASC;";
        return $this->db->query($query)->result();
    }

    public function all_books_by_category($category_id) {
        $this->db->join('book_category', 'book_category.category_id = category.category_id');
        $this->db->join('book', 'book_category.book_id = book.book_id');
        $this->db->join('publication', 'publication.publication_id = book.publication_id');
        $this->db->where('category.category_id', $category_id);
        return $this->db->get('category')->result();
    }

    public function check_book_existence($book_id) {
        $this->db->where('book_id', $book_id);
        return $this->db->count_all_results('book');
    }

    public function check_duplicate_isbn($book_isbn) {
        $this->db->where('book_isbn', $book_isbn);
        return $this->db->get('book')->row();
    }

    public function check_book_title_edition($book_title, $book_edition) {
        $this->db->where('book_title', $book_title)->where('book_edition', $book_edition)->where('is_deleted', 0);
        return $this->db->get('book')->row();
    }

    public function check_book_id_accession_no($book_id, $book_copy_accession_no) {
        return $this->db->where('book_id', $book_id)->where('book_copy_accession_no', $book_copy_accession_no)->count_all_results('book_copy');
    }

    public function check_book_for_issue($book_id) {
        return $this->db->where('issue_status !=', 3)->where('issue_book_id', $book_id)->count_all_results('issue');
    }

    public function add_book($book, $publication_name, $authors, $categories) {

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


        // Inserting Book
        $this->db->insert('book', $book);
        $book_id = $book['book_id'];

        // echo $this->db->last_query();

        // $this->printer($book, true);

        // Processing Authors
        $book_author = array();
        foreach($authors as $key => $author_name) {
            $this->db->where('author_name', $author_name);
            $author = $this->db->get('author')->row();
            if($author) $book_author = array('book_author_id'=>$this->new_id('book_author'), 'book_id'=>$book_id, 'author_id'=>$author->author_id);
            else {
                $a_id = $this->new_id('author');
                $author = array('author_name' => $author_name, 'author_id'=>$a_id);
                $this->db->insert('author', $author);
                $book_author = array('book_author_id'=>$this->new_id('book_author'), 'book_id'=>$book_id, 'author_id'=>$a_id);
            }
            //Inserting Book-Author Relation
            $this->db->insert('book_author', $book_author);
        }
        // $book_author_aff = $this->db->affected_rows();

        //Processing Categories
        $book_category = array();
        foreach($categories as $key=>$category_name) {
            $this->db->where('category_name', $category_name);
            $category = $this->db->get('category')->row();
            if($category) $book_category = array('book_category_id'=>$this->new_id('book_category'), 'book_id'=>$book_id, 'category_id'=>$category->category_id);
            else {
                $c_id = $this->new_id('category');
                $category = array('category_name' => $category_name, 'category_id'=>$c_id);
                $this->db->insert('category', $category);
                $book_category = array('book_category_id'=>$this->new_id('book_category'), 'book_id'=>$book_id, 'category_id'=>$c_id);
            }
            //Inserting Book-Category Relation
            $this->db->insert('book_category', $book_category);
        }
        // $book_category_aff = $this->db->affected_rows();

        $this->db->trans_complete();
        return ($this->db->trans_status())?1:0;
    }

    public function update_book($book_id, $book, $publication_name, $authors, $categories) {

        // $this->printer($book_id);
        // $this->printer($book);
        // $this->printer($publication_name);
        // $this->printer($authors);
        // $this->printer($categories, true);

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

        //Removing old Book-Author Relations
        $this->db->where('book_id', $book_id);
        $this->db->delete('book_author');

        $book_author = array();
        foreach($authors as $key => $author_name) {
            $this->db->where('author_name', $author_name);
            $author = $this->db->get('author')->row();
            if($author) $book_author = array('book_author_id'=>$this->new_id('book_author'), 'book_id'=>$book_id, 'author_id'=>$author->author_id);
            else {
                $a_id = $this->new_id('author');
                $author = array('author_name' => $author_name, 'author_id'=>$a_id);
                $this->db->insert('author', $author);
                $book_author = array('book_author_id'=>$this->new_id('book_author'), 'book_id'=>$book_id, 'author_id'=>$a_id);
            }

            //Inserting Book-Author Relation
            $this->db->insert('book_author', $book_author);
        }
        // $book_author_aff = $this->db->affected_rows();

        //Processing Categories

        //Removing old Book-Category Relations
        $this->db->where('book_id', $book_id);
        $this->db->delete('book_category');

        $book_category = array();
        foreach($categories as $key=>$category_name) {
            $this->db->where('category_name', $category_name);
            $category = $this->db->get('category')->row();
            if($category) $book_category = array('book_category_id'=>$this->new_id('book_category'), 'book_id'=>$book_id, 'category_id'=>$category->category_id);
            else {
                $c_id = $this->new_id('category');
                $category = array('category_name' => $category_name, 'category_id'=>$c_id);
                $this->db->insert('category', $category);
                $book_category = array('book_category_id'=>$this->new_id('book_category'), 'book_id'=>$book_id, 'category_id'=>$c_id);
            }

            //Inserting Book-Category Relation
            $this->db->insert('book_category', $book_category);
        }
        // $book_category_aff = $this->db->affected_rows();

        $this->db->trans_complete();
        return ($this->db->trans_status())?1:0;
    }

    public function delete_book($book_id) {
        $this->db->trans_start();
        //$this->db->where('book_id', $book_id)->update('book_copy', array('book_copy_is_deleted'=>1));
        //$this->db->where('book_id', $book_id)->update('book', array('is_deleted'=>1, 'book_stock'=>0, 'book_available'=>0));
        $this->db->where('book_id', $book_id)->update('book', array('is_deleted'=>1));
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function restore_book($book_id) {
        $this->db->trans_start();
        $this->db->where('book_id', $book_id)->update('book', array('is_deleted'=>0));
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function get_all_copies($book_id) {
        $this->db->where('book_id', $book_id);
        $this->db->where('book_copy_is_deleted', 0);
        return $this->db->get('book_copy')->result();
    }

    public function get_all_deleted_copies($book_id) {
        $this->db->where('book_id', $book_id);
        $this->db->where('book_copy_is_deleted', 1);
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

    public function add_copy($book_copy, $book_copy_type) {
        $aff = 0;
        $this->db->trans_start();
        $this->db->insert_batch('book_copy', $book_copy);
        $aff = $this->db->affected_rows();
        $book = $this->get_single_book($book_copy[0]['book_id']);
        $book_updated = array();
        $book_updated['book_stock'] = $book->book_stock + count($book_copy);
        if($book_copy_type) $book_updated['book_available'] = $book->book_available + count($book_copy);

        $this->db->where('book_id', $book_copy[0]['book_id']);
        $this->db->update('book', $book_updated);

        $this->db->trans_complete();
        return ($this->db->trans_status())?$aff:0;
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

    public function delete_copy($book_copy_accession_no, $book) {
        $this->db->trans_start();

        $this->db->where('book_copy_accession_no', $book_copy_accession_no);
        $this->db->update('book_copy', array('book_copy_is_deleted'=>1));

        $book_copy = $this->get_single_copy($book_copy_accession_no);
        $new_book = array('book_stock'=>$book->book_stock-1);
        if($book_copy->book_copy_type) $new_book['book_available']=$book->book_available-1;
        $this->db->where('book_id', $book->book_id);
        $this->db->update('book', $new_book);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }


    public function restore_copy($book_copy_accession_no, $book) {
        $this->db->trans_start();

        $this->db->where('book_copy_accession_no', $book_copy_accession_no);
        $this->db->update('book_copy', array('book_copy_is_deleted'=>0));

        $book_copy = $this->get_single_copy($book_copy_accession_no);
        $new_book = array('book_stock'=>$book->book_stock+1);
        if($book_copy->book_copy_type) $new_book['book_available']=$book->book_available+1;
        $this->db->where('book_id', $book->book_id);
        $this->db->update('book', $new_book);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function delete_copy_range($book_id, $ac_1, $ac_2) {
        $this->db->trans_start();
        $book = $this->get_single_book($book_id);
        $id_1 = $this->get_single_copy($ac_1)->book_copy_id;
        $id_2 = $this->get_single_copy($ac_2)->book_copy_id;

        // Deleting normal copies and updaing book stock+available records
        $this->db->where('book_id', $book_id);
        $this->db->where('book_copy_id >=', $id_1);
        $this->db->where('book_copy_id <=', $id_2);
        $this->db->where('book_copy_type', 1);
        $this->db->where('book_copy_status', 1);
        $this->db->where('book_copy_is_deleted', 0);
        $this->db->update('book_copy', array('book_copy_is_deleted'=>1));
        $aff = $this->db->affected_rows();
        $last_available = $book->book_stock-$aff;
        $this->db->where('book_id', $book_id)->update('book', array('book_stock'=>$last_available, 'book_available'=>$book->book_available-$aff));

        // Deleting reference copies
        $this->db->where('book_id', $book_id);
        $this->db->where('book_copy_id >=', $id_1);
        $this->db->where('book_copy_id <=', $id_2);
        $this->db->where('book_copy_type', 0);
        $this->db->where('book_copy_status', 1);
        $this->db->where('book_copy_is_deleted', 0);
        $this->db->update('book_copy', array('book_copy_is_deleted'=>1));

        $aff = $this->db->affected_rows();
        $this->db->where('book_id', $book_id)->update('book', array('book_stock'=>$last_available-$aff));

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function all_accession_numbers($book_id) {
        $this->db->select('book_copy_accession_no');
        $this->db->where('book_id', $book_id);
        return $this->db->get('book_copy')->result();
    }

    public function last_accession_number() {
        $new_key = 0;
        $result = $this->db->select('book_copy_accession_no')->order_by('book_copy_id', 'DESC')->limit(1)->get('book_copy')->row();
        if($result) {
            preg_match_all('!\d+!', $result->book_copy_accession_no, $matches);
            // $this->printer($matches);
            $new_key = $matches[0][0] + 1;
        }
        else $new_key = 1;
        return $new_key;
    }

    public function book_url($book_id) {
        $book = $this->db->select('book_url')->where('book_id', $book_id)->get('book')->row();
        return ($book) ? $book->book_url: NULL;
    }

    public function merge($master_id, $slave_ids) {
        $this->db->trans_start();

        $master_book = $this->get_single_book($master_id);

        $new_stock = $master_book->book_stock;
        $new_available = $master_book->book_available;

        foreach ($slave_ids as $key => $sid) {
            // echo '<br>Processing ID: '.$sid.'<br>';
            $slave_book = $this->get_single_book($sid);

            $new_stock += $slave_book->book_stock;
            $new_available += $slave_book->book_available;


            $authors = $this->db->where('book_id', $sid)->get('book_author')->result();
            // echo $this->db->last_query().'<br>';
            // $this->printer($authors);
            foreach($authors as $key => $author) {
                // echo 'Author: '.$author->author_id.'<br>';
                $existing_record = $this->db->where('book_id', $master_id)->where('author_id', $author->author_id)->get('book_author')->row();

               if($existing_record) continue;
                else { 
                    // echo 'Found New Author<br>';
                    $this->db->where('book_author_id', $author->book_author_id)->update('book_author', array('book_id'=>$master_id));
                    // echo $this->db->last_query().'<br>';
                }

            }


            $categories = $this->db->where('book_id', $sid)->get('book_category')->result();
            // echo $this->db->last_query().'<br>';
            // $this->printer($categories);
            foreach($categories as $key => $category) {
                // echo 'Category: '.$category->category_id.'<br>';

                $existing_record = $this->db->where('book_id', $master_id)->where('category_id', $category->category_id)->get('book_category')->row();

                if($existing_record) continue;
                else {
                    // echo 'Found New Category<br>';
                    $this->db->where('book_category_id', $category->book_category_id)->update('book_category', array('book_id'=>$master_id));
                    // echo $this->db->last_query().'<br>';
                }
            }

            $this->db->where('book_id', $sid)->update('book_copy', array('book_id'=>$master_id));
            $this->db->where('issue_book_id', $sid)->update('issue', array('issue_book_id'=>$master_id));

            $this->db->where('book_id', $sid)->delete('book');
        }

        $new_book = array();
        $new_book['book_stock'] = $new_stock;
        $new_book['book_available'] = $new_available;

        $this->db->where('book_id', $master_id)->update('book', $new_book);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /************************** Import Functions **************************/

    public function old_books($limit=50) {
        $this->db->where('flag', 0);
        $this->db->limit($limit);
        return $this->db->get('lib_book')->result();
    }

    public function old_copies($book_id, $limit=1000) {
        $this->db->where('book_id', $book_id);
        $this->db->where('copy_status', 1);
        $this->db->limit($limit);
        return $this->db->get('lib_copy')->result();
    }

    public function flag_book($book_id) {
        $this->db->trans_start();
        $this->db->where('book_id', $book_id);
        $this->db->update('lib_book', array('flag'=>1));
        $this->db->trans_complete();
    }

    public function flag_copy($copy_id) {
        $this->db->trans_start();
        $this->db->where('copy_id', $copy_id);
        $this->db->update('lib_copy', array('copy_status'=>0));
        $this->db->trans_complete();
    }

    public function add_old_copies($book_id, $book_copy, $ref_copies) {
        $aff = 0;
        $this->db->trans_start();
        $this->db->insert_batch('book_copy', $book_copy);
        $aff = $this->db->affected_rows();
        $book = $this->get_single_book($book_id);
        $book_updated = array();
        $book_updated['book_stock'] = $book->book_stock + count($book_copy);
        $book_updated['book_available'] = $book->book_available + (count($book_copy) - $ref_copies);

        $this->db->where('book_id', $book_id);
        $this->db->update('book', $book_updated);

        $this->db->trans_complete();
        return ($this->db->trans_status())?$aff:0;
    }

}
?>