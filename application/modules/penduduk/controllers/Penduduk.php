<?php 

class Penduduk extends CI_Controller {

function __construct()
	 {
		parent::__construct();
		$this->load->model('Mpenduduk','m');
		$this->load->helper(array('url','html','link','agama','sidebar','view'));
		$this->cek_login();
	 }
	 
	 function cek_login(){
	 	if($this->session->userdata('id_user')==''){
	 		redirect('penduduk/login');
	 	}

	 }
	 
	 function log_out(){
	 	$this->session->sess_destroy();
	 }
	 
	 function index(){
	 	$this->dashboard();
	 }
	 
	 function pagination(){

		$this->load->library('pagination');
		$config['suffix'] = (isset($_GET['q']))?'?q='.$_GET['q']:'';
		$config['cur_tag_open'] = '<li><a><b>';
      	$config['cur_tag_close'] = '</b></a></li>';
      	$config['num_tag_open'] = '<li>';
      	$config['num_tag_close'] = '</li>';
      	$config['last_tag_open'] = '<li>';
      	$config['last_tag_close'] = '</li>';
      	$config['next_tag_open'] = '<li>';
      	$config['next_tag_close'] = '</li>';
      	$config['prev_tag_open'] = '<li>';
      	$config['prev_tag_close'] = '</li>';
      	$config['first_tag_open'] = '<li>';
      	$config['first_tag_close'] = '</li>';
      	$config['use_page_numbers'] = TRUE;
      	$config['base_url'] = site_url('penduduk/data_penduduk/');
		$config['total_rows'] =$this->m->get_jumlah_penduduk();
		$config['per_page'] = 10;

		$this->pagination->initialize($config);

		return $this->pagination->create_links();

	 }
	 function pagination_kelahiran(){

		$this->load->library('pagination');
		$config['suffix'] = (isset($_GET['q']))?'?q='.$_GET['q']:'';
		$config['cur_tag_open'] = '<li><a><b>';
      	$config['cur_tag_close'] = '</b></a></li>';
      	$config['num_tag_open'] = '<li>';
      	$config['num_tag_close'] = '</li>';
      	$config['last_tag_open'] = '<li>';
      	$config['last_tag_close'] = '</li>';
      	$config['next_tag_open'] = '<li>';
      	$config['next_tag_close'] = '</li>';
      	$config['prev_tag_open'] = '<li>';
      	$config['prev_tag_close'] = '</li>';
      	$config['first_tag_open'] = '<li>';
      	$config['first_tag_close'] = '</li>';
      	$config['use_page_numbers'] = TRUE;
      	$config['base_url'] = site_url('penduduk/data_kelahiran/');
		$config['total_rows'] =$this->m->get_jumlah_kelahiran();
		$config['per_page'] = 10;

		$this->pagination->initialize($config);

		return $this->pagination->create_links();

	 }
	 function pagination_perpindahan(){

		$this->load->library('pagination');
		$config['suffix'] = (isset($_GET['q']))?'?q='.$_GET['q']:'';
		$config['cur_tag_open'] = '<li><a><b>';
      	$config['cur_tag_close'] = '</b></a></li>';
      	$config['num_tag_open'] = '<li>';
      	$config['num_tag_close'] = '</li>';
      	$config['last_tag_open'] = '<li>';
      	$config['last_tag_close'] = '</li>';
      	$config['next_tag_open'] = '<li>';
      	$config['next_tag_close'] = '</li>';
      	$config['prev_tag_open'] = '<li>';
      	$config['prev_tag_close'] = '</li>';
      	$config['first_tag_open'] = '<li>';
      	$config['first_tag_close'] = '</li>';
      	$config['use_page_numbers'] = TRUE;
      	$config['base_url'] = site_url('penduduk/data_perpindahan/');
		$config['total_rows'] =$this->m->get_jumlah_perpindahan();
		$config['per_page'] = 10;

		$this->pagination->initialize($config);

		return $this->pagination->create_links();

	 }
	  function pagination_kematian(){

		$this->load->library('pagination');
		$config['suffix'] = (isset($_GET['q']))?'?q='.$_GET['q']:'';
		$config['cur_tag_open'] = '<li><a><b>';
      	$config['cur_tag_close'] = '</b></a></li>';
      	$config['num_tag_open'] = '<li>';
      	$config['num_tag_close'] = '</li>';
      	$config['last_tag_open'] = '<li>';
      	$config['last_tag_close'] = '</li>';
      	$config['next_tag_open'] = '<li>';
      	$config['next_tag_close'] = '</li>';
      	$config['prev_tag_open'] = '<li>';
      	$config['prev_tag_close'] = '</li>';
      	$config['first_tag_open'] = '<li>';
      	$config['first_tag_close'] = '</li>';
      	$config['use_page_numbers'] = TRUE;
      	$config['base_url'] = site_url('penduduk/data_kematian/');
		$config['total_rows'] =$this->m->get_jumlah_kematian();
		$config['per_page'] = 10;

		$this->pagination->initialize($config);

		return $this->pagination->create_links();

	 }
	
