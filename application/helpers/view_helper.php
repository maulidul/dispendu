<?php
function head($data=array()){
	echo '
		<!DOCTYPE html>
		<html lang="en">
		 <head>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>'.$data['title'].'</title>
			'.css(array('bootstrap.css','style.css')).'
			
		 </head>
		<div class="container-fluid" style="">	
	';
}
function footer(){
	js(array('jquery.min.js','bootstrap.min.js'));
	echo '
		</div> 
	';//untuk class "container-fluid"
}
function header_template($data=array()){
	//check_login(true); //check jk belum login
	$CI=& get_instance();
	head($data);
	$CI->load->view('header',$data);
}
function footer_template($data=array()){
	$CI=& get_instance();
	$CI->load->view('footer',$data);
	footer();
}

function view($view=array(),$data=array()){
	$CI=& get_instance();
	if(isset($view['body']))$CI->load->view($view['body'],$data);
	if(isset($view['footer']))footer_template($data);
	if(isset($view['header']))header_template($data);
}

function menu_default(){
	$CI=& get_instance();
	$CI->load->view('menu_default');
}

function not_found(){
	echo 'not found';
	exit;
}

// 26 08 15
function get_logo_web(){
	echo img(array(
			'src'=>base_url('assets/images/icon/logo.png'),
			'height'=>'30px'
		)
	);
}

?>