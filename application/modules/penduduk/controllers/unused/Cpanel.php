<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpanel extends MX_Controller {
	public $controller='cpanel';
	public $model='mcpanel';

	function __construct(){
		parent::__construct();
		$this->load->model($this->model,'m');
		$this->load->helper(array('html','link'));
		$this->is_login();
	}

	function is_login(){
		if(session_userdata_get('loginData') == ''){
			redirect(get_link(1,'a2').'/login');
		}
	}

	function logout(){
		$this->load->driver('session');
		$this->session->sess_destroy();
		redirect(get_link(1,'a2').'/login');
	}

	function index(){
		//$this->dashboard();
	}

	function dashboard()
	{
		$data['controller']=$this->controller;
			$data['title']='Dashboard';
			$data['menu_ac']=1;
			$this->load->view(getcontroller('c1').'/Header',$data);
		$this->load->view(getcontroller('c1').'/Menu');
		// mengambil data akun 
		$data['akun_data']=$this->m->get_account_data();
		// mengambil data log 
		$data['log_data']=$this->m->get_log_login_data();
		$this->load->view(getcontroller('c1').'/Dashboard',$data);
		$this->load->view(getcontroller('c1').'/Footer');
	}

	function mystore(){
		$this->load->helper('form');
		$data['controller']=$this->controller;
		$data['title']='Store';
		$data['menu_ac']=2;
		$this->load->view(getcontroller('c1').'/Header',$data);
		$this->load->view(getcontroller('c1').'/Menu');
		$this->m->create_new_toko(); // membuat baru jika data tidak ada;
		$data['detail_toko']=$this->m->detail_toko();
		$data['categories']=$this->m->get_categories();
		$view=(!isset($_GET['edit']))?'Store_browse':'Store_form';
		$this->load->view($view,$data);
		$this->load->view(getcontroller('c1').'/Footer');
	}

	function save_form(){
		$this->m->save_store_info();
		redirect('cpanel/mystore?edit');
	}

	function account($type=0){
		$data['title']='Akun';
		$data['controller']=$this->controller;
		$data['menu_ac']=2;
		$this->load->view(getcontroller('c1').'/Header',$data);
		$this->load->view(getcontroller('c1').'/Menu');
		if($type == 'change_password'){
			$this->m->save_info(); // if submited
			$this->load->helper('form');
			$this->load->view(getcontroller('c1').'/change_password',$data);
		}
		$this->load->view(getcontroller('c1').'/Footer',$data);
	}

}