	 function set_ketua($ktp,$id_kk){
	 	$this->load->m->set_ketua($ktp,$id_kk);


	 }

	 function data_penduduk($start=1){
	 	$data['title']='Dashboard';
		$data['menu_ac']=2;
		//if(!empty($this->session->flashdata('nik')))$this->session->unset_userdata('nik');
		$this->load->view(getcontroller('c1').'/Header',$data);
		$data['q']=$this->m->data_penduduk($start);
		$data['pagin']=$this->pagination();
		$this->load->view('browse_penduduk',$data);
	 }
	 
	 function daftar_lokasi(){
	 	//$this->output->enable_profiler(TRUE);
		$data['title']='Dashboard';
		$data['menu_ac']=6;
		
		$this->load->view(getcontroller('c1').'/Header',$data);
		$data['q']=$this->m->select_lokasi();
		$data['pagin']=$this->pagination();
		$this->load->view('daftar_lokasi',$data);
	 }
	
	function new_penduduk(){
		$data['title']='Dashboard';
		$data['menu_ac']=2;
		$this->m->save_penduduk('new');
		$this->load->view(getcontroller('c1').'/Header',$data);
	 	$this->load->helper('form');
	 	$data['pekerjaan']=$this->m->get_data_pekerjaan();
		$this->load->view('form_penduduk',$data);
		
	}

	function get_kelurahan(){
		$this->m->get_kelurahan();
	}

	function edit_penduduk($nik){
		$data['title']='Dashboard';
		$data['menu_ac']=2;
		//if(!empty($this->session->flashdata('nik')))$this->session->unset_userdata('nik');
		$this->load->view(getcontroller('c1').'/Header',$data);
		$this->load->helper('form');
		$this->m->save_penduduk('update');
		$data['penduduk']=$this->m->select_penduduk($nik);
		$data['pekerjaan']=$this->m->get_data_pekerjaan();
	 	//$data['penduduk']=$this->m->get_penduduk();
		$this->load->view('form_penduduk',$data);
		}
		function edit_kelahiran($nik){
		$data['title']='Dashboard';
		$data['menu_ac']=3;
		//if(!empty($this->session->flashdata('nik')))$this->session->unset_userdata('nik');
		$this->load->view(getcontroller('c1').'/Header',$data);
		$this->load->helper('form');
		$this->m->save_penduduk('update');
		$data['penduduk']=$this->m->select_penduduk($nik);
		$data['pekerjaan']=$this->m->get_data_pekerjaan();
	 	//$data['penduduk']=$this->m->get_penduduk();
		$this->load->view('form_penduduk',$data);
		}
		function edit_kematian($nik){
		$data['title']='Dashboard';
		$data['menu_ac']=4;
		//if(!empty($this->session->flashdata('nik')))$this->session->unset_userdata('nik');
		$this->load->view(getcontroller('c1').'/Header',$data);
		$this->load->helper('form');
		$this->m->save_penduduk('update');
		$data['penduduk']=$this->m->select_penduduk($nik);
		$data['pekerjaan']=$this->m->get_data_pekerjaan();
	 	//$data['penduduk']=$this->m->get_penduduk();
		$this->load->view('form_penduduk',$data);
		}
	function update_penduduk($id){
		//print_r($_POST);
		$data['a']=$this->m->update_penduduk($id);
		//$this->load->view('header');
		$this->load->view('browse',$data);	
	}
	
