<div class='row'>
		<div class=col-md-2></div>
		<div class=col-md-10 style="overflow:auto">
			<table  style='text-align:center;' class='table'>
				<tr>
					<th>KTP</th>
					<th>Nama Lengkap</th>
					<th>Alamat</th>
					<th>Nama Kecamatan</th>
					<th>Nama Kelurahan</th>
					<th>Nama Desa</th>
					<th>RT</th>
					<th>RW</th>
					<th>Nama Pekerjaan</th>
					<th>Status</th>
					
				</tr>
			<?php 
				$no=1;
				foreach ($q as $r){
					$id=$r->ID;
				
					echo"<tr>
						<td>".$r->ktp."</td>
						<td>".$r->nama."</td>
						<td>".$r->alamat."</td>
						<td>".$r->id_kecmatan."</td>
						<td>".$r->id_kelurahan."</td>
						<td>".$r->id_desa."</td>
						<td>".$r->rt."</td>
						<td>".$r->rw."</td>
						<td>".$r->pekerjaan."</td>
						<td>".$r->status_perkawinan."</td>
						<td>".$r->id_kk."</td>
						<td>".anchor('karakteristik/penduduk/'.$id,'insert')."</td>
						<td>".anchor('karakteristik/edit_page/'.$id,'edit')."</td>
						<td>".anchor('karakteristik/delete/'.$id,'delete')."</td>
					</tr>";
					$no++;}
					"</table>"
					?>
	</div>
</div>

