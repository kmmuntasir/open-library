<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Base_Controller {

	public $module = 'admin';	// defines the module
	public $template = 'open_library';	// Current Template Name
	public $viewpath = '';
	//========================
	public $data = array();

	function __construct()
    {
        parent::__construct();

        $this->__security($this->module);

        $this->load->model($this->module."/m_admin"); // Loading Model
        $this->load->model($this->module."/m_issue");
        $this->load->model($this->module."/m_sync");
        $this->load->model($this->module."/m_book");

        $this->viewpath = $this->module.'/'.$this->template.'/';	// Creating the Path
        $this->data['fullpath'] = base_url().'view/'.$this->viewpath;;
        $this->data['page_title'] = '';
        $this->data['module'] = $this->module;
        $this->data['page'] = '';
        $this->data['controller'] = site_url('admin/dashboard');
    }
    //====================================//

	public function index() {
		$data = $this->data;
        $data['page'] = 'dashboard';
    	$data['page_title'] .= 'Dashboard';

        $data['issues'] = $this->m_issue->all_issue_requests();
        foreach($data['issues'] as $key=> $issue) {
            if($issue->issue_status == 1 && strtotime($issue->issue_deadline) < time()) {
                $data['issues'][$key]->issue_status = -1;

                $now = time(); 
                $deadline = strtotime($issue->issue_deadline);
                $datediff = $now - $deadline;

                $diff = ceil($datediff / (60 * 60 * 24));

                $data['issues'][$key]->issue_overdue = $diff.' days';

                $data['issues'][$key]->issue_fine = ($diff * 2).'/=';
            }
            else{ 
                $data['issues'][$key]->issue_overdue = $data['issues'][$key]->issue_fine = 'N/A';
            }
        }
        $data['book_count'] = $this->m_book->count_books();
        $data['copy_count'] = $this->m_book->count_copies();
        $data['overdue_count'] = $this->m_issue->count_overdue_issues();
        $data['last_sync'] = $this->time_elapsed_string($this->m_sync->server_info()->server_last_connection, true);
        //$this->printer($data, true);

        $data['content'] = 'v_dashboard.php';
    	$this->load->view($this->viewpath.'v_main', $data);
	}
}
