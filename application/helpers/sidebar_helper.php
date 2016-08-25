<?php


function menu($seg){
	//echo $seg;
	echo '
	<div class="list-group"><br>';
	$array=array(
				array('title'=>'Dashboard','link' =>site_url('/penduduk/dashboard')),
				array('title'=>'Data Penduduk','link' =>site_url('/penduduk/data_penduduk')),
				array('title'=>'Data Kelahiran','link' =>site_url('/penduduk/data_kelahiran')),
				array('title'=>'Data Kematian','link' =>site_url('/penduduk/data_kematian')),
				array('title'=>'Data perpindahan','link' =>site_url('/penduduk/data_perpindahan')),
				array('title'=>'Data Lokasi','link' =>site_url('/penduduk/daftar_lokasi')),
				array('title'=>'Kartu Keluarga','link' =>site_url('/penduduk/data_keluarga'))
			);
	$n=1;
	foreach($array as $a){
		$act=($seg==$n)?'active':'';
		
		echo'  <a href='.$a["link"].' class="list-group-item 
				'.$act.'">'.$a['title'].'</a>';
		$n++;
	}
		echo'</div>';

}


?>