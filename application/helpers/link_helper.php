<?php
function getcontroller($controller_id=''){
	$arr_controll=array(
		'apps'=>'a1',
		'auth'=>'a2',
		'cpanel'=>'c1',
		'pages'=>'p1',
		'product'=>'p2',
		'data_penduduk'=>'k1'

	);
	return array_search($controller_id, $arr_controll);
}

function version($version_id=1){
	$arr_version=array(
			'penduduk'=>1,
			'v2'=>2, //belum dipakai
		);
	return array_search($version_id, $arr_version);
}

//function get_link($version_id='',$controller_id=''){
//	$folder=version($version_id);
//	$controller=getcontroller($controller_id);
//	return $folder.'/'.$controller;
//}

function gethelper($helper_id=''){
	$arr_helper=array(
			'emailtemplate'=>'e1',
			'functions'=>'f1',
			'link'=>'l1',
			'loader'=>'l2',
			'log'=>'l3',
			'user'=>'u1',
			'utilities'=>'u2',
			'view'=>'v1',
		);
	return array_search($helper_id, $arr_helper);
}

?>