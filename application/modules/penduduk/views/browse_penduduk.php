<div class="container">
	<div class='row'>
		<div class=col-md-2 ><div class='row'><div style="width:100%"><?php menu($menu_ac);?></div></div></div>
			<div class=col-md-10 style="overflow:auto">
			<br>
			  <div class="panel panel-primary">
			   <div class="panel-heading ">
			   		<div class='row'>
					   	<span class='col-md-8'>Data penduduk</span>
					   	
					   	<form class='col-md-4' method='GET' >
		            		<input type="text" class="form-control" id="cari" name="q" value="<?php echo (isset($_GET['q']))?$_GET['q']:''?>">
		          		</form> 
		          	</div>
			   </div>
	  		    <div class="panel-body">
					<table  style='text-align:center;' class='table'>
					<tr>
						<th>No</th>
						<th>#</th>
						<th>KTP</th>
						<th>NO KK</th>
						<th>Nama</th>
						<th>Agama</th>
						<th colspan=3><?php echo anchor('penduduk/new_penduduk','Insert','class="btn btn-xs btn-default"');?></th>
						
					</tr>
				<?php 
					$no=($this->uri->segment(3) > 1)?10*($this->uri->segment(3)-1)+1:1;
					foreach ($q as $r){
						$id=$r->NIK;
						$ktp=$r->KTP;				//print_r($r);	//print_r($r->Nama_pekerjaan);
						echo '<tr style="text-align:left">
							<td>'.$no.'</td>
							<td>'.img(base_url('uploads/foto/'.$r->foto),'class="img-rounded" style="width:40px"').'</td>
							<td>'.$r->KTP.'</td>
							<td>'.$r->no_kk.'</td>
							<td>'.$r->nama_lengkap.'</td>
							<td>'.get_agama($r->id_agama).'</td>
							<td>
							<div class="btn-group btn-group-xs" role="group" aria-label="...">
								'.anchor('penduduk/detail/'.$ktp,'Detail',' class="btn btn-xs btn-default"').'
								'.anchor('penduduk/edit_penduduk/'.$id,'Edit',' class="btn btn-xs btn-default"').'
								<a onclick="delete_rec('.$id.');" class="btn btn-xs btn-danger">Delete</a>
							</div>
							</td>
						</tr>';
						$no++;
					}
					echo '<tr>
							<td colspan="9"> <nav><ul class="pagination">'.$pagin.'</ul></nav></td>

						</tr>';
						echo "</table>";
		
						?>
		 	 	 </div>
				</div>
		</div>
	</div>

</div>   
		<script type="text/javascript">
			function delete_rec(id){
				var comp=confirm("yakin hapus??");
				if(comp === true){
					document.location="<?=site_url('penduduk/delete/"+id+"')?>";
				}
			}
		</script>