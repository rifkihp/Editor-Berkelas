<?php /* Smarty version Smarty-3.1.21-dev, created on 2020-11-10 14:00:24
         compiled from "D:\www\wtvindonesia\templates\back-end\penguin\includes\head.html" */ ?>
<?php /*%%SmartyHeaderCode:9337189015fa998b81229e7-78504239%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ca2b7ddeb53d7359c7ec675a737de858cca8524' => 
    array (
      0 => 'D:\\www\\wtvindonesia\\templates\\back-end\\penguin\\includes\\head.html',
      1 => 1604991623,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9337189015fa998b81229e7-78504239',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5fa998b81bce11_63391025',
  'variables' => 
  array (
    'tpl_dir' => 0,
    'homeurl' => 0,
    'adminweburl' => 0,
    'data_user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa998b81bce11_63391025')) {function content_5fa998b81bce11_63391025($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>WTV Indonesia</title>
	
	<!-- Global stylesheets -->	
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/fonts/fonts.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/icons/icomoon/icomoon.css">
        <link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/animate.min.css">
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/bootstrap.css">   
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/core.css">	
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/layout.css">	
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/bootstrap-extended.css">	    
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/components.css">
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/plugins.css">
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/loaders.css">
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/responsive.css">
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/color-system.css">		
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/fancybox/jquery.fancybox.css">
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/sweetalert2/sweetalert2.min.css">
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/bootstrap-fileinput/css/fileinput.min.css">
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/burnt_sienna_light.css">	
        <link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/AdminLTE.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo $_SESSION['tpl']-'theme';?>
" id="theme">
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/sweetalert2/sweetalert2.min.js"><?php echo '</script'; ?>
>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php echo '<script'; ?>
>
		var base_tpl_url = "<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/themes/";
		var base_url = "<?php echo $_smarty_tpl->tpl_vars['homeurl']->value;?>
/";
	<?php echo '</script'; ?>
>
	<style>
		.main-nav .navbar-left {
			background-color: rgb(255, 255, 255) !important;
			height: 50px;
			padding: 0 15px;
			width: 250px !important;
		}		
	</style>
	<!-- /global stylesheets -->
</head>
<body class="material-menu" id="top">
	<div id="preloader">
		<div id="status">
			<div class="loader">
				<div class="loader-inner ball-pulse">
				  <div class="bg-blue"></div>
				  <div class="bg-amber"></div>
				  <div class="bg-success"></div>
				</div>
			</div>
		</div>
	</div>
	
	<header class="main-nav clearfix">	
		<div class="top-search-bar">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="search-input-addon">
							<span class="addon-icon"><i class="icon-search4"></i></span>
							<input type="text" class="form-control top-search-input" placeholder="Search">
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="navbar-left pull-left">
			<div class="clearfix">
				<ul class="left-branding pull-left">
					<li><span class="left-toggle-switch"><i class="icon-menu7"></i></span></li>
				</ul>				
			</div>
		</div>
		
		<div class="navbar-right pull-right">
			<div class="clearfix">				
				<ul class="pull-right top-right-icons">
					<li class="dropdown user-dropdown">
						<a href="<?php echo $_smarty_tpl->tpl_vars['adminweburl']->value;?>
#" class="btn-user dropdown-toggle hidden-xs" data-toggle="dropdown"><img src="<?php echo $_smarty_tpl->tpl_vars['homeurl']->value;?>
/uploads/umum/default_logo.png" class="img-circle user" alt=""/></a>
						<a href="<?php echo $_smarty_tpl->tpl_vars['adminweburl']->value;?>
#" class="dropdown-toggle visible-xs" data-toggle="dropdown"><i class="icon-more"></i></a>
						<div class="dropdown-menu">	
							<div class="text-center"><img src="<?php echo $_smarty_tpl->tpl_vars['homeurl']->value;?>
/uploads/umum/default_logo.png" class="img-circle img-70" alt=""/></div>
							<h5 class="text-center"><b>Hi! <?php echo $_smarty_tpl->tpl_vars['data_user']->value['nama'];?>
</b></h5>
							<ul class="more-apps">
								<!-- li><a href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/material/user_profile_social.html"><i class="icon-profile"></i> My profile</a></li -->
								<!-- li><a href="<?php echo $_smarty_tpl->tpl_vars['adminweburl']->value;?>
#"><i class="icon-envelop5"></i> Inbox <span class="badge badge-danger pull-right">4</span></a></li -->
								<li><a href="<?php echo $_smarty_tpl->tpl_vars['adminweburl']->value;?>
/editprofile/"><i class="icon-profile"></i> My Profile</a></li>
								<li><a href="<?php echo $_smarty_tpl->tpl_vars['adminweburl']->value;?>
/gantipassword/"><i class="icon-lock5"></i> Ganti Password</a></li>
							</ul>
							<div class="text-center"><a href="<?php echo $_smarty_tpl->tpl_vars['adminweburl']->value;?>
/logout.php" class="btn btn-sm btn-info"><i class="icon-exit3 i-16 position-left"></i> Logout</a></div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</header>
<?php }} ?>
