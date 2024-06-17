<?php /* Smarty version Smarty-3.1.21-dev, created on 2021-06-14 12:10:53
         compiled from "..\templates\back-end\penguin\login.html" */ ?>
<?php /*%%SmartyHeaderCode:45143310160b5624630c9f2-17177800%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b239b336afb53a808bdb16ecbfb9ab6520df44a' => 
    array (
      0 => '..\\templates\\back-end\\penguin\\login.html',
      1 => 1623647446,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45143310160b5624630c9f2-17177800',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_60b5624633fb62_62418548',
  'variables' => 
  array (
    'tpl_dir' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_60b5624633fb62_62418548')) {function content_60b5624633fb62_62418548($_smarty_tpl) {?><!doctype html>
<html style="height:100%">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Editor Berkelas Preset</title>
        
	<!-- link href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/favicon.ico" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/favicon.ico" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/favicon.ico" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/favicon.ico" rel="apple-touch-icon" type="image/png">
	<link href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/favicon.ico" rel="icon" type="image/png">
	<link href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/favicon.ico" rel="shortcut icon" -->
	
	<!-- Global stylesheets -->	
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/fonts/fonts.css">
    <link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/icons/icomoon/icomoon.css">    
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/bootstrap.css">   
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/core.css">
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/bootstrap-extended.css">	    		
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/plugins.css">	    		
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/css/color-system.css">
	<!-- /global stylesheets -->

</head>
<body style="height:100%; background:url('<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/assets/login_bg.jpg') no-repeat 0 0; background-size:cover;">
	<div class="login-container material">

		<!-- Page content -->
		<div class="page-content">

			<!-- Simple login form -->
			<form action="login.php" method="post">			
				<div class="login-form no-border no-border-radius" style="box-shadow: 5px 10px 30px rgba(0,0,0,0.3)">							
					<div class="welcome bg-light p-t-20">						
						<div class="welcome-text text-size-huge text-light">
							
						</div>
					</div>
					<div class="panel panel-flat no-border">
						<div class="panel-body no-padding-bottom">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Username" name="username" required="required">							
							</div>

							<div class="form-group">
								<input type="password" class="form-control" placeholder="Password" name="password" required="required">							
							</div>

							<div class="login-options">
								<div class="row">
									<div class="col-sm-6 col-xs-6">
										<div class="checkbox">
											<label>
												<input type="checkbox" class="styled" checked="checked">
												Remember me
											</label>
										</div>
									</div>

									<div class="col-sm-6 col-xs-6 text-right">
										<button type="submit" class="btn bg-blue no-border-radius">Login</button>																		
									</div>
								</div>
							</div>

							<div class="form-group text-center">
								<a href="http://localhost/templates/penguin/material/login_password_recover.html">Forgot password?</a>
							</div>
							
						</div>
						<div class="panel-footer text-center hide">
							<a href="login_material.htm#">Create an account</a>
						</div>
					</div>
				</div>
				
			</form>
			<!-- /simple login form -->


			<!-- Footer -->
			<div class="footer text-size-mini">
				Power By <a href="#" target="_blank">Editor Berkelas Preset</a>&nbsp;2021
			</div>
			<!-- /footer -->

		</div>
		<!-- /page content -->

	</div>

<!-- Global scripts -->
<?php echo '<script'; ?>
 type="text/javascript" src<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/jquery.js"><?php echo '</script'; ?>
>	
<?php echo '<script'; ?>
 type="text/javascript" src<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/bootstrap.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/forms/uniform.min.js"><?php echo '</script'; ?>
>	
<!-- /global scripts -->

<?php echo '<script'; ?>
>
$(function() {
	$(".styled, .multiselect-container input").uniform({
		radioClass: 'choice'
	});
	$('input,textarea').focus(function(){
	   $(this).data('placeholder',$(this).attr('placeholder'))
			  .attr('placeholder','');
	}).blur(function(){
	   $(this).attr('placeholder',$(this).data('placeholder'));
	});
});
<?php echo '</script'; ?>
>
</body>
</html><?php }} ?>
