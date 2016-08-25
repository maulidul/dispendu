<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MX_Controller {
	public $controller='product';
	public $model='pmodel';

	function __construct(){
		parent::__construct();
		$this->load->model($this->model,'m');
		$this->load->helper(array('html','link'));
		$this->is_login();
	}

	function is_login(){
		if(session_userdata_get('loginData') == ''){
			redirect('auth/login');
		}
	}

	function index(){
		//$this->home();
	}

	function home(){
		$data['controller']=$this->controller;
		$data['title']='Product';
		//$data['menu_ac']=3;
		$this->load->view(getcontroller('c1').'/Header',$data);
		$this->load->view('Menu');
		//$this->load->view(getcontroller('p2').'/Product_page',$data);
		$this->load->view(getcontroller('c1').'/Footer');
	}
}