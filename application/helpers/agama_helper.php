<?php

function arr_agama($par=1){
	$q=array('1'=>'Islam','2'=>'Kristen','3'=>'Hindu'
				,'4'=>'Budha','5'=>'Katholig');
	if($par==1){return $q;}else{
		return $qq=array('Islam'=>'1','Kristen'=>'2'
						,'Hindu'=>'3','Budha'=>'4',
			'katholik'=>'5');
	}


}
function get_agama($id_agama){
 return array_search($id_agama,arr_agama(2));

}
function form_agama($default=1){
	
	return form_dropdown('agama',arr_agama(),$default,'class="form-control"'); 
}

function get_jenis_kelamin($jk=1){

	if($jk==1){return 'laki_laki';}else{return 'perempuan';
	

}
}
function get_perkawinan($pw=1){
if($pw==1){return 'menikah';}else{return 'belum menikah';}

}

?>