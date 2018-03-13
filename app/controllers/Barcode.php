<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barcode extends Base_Controller {
	public $module = 'user';	// defines the module
	function __construct() {
        parent::__construct();
        $this->__security($this->module);
    }

	public function index()
	{
		$this->__set_barcode("No Code Given");
	}
	public function generate() {
		$code = isset($_GET['code'])?$_GET['code']:'No Code Given';
		$barHeight = isset($_GET['height'])?$_GET['height']:14;
		$factor = isset($_GET['factor'])?$_GET['factor']:1.98;
		$this->__set_barcode($code, $barHeight, $factor);
	}
}
