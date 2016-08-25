<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/token-input.css');?>">
<div class="container">
	<div class='row'>
		<div class="col-md-2" ><div class='row'><div style="width:100%"><?php menu($menu_ac);?></div></div></div>
		<div class="col-md-10" style="">
					<br>
  <div class="panel panel-primary">
   <div class="panel-heading ">
   		<div class='row'>
		   	<span class='col-md-8'>Form Data penduduk</span>
  		</div>
   </div>
   <div class="panel-body">
   	<div class="row">
   		<div class="col-md-12">
   			<?=!empty($this->session->flashdata('info'))?'<div class="alert alert-info">'.$this->session->flashdata('info').'</div>':''?>
   		</div>
   	</div>
		<div class='row '>

	
	<?php
	$arr=array();
	$jenis='';
	$pkr=array();	
	if($pekerjaan){
		$pkr['']="none";
		foreach($pekerjaan->result() as $r)
		{
			$pkr[$r->ID]=$r->nama_pekerjaan;

		}
	}			
	//print_r($kas_record->row());
	if (isset($penduduk)){
		foreach( $penduduk->result() as $row){
			//print_r($row);
			$nik=$row->NIK;
			$this->session->set_flashdata('nik',$nik);
			$ktp=$row ->KTP;
			$nama=$row->nama_lengkap;
			$jenis=$row->jenis_kelamin;
			$alamat=$row->alamat;
			$foto=$row->foto;
			$agama=$row->id_agama;
			$pekerjaan=$row->id_pekerjaan;
			$perkawinan=$row->status_perkawinan;
			$nomor_kk=isset($row->no_kk)?$row->no_kk:'';
			$gol_darah=$row->gol_darah;
			$kematian=$row->tanggal_kematian;
			$kelahiran=$row->tanggal_lahir;
			$tempat_lahir=$row->id_kelurahan_ttl;	
			$tempat_meninggal=$row->id_kelurahan_kematian;		
		}
	}
	echo form_open();
		?>
	 <div class="col-md-6" >
			<?php
		$dropdon=array('type'=>'dropdown','value'=>'','class'=>'form-control');
		$submit=array('type'=>'submit','value'=>'Save','class'=>'btn btn-xs btn-primary');
		$jenis_laki2=array('type'=>'radio','value'=>'1','session_name()'=>'jk','class'=>'form-control');
		$jenis_perempuan=array('type'=>'radio','value'=>'0','name'=>'jk','class'=>'form-control');
		$stt=array(	'0'=>'Belum menikah','1'=>'Menikah');	?>
			<table class='table'> 
				<tr>
						<td><label for='exampleInputEmail1'>NIK</label></td>
						<td><?=isset($nik)?$this->session->flashdata('nik'):form_input('nik','','class="form-control"')?></td>
				</tr>
				<tr>
						<td><label for='exampleInputEmail1'>KTP</label></td>
						<td><?=form_input('ktp',isset($ktp)?$ktp:'','class="form-control"')?></td>
				</tr>
				<tr>
					<td><label for='exampleInputEmail1'>Nama</label></td>
					<td>	<?=form_input('nama',isset($nama)?$nama:'','class="form-control"')?></td>
				</tr>
				<tr>
					<td><label for='exampleInputEmail1'>Jenis_kelamin</label></td>
					<td>
					 	<input type="radio" name="jk" value="1"<?php echo ($jenis==1)?'checked':''?> >laki laki
						<input type="radio" name="jk" value="0"<?php echo ($jenis==0)?'checked':''?> >perempuan
					</td>
				</tr>		
				<tr>
					<td><label for='exampleInputEmail1'>foto</label></td>
					<td><?=form_upload('foto',isset($foto)?$foto:'','class="form-control"')?></td></tr>
				<tr>
					<td><label for='exampleInputEmail1'>Agama</label></td>
					<td><?=form_agama(isset($agama)?$agama:'')?></td>
				<tr>
				<tr><?php //print_r($pkr);?>
				<td><label for='exampleInputEmail1'>Pekerjaan</label></td>
				<td><?=form_dropdown('pekerjaan',$pkr,isset($pekerjaan)?$pekerjaan:'','class="form-control"')?></td>
			</tr>
			</table>
			<?php 
				function get_lokasi($klr_val){
							//echo $klr_val;
							if($klr_val !== ''){
								$CI=&get_instance();
								$data=$CI->m->get_default_lokasi($klr_val);
								return ($data !== false)?$data:'';
							}
							return '{"nama_kel":"","nama_kota":"Not Set"}';
						}
				function get_no_kk($no_kk){
					if($no_kk !==''){
						$CI=&get_instance();
						$data=$CI->m->get_default_kk($no_kk);
						return ($data !== false)?$data:'';
					}
					return '[]';

				}
			
			?>
				
	
	</div>
							
	<div class="col-md-6">
		<table class='table'>
			<tr>
				<td><label for='exampleInputEmail1'>Status Perkawinan</label></td>
				<td><?=form_dropdown('status',$stt,isset($perkawinan)?$perkawinan:'','class="form-control"')?></td>
			</tr>
			<tr>
				<td><label for='exampleInputEmail1'>Nama_kk</label></td>
				<td><?=form_input('kk','','class="form-control" id="kk"')?></td>
			</tr>
			<tr>
			<td><label for='exampleInputEmail1'>Gol_darah</label></td>
			<td><?=form_dropdown('gol_darah',['a'=>'A','b'=>'B','ab'=>'AB','o'=>'O'],isset($gol_darah)?$gol_darah:'','class="form-control"')?></td></tr>
			</tr>
			<tr style="background:#add">
				<td><label for='exampleInputEmail1'>Tempat lahir</label></td>
				<td><?=form_input("tempat_kelahiran",'',"class='form-control' id='kelurahan'")?></td>
			</tr>
			<tr style="background:#add">
				<td><label for='exampleInputEmail1'>Tanggal Lahir</label></td>
				<td><?=form_input(['name'=>"tanggal",'value'=>isset($kelahiran)?$kelahiran:'',"class"=>'form-control','type'=>'date'])?></td>
			</tr>
			
			<tr style="background:#fdd">
				<td><label for='exampleInputEmail1'>Tempat Meninggal</label></td>
				<td><?=form_input("tempat_kematian",'',"class='form-control' id='kematian'")?></td>
			</tr>
			<tr style="background:#fdd">
				<td><label for='exampleInputEmail1'>Tanggal_kematian</label></td>
				<td><?=form_input(['name'=>"tanggal_k",'value'=>isset($kematian)?$kematian:'',"class"=>'form-control','type'=>'date'])?></td>	
			</tr>
			
			<tr>
				<td></td>
				<td>
					<?php $submit=array('type'=>'submit','value'=>'Save','class'=>'btn btn-md btn-primary');?>
					<?=form_submit($submit)//form_submit($submit)=($menu_ac)?(false)?>
					<button class='btn btn-md btn-warning' onclick='history.back();'>Back</button>
				</td>
			</tr>
		</table>

	


	</div> 		
   </div>
