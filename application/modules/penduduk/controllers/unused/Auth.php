<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller {

	public $controller='auth';
	public $model='mauth';

	function __construct(){
		parent::__construct();
		$this->load->helper(array('view','url','html','utilities','link'));
		$this->load->model($this->model,'m');
	}

	function is_login(){
		if(session_userdata_get('loginData') != ''){
			redirect('cpanel');
		}
	}

	function forgot_pass(){
		//check if is_logged in
		$this->is_login();
		$res=$this->m->forgot_password();
		if(!empty($res)){
			echo $res;
			exit;
		}
		$data=array(
			'title'=>'forgot_password',
			'body'=>'forgot_password',
			'controller'=>$this->controller
			);
		$this->load->view('user_templates/header',$data);
		$this->load->view(getcontroller('a2').'/forgot_password',$data);
		$this->load->view('user_templates/footer');
	}

	function home(){
		$data['ac_menu']=1;
		$data['message']='';
		$data['controller']=$this->controller;
		$message=$this->m->register();
		if ($message == 'berhasil'){
			$message='<div class="alert alert-success" role="alert">BERHASIL. Mohon cek Email anda untuk konfirmasi!</div>';
		}
		$data['message']=$message;
		$data['title']='Kios27';
		$this->load->view('user_templates/header',$data);
		$this->load->view(getcontroller('a2').'/home_page',$data);
		$this->load->view('user_templates/footer');
	}
	
	function register(){
		$data['message']='';
		$data['controller']=$this->controller;
		$message=$this->m->register();
		if ($message == 'berhasil'){
			$data['message']='<div class="alert alert-success" role="alert">BERHASIL. Mohon cek Email anda untuk konfirmasi!</div>';
		}
		$data['title']='Register';
		$this->load->view('user_templates/header',$data);
		$this->load->view(getcontroller('a2').'/register_page',$data);
		$this->load->view('user_templates/footer');
	}
	
	function login_mdl(){
		//check if is_logged in
		$this->is_login();
		$this->load->driver('session');
		$res=$this->m->login();
		
	}

	function login(){
		$this->load->helper('log');
		$data['ac_menu']=4;
		$data['title']='Login Page';
		$this->is_login();
		$res=$this->m->login();
		$this->load->view('user_templates/header',$data);
		$this->load->view(getcontroller('a2').'/login_page',$data);
		$this->load->view('user_templates/footer');
	}

	function confirm_registration($code=''){
		//check if is_logged in
		$this->is_login();
		$message=$this->m->confirm_registration($code);
		$data=array(
			'title'=>'Konfirmasi Sukses',
			'message'=>$message,
			'controller'=>$this->controller
		);
		$this->load->view('user_templates/header',$data);
		$this->load->view(getcontroller('a2').'/usrAddPass_page',$data);
		$this->load->view('user_templates/footer');
	}

	function available_user(){
		$data=$this->m->available_user();
		echo $data;
	}

	function registering_user(){
		$result=$this->m->registering_user();
		echo $result;
	}
	
}
