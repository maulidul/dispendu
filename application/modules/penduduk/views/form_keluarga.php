
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/token-input.css');?>">
<div class="container">
	<div class='row'>
		<div class="col-md-2" ><div class='row'><div style="width:100%"><?php menu($menu_ac);?></div></div></div>
			<div class="col-md-6" style="">
		<br>
		  	<div class="panel panel-primary">
		   	<div class="panel-heading ">
		   		<div class='row'>
				   	<span class='col-md-8'>form_keluarga</span>
		  		</div>
		   	</div>
		    		<div class="panel-body">
				<div class='row '>
				<?php
				
				$action=site_url('penduduk/form_keluarga');
				$no="";
				$penduduk_val="";
				$alamat="";
				$klr_val='';
				$rt="";
				$rw="";
				$arr=array();
				if (isset($keluarga)){
				foreach( $keluarga as $row){
				//print_r($row);
					$id=$row->ID;
					$no=$row ->no_kk;
					$penduduk_val=$row->nama_kk;
					$alamat=$row->alamat;
					$klr_val=$row->id_kelurahan;
					$rt=$row->rt;
					$rw=$row->rw;					
					
				}
				$action=site_url("penduduk/update_keluarga/".$id);
			}
				echo form_open($action);
				$submit=array('type'=>'submit','value'=>'save','class'=>'btn btn-xs btn-primary');

						echo "<table class='table'> 

						<tr><td><label for='exampleInputEmail1'>nama</label></td>
							<td>".form_input('nama','','class="form-control" id="penduduk"')."</td>
						</tr><tr><td><label for='exampleInputEmail1'>no_kk</label></td>
							<td>".form_input("no",$no,"class='form-control'")."</td>
						</tr>
						<tr>
						<td><label for='exampleInputEmail1'>nama kota</label></td>
						<td>".form_input('kota','','class="form-control" id="kelurahan"')."</td>
						</tr>
						<tr><td><label for='exampleInputEmail1'>alamat</label></td>
							<td>".form_input("alamat",$alamat,"class='form-control'")."</td>
						</tr><tr><td><label for='exampleInputEmail1'>rt</label></td>
							<td>".form_input("rt",$rt,"class='form-control'")."</td>
						</tr><tr><td><label for='exampleInputEmail1'>rw</label></td>
							<td>".form_input("rw",$rw,"class='form-control'")."</td>
						</tr>
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
						function get_kk($no){
							//echo $penduduk_val;
							if($no !== ''){
								$CI=&get_instance();
								$data=$CI->m->get_default_kk($no);
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
		var populate=[<?=get_lokasi($klr_val);?>];
	//	console.log(nilai_default);
	    $("#kelurahan").tokenInput("<?=site_url('penduduk/cari_kelurahan')?>", {
              propertyToSearch: "nama_kel",
              resultsFormatter: function(item){ return "<li>" + "<div style='display: inline-block; padding-left: 10px;'>"
              +"<div class='full_name'>" + item.nama_kel + "</div><div class='email'>" + item.nama_kota + "</div></div></li>" },
              tokenFormatter: function(item) { return "<li><p>" + item.nama_kel + ":" + item.nama_kota + "</p></li>" },
              tokenLimit : 1,
              preventDuplicates: true,
              prePopulate: populate
          });
 
        });
</script>
<script type="text/javascript">
	$(document).ready(function() {
				var nilai_default= '';
				var populate=<?=get_kk($no);?>;
	    $("#penduduk").tokenInput("<?=site_url('penduduk/cari_id_penduduk')?>", {
              propertyToSearch: "nama_kk",
              resultsFormatter: function(item){ return "<li>" + 
              "<div style='display: inline-block; padding-left: 10px;'>" +
              "<div class='full_name'>" + item.nama_kk + "</div></div></li>" },
              tokenFormatter: function(item) { return "<li><p>" + item.nama_kk + " </p></li>" },
              tokenLimit : 1,
              preventDuplicates: true,
              prePopulate: populate
          });
 
        });
</script>
