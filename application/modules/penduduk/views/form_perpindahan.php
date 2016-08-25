
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/token-input.css');?>">
<div class="container">
	<div class='row'>
		<div class="col-md-2" ><div class='row'><div style="width:100%"><?php menu($this->uri->segment(2));?></div></div></div>
			<div class="col-md-6" style="">
		<br>
		  	<div class="panel panel-primary">
		   	<div class="panel-heading ">
		   		<div class='row'>
				   	<span class='col-md-8'>form_perpindahan</span>
		  		</div>
		   	</div>
		    		<div class="panel-body">
				<div class='row '>
				<?php
				
				$action=site_url('penduduk/insert_perpindahan');
				$nama="";
				$type="";
				$tgl='';
				$ket='';
				$arr=array();
				if (isset($keluarga)){
				foreach( $keluarga as $row){
				//print_r($row);
					$id=$row->ID;
					$nama=$row->nama_lengkap;
					$typet=$row->type;
					$tgl=$row->tanggal_pindah;
					$ket=$row->keterangan;
					
				}
				$action=site_url("penduduk/update_perpindahan/".$id);
			}
				echo form_open($action);
				$submit=array('type'=>'submit','value'=>'save','class'=>'btn btn-xs btn-primary');

						echo "<table class='table'> 

						<tr><td><label for='exampleInputEmail1'>NIK</label></td>
							<td>".form_input('nik','','class="form-control" id="perpindahan"')."</td>
						<tr>
						<td><label for='exampleInputEmail1'>type</label></td>
						<td>".form_dropdown('type',['none'=>'none','1'=>'1','0'=>'0'],isset($$type)?$$type:'','class="form-control"')."</td>
						</tr>
						<tr><td><label for='exampleInputEmail1'>tanggal</label></td>
							<td>".form_input(['name'=>"tgl",'value'=>isset($tgl)?$tgl:'',"class"=>'form-control','type'=>'date'])."</td>
						</tr><tr><td><label for='exampleInputEmail1'>keterangan</label></td>
							<td>".form_input("ket",$ket,"class='form-control'")."</td>
						<tr><td></td>
							<td>".form_submit($submit)."
								<button class='btn btn-xs btn-warning' onclick='history.back();''>back</button>
							</td>
						</tr>
						</table>";
							
					 
	/*					function get_lokasi($klr_val){
							//echo $klr_val;
							if($klr_val !== ''){
								$CI=&get_instance();
								$data=$CI->m->get_default_lokasi($klr_val);
								return ($data !== false)?$data:'';
							}
							return '[]';
						}*/
						function get_perpindahan($nama){
							//echo $klr_val;
							if($nama !== ''){
								$CI=&get_instance();
								$data=$CI->m->get_default_perpindahan($nama);
								return ($data !== false)?$data:'';
							}
							return '[]';
						}

					?>
								
					<?=form_close()?>

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
				var populate=<?=get_perpindahan($nama);?>;
	    $("#perpindahan").tokenInput("<?=site_url('penduduk/cari_id_penduduk')?>", {
              propertyToSearch: "nama_penduduk",
              resultsFormatter: function(item){ return "<li>" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name'>" + item.nama_penduduk + "</div></div></li>" },
              tokenFormatter: function(item) { return "<li><p>" + item.nama_penduduk + " </p></li>" },
              tokenLimit : 1,
              preventDuplicates: true,
              prePopulate: populate
          });
 
        });
</script>