	function join_data(){
		$data['q']=$this->m->join_penduduk();
		$this->load->view('form',$data);
		//print_r($data['q']);
	}
	
	function delete($id){
	  	$this->m->delete_penduduk($id);
	  	redirect('penduduk/data_penduduk');
	  }
	
	function detail($ktp){
	 	$data['title']='Dashboard';
		$data['menu_ac']=2;
		$this->load->view(getcontroller('c1').'/Header',$data);
		$data['q']=$this->m->detail($ktp);
		$this->load->view('detail_penduduk',$data);
	}

	function dashboard($start=0){
		 	$data['title']='Dashboard';
			$data['menu_ac']=1;
			$this->load->view(getcontroller('c1').'/Header',$data);
			$data['penduduk']=$this->m->chart_data_penduduk();
			$data['kematian']=$this->m->chart_data_kematian();
			$data['kelahiran']=$this->m->chart_data_kelahiran();
			$data['masuk']=$this->m->chart_data_masuk();
			$data['keluar']=$this->m->chart_data_keluar();
			$this->load->view('dasboard',$data);
	}
	
	function edit_data_kecamatan($id){
		$data['title']='Dashboard';
		$data['menu_ac']=1;
		$this->load->view(getcontroller('c1').'/Header',$data);
		$this->load->helper('form');
		$data['q']=$this->m->edit_data_kecamatan($id);
		$data['kec']=$this->m->data_kecamatan();
		$this->load->view('form_data_kecamatan',$data);
	}

	function update_data_kecamatan($id){
		$data=$this->m->update_data_kecamatan($id);
	}	
	
	function cari_kelurahan(){
		if(!empty($this->session->flashdata('nik')))$this->session->keep_flashdata('nik');
		$query=$this->m->cari_kelurahan();
		if($query){
			foreach ($query as $dk) {
				$data[]=['id'=>$dk->ID,'nama_kel'=>$dk->nama_kelurahan,
				'nama_kec'=>$dk->nama_kecamatan,'nama_kota'=>str_replace('KABUPATEN','Kab.',$dk->nama_kota)];
			}
			echo json_encode($data);
		}
	}

  	function get_default_lokasi($id){
  		//$query=$this->m->get_default_lokasi($id);
  		if($query){
  			foreach ($query as $dk) {
  				$data[]=['id'=>$dk->ID,'nama_kel'=>$dk->nama_kelurahan,'nama_kec'=>$dk->nama_kecamatan
					,'nama_kota'=>$dk->nama_kecamatan];
  			}
  			return json_encode($data);
  		}
  	}

  	
  	//Dipakai leh view form_kk
  	function cari_id_kk(){
			if(!empty($this->session->flashdata('nik')))$this->session->keep_flashdata('nik');
  		$query=$this->m->cari_id_kk();
  		if($query){
  			foreach ($query as $dk) {
  				$data[]=['nama_kk'=>$dk->nama_kk,'id'=>$dk->no_kk];
  			}
  			echo json_encode($data);
  		}
  	}
		function cari_penduduk(){
			if(!empty($this->session->flashdata('nik')))$this->session->keep_flashdata('nik');
  		$query=$this->m->cari_penduduk();
  		if($query){
  			foreach ($query as $dk) {
  				$data[]=['nama_lengkap'=>$dk->nama_penduduk,'id'=>$dk->no_kk];
  			}
  			echo json_encode($data);
  		}
  	}

  	function get_default_kk($id){
  		$query=$this->m->get_default_kk($id);
  		echo $query;
  	}
	
