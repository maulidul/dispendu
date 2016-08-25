<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','html'));
	}
	
	public function index(){
		qrcode();
		//$this->load->helper('phpqrcode/qrlib');
		
	}

	function get_qrcode(){

	}
}
