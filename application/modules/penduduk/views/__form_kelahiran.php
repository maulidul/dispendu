<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/token-input.css');?>">

<div class="container">
	<div class='row'>
		<div class="col-md-2" ><div class='row'><div style="width:100%"><?php menu($this->uri->segment(2));?></div></div></div>
			<div class="col-md-6" style="">
		<br>
		  	<div class="panel panel-primary">
		   	<div class="panel-heading ">
		   		<div class='row'>
				   	<span class='col-md-8'>Form Kelahiran</span>
		  		</div>
		   	</div>
		    		<div class="panel-body">
				<div class='row '>
				<?php
				
				$action=site_url('penduduk/form_kelahiran');
				$id_p="";
				$nama="";
				$tgl="";
				$klr_val='';
				$ket="";
				$arr=array();
				if (isset($kelahiran)){
				foreach( $kelahiran as $row){
					
					$id=$row->ID;
					$id_p=$row->id_penduduk;
					$tgl=$row->tanggal_lahir;
					$klr_val=$row->tmpat_lahr;
					$ket=$row->keterangan;
					$nama=isset($row->nama)?$row->nama:'';
					
				}
				$action=site_url("penduduk/update_kelahiran/".$id);
			}
				echo form_open($action);
				$submit=array('type'=>'submit','value'=>'save','class'=>'btn btn-xs btn-primary');

						echo "<table class='table'> 

						<tr>
							<td><label for='exampleInputEmail1'>nama</label></td>
							<td>".form_input('id_penduduk','','class="form-control" id="nama"')."</td>
						</tr>
						<tr>
							<td><label for='exampleInputEmail1'>lokasi</label></td>
							<td>".form_input("id_lokasi",'','class="form-control" id="tempatLahir"')."</td>
						</tr>
						<tr>
							<td><label for='exampleInputEmail1'>tanggal</label></td>
							<td>".form_input(['name'=>"tanggal",'value'=>$tgl,"class"=>'form-control','type'=>'date'])."</td>
						</tr>
						<tr>
							<td><label for='exampleInputEmail1'>keterangan</label></td>
							<td>".form_input("keterangan",$ket,"class='form-control'")."</td>
						
						<tr><td></td>
							<td>".form_submit($submit)."
								<button class='btn btn-xs btn-warning' onclick='history.back();''>back</button>
							</td>
						</tr>
						</table>";
						
						function get_lokasi($klr_val){
							//echo $klr_val;
							if($klr_val !== ''){
								$CI=&get_instance();
								$data=$CI->m->get_default_lokasi($klr_val);
								return ($data !== false)?$data:'';
							}
							return '[]';
						}


					?>	

		</div>
			</div>
		<?=form_close()?>
			
		</div>
	</div>
		<div class="col-md-2"></div>
	</div>

</div>
<script type="text/javascript" src="<?=base_url('assets/js')?>/jquery.tokeninput.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var nilai_default= '';
		var populate=[<?=get_lokasi($klr_val);?>];
	//	console.log(nilai_default);
	    $("#tempatLahir").tokenInput("<?=site_url('penduduk/cari_kelurahan')?>", {
              propertyToSearch: "nama_kel",
              resultsFormatter: function(item){ return "<li>" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name'>" + item.nama_kel + "</div><div class='email'>" + item.nama_kota + "</div></div></li>" },
              tokenFormatter: function(item) { return "<li><p>" + item.nama_kel + ":" + item.nama_kota + "</p></li>" },
              tokenLimit : 1,
              preventDuplicates: true,
              prePopulate: populate
          });
        });
</script>