<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	var $controller='pages';
	var $model='mpages';

	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','html','link'));
		$this->load->model($this->model,'m');
	}
	
	public function index(){
		$this->store_list();
	}
	
	function store_list(){
		$data['ac_menu']=2;
		$data['title']='Daftar Toko';
		$this->load->view('user_templates/header',$data);
		$data['store_list']=$this->m->store_list();
		$this->load->view(getcontroller('p1').'/Store',$data);
		$this->load->view('user_templates/footer');
	}
	
	function aboutus(){
		$data['ac_menu']=3;
		$data['title']='Tentang Kami';
		$this->load->view('user_templates/header',$data);
		$this->load->view(getcontroller('p1').'/tentang-kami',$data);
		$this->load->view('user_templates/footer');
	}
}
