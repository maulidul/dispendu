
<div class="container">
	<div class='row'>
		<div class=col-md-2 ><div class='row'><div style="width:100%"><?php menu($menu_ac);?></div></div></div>
			<div class=col-md-10 style="overflow:auto">
			<br>
			  <div class="panel panel-primary">
			   <div class="panel-heading ">
			   		<div class='row'>
					   	<span class='col-md-8'>Data kelahiran</span>
					   	
					   	<form class='col-md-4' method='GET' >
		            		<input type="text" class="form-control" id="cari" name="q" value="<?php echo (isset($_GET['q']))?$_GET['q']:''?>">
		          		</form> 
		          	</div>
			   </div>
	  		    <div class="panel-body">
					<table  style='text-align:left;' class='table'>
					<tr>
						<th >No </th>
						<th>Nama</th>
						<th>lokasi</th>
						<th>tanggal</th>
						<th>keterangan</th>
						<th>*</th>
					</tr>
				<?php 
					$no=($this->uri->segment(3) > 1)?10*($this->uri->segment(3)-1)+1:1;
					foreach ($q as $r){
					//print_r($r);
						$nik=$r->NIK;
					
					//print_r($r->Nama_pekerjaan);
						echo '<tr>
							<td>'.$no.'</td>
							<td>'.$r->nama_lengkap.'</td>
							<td>'.$r->kelurahan.'</td>
							<td>'.$r->tanggal_lahir.'</td>
							<td>'.$r->keterangan.'</td>				
							<td>
							<div class="btn-group btn-group-xs" role="group" aria-label="...">
								'.anchor('penduduk/edit_kelahiran/'.$nik,'edit','class="btn btn-xs btn-default"').'
							</div>
							</td>
						</tr>';
						$no++;
					}
						echo '<tr style=text-align:center;>
							<td colspan="9"> <nav><ul class="pagination">'.$pagin.'</ul></nav></td>

						</tr>';
						echo "</table>";
		
						?>
		 	 	 </div>
				</div>
	</div>
	</div>
</div>   