</div>
	<?php
		//include('form_kelahiran.php');
	?>
					
		</div>
<?=form_close()?>
		<div class="col-md-2"></div>
	</div>
<?php //echo get_no_kk($nomor_kk);?>
</div>

<script type="text/javascript" src="<?=base_url('assets/js')?>/jquery.tokeninput.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    $("#kk").tokenInput("<?=site_url('penduduk/cari_id_kk')?>", {
              propertyToSearch: "nama_kk",
              resultsFormatter: function(item){ return "<li>" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name'>" + item.nama_kk + "</div></div></li>" },
              tokenFormatter: function(item) { return "<li><p>" + item.nama_kk + " </p></li>" },
              tokenLimit : 1,
              preventDuplicates: true,
              prePopulate: <?=get_no_kk(isset($nomor_kk)?$nomor_kk:'');?>

          });
          
      var lokasi_default= '';
			var lokasi_populate=[<?=get_lokasi(isset($tempat_lahir)?$tempat_lahir:'');?>];
		//	console.log(nilai_default);
			  $("#kelurahan").tokenInput("<?=site_url('penduduk/cari_kelurahan')?>", {
		            propertyToSearch: "nama_kel",
		            resultsFormatter: function(item){ return "<li>" + "<div style='display: inline-block; padding-left: 10px;'>"
		            +"<div class='full_name'>" + item.nama_kel + "</div><div class='email'>" + item.nama_kota + "</div></div></li>" },
		            tokenFormatter: function(item) { return "<li><p>" + item.nama_kel + ":" + item.nama_kota + "</p></li>" },
		            tokenLimit : 1,
		            preventDuplicates: true,
		            prePopulate: lokasi_populate
		        });
          
      var lokasi_kematian= '';
			var lokasi_kematian_populate=[<?=get_lokasi(isset($tempat_meninggal)?$tempat_meninggal:'');?>];
		//	console.log(nilai_default);
			  $("#kematian").tokenInput("<?=site_url('penduduk/cari_kelurahan')?>", {
		            propertyToSearch: "nama_kel",
		            resultsFormatter: function(item){ return "<li>" + "<div style='display: inline-block; padding-left: 10px;'>"
		            +"<div class='full_name'>" + item.nama_kel + "</div><div class='email'>" + item.nama_kota + "</div></div></li>" },
		            tokenFormatter: function(item) { return "<li><p>" + item.nama_kel + ":" + item.nama_kota + "</p></li>" },
		            tokenLimit : 1,
		            preventDuplicates: true,
		            prePopulate: lokasi_kematian_populate
		        });
  });
</script>
              