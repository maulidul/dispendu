<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/token-input.css');?>">

<div class="container">
	<div class='row'>
		<div class="col-md-2" ><div class='row'><div style="width:100%"><?php menu($this->uri->segment(2));?></div></div></div>
			<div class="col-md-6" style="">
		<br>
		  	<div class="panel panel-primary">
		   	<div class="panel-heading ">
		   		<div class='row'>
				   	<span class='col-md-8'>form_kematian</span>
		  		</div>
		   	</div>
		    		<div class="panel-body">
				<div class='row '>
				<?php
				
				$action=site_url('penduduk/form_kematian');
				$id_p="";
				$id_l="";
				$klr_val='';
				$nama="";
				$tgl="";
				$ket="";
				$arr=array();
				if (isset($kematian)){
				foreach( $kematian as $row){
					
					$id=$row->ID;
					$id_p=$row->id_penduduk;
					$klr_val=$row->id_kelurahan;
					$id_l=$row ->id_lokasi;
					$tgl=$row->tanggal_kematian;
					$ket=$row->keterangan;
					$nama=isset($row->nama)?$row->nama:'';
					
				}
				$action=site_url("penduduk/update_kematian/".$id);
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
							<td>".form_input("id_lokasi",'','class="form-control" id="kelurahan"')."</td>
						</tr>
						<tr>
							<td><label for='exampleInputEmail1'>tanggal</label></td>
							<td>".form_input("tanggal",$tgl,"class='form-control'")."</td>
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
					
				function get_penduduk($id){
					if($id !==''){
						
						$CI=&get_instance();
						$data=$CI->m->get_default_penduduk($id);
						return ($data !== false)?$data:'';
					}
					return '[]';

				}
						
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
<?=get_penduduk($id_p);?>
</div>
<script type="text/javascript" src="<?=base_url('assets/js')?>/jquery.tokeninput.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    $("#nama").tokenInput("<?=site_url('penduduk/cari_id_penduduk')?>", {
              propertyToSearch: "nama",
              resultsFormatter: function(item){ return "<li>" + "<div style='display: inline-block; padding-left: 10px;'>"+
																"<div class='full_name'>"+ item.nama +"(" + item.no_kk + ")</div></div></li>" },
              tokenFormatter: function(item) { return "<li><p>" + '( '+ item.no_kk + ' ): ' + item.nama + " </p></li>" },
              tokenLimit : 1,
              preventDuplicates: true,
              prePopulate: <?=get_penduduk($id_p);?>

          });
        });
</script>
<script type="text/javascript">
	$(document).ready(function() {
		var nilai_default= '';
		var populate=[<?=get_lokasi($klr_val);?>];
	//	console.log(nilai_default);
	    $("#kelurahan").tokenInput("<?=site_url('penduduk/cari_kelurahan')?>", {
              propertyToSearch: "nama_kel",
              resultsFormatter: function(item){ return "<li>" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name'>" + item.nama_kel + "</div><div class='email'>" + item.nama_kota + "</div></div></li>" },
              tokenFormatter: function(item) { return "<li><p>" + item.nama_kel + ":" + item.nama_kota + "</p></li>" },
              tokenLimit : 1,
              preventDuplicates: true,
              prePopulate: populate
          });
        });
</script>