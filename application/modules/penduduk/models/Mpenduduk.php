<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpenduduk extends CI_Model{
	
	
	function save_penduduk($type){
		if($_POST){			
			$ktp=$this->input->post("ktp");
			$nama=$this->input->post("nama");
			$jk=$this->input->post("jk");
			$agama=$this->input->post("agama");
			$tempat_kelahiran=$this->input->post("tempat_kelahiran");
			$tempat_kematian=$this->input->post("tempat_kematian");
			$tanggal=$this->input->post("tanggal");
			$tanggal_k=$this->input->post("tanggal_k");
			$pekerjaan=$this->input->post("pekerjaan");
			$perkawinan=$this->input->post("status");
			$kk=$this->input->post("kk");
			$gol_darah=$this->input->post("gol_darah");
				$data_p=array(
				 'KTP'=>$ktp,
				 'nama_lengkap'=>$nama,
				 'no_kk'=>$kk);
				$data_pd=array(
				 'jenis_kelamin'=>$jk,
				 'id_agama'=>$agama,
				 'id_pekerjaan'=>$pekerjaan,
				 'status_perkawinan'=>$perkawinan,
				 'gol_darah'=>$gol_darah
				);
				$data_pk=array(
				'id_kelurahan_ttl'=>$tempat_kelahiran,
				'tanggal_lahir'=>$tanggal				
				);
				$data_pkematian=array(
				'id_kelurahan_kematian'=>$tempat_kematian,
				'tanggal_kematian'=>$tanggal_k				
				);
				if($type == 'update'){
					$nik=$this->session->flashdata('nik');
					$this->db->update('penduduk',$data_p,['NIK'=>$nik]);
					$this->update_detail($data_pd,['NIK'=>$nik]);
					$this->update_kelahiran($data_pk,['NIK'=>$nik]);
					$this->update_kematian($data_pkematian,['NIK'=>$nik]);
					$this->session->set_flashdata('info','Data Berhasil Diubah.');
				}else{
					$nik=$this->input->post('nik');
					$data_p['NIK']=$nik;
					$this->db->insert('penduduk',$data_p);
					//$id=$this->db->insert_id();
					if($nik > 0){
						$data_pd['NIK']=$nik;
						$data_pk['NIK']=$nik;
						$data_pkematian['NIK']=$nik;
						$this->db->insert('penduduk_detail',$data_pd);
						$this->db->insert('penduduk_kelahiran',$data_pk);
						$this->db->insert('penduduk_kematian',$data_pkematian);
						$this->session->set_flashdata('info','Data Berhasil Ditambahkan.');
					}
				}	 
					redirect('penduduk/edit_penduduk/'.$nik);
		}
	}
	
	function update_detail($data,$where){
		print_r($where);
		$this->db->where($where);
		$q=$this->db->get('penduduk_detail');
		if($q->num_rows() == 0)$this->db->insert('penduduk_detail',['nik'=>$where['NIK']]);
		$this->db->update('penduduk_detail',$data,$where);	
	}
	
	function update_kelahiran($data,$where){
		$this->db->where($where);
		$q=$this->db->get('penduduk_kelahiran');
		if($q->num_rows() == 0)$this->db->insert('penduduk_kelahiran',['nik'=>$where['NIK']]);
		$this->db->update('penduduk_kelahiran',$data,$where);
	}
	
	function update_kematian($data,$where){
		$this->db->where($where);
		$q=$this->db->get('penduduk_kematian');
		if($q->num_rows() == 0)$this->db->insert('penduduk_kematian',['nik'=>$where['NIK']]);
		$this->db->update('penduduk_kematian',$data,$where);
	}

	function get_kelurahan(){
		if($_GET){
			$id=$_GET['kel'];
			$this->db->where('ID',$id);
			$this->db->select(array('km1.ID','km1.nama as nama_kelurahan','km2.nama as nama_kecamatan'));
			$this->db->join('kelurahan as km2','km2.ID=km1.kecamatan','left');
			$q=$this->db->get('kelurahan km1');
			if($q->num_rows()>0){
				foreach($q->result() as $r){
					$data=['id'=>$r->ID,'nama_kec'=>$r->nama_kecamatan,'nama_kel'=>$r->nama_kelurahan];
				}
				echo json_encode($data);
			}
		}
	}

	function get_data_kelurahan(){
			//$q=$this->db->query('SELECT * FROM kelurahan WHERE kelurahan != 0 '); 
			
		$this->db->where('kelurahan <>','0');
		$this->db->select(array('ID','nama'));
		$q=$this->db->get('kelurahan');
		if($q->num_rows()>0)return $q;
	}
	function get_data_kecamatan(){
		$this->db->where('kelurahan ','0');
		$this->db->select(array('ID','nama'));
		$q=$this->db->get('kelurahan');
		if($q->num_rows()>0)return $q;
	}
	
	function get_data_pekerjaan(){
		$this->db->select(array('ID','nama_pekerjaan'));
		$q=$this->db->get('penduduk_pekerjaan'); 
		if($q->num_rows()>0)return $q;
	}
	
	function select_lokasi(){
		//$this->db->cache_on();
		//$this->db->order_by('kecamatan asc');
		$this->db->limit(10);
		$this->db->where('regency_id',3573);
		$this->db->order_by('name asc');
		$this->db->select(array('ID','name'));
		$q=$this->db->get('lokasi_kecamatan');
		return $q->result();
	}	

	function proses(){
		$induk=1;
		$lokasi=$this->select_lokasi();
		foreach($lokasi as $r){
			$ID=$r->ID;
			$kecamatan=$r->kecamatan;
			$kelurahan=$r->kelurahan;
			if($kelurahan == 0){
				$induk=$ID;
			}
			$this->db->update('kelurahan',['kecamatan'=>$induk],['ID'=>$ID]);
		}
	}

	function select_kelurahan(){
		$this->db->where('kelurahan <>','0');
		$this->db->select(array('ID','nama','kecamatan','kelurahan'));
		$q=$this->db->get('kelurahan');
		return $q->result();
	}	
	function data_penduduk($start){
		$start=($start>1)?10*($start-1):0;
		if(isset($_GET['q'])){
			$this->db->like('p.nama_lengkap',$_GET['q']);
		}
		$this->db->limit(10,$start);
		$this->db->select(array('p.NIK','p.KTP','p.nama_lengkap','p.no_kk','penduduk_detail.foto'
								//,'p.id_kelurahan'
								,'penduduk_detail.id_pekerjaan'
								,'penduduk_detail.id_agama'
								//,'km.nama'
								//,'km2.nama as nama_kecamatan'
								,'pk.nama_pekerjaan'
								));
		$this->db->join('penduduk_detail', 'p.NIK=penduduk_detail.NIK', 'left');
		//$this->db->join('kelurahan km2', 'km.kecamatan=km2.ID', 'left');
		$this->db->join('penduduk_pekerjaan pk', 'p.NIK=pk.ID', 'left');
		$q=$this->db->get('penduduk p');
		return $q->result();
				
	}

	function select_penduduk($nik){
		$this->db->where('p.NIK',$nik);
		$this->db->select(array('p.NIK','p.KTP','p.nama_lengkap','p.no_kk','penduduk_detail.foto'
								,'penduduk_detail.id_pekerjaan'
								,'penduduk_detail.jenis_kelamin'
								,'penduduk_detail.id_agama'
								,'penduduk_detail.status_perkawinan'
								,'penduduk_detail.gol_darah'
								,'kartu_keluarga.alamat'
								,'pk.nama_pekerjaan'
								,'kartu_keluarga.alamat'
								,'penduduk_kematian.tanggal_kematian'
								,'penduduk_kematian.id_kelurahan_kematian'
								,'penduduk_kelahiran.id_kelurahan_ttl'
								,'penduduk_kelahiran.tanggal_lahir'
								
								));
		$this->db->join('penduduk_detail', 'p.NIK=penduduk_detail.NIK', 'left');
		$this->db->join('penduduk_pekerjaan pk', 'p.NIK=pk.ID', 'left');
		$this->db->join('penduduk_kematian ', 'p.NIK=penduduk_kematian.NIK', 'left');
		$this->db->join('penduduk_kelahiran', 'p.NIK=penduduk_kelahiran.NIK', 'left');
		$this->db->join('kartu_keluarga', 'p.NIK=kartu_keluarga.ID', 'left');
		//$this->db->join('kartu_keluarga', 'p.ID=kartu_keluarga.id_penduduk', 'left');
		$q=$this->db->get('penduduk p');
		return $q;
	}
	
	function get_penduduk(){
		$this->db->select(array('p.NIK','p.KTP','p.nama_lengkap','p.no_kk','penduduk_detail.foto'
								,'penduduk_detail.id_pekerjaan'
								,'penduduk_detail.jenis_kelamin'
								,'penduduk_detail.id_agama'
								,'penduduk_detail.status_perkawinan'
								,'penduduk_detail.gol_darah'
								,'kartu_keluarga.alamat'
								,'pk.nama_pekerjaan'
								,'kartu_keluarga.alamat'
								,'penduduk_kematian.tanggal_kematian'
								,'penduduk_kematian.id_kelurahan_kematian'
								,'penduduk_kelahiran.id_kelurahan_ttl'
								,'penduduk_kelahiran.tanggal_lahir'
								
								));
		$this->db->join('penduduk_detail', 'p.NIK=penduduk_detail.NIK', 'left');
		$this->db->join('penduduk_pekerjaan pk', 'p.NIK=pk.ID', 'left');
		$this->db->join('penduduk_kematian ', 'p.NIK=penduduk_kematian.NIK', 'left');
		$this->db->join('penduduk_kelahiran', 'p.NIK=penduduk_kelahiran.NIK', 'left');
		$this->db->join('kartu_keluarga', 'p.NIK=kartu_keluarga.ID', 'left');
		//$this->db->join('kartu_keluarga', 'p.ID=kartu_keluarga.id_penduduk', 'left');
		$q=$this->db->get('penduduk p');
		return $q;
	}
	function delete_penduduk($id){
		$this->db->delete('penduduk', array('NIK' => $id));
	}
	function detail($ktp){
		$this->db->select(array('p.NIK as id_penduduk',
					'p.*','kartu_keluarga.alamat'
					,'penduduk_detail.foto'
					,'penduduk_detail.id_pekerjaan'
					,'penduduk_detail.jenis_kelamin'
					,'penduduk_detail.id_agama'
					,'penduduk_detail.status_perkawinan'
					,'penduduk_detail.gol_darah'
					,'pekerjaan.nama_pekerjaan'
					,'kartu_keluarga.rt'
					,'kartu_keluarga.rw'
					,'lokasi_kelurahan.name as nama_kel'));
		$this->db->where('p.ktp ',$ktp);
		$this->db->join('kartu_keluarga', 'p.no_kk=kartu_keluarga.no_kk', 'left');
		$this->db->join('lokasi_kelurahan', 'kartu_keluarga.id_kelurahan=lokasi_kelurahan.ID', 'left');
		$this->db->join('penduduk_detail', 'p.NIK=penduduk_detail.NIK', 'left');
		$this->db->join('penduduk_pekerjaan pekerjaan', 'penduduk_detail.id_pekerjaan=pekerjaan.ID', 'left');
		//$this->db->join(' kartu_keluarga', 'p.no_kk=kartu_keluarga.ID', 'left');
		$q=$this->db->get('penduduk p');	
		return $q->result();
	}
	function get_jumlah_penduduk(){
		if(isset($_GET['q'])){
			$this->db->like('Nama_lengkap',$_GET['q']);

		}
		$this->db->select('count(NIK) as jumlah');
		$data=$this->db->get('penduduk');
		return $data->row()->jumlah;

	}
		function get_jumlah_kelahiran(){
		if(isset($_GET['q'])){
			$this->db->like('Nama_lengkap',$_GET['q']);

		}
		$this->db->select('count(NIK) as jumlah');
		$data=$this->db->get('penduduk_kelahiran');
		return $data->row()->jumlah;
		

	}	
	function get_jumlah_kematian(){
		if(isset($_GET['q'])){
			$this->db->like('Nama_lengkap',$_GET['q']);

		}
		$this->db->select('count(NIK) as jumlah');
		$data=$this->db->get('penduduk_kematian');
		return $data->row()->jumlah;
		

	}
	function get_jumlah_perpindahan(){
		if(isset($_GET['q'])){
			$this->db->like('Nama_lengkap',$_GET['q']);

		}
		$this->db->select('count(NIK) as jumlah');
		$data=$this->db->get('penduduk_perpindahan');
		return $data->row()->jumlah;
		

	}
	function select_data_terakhir($start){
	$this->db->order_by('ID','desc');
	$this->db->limit(5,$start);
		$this->db->select(array('p.ID','p.ktp','p.Nama','p.jenis_kelamin'
								,'p.id_kelurahan','p.id_pekerjaan'
								,'p.id_agama'
								,'km.nama'
								,'km2.nama as nama_kecamatan'
								,'pk.nama_pekerjaan'));
		$this->db->join('kelurahan km', 'p.id_kelurahan=km.ID', 'left');
		$this->db->join('kelurahan km2', 'km.kecamatan=km2.ID', 'left');
		$this->db->join('pekerjaan pk', 'p.id_pekerjaan=pk.ID', 'left');
		$q=$this->db->get('penduduk p');
		return $q->result();

	}
	function edit_data_kecamatan($id){
		$this->db->where('ID',$id);
		$this->db->select(array('ID','nama','kelurahan','kecamatan'));
		$q=$this->db->get('kelurahan');
		return $q->result();
	}
	function update_data_kecamatan($id){
		if($_POST){
			print_r($_POST);
			$nama=$this->input->post("nama");
			$id_kec=$this->input->post("id_kecamatan");
			$data['nama']=$nama;
			if(isset($_POST['id_kecamatan']))	$data['kecamatan']=$id_kec;
			$this->db->where('ID',$id);
				if(

					$this->db->update('kelurahan',$data)){
					redirect("penduduk/daftar_lokasi");
					}	 
					 
				
		}

	}
	function data_kecamatan(){
		$this->db->where('kelurahan','0');
		$this->db->select(array('ID','nama',));
		$q=$this->db->get('kelurahan');
		return $q->result();

	}
	function cari_kelurahan(){
		if(isset($_GET['q'])){
			$this->db->like('lk.name',$_GET['q']);
			$this->db->limit(10);
		}
			//$this->db->where('lk. >',0);
			$this->db->select(array('lk.ID','lk.name as nama_kelurahan','lk2.name as nama_kecamatan','lk3.name as nama_kota'));
			$this->db->join('lokasi_kecamatan as lk2','lk2.ID=lk.district_id','left');
			$this->db->join('lokasi_kab_kota as lk3','lk3.ID=lk2.regency_id','left');
			$q=$this->db->get('lokasi_kelurahan lk');
			if($q->num_rows()>0){
				return $q->result();
			}

	}
		
	//ipakai oleh controller function cari_id_kk
	function cari_id_kk(){
		if(isset($_GET['q'])){
			$this->db->like('kk.nama_kk',$_GET['q']);
			}
			$this->db->select(array('kk.no_kk','kk.nama_kk'));
			//$this->db->join('penduduk','penduduk.no_kk=kk.no_kk','left');
			$q=$this->db->get('kartu_keluarga kk');
			if($q->num_rows()){
				return $q->result();
			}

	}
		function cari_penduduk(){
		if(isset($_GET['q'])){
			$this->db->like('p.nama_lengkap',$_GET['q']);
			}
			$this->db->select(array('p.nama_lenkap','p.nik'));
			$q=$this->db->get('penduduk p');
			if($q->num_rows()){
				return $q->result();
			}

	}
	function login(){
		if($_POST){
					$email=$this->input->post('email');
					$pass=$this->input->post('pass');
				
				$data=array(
					'user_email'=>$email,
					'user_pass'=>md5($pass)
					);
				$this->db->where($data);
				$this->db->limit(1);
				$this->db->select(array('ID'));
				$q=$this->db->get('karyawan');
				if( $q->num_rows()>0){
					$id=$q->row()->ID;
					$this->session->set_userdata('id_user',$id);
					redirect('penduduk');
				}

				}
				
			//redirect('');
	}

	function get_default_lokasi($id){
			$this->db->where('lk.ID ',$id);
			$this->db->select(array('lk.ID','lk.name as nama_kelurahan','lk3.name as nama_kota'));
			$this->db->join('lokasi_kecamatan as lk2','lk2.ID=lk.district_id','left');
			$this->db->join('lokasi_kab_kota as lk3','lk3.ID=lk2.regency_id','left');
			$q=$this->db->get('lokasi_kelurahan lk');
			if($q->num_rows()>0){
	  			foreach ($q->result() as $dk) {
	  				$data=['id'=>$dk->ID,'nama_kel'=>$dk->nama_kelurahan,'nama_kota'=>str_replace('KABUPATEN','Kab.',$dk->nama_kota)];
	  			}
	  			return json_encode($data);
			}
			return false;
	}
	function get_default_kk($id){
			$this->db->where('kk.no_kk',$id);
			$this->db->select(array('kk.no_kk','kk.nama_kk'));
			$q=$this->db->get('kartu_keluarga kk');
			if($q->num_rows()>0){
	  			foreach ($q->result() as $dk) {
	  				$data[]=['id'=>$dk->no_kk,'nama_kk'=>$dk->nama_kk];
	  			}
	  			return json_encode($data);
			}
			return false;
	}
	function insert_keluarga(){
		if($_POST){print_r($_POST);
		//$id=$this->input->post('id');
		$no=$this->input->post('no');
		$nama=$this->input->post('nama');
		$kota=$this->input->post('kota');
		$alamat=$this->input->post('alamat');
		$rt=$this->input->post('rt');
		$rw=$this->input->post('rw');
		$data=array(
			
			//'no_ktp'=>'a'.$no,
			'no_kk'=>$no,			
			'nama_kk'=>$nama,
			'alamat'=>$alamat,
			'id_kelurahan'=>$kota,
			'rt'=>$rt,
			'rw'=>$rw,
			);
		
			if($this->db->insert('kartu_keluarga',$data)){
				redirect('penduduk/data_keluarga');
			}
		}
	}
	function select_keluarga(){
	if(isset($_GET['q'])){
			$this->db->like('kk.nama_kk',$_GET['q']);
		}
		$this->db->select(array('kk.*'));
		//$this->db->join('penduduk ','kk.id_penduduk=penduduk.ktp', 'left');
		$q=$this->db->get('kartu_keluarga kk');
		return $q->result();
	}
	function get_keluarga($id){
		$this->db->where('kk.ID',$id);
		$this->db->select(array('kk.*','lokasi_kelurahan.ID as id_kelurahan'));
			$this->db->join('lokasi_kelurahan ','kk.id_kelurahan=lokasi_kelurahan.ID','left');
			
		$q=$this->db->get('kartu_keluarga kk');
		return $q->result();
	}
	function update_keluarga($id){
		if($_POST){
		$id_kepala=$this->input->post('id');
		$no=$this->input->post('no');
		$nama=$this->input->post('nama');
		$kota=$this->input->post('kota');
		$alamat=$this->input->post('alamat');
		$rt=$this->input->post('rt');
		$rw=$this->input->post('rw');
		$data=array(
			'no_kk'=>$no,
			'nama_kk'=>$nama,
			'id_kelurahan'=>$kota,
			'alamat'=>$alamat,
			'rt'=>$rt,
			'rw'=>$rw,
			);
			$this->db->where('ID',$id);
		if($this->db->update('kartu_keluarga',$data)){
		redirect('penduduk/data_keluarga/'.$id);
		}
		}
	}
	function delete_keluarga($no_kk){
		$this->db->update('penduduk',array('no_kk'=>'0'),array('no_kk'=>$no_kk)); // set default
		$this->db->delete('kartu_keluarga', array('no_kk' => $no_kk));

	}

	function detail_keluarga($id){
		$this->db->select(array(
			'kk.ID as id_kk','kk.no_kk as no_kk','kk.nama_kk as nama_keluarga',
			'p1.KTP as ktp_ketua','p1.nama_lengkap as nama_ketua',
			'p2.KTP as ktp_anggota','p2.nama_lengkap as nama_anggota',
			)
		);
		$this->db->where('kk.ID ',$id);
		$this->db->join('penduduk p1','kk.no_kk=p1.KTP', 'left');//kepla_keluarga
		$this->db->join('penduduk p2','kk.no_kk=p2.no_kk', 'left');//anggotakeluarga
		$q=$this->db->get('kartu_keluarga kk');
		return $q->result();
				
	}
	function insert_perpindahan(){
		if($_POST){print_r($_POST);
		//$id=$this->input->post('id');
		$nik=$this->input->post('nik');
		$type=$this->input->post('type');
		$tgl=$this->input->post('tgl');
		$ket=$this->input->post('ket');
		$data_pp=array(
			'tipe'=>$type,
			'NIK'=>$nik,
			'tanggal_pindah'=>$tgl,
			'keterangan'=>$ket
			);
			
		if(
			$this->db->insert('penduduk_perpindahan',$data_pp)
			//$this->db->insert('penduduk',$data_p);
			){
				redirect('penduduk/data_perpindahan');
			}

			}
	}
	function get_perpindahan($id){
		$this->db->where('kk.ID',$id);
		$this->db->select(array('kk.*','lokasi_kelurahan.ID as id_kelurahan'));
			$this->db->join('lokasi_kelurahan ','kk.id_kelurahan=lokasi_kelurahan.ID','left');
			
		$q=$this->db->get('kartu_keluarga kk');
		return $q->result();
	}
	function set_ketua($ktp,$id_kk){
		if($ktp!=""){
			$this->db->where('ID',$id_kk);
			$this->db->update('kartu_keluarga',['ktp_kepala_keluarga'=>$ktp]);


		redirect('penduduk/detail_kk/'.$id_kk);

		}


	}
	function select_kematian($start){
	
		$start=($start>1)?10*($start-1):0;
		if(isset($_GET['q'])){
			$this->db->like('penduduk.nama_lengka',$_GET['q']);
		}
		$this->db->limit(10,$start);
		
		$this->db->where('pk.tanggal_kematian >','0001-01-01');
		$this->db->select(array('pk.*','penduduk.nama_lengkap','lokasi_kelurahan.name as kelurahan'));
		$this->db->join('penduduk ','pk.NIK=penduduk.NIK', 'left');
		$this->db->join('lokasi_kelurahan','pk.id_kelurahan_kematian=lokasi_kelurahan.ID', 'left');
		$q=$this->db->get('penduduk_kematian pk');
		return $q->result();
	}
	
	function select_perpindahan($start){
		$start=($start>1)?10*($start-1):0;
		if(isset($_GET['q'])){
			$this->db->like('p.nama_lengkap',$_GET['q']);
		}
		$this->db->limit(10,$start);
		$this->db->select(array('pp.*','p.nama_lengkap'));
		$this->db->join('penduduk p','pp.NIK=p.NIK', 'left');
		$q=$this->db->get('penduduk_perpindahan pp');
		return $q->result();
		}
	function select_kelahiran($start){
		$start=($start>1)?10*($start-1):0;
		if(isset($_GET['q'])){
			$this->db->like('p.nama_lengkap',$_GET['q']);
		}
		$this->db->limit(10,$start);
	
		$this->db->where('pk.tanggal_lahir >','0001-01-01');
		$this->db->select(array('pk.*','penduduk.nama_lengkap','lokasi_kelurahan.name as kelurahan'));
		$this->db->join('penduduk ','pk.NIK=penduduk.NIK', 'left');
		$this->db->join('lokasi_kelurahan','pk.id_kelurahan_ttl=lokasi_kelurahan.ID', 'left');
		$q=$this->db->get('penduduk_kelahiran pk');
		return $q->result();
		}
	
	function insert_kematian(){
		if($_POST){
		print_r($_POST);
		$id_p=$this->input->post('id_penduduk');
		$id_l=$this->input->post('id_lokasi');
		$tgl=$this->input->post('tanggal');
		$ket=$this->input->post('keterangan');
		$data=array(
			'id_penduduk'=>$id_p,			
			'id_lokasi'=>$id_l,
			'tanggal_kematian'=>$tgl,
			'keterangan'=>$ket
			);
			if($this->db->insert('penduduk_kematian',$data)){
		//		redirect('penduduk/data_kematian');
			}
		}
	}
	
	function cari_id_penduduk(){
		if(isset($_GET['q'])){
		
			$this->db->like('penduduk.nama_lengkap',$_GET['q']);
			}
			//$this->db->where('penduduk.no_kk','');
			$this->db->select(array('penduduk.NIK','penduduk.nama_lengkap','kartu_keluarga.no_kk','penduduk_perpindahan.NIK'));
			$this->db->join('kartu_keluarga','penduduk.NIK=kartu_keluarga.ID','left');
			$this->db->join('penduduk_perpindahan','penduduk.NIK=penduduk_perpindahan.NIK','left');
			$q=$this->db->get('penduduk ');
			if($q->num_rows()){
				return $q->result();
			}

	}
	function get_default_penduduk($id){
			$this->db->where('penduduk.NIK',$id);
			$this->db->select(array('penduduk.NIK','penduduk.nama_lengkap','penduduk.KTP'));
			$q=$this->db->get('penduduk');
			if($q->num_rows()>0){
	  			foreach ($q->result() as $dk) {
	  				$data[]=['id'=>$dk->NIK,'nama_penduduk'=>$dk->nama_lengkap];
	  			}
	  			return json_encode($data);
			}
			return false;
	}
	
	function get_kematian($id){
		$this->db->where('penduduk_kematian.ID',$id);
		$this->db->select(array('penduduk_kematian.*','penduduk.nama','lokasi_kelurahan.ID as id_kelurahan'));
			$this->db->join('penduduk','penduduk_kematian.id_penduduk=penduduk.ID','left');
			$this->db->join('lokasi_kelurahan ','penduduk_kematian.id_lokasi=lokasi_kelurahan.ID','left');
		$q=$this->db->get('penduduk_kematian');
		return $q->result();
	}
function detail_kematian($ktp){
		$this->db->select(array('penduduk_kematian.*'
					,'p.ID as id_penduduk',
					'p.*','kartu_keluarga.alamat'
					,'penduduk_detail.foto'
					,'penduduk_detail.id_pekerjaan'
					,'penduduk_detail.jenis_kelamin'
					,'penduduk_detail.id_agama'
					,'penduduk_detail.status_perkawinan'
					,'penduduk_detail.gol_darah'
					,'pekerjaan.nama_pekerjaan'
					,'kartu_keluarga.rt'
					,'kartu_keluarga.rw'));
		$this->db->where('p.ktp ',$ktp);
		$this->db->join('kartu_keluarga', 'p.no_kk=kartu_keluarga.no_kk', 'left');
		$this->db->join('penduduk_kematian', 'penduduk_kematian.id_penduduk=p.ID', 'left');
		$this->db->join('penduduk_detail', 'p.ID=penduduk_detail.id_penduduk', 'left');
		$this->db->join('penduduk_pekerjaan pekerjaan', 'penduduk_detail.id_pekerjaan=pekerjaan.ID', 'left');
		//$this->db->join('kk', 'p.no_kk=kk.ID', 'left');
		$q=$this->db->get('penduduk p');	
		return $q->result();
	}
	
	function tampilkan_kelurahan($id_kecamatan){
		$this->db->where('district_id',$id_kecamatan);
		$q=$this->db->get('lokasi_kelurahan');
		return $q->result();
	}
	
	function chart_data_penduduk(){
		$sql="
		SELECT tahun,lahir,mati ,sum(lahir)-sum(mati) as hasil FROM (
			SELECT *,sum(kematian) as mati FROM (
				SELECT tahun,COUNT(NIK) as lahir ,0 as kematian FROM(
					SELECT p.NIK,LEFT(pkl.tanggal_lahir,4) as tahun FROM `penduduk` p
					 LEFT JOIN penduduk_kelahiran pkl ON pkl.NIK=p.NIK
						where pkl.tanggal_lahir > 0) kelahiran
						GROUP BY tahun
						union 
						SELECT tahun,0 as lahir,COUNT(NIK) as kematian FROM(
							SELECT p.NIK,LEFT(pkm.tanggal_kematian,4) as tahun FROM `penduduk` p
							 LEFT JOIN penduduk_kematian pkm ON pkm.NIK=p.NIK
							where pkm.tanggal_kematian > 0) kematian
							GROUP BY tahun
							) data
						GROUP BY tahun
				ORDER BY tahun
			) hasil
			GROUP BY tahun
		";
		$q=$this->db->query($sql);
		$hasil=0;
		foreach($q->result() as $r){
			$tahun=$r->tahun;
			$kelahiran=$r->lahir;
			$kematian = $r->mati;
			$hasil += $r->hasil;
			$data[]= array('tahun'=>$tahun,'jumlah'=>$hasil);
			//echo "tahun=$tahun , total=$hasil";
		}
		return json_encode($data);
		
	}
	
	function chart_data_kelahiran(){
		$sql="
		SELECT tahun_lahir,COUNT(NIK) as jumlah FROM (SELECT p.NIK,LEFT(pkl.tanggal_lahir,4) as tahun_lahir FROM `penduduk` p
			LEFT JOIN penduduk_kelahiran pkl ON pkl.NIK=p.NIK
			WHERE 1) t1
				WHERE tahun_lahir > '0000'
				GROUP BY tahun_lahir
		";
		$q=$this->db->query($sql);
		return json_encode($q->result());
	}
	
	function chart_data_kematian(){
		$sql="
		SELECT tahun_mati,COUNT(NIK) as jumlah FROM (SELECT p.NIK,LEFT(pkm.tanggal_kematian,4) as tahun_mati FROM `penduduk` p
			LEFT JOIN penduduk_kematian pkm ON pkm.NIK=p.NIK
			WHERE 1) t1
				WHERE tahun_mati > '0000'
				GROUP BY tahun_mati
		";
		$q=$this->db->query($sql);
		return json_encode($q->result());
	}
	function chart_data_masuk(){
		$sql="
SELECT bulan_pindah,COUNT(NIK) as jumlah FROM (SELECT p.NIK,MONTH(pp.tanggal_pindah) as bulan_pindah,tipe FROM `penduduk` p
			LEFT JOIN penduduk_perpindahan pp ON pp.NIK=p.NIK
			WHERE 1) t1
				WHERE tipe > '0'
				GROUP BY bulan_pindah
		";
		$q=$this->db->query($sql);
		return json_encode($q->result());
	}
	function chart_data_keluar(){
		$sql="
	
			SELECT bulan_pindah,COUNT(NIK) as jumlah FROM (SELECT p.NIK,MONTH(pp.tanggal_pindah) as bulan_pindah,tipe FROM `penduduk` p
			LEFT JOIN penduduk_perpindahan pp ON pp.NIK=p.NIK
			WHERE 1) t1
				WHERE tipe ='0'
				GROUP BY bulan_pindah
		";
		$q=$this->db->query($sql);
		return json_encode($q->result());
	}
	function insert_kelahiran(){
		if($_POST){
			print_r($_POST);
			$data=[
				''=>$this->input->post('nama_penduduk'),
				'tempat_lahir'=>$this->input->post('id_lokasi'),
				'tanggal_lahir'=>$this->input->post('tanggal'),
				'keterangan'=>$this->input->post('keterangan')
			];
		}
	}
	
	
}


//end of file