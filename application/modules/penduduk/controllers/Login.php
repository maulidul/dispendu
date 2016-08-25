<?php
ini_set('display_errors',1);
class Login extends CI_controller{

function __construct(){
	parent::__construct();
	$this->load->model('mpenduduk','m');
	$this->load->helper(array('url','html','link','sidebar','view'));
	$this->cek_login();

}
function index(){

	 $data['title']='Dashboard';
	$data=$this->m->login();
	$this->load->helper('form');
	$this->load->view('form_login');

}
 function cek_login(){
	 	if($this->session->userdata('id_user')!=''){
	 		redirect('penduduk');
	 	}

	 }


}






?>