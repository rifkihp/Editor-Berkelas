<?php /*%%SmartyHeaderCode:155372112160bd9a73152318-81181534%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45d26d4c4aca1e88dd392d085cf81ec14ebe9f0b' => 
    array (
      0 => '..\\..\\templates\\back-end\\penguin\\tabpanel\\edit.html',
      1 => 1623034269,
      2 => 'file',
    ),
    '97b1889bff02f5072bb4a825e91e2b3e248453ad' => 
    array (
      0 => 'D:\\www\\editorberkelas\\templates\\back-end\\penguin\\includes\\head.html',
      1 => 1622500436,
      2 => 'file',
    ),
    'b93fd257547e2848e1fd14597ba82fb51202978f' => 
    array (
      0 => 'D:\\www\\editorberkelas\\templates\\back-end\\penguin\\includes\\sidebar.html',
      1 => 1604991837,
      2 => 'file',
    ),
    '20d25c016dd3bed6cbb0b1ec311d9da67af70eb1' => 
    array (
      0 => 'D:\\www\\editorberkelas\\templates\\back-end\\penguin\\includes\\footer.html',
      1 => 1622500434,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '155372112160bd9a73152318-81181534',
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_60bd9d6cbd1c49_38627095',
  'has_nocache_code' => false,
  'cache_lifetime' => 0,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_60bd9d6cbd1c49_38627095')) {function content_60bd9d6cbd1c49_38627095($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Editor Berkelas Preset</title>
	
	<!-- Global stylesheets -->	
	<link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/assets/fonts/fonts.css">
        <link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/assets/icons/icomoon/icomoon.css">
        <link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/css/animate.min.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/css/bootstrap.css">   
	<link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/css/core.css">	
	<link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/css/layout.css">	
	<link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/css/bootstrap-extended.css">	    
	<link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/css/components.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/css/plugins.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/css/loaders.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/css/responsive.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/css/color-system.css">		
	<link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/css/fancybox/jquery.fancybox.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/assets/sweetalert2/sweetalert2.min.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/assets/bootstrap-fileinput/css/fileinput.min.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/css/burnt_sienna_light.css">	
        <link type="text/css" rel="stylesheet" href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/css/AdminLTE.css" />
	<link type="text/css" rel="stylesheet" href="0" id="theme">
	<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/assets/sweetalert2/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script>
		var base_tpl_url = "http://192.168.1.8/editorberkelas/templates/back-end/penguin/css/themes/";
		var base_url = "http://192.168.1.8/editorberkelas/";
	</script>
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
						<a href="http://192.168.1.8/editorberkelas/adminweb#" class="btn-user dropdown-toggle hidden-xs" data-toggle="dropdown"><img src="http://192.168.1.8/editorberkelas/uploads/umum/default_logo.png" class="img-circle user" alt=""/></a>
						<a href="http://192.168.1.8/editorberkelas/adminweb#" class="dropdown-toggle visible-xs" data-toggle="dropdown"><i class="icon-more"></i></a>
						<div class="dropdown-menu">	
							<div class="text-center"><img src="http://192.168.1.8/editorberkelas/uploads/umum/default_logo.png" class="img-circle img-70" alt=""/></div>
							<h5 class="text-center"><b>Hi! Administrator</b></h5>
							<ul class="more-apps">
								<!-- li><a href="http://192.168.1.8/editorberkelas/templates/back-end/penguin/material/user_profile_social.html"><i class="icon-profile"></i> My profile</a></li -->
								<!-- li><a href="http://192.168.1.8/editorberkelas/adminweb#"><i class="icon-envelop5"></i> Inbox <span class="badge badge-danger pull-right">4</span></a></li -->
								<li><a href="http://192.168.1.8/editorberkelas/adminweb/editprofile/"><i class="icon-profile"></i> My Profile</a></li>
								<li><a href="http://192.168.1.8/editorberkelas/adminweb/gantipassword/"><i class="icon-lock5"></i> Ganti Password</a></li>
							</ul>
							<div class="text-center"><a href="http://192.168.1.8/editorberkelas/adminweb/logout.php" class="btn btn-sm btn-info"><i class="icon-exit3 i-16 position-left"></i> Logout</a></div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</header>

	
<!--sidebar-->
	<aside class="sidebar">
            <div class="left-aside-container">
                <div class="user-profile-container">
                    <div class="user-profile clearfix">
                        <div class="admin-user-thumb">
                            <img src="http://192.168.1.8/editorberkelas/uploads/umum/default_logo.png" alt="admin" class="img-circle">
                        </div>
                        <div class="admin-user-info">
                            <ul class="user-info">
                                <li><a href="http://192.168.1.8/editorberkelas/adminweb/logout.php" class="text-semibold text-size-large">Administrator</a></li>
                                <li><a href="http://192.168.1.8/editorberkelas/adminweb/logout.php"><small>Content Management</small></a></li>
                            </ul>
                            <div class="logout-icon"><a href="http://192.168.1.8/editorberkelas/adminweb/logout.php"><i class="icon-exit2"></i></a></div>
                        </div>
                    </div>				
                </div>
                
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active fadeIn" id="menu">
                        <ul class="sidebar-accordion">
                            <li><br />&nbsp;&nbsp;&nbsp;</li>
                            
                                <li class="active acc-parent-li">

                                    <a class="acc-parent active" href="#"><i class="icon-bookmark"></i> Konten <span class="fa arrow"></span></a>

                                    
                                        <ul>

                                        
                                            <li>

                                                <a href="http://192.168.1.8/editorberkelas/adminweb/banner/"><i class="fa fa-folder"></i> Banner</a>

                                            </li>

                                        
                                            <li>

                                                <a href="http://192.168.1.8/editorberkelas/adminweb/tabpanel/"><i class="fa fa-folder"></i> Tab Menu</a>

                                            </li>

                                        
                                            <li>

                                                <a href="http://192.168.1.8/editorberkelas/adminweb/category/"><i class="fa fa-folder"></i> Kategori</a>

                                            </li>

                                        
                                            <li>

                                                <a href="http://192.168.1.8/editorberkelas/adminweb/konten/"><i class="fa fa-folder"></i> Konten</a>

                                            </li>

                                        
                                        </ul>

                                    
                                </li>

                            
                                <li>

                                    <a class="acc-parent active" href="#"><i class="icon-cog3"></i> Pengaturan <span class="fa arrow"></span></a>

                                    
                                        <ul>

                                        
                                            <li>

                                                <a href="http://192.168.1.8/editorberkelas/adminweb/pengaturan/"><i class="fa fa-edit"></i> Umum</a>

                                            </li>

                                        
                                        </ul>

                                    
                                </li>

                            						
                        </ul>
                    </div>
                </div>          
            </div>
	</aside>

<!--/sidebar-->

<!--Page Container-->
<section class="main-container">	
    
    <!--Page Header-->
    <div class="header">
        <div class="header-content">
            <div class="page-title">
                <i class="icon-table position-left"></i> Tab Menu
            </div>
            <ul class="breadcrumb">
                <li><a href="http://192.168.1.8/editorberkelas/adminweb">Beranda</a></li>
                <li><a href="http://192.168.1.8/editorberkelas/adminweb/tabpanel/">Tab Menu</a></li>
                <li class="active">Edit Tab Menu</li>
            </ul>					
        </div>
    </div>		
    <!--/Page Header-->
			
    <div class="container-fluid page-content">				
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-flat">
                    
                    <div class="form-group panel-body no-padding-bottom">
                        <div id="alert_error" class="form-group" style="display: none;">
                            <div class="alert alert-danger">&nbsp;</div>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Tab Menu:</label>
                            <input type="text" value="TV SHOW" class="form-control" name="nama" placeholder="" />
                        </div>

                        <div class="form-group">
                            <label for="is_aktif">Tampilkan:</label>
                            <select name="is_aktif" class="form-control">
                                <option value="0" >TIDAK</option>
                                <option value="1"  selected="selected" >YA</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <table>
                                <tbody>
                                    <tr>
                                        <td width="100%">&nbsp;</td> 
                                        <td nowrap>
                                            <div id="i_loading" class="G-btn-animation" style="display: none;"><img src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/assets/img/loading.gif" /></div>                  
                                            <div id="btn_simpan" type="submit" class="btn btn-primary">Simpan</div>
                                            <a id="btn_batal"  href="list.php" class="btn btn-warning">Batal</a>                                                        
                                        </td>
                                    </tr>
                                </tbody>                                
                            </table>
                        </div>
                    </div>				
                    
		</div>				
            </div>
        </div>
    </div>
	
    <!--Footer -->
    		<footer class="footer-container">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="footer-left">
							Powered By <a href="#" target="_blank">Editor Berkelas Preset</a>&nbsp;2021
						</span>
						</div>
					</div>				
				</div>
			</div>
		</footer>

    <!--/Footer-->			
				
</section>
<!--/Page Container-->

<a id="scrollTop" href="index1.htm#top"><i class="icon-arrow-up12"></i></a>	

<!-- Global scripts -->
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/jquery.js"></script>	
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/bootstrap.js"></script>
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/jquery.ui.js"></script>
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/nav.accordion.js"></script>	
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/hammerjs.js"></script>
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/jquery.hammer.js"></script>
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/scrollup.js"></script>	
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/jquery.slimscroll.js"></script>	
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/smart-resize.js"></script>
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/blockui.min.js"></script>		
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/wow.min.js"></script>					
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/fancybox.min.js"></script>
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/venobox.js"></script>
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/forms/uniform.min.js"></script>
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/forms/switchery.js"></script>
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/forms/select2.min.js"></script>	
<script src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/core.js"></script>
<!-- /global scripts -->

<!-- Page scripts -->
<script type="text/javascript" src="http://192.168.1.8/editorberkelas/templates/back-end/penguin/js/jquery.cropit.js"></script>  

<script type="text/javascript">
    $(function () {
        var isEdit = true;

        function setErrorMessage(message) {

            $('#alert_error .alert').text(message);
            $('#alert_error').show('slow');
            setTimeout(function() {
                $('#alert_error').hide('slow');
            }, 5000);

            $("body, html").animate({ 
                scrollTop: $('#wrapper').offset().top 
            }, 600);
        }

        $('#btn_simpan').click(function() {

            var data = new FormData();
            data.append('id', isEdit?'1':'');
            data.append('nama', $('[name=nama]').val());
            data.append('is_aktif', $('[name=is_aktif]').val());

            setLoading(true);
            $.ajax({
                type: 'POST',
                url: isEdit?'update.php':'save.php',
                data: data,
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function(data) {
                    if(data['success']) {
                        swal({
                          title: 'Sukses!',
                          text: 'Data Berhasil Disimpan',
                          type:'success',
                          timer: 3000
                        }).then(
                          function () {},
                          // handling the promise rejection
                          function (dismiss) {
                                if (dismiss === 'timer') {
                                  console.log('I was closed by the timer')
                                }
                          }
                        );							
                        window.location = 'list.php';                    

                    } else {
                        setLoading(false);
                        setErrorMessage(data['message']);                        
                    }
                }, 

                error: function() {
                    setLoading(false);
                    setErrorMessage('Kesalahan server. Mohon diulang kembali!');
                }
            }); 
        });

        function setLoading(isLoading) {
            if(isLoading) {
                $('#i_loading').show();
                $('#btn_simpan').hide();
                $('#btn_batal').hide();
            } else {
                $('#i_loading').hide();
                $('#btn_simpan').show(); 
                $('#btn_batal').show();                    
            }
        }

    });
</script>
</body>
</html><?php }} ?>