  	function form_keluarga(){
  		$data['title']='Keluarga';
			$data['menu_ac']=7;
			//$data['segmet']=menu($this->uri->segment(2));
			//$this->m->insert_new();
			$this->load->view(getcontroller('c1').'/Header',$data);
		 	$this->load->helper('form');
		 	//$data['pekerjaan']=$this->m->get_data_pekerjaan();
			$data['penduduk']=$this->m->insert_keluarga();
			$this->load->view('form_keluarga',$data);
  	}
  	function data_keluarga(){
  		$data['title']='Dashboard';
			$data['menu_ac']=7;
			$this->load->view(getcontroller('c1').'/Header',$data);
			$data['q']=$this->m->select_keluarga();
			$this->load->view('browse_keluarga',$data);

  	}
  	function edit_keluarga($id){
  		$data['title']='Dashboard';
			$data['menu_ac']=1;
			$this->load->view(getcontroller('c1').'/Header',$data);
			$this->load->helper('form');
			$data['action']=("edit");
			$data['keluarga']=$this->m->get_keluarga($id);
			$this->load->view('form_keluarga',$data);
  	}
  	
  	function update_keluarga($id){
			$data['q']=$this->m->update_keluarga($id);
			$this->load->view('browse_kk',$data);
  	}
  	
  	function delete_kk($no_kk){
			$this->m->delete_keluarga($no_kk);
			redirect('penduduk/data_keluarga');  	
  	}
  	
  	function detail_kk($id){
  		$this->load->helper('form');
		 	$data['title']='Dashboard';
			$data['menu_ac']=7;
			$this->load->view(getcontroller('c1').'/Header',$data);
			$data['q']=$this->m->detail_keluarga($id);
			$this->load->view('detail_kk',$data);
  	}

	function data_kematian($start=1){
  	$data['title']='Dashboard';
		$data['menu_ac']=4;
		$this->load->view(getcontroller('c1').'/Header',$data);
		$data['q']=$this->m->select_kematian($start);
		$data['pagin']=$this->pagination_kematian();
		$this->load->view('browse_kematian',$data);

  	}
	
  	function data_kelahiran($start=1){
			$data['title']='Dashboard';
			$data['menu_ac']=3;
			$this->load->view(getcontroller('c1').'/Header',$data);
			$data['q']=$this->m->select_kelahiran($start);
			$data['pagin']=$this->pagination_kelahiran();
			$this->load->view('browse_kelahiran',$data);

  	}
  	function data_perpindahan($start=1){
			$data['title']='Dashboard';
			$data['menu_ac']=5;
			$this->load->view(getcontroller('c1').'/Header',$data);
			$data['q']=$this->m->select_perpindahan($start);
			$data['pagin']=$this->pagination_perpindahan();
			$this->load->view('browse_perpindahan',$data);

  	}

  	function cari_id_penduduk(){
  		$query=$this->m->cari_id_penduduk();
  		if($query){
  			foreach ($query as $dk) {
  				$data[]=['nama_penduduk'=>$dk->nama_lengkap,'NIK'=>$dk->NIK,'id'=>$dk->NIK];
  			}
  			echo json_encode($data);
  		}
  	}

  	function get_default_penduduk($id){
  		$query=$this->m->get_default_penduduk($id);
  		echo $query;
  	}
  	function insert_perpindahan(){
  		$data['title']='perpindahan';
			$data['menu_ac']=5;
			$this->load->view(getcontroller('c1').'/Header',$data);
		 	$this->load->helper('form');
			$data['perpindahan']=$this->m->insert_perpindahan();
			$this->load->view('form_perpindahan',$data);
  	}
	
	function edit_perpindahan($id){
  		$data['title']='Dashboard';
		$data['menu_ac']=5;
		$this->load->view(getcontroller('c1').'/Header',$data);
		$this->load->helper('form');
		$data['action']=("edit");
		$data['kematian']=$this->m->get_perpindahan($id);
		$this->load->view('form_perpindahan',$data);	
	}
	  	function detail_kematian($id){
  		$this->load->helper('form');
	 	$data['title']='Dashboard';
		$data['menu_ac']=4;
		$this->load->view(getcontroller('c1').'/Header',$data);
		$data['q']=$this->m->detail_kematian($id);
		$this->load->view('detail_kematian',$data);
  	}
  	
  	function tampilkan_kelurahan($id_kecamatan=0){
  		//$this->output->enable_profiler(TRUE);
			$data['title']='daftar lokasi';
			$data['menu_ac']=6;
		
			$this->load->view(getcontroller('c1').'/Header',$data);
			$data['q']=$this->m->tampilkan_kelurahan($id_kecamatan);
			$this->load->view('daftar_kelurahan',$data);
  	}

}
?>
