<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Base_Controller {

	public function index() {
		redirect(site_url('user/dashboard'));
	}
}
