<?php

class M_issue extends Ci_model {

    // Basic Functions

    public function all_issues() {
        $now = date('Y-m-d H:i:s');
        $selection = 'issue_id, user.user_id, user.user_name, user.is_teacher, book.book_id, issue_book_copy_accession_no, book.book_title, issue_datetime, issue_auto_expire_datetime, issue_deadline, issue_return_datetime, issue_total_fine, issue_status';
        $this->db->select($selection);
        $this->db->join('user', 'user.user_id = issue.user_id')->join('book', 'book.book_id = issue.issue_book_id');
        //return $this->db->where('issue_auto_expire_datetime >', $now)->or_where('issue_status !=', 8)->get('issue')->result();
        $this->db->where('issue_status !=', 8);
        $result = $this->db->get('issue')->result();
        // echo $this->db->last_query();
        // exit();
        return $result;
    }
    
    public function all_demands() {
        $now = date('Y-m-d H:i:s');
        // $this->db->join('user', 'user.user_id = issue.user_id')->join('book', 'book.book_id = issue.issue_book_id');
        return $this->db->where('issue_status', 6)->get('issue')->result();
    }

    public function book_availibility($book_id) {
        return $this->db->select('book_available')->where('book_id', $book_id)->get('book')->row()->book_available;
    }
    
    public function all_new_issue_requests() {
        $now = date('Y-m-d H:i:s');
        $this->db->join('user', 'user.user_id = issue.user_id')->join('book', 'book.book_id = issue.issue_book_id');
        return $this->db->where('issue_auto_expire_datetime >', $now)->where('(issue_status = 9)')->get('issue')->result();
    }

    public function all_issue_requests() {
        $now = date('Y-m-d H:i:s');
        $selection = 'issue_id, user.user_id, user.user_name, user.is_teacher, book.book_id, book.book_title, issue_datetime, issue_auto_expire_datetime, issue_id as ID, issue_status';
        $this->db->select($selection);
        $this->db->join('user', 'user.user_id = issue.user_id')->join('book', 'book.book_id = issue.issue_book_id');
        $this->db->group_start()->where('issue_auto_expire_datetime >', $now)->where('issue_status', 0)->group_end();
        $this->db->or_where('issue_status', 6);
        return $this->db->get('issue')->result();
    }

    public function all_active_issues() {
        $now = date('Y-m-d H:i:s');
        $selection = 'issue_id, user.user_id, user.user_name, user.is_teacher, book.book_id, issue_book_copy_accession_no, book.book_title, issue_datetime, issue_deadline, issue_id as ID, issue_status';
        $this->db->select($selection);
        $this->db->join('user', 'user.user_id = issue.user_id')->join('book', 'book.book_id = issue.issue_book_id');
        return $this->db->where('issue_deadline >', $now)->where('issue_status', 1)->get('issue')->result();
    }

    public function all_overdue_issues() {
        $now = date('Y-m-d H:i:s');
        $this->db->join('user', 'user.user_id = issue.user_id')->join('book', 'book.book_id = issue.issue_book_id');
        return $this->db->where('user.is_teacher !=', 1)->where('issue_deadline <', $now)->where('issue_status', 1)->get('issue')->result();
    }

    public function count_overdue_issues() {
        $now = date('Y-m-d H:i:s');
        return $this->db->select('COUNT(*) as count')->where('issue_deadline <', $now)->where('issue_status', 1)->get('issue')->row()->count;
    }

    public function all_completed_issues() {
        $selection = 'issue_id, user.user_id, user.user_name, user.is_teacher, book.book_id, issue_book_copy_accession_no, book.book_title, issue_datetime, issue_return_datetime, issue_id as ID, issue_status';
        $this->db->select($selection);
        $this->db->join('user', 'user.user_id = issue.user_id')->join('book', 'book.book_id = issue.issue_book_id');
        return $this->db->where('issue_status', 3)->get('issue')->result();
    }

    public function get_single_issue($issue_id) {
        $this->db->join('book', 'book.book_id = issue.issue_book_id');
        $this->db->join('user', 'user.user_id = issue.user_id');
        $this->db->join('manager', 'manager.manager_id = issue.manager_id', 'left');
        return $this->db->where('issue_id', $issue_id)->get('issue')->row();
    }

    public function add_issue($book, $book_id, $book_copy, $book_copy_accession_no, $issue) {
        $this->db->trans_start();
        $this->db->where('book_id', $book_id)->update('book', $book);
        $this->db->where('book_copy_accession_no', $book_copy_accession_no)->update('book_copy', $book_copy);
        $this->db->insert('issue', $issue);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }


    public function update_issue($issue_id, $issue, $book=NULL, $book_copy=NULL) {
        $this->db->trans_start();
        if($book) $this->db->where('book_id', $book['book_id'])->update('book', $book);
        if($book_copy) $this->db->where('book_copy_accession_no', $book_copy['book_copy_accession_no'])->update('book_copy', $book_copy);
        $this->db->where('issue_id', $issue_id)->update('issue', $issue);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function update_issue_for_sync($book=NULL, $issue=NULL) {
        $this->db->trans_start();
        if($book) $this->db->where('book_id', $book['book_id'])->update('book', $book);
        if($issue) $this->db->where('issue_id', $issue['issue_id'])->update('issue', $issue);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function renew_issue($issue_old, $issue_new) {
        $this->db->trans_start();
        $this->db->where('issue_id', $issue_old['issue_id'])->update('issue', $issue_old);
        $this->db->insert('issue', $issue_new);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function delete_issue($issue_id, $book=NULL, $book_copy=NULL) {
        $this->db->trans_start();
        if(!$issue_id) return false;
        if($book) $this->db->where('book_id', $book['book_id'])->update('book', $book);
        if($book_copy) $this->db->where('book_copy_accession_no', $book_copy['book_copy_accession_no'])->update('book_copy', $book_copy);
        $this->db->where('issue_id', $issue_id)->delete('issue');
        $this->db->trans_complete();
        return $this->db->trans_status();
    }


    public function all_issue_by_user($user_id) {
        $this->db->join('user', 'user.user_id = issue.user_id')->join('book', 'book.book_id = issue.issue_book_id');
        return $this->db->where('issue.user_id', $user_id)->get('issue')->result();
    }

    public function all_issue_by_book($book_id) {
        $this->db->join('user', 'user.user_id = issue.user_id')->join('book', 'book.book_id = issue.issue_book_id');
        return $this->db->where('issue.issue_book_id', $book_id)->get('issue')->result();
    }

    public function all_issue_by_book_copy($book_copy_accession_no) {
        $this->db->join('user', 'user.user_id = issue.user_id')->join('book', 'book.book_id = issue.issue_book_id');
        return $this->db->where('issue.issue_book_copy_accession_no', $book_copy_accession_no)->get('issue')->result();
    }

    public function get_user_by_user_library_code($user_library_code) {
        return $this->db->where('user_library_code', $user_library_code)->get('user')->row();
    }

    public function check_book_duplicate_issue($user_id, $book_id) {
        $this->db->where('user_id', $user_id)->where('issue_book_id', $book_id)->where('(issue_status != 2 AND issue_status != 3 AND issue_status != 8)');
        return $this->db->count_all_results('issue');
    }

    public function all_expired_confirmed_issue_requests() {
        $now = date('Y-m-d H:i:s');
        $this->db->join('user', 'user.user_id = issue.user_id')->join('book', 'book.book_id = issue.issue_book_id');
        return $this->db->where('issue_auto_expire_datetime <', $now)->where('(issue_status = 0)')->get('issue')->result();
    }

}
?>