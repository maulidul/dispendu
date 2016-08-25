<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title><?=$title?></title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="<?php echo base_url('assets/css/styles.css') ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
	</head>
	<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php get_logo_web(); ?><b></b></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <div class="dropdown" style="margin-top:14px;margin-left:20px">
                <div class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  <a class="glyphicon glyphicon-cog"></a>
                  <span class="caret"></span>
                </div>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <?php
                  $arr_menu=array(
                        '/account' => 'Akun Saya', 
                        '/account/change_password' => 'Ganti Password', 
                        '/messages' => 'Pesan', 
                        '/logout' => 'Keluar', 
                      );
                ?>
                <?php
                  foreach($arr_menu as $link=>$label):
                      echo '<li role="presentation">'.anchor($link,$label,'tabindex="-1" role="menuitem"').'</li>';
                    endforeach;
                ?>
                </ul>
              </div>
            </li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
</nav>