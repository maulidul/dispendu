<div class="container">
	<div class='row'>
		<div class=col-md-2 >
			<div class='row'>
				<div style="width:100%"><?php menu($menu_ac);?></div>
			</div>
		</div>
		<div class=col-md-8 style="overflow:auto">
			<br>
		  <div class="panel panel-primary">
		   <div class="panel-heading">Daftar Lokasi</div>
  		    <div class="panel-body">
			<table  style='text-align:center;' class='table'>
				<tr>
					<td>no</td>
					<th>kecamatan</th>
					<th> * </th>
				</tr>
				
				<?php 
				$no=1;
				$kel=false; // inisial pertama kali
				foreach ($q as $r){
					$id=$r->id;
					if($r->name != ''){ // jika kecamatan
						if($kel == false){
							echo '<tr>
									<td>'.$no.'</td>
									<td style="text-align:left;cursor:pointer;"><span>'.$r->name.'</span>';
								echo '<div class="list-group collapse" id="collapseExample'.$no.'" style="margin-top:10px">';
								$a=1;
						//}else{
								echo '</div>';
								echo '<td valign="top" style="text-align:right">
								'.anchor("penduduk/edit_data_kelurahan/".$id,'edit','class="btn btn-xs btn-primary" style="margin-right:5px;"').'
								</td>';
							echo '</td>';
								 echo '</tr>';
						}
						$no++;
					}
					
				}
					?>
				<tr>
					<td colspan="3" style="text-align:left"><button class="btn btn-primary" onclick="history.back()"><b> < </b></button></td>
				</tr>
			</table>
			
			<script type="text/javascript">
				
				function delete_rec(id){
					var comp=confirm("yakin hapus??");
					if(comp === true){
					document.location="<?=site_url('penduduk/delete_kelurahan/"+id+"')?>"
					}
				}
			</script>
		   </div>
		 </div>

	   </div>
	</div>

</div>