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
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_6670344b24a556_64468682',
  'has_nocache_code' => false,
  'cache_lifetime' => 0,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6670344b24a556_64468682')) {function content_6670344b24a556_64468682($_smarty_tpl) {?><!doctype html>
<html style="height:100%">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Editor Berkelas Preset</title>
        
	<!-- link href="http://localhost/editorberkelas/templates/back-end/penguin/http://localhost/editorberkelas/templates/back-end/penguin/assets/images/favicon.ico" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="http://localhost/editorberkelas/templates/back-end/penguin/http://localhost/editorberkelas/templates/back-end/penguin/assets/images/favicon.ico" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="http://localhost/editorberkelas/templates/back-end/penguin/http://localhost/editorberkelas/templates/back-end/penguin/assets/images/favicon.ico" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="http://localhost/editorberkelas/templates/back-end/penguin/http://localhost/editorberkelas/templates/back-end/penguin/assets/images/favicon.ico" rel="apple-touch-icon" type="image/png">
	<link href="http://localhost/editorberkelas/templates/back-end/penguin/http://localhost/editorberkelas/templates/back-end/penguin/assets/images/favicon.ico" rel="icon" type="image/png">
	<link href="http://localhost/editorberkelas/templates/back-end/penguin/http://localhost/editorberkelas/templates/back-end/penguin/assets/images/favicon.ico" rel="shortcut icon" -->
	
	<!-- Global stylesheets -->	
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/assets/fonts/fonts.css">
    <link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/assets/icons/icomoon/icomoon.css">    
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/bootstrap.css">   
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/core.css">
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/bootstrap-extended.css">	    		
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/plugins.css">	    		
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/color-system.css">
	<!-- /global stylesheets -->

</head>
<body style="height:100%; background:url('http://localhost/editorberkelas/templates/back-end/penguin/assets/images/assets/login_bg.jpg') no-repeat 0 0; background-size:cover;">
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
<script type="text/javascript" srchttp://localhost/editorberkelas/templates/back-end/penguin/js/jquery.js"></script>	
<script type="text/javascript" srchttp://localhost/editorberkelas/templates/back-end/penguin/js/bootstrap.js"></script>
<script type="text/javascript" srchttp://localhost/editorberkelas/templates/back-end/penguin/js/forms/uniform.min.js"></script>	
<!-- /global scripts -->

<script>
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
</script>
</body>
</html><?php }} ?>
