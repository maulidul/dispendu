<?php

function arr_agama($par=1){
	$q=array('1'=>'islam','2'=>'kristen','3'=>'hindu'
				,'4'=>'budha','5'=>'katholig');
	if($par==1){return $q;}else{
		return $qq=array('islam'=>'1','kristen'=>'2'
						,'hindu'=>'3','budha'=>'4',
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