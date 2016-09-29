<div class="container">
	<div class='row'>
			<div class=col-md-2 ><div class='row'><div style="width:100%"><?php menu($menu_ac);?></div></div></div>
				<div  class=col-md-8 >
					<div class='row'>
						<div class=col-md-5>
							<br>
								<div class="panel panel-primary">
								   <div class="panel-heading ">
								   		<div class='row'>
										   	<span class='col-md-8'>Ditail</span>
										   	
								    	</div>
								   	</div>
		  		    				<div class="panel-body">
				
										<table  style='' class='table'>
												
											<?php 
												$no=1;
												foreach ($q as $r){
											//print_r($r);exit;
													 $id_kk=$r->id_kk;
													 $no_kk=$r->no_kk;
													 $nik=!empty($r->nik_ketua)?$r->nik_ketua:'Belum Diset';
													 $ketua=!empty($r->nama_ketua)?anchor('penduduk/detail/'.$nik,$r->nama_ketua):'Belum Diset';
													 $nama_keluarga=$r->nama_keluarga;
													 $calon_kepala[$r->nik_anggota]=$r->nama_anggota;
													$no++;
													$submit=array('type'=>'submit','value'=>'save','class'=>'btn btn-xs btn-primary');
							
												}
												if($no_kk>0){
														echo "<tr>
																<th width='150px'>Nomor KK</th><td>".$no_kk."</td>
															</tr>
															<tr>
																<th>Nama Keluarga</th><td>".$nama_keluarga."</td>
															</tr>
															<tr>
																<th>NIK Kepala</th>		
																<td>".$nik."</td>
															</tr>
															<tr>
																<th>Nama Kepala</th><td>".$ketua."</td>
															</tr>
															<tr>
																<td></td>
																<td>".anchor('penduduk/edit_keluarga/'.$id_kk,'edit','class="btn btn-xs btn-default"')."
																<a onclick='delete_rec(".$no_kk.");'class='btn btn-xs btn-danger'>delete</a>
																
																</td>
															</tr>";
														}
													?>
										</table>
									</div>
								</div>

						</div>
						<script type="text/javascript">
				function delete_rec(id){
					var comp=confirm("yakin hapus??");
					if(comp === true){
					document.location="<?=site_url('penduduk/delete_kk/"+id+"')?>"
					}
				}
			</script>
			<div class=col-md-7>
				<br>
				<div class="panel panel-primary">
				   <div class="panel-heading ">
				   		<div class='row'>
						   	<span class='col-md-8'>Ditail</span>
						   	
				    	</div>
				   	</div>
		    			<div class="panel-body">
	
						<table  style='' class='table'>
							<tr>
								<th width='60px'>#</th>
								<th>KTP</th>
								<th>Nama</th>
								<th></th>
							</tr>
								
							<?php 
								$no=1;
								foreach ($q as $r){
									 $nama_anggota=$r->nama_anggota;
									 $nik_anggota=!empty($r->nik_anggota)?$r->nik_anggota:'Belum Diset';
									
									echo "
										<tr>
											<td>".$no."</td>
											<td>".anchor('penduduk/detail/'.$nik_anggota,$nik_anggota)."</td>
											<td>".$nama_anggota."</td>
										<td>".(($nik_anggota!=$nik)?anchor('penduduk/set_ketua/'.$nik_anggota.'/'.$id_kk,'set_ketua'):'')."</td>
										</tr>
										
										";
									$no++;
								}
									?>
				
						</table>
					</div>
				</div>

			</div>
			<script type="text/javascript">
				function delete_rec(id){
					var comp=confirm("yakin hapus??");
					if(comp === true){
					document.location="<?=site_url('penduduk/delete_kk/"+id+"')?>"
					}
				}
			</script>

					</div>
				</div>
			<div class=col-md-2></div>
	</div>
</div>