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
					<tr><th >No </th>
						<th >Nama</th>
						<th >no kk</th>
						<th >Alamat</th>
						<th >Rt</th>
						<th >Rw</th>
						<th colspan=3><?php echo anchor('penduduk/form_keluarga','insert','class="btn btn-xs btn-default"');?></th>
						
					</tr>
				<?php 
					$no=($this->uri->segment(3) > 1)?10*($this->uri->segment(3)-1)+1:1;
					foreach ($q as $r){
						$id=$r->ID;
						$no_kk=$r->no_kk;
					
					//print_r($r->Nama_pekerjaan);
						echo '<tr>
							<td>'.$no.'</td>
							<td>'.$r->nama_kk.'</td>
							<td>'.$r->no_kk.'</td>
							<td>'.$r->alamat.'</td>
							<td>'.$r->rt.'</td>
							<td>'.$r->rw.'</td>
							
							<td>
							<div class="btn-group btn-group-xs" role="group" aria-label="...">
								'.anchor('penduduk/detail_kk/'.$id,'detail','class="btn btn-xs btn-default"').'
								'.anchor('penduduk/edit_keluarga/'.$id,'edit','class="btn btn-xs btn-default"').'
								<a onclick="delete_rec(\''.$no_kk.'\');" class="btn btn-xs btn-danger">delete</a>
							</div>
							</td>
						</tr>';
						$no++;
					}
						echo "</table>";
		
						?>
		 	 	 </div>
				</div>
	</div>
	</div>
		<script type="text/javascript">
			function delete_rec(no_kk){
				var comp=confirm("yakin hapus??"+no_kk);
				if(comp === true){
				document.location="<?=site_url('penduduk/delete_kk/"+no_kk+"')?>"
				}
			}
		</script>

</div>   