<?php /*%%SmartyHeaderCode:194716258760b563d07873d5-39639324%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '39d4f28049d7b5c9151732b0ff34607ef41d26c0' => 
    array (
      0 => '..\\..\\templates\\back-end\\penguin\\pengaturan\\edit.html',
      1 => 1623661191,
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
  'nocache_hash' => '194716258760b563d07873d5-39639324',
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_6670346327f3f5_21685964',
  'has_nocache_code' => false,
  'cache_lifetime' => 0,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6670346327f3f5_21685964')) {function content_6670346327f3f5_21685964($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Editor Berkelas Preset</title>
	
	<!-- Global stylesheets -->	
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/assets/fonts/fonts.css">
        <link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/assets/icons/icomoon/icomoon.css">
        <link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/animate.min.css">
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/bootstrap.css">   
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/core.css">	
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/layout.css">	
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/bootstrap-extended.css">	    
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/components.css">
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/plugins.css">
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/loaders.css">
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/responsive.css">
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/color-system.css">		
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/fancybox/jquery.fancybox.css">
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/assets/sweetalert2/sweetalert2.min.css">
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/assets/bootstrap-fileinput/css/fileinput.min.css">
	<link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/burnt_sienna_light.css">	
        <link type="text/css" rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/css/AdminLTE.css" />
	<link type="text/css" rel="stylesheet" href="0" id="theme">
	<script src="http://localhost/editorberkelas/templates/back-end/penguin/assets/sweetalert2/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script>
		var base_tpl_url = "http://localhost/editorberkelas/templates/back-end/penguin/css/themes/";
		var base_url = "http://localhost/editorberkelas/";
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
						<a href="http://localhost/editorberkelas/adminweb#" class="btn-user dropdown-toggle hidden-xs" data-toggle="dropdown"><img src="http://localhost/editorberkelas/uploads/umum/default_logo.png" class="img-circle user" alt=""/></a>
						<a href="http://localhost/editorberkelas/adminweb#" class="dropdown-toggle visible-xs" data-toggle="dropdown"><i class="icon-more"></i></a>
						<div class="dropdown-menu">	
							<div class="text-center"><img src="http://localhost/editorberkelas/uploads/umum/default_logo.png" class="img-circle img-70" alt=""/></div>
							<h5 class="text-center"><b>Hi! Administrator</b></h5>
							<ul class="more-apps">
								<!-- li><a href="http://localhost/editorberkelas/templates/back-end/penguin/material/user_profile_social.html"><i class="icon-profile"></i> My profile</a></li -->
								<!-- li><a href="http://localhost/editorberkelas/adminweb#"><i class="icon-envelop5"></i> Inbox <span class="badge badge-danger pull-right">4</span></a></li -->
								<li><a href="http://localhost/editorberkelas/adminweb/editprofile/"><i class="icon-profile"></i> My Profile</a></li>
								<li><a href="http://localhost/editorberkelas/adminweb/gantipassword/"><i class="icon-lock5"></i> Ganti Password</a></li>
							</ul>
							<div class="text-center"><a href="http://localhost/editorberkelas/adminweb/logout.php" class="btn btn-sm btn-info"><i class="icon-exit3 i-16 position-left"></i> Logout</a></div>
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
                            <img src="http://localhost/editorberkelas/uploads/umum/default_logo.png" alt="admin" class="img-circle">
                        </div>
                        <div class="admin-user-info">
                            <ul class="user-info">
                                <li><a href="http://localhost/editorberkelas/adminweb/logout.php" class="text-semibold text-size-large">Administrator</a></li>
                                <li><a href="http://localhost/editorberkelas/adminweb/logout.php"><small>Content Management</small></a></li>
                            </ul>
                            <div class="logout-icon"><a href="http://localhost/editorberkelas/adminweb/logout.php"><i class="icon-exit2"></i></a></div>
                        </div>
                    </div>				
                </div>
                
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active fadeIn" id="menu">
                        <ul class="sidebar-accordion">
                            <li><br />&nbsp;&nbsp;&nbsp;</li>
                            
                                <li>

                                    <a class="acc-parent active" href="#"><i class="icon-bookmark"></i> Konten <span class="fa arrow"></span></a>

                                    
                                        <ul>

                                        
                                            <li>

                                                <a href="http://localhost/editorberkelas/adminweb/banner/"><i class="fa fa-folder"></i> Banner</a>

                                            </li>

                                        
                                            <li>

                                                <a href="http://localhost/editorberkelas/adminweb/tabpanel/"><i class="fa fa-folder"></i> Tab Menu</a>

                                            </li>

                                        
                                            <li>

                                                <a href="http://localhost/editorberkelas/adminweb/category/"><i class="fa fa-folder"></i> Kategori</a>

                                            </li>

                                        
                                            <li>

                                                <a href="http://localhost/editorberkelas/adminweb/konten/"><i class="fa fa-folder"></i> Konten</a>

                                            </li>

                                        
                                        </ul>

                                    
                                </li>

                            
                                <li class="active acc-parent-li">

                                    <a class="acc-parent active" href="#"><i class="icon-cog3"></i> Pengaturan <span class="fa arrow"></span></a>

                                    
                                        <ul>

                                        
                                            <li>

                                                <a href="http://localhost/editorberkelas/adminweb/pengaturan/"><i class="fa fa-edit"></i> Umum</a>

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
						<i class="icon-table position-left"></i> Basic tables
					</div>
					<ul class="breadcrumb">
						<li><a href="http://localhost/editorberkelas/adminweb">Beranda</a></li>
						<li><a href="http://localhost/editorberkelas/adminweb/pengaturan/">Umum</a></li>
						<li class="active">Edit Umum</li>
					</ul>					
				</div>
			</div>		
			<!--/Page Header-->
			
			<div class="container-fluid page-content">
				
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h3 class="panel-title"><strong>Umum</strong></h3>				
								<h5 class="panel-title">Edit Umum</h5>			
							</div>

							<div class="panel-body no-padding-bottom">
                    <div class="form-group">

                        <ul id="myTab" class="nav nav-tabs">                                

                            <li class="active">

                                <a href="#umum" data-toggle="tab"><b>Utama</b></a>

                            </li>                                 

                            <!-- li>

                                <a href="#alamat" data-toggle="tab"><b>Alamat</b></a>

                            </li>

                            <li>

                                <a href="#livetv" data-toggle="tab"><b>Live TV</b></a>

                            </li -->

                            <li>

                                <a href="#syaratkondisi" data-toggle="tab"><b>Syarat &amp; Ketentuan</b></a>

                            </li> 

                        </ul>

                    </div>

                    <div id="alert_success" class="form-group" style="display: none;">                         

                        <div class="alert alert-info">&nbsp;</div>

                    </div>


                    <div id="alert_error" class="form-group" style="display: none;">                         

                        <div class="alert alert-danger">&nbsp;</div>

                    </div>

                    

                    <div class="form-group tab-content">

                        <div class="tab-pane fade active in" id="umum">

                            <div class="form-group">&nbsp;</div>

                            <div class="form-group">

                                <label for="judul">Nama Aplikasi:</label>

                                <input type="text" value="Halo Editor Berkelas! ðŸ˜ƒ" class="form-control" name="judul" placeholder="" />

                            </div>



                            <div class="form-group">

                                <label for="tagline">Tag Line:</label>

                                <input type="text" value="Sebelum Menggunakan aplikasi ini, jangan lupa klik Subscribe ya!" class="form-control" name="tagline" placeholder="" />

                            </div>

                            <div class="form-group">

                                <label for="website">Link Youtube:</label>

                                <input type="text" value="https://www.youtube.com/user/HardaPrivate" class="form-control" name="website" placeholder="" />


                            </div>

                            <div class="form-group">

                                <label for="detail">Tentang Website:</label>

                                <div class="summernote"></div>

                            </div>

                            <div class="form-group">

                                <label for="admin">Avatar Admin:</label>                        
                                <style type="text/css">
                                    .preview-avatar {
                                        border:1px solid #a6bac4;
                                        width: 210px;
                                        height: 210px;
                                        cursor: move;
                                    }

                                    .post-img-avatar {
                                        width: 210px;
                                        height: 210px;
                                    }

                                </style>

                                <div class="image-editor-avatar post-img-avatar">
                                    <input id="fileupload_avatar" type="file" name="fileupload_avatar" style="display:none;" class="cropit-image-input" />
                                    <div class="cropit-image-preview preview-avatar"></div>
                                </div>

                                <label>Ukuran 210 X 210 px</label><br />   
                                <div id="upload_avatar" class="btn btn-primary">Upload</div>

                             </div>

                            <div class="form-group">

                                <label for="logo">Logo:</label>                        
                                <style type="text/css">
                                    .preview-logo {
                                        border:1px solid #a6bac4;
                                        width: 320px;
                                        height: 320px;
                                        cursor: move;
                                    }

                                    .post-img-logo {
                                        width: 320px;
                                        height: 320px;
                                    }

                                </style>

                                <div class="image-editor-logo post-img-logo">
                                    <input id="fileupload_logo" type="file" name="fileupload_logo" style="display:none;" class="cropit-image-input" />
                                    <div class="cropit-image-preview preview-logo"></div>
                                </div>

                                <label>Ukuran 320 X 320 px</label><br />   
                                <div id="upload_logo" class="btn btn-primary">Upload</div>

                             </div>

                            <div class="form-group">
                                <label for="bg">Splash Screen Background (untuk android):</label>                        

                                <style type="text/css">
                                    .preview-bg {
                                        border:1px solid #a6bac4;
                                        width: 640px;
                                        height: 1107px;
                                        cursor: move;
                                    }

                                    .post-img-bg {
                                        width: 640px;
                                        height: 1107px;
                                    }
                                </style>

                                <div class="image-editor-bg post-img-bg">
                                    <input id="fileupload_bg" type="file" name="fileupload_bg" style="display:none;" class="cropit-image-input" />
                                    <div class="cropit-image-preview preview-bg"></div>
                                </div>

                                <label>Ukuran 640 X 1107 px</label><br />   
                                <div id="upload_bg" class="btn btn-primary">Upload</div>
                             </div>
                            
                            <div class="form-group">

                                <label for="email">Email:</label>

                                <input type="text" value="editorberkelaspreset@gmail.com" class="form-control" name="email" placeholder="" />

                            </div>

                            <div class="form-group">&nbsp;</div>

                            <div class="form-group">

                                <div id="i_loading_umum" class="G-btn-animation" style="display: none;"><img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/img/loading.gif" /></div>                  

                                <div id="btn_simpan_umum" class="btn btn-primary">Update</div>
                            </div>

                            

                        </div>

                        <div class="tab-pane fade" id="alamat">

                            <div class="form-group">&nbsp;</div>

                            <div class="form-group">

                                <label for="alamat">Alamat:</label>

                                <textarea class="form-control" style="height: 50px;" name="alamat">Komplek TNI AD Jln Kenadi</textarea>

                            </div>

                            
                            <div class="form-group">

                                <label for="propinsi">Propinsi:</label>

                                <select id="propinsi" name="propinsi" class="form-control">

                                    
                                </select>

                            </div>



                            <div class="form-group">

                                <label for="kota">Kota:</label>

                                <select id="kota" name="kota" class="form-control"></select>

                            </div>

                            

                            <div class="form-group">

                                <label for="kode_pos">Kode Pos:</label>

                                <input type="text" value="40254" class="form-control" name="kode_pos" />

                            </div>

                            <div class="form-group">

                                <label for="latitude">Latitude:</label>

                                <input type="text" value="123123" class="form-control" name="latitude" />

                            </div>

                            <div class="form-group">

                                <label for="longitude">Longitude:</label>

                                <input type="text" value="243434" class="form-control" name="longitude" />

                            </div>

                            

                            <div class="form-group">&nbsp;</div>

                            <div class="form-group">

                                <div id="i_loading_alamat" class="G-btn-animation" style="display: none;"><img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/img/loading.gif" /></div>                  

                                <div id="btn_simpan_alamat" class="btn btn-primary">Update</div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="livetv">

                            <div class="form-group">
                                                                    <img src="https://img.youtube.com/vi//maxresdefault.jpg" height="235px" />
                                                            </div>

                            <div class="form-group">

                                <label for="title">Judul:</label>

                                <input type="text" value="" class="form-control" name="title" placeholder="" />

                            </div>

                            <div class="form-group">

                                <label for="videoId">Video ID:</label>

                                <input type="text" value="" class="form-control" name="videoId" placeholder="" />

                            </div>

                            <div class="form-group">

                                <label for="duration">Durasi:</label>

                                <input type="text" value="" class="form-control" name="duration" placeholder="" />

                            </div>
                            

                            <div class="form-group">

                                <label for="is_live">Tampilkan:</label>

                                <select name="is_live" class="form-control">

                                    <option value="0"  selected="selected" >TIDAK</option>
                                    <option value="1" >YA</option>
                                    
                                </select>
                            </div>

                            <div class="form-group">&nbsp;</div>

                            <div class="form-group">

                                <div id="i_loading_livetv" class="G-btn-animation" style="display: none;"><img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/img/loading.gif" /></div>                  

                                <div id="btn_simpan_livetv" class="btn btn-primary">Update</div>
                            </div>

                            

                        </div>

                        <div class="tab-pane fade" id="syaratkondisi">

                            <div class="form-group">

                                <div class="summernote_syaratkondisi"></div>

                            </div>

                            <div class="form-group">&nbsp;</div>

                            <div class="form-group">

                                <div id="i_loading_syaratkondisi" class="G-btn-animation" style="display: none;"><img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/img/loading.gif" /></div>                  

                                <div id="btn_simpan_syaratkondisi" class="btn btn-primary">Update</div>
                            </div>

                        </div>

                    </div>							
						</div>
					</div>
				</div>
	
			<!--Rightbar Chat-->
			<aside class="rightbar">
				<div class="rightbar-container">
					<div class="right-chat-bar">
						<div class="coversation-header">
							<div class="chat-back" data-popup="tooltip" data-placement="left" title="Back">
								<i class="icon-arrow-left12"></i>
							</div>
							<div class="active-conversation">
								<div class="chat-avatar">
									<img src="assets/images/faces/face12.png" alt="user">
								</div>
								<div class="chat-user-status">
									<ul>
										<li class="text-semibold"> John Parker</li>
										<li><small>Online</small></li>
									</ul>
								</div>
							</div>
							<div class="conversation-actions">
								<ul>
									<li><i class="icon-phone-wave" data-popup="tooltip" data-placement="bottom" title="Call"></i></li>
									<li><i class="icon-attachment" data-popup="tooltip" data-placement="bottom" title="Send file"></i></li>
									<li><i class="icon-mic2" data-popup="tooltip" data-placement="bottom" title="Send voice"></i></li>
									<li><i class="icon-user-block" data-popup="tooltip" data-placement="bottom" title="Block"></i></li>					
								</ul>
							</div>
						</div>
						<div class="conversation-container">
							<div class="conversation-row even">
								<ul class="conversation-list">
									<li>
										<p>
											Lorem ipsum dolor sit amet?
										</p>
									</li>							
								</ul>
							</div>
							<div class="conversation-row odd">
								<ul class="conversation-list">
									<li>
										<p>
											Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus
										</p>
									</li>
								</ul>
							</div>
							<div class="conversation-row even">
								<ul class="conversation-list">
									<li>
										<p>
											Maecenas nec odio et ante tincidunt tempus. 
										</p>
									</li>
								</ul>
							</div>
							<div class="conversation-row even">
								<ul class="conversation-list">
									<li>						
										<a href="assets/images/demo/pic7.jpg" class="venobox"><img src="assets/images/demo/pic7.jpg" alt=""/></a>
									</li>
								</ul>
							</div>
							<div class="conversation-row odd">
								<ul class="conversation-list">
									<li>
										<p>
											Donec sodales :)
										</p>
									</li>
								</ul>
							</div>
						</div>
						<div class="chat-text-input">			
							<div class="input-group">
								<input type="text" class="form-control input-xs" placeholder="Type a message...">
								<span class="input-group-btn">
								<button class="btn btn-default" type="button"><i class="icon-enter5"></i></button>
								</span>
							</div>
						</div>
					</div>
					
					<div class="chat-user-toolbar clearfix">
						<div class="chat-user-search pull-left">
							<span class="addon-icon"><i class="icon-search4"></i></span>
							<input type="text" class="form-control" placeholder="Search">
						</div>
						<div class="add-chat-list pull-right">
							<i class="icon-user-plus" data-toggle="tooltip" data-placement="left" title="Add new user"></i>
						</div>
					</div>
					
					<div class="chat-user-container">			
						<ul class="chat-user-list">
							<li>
								<div><span class="chat-avatar"><img src="assets/images/faces/face1.png" alt="Avatar"></span><span class="chat-u-info">Jane Elliott<cite>Li Europan lingues es...</cite></span>
								</div>
								<span class="chat-u-status"><i class="icon icon-circles"></i></span>
							</li>
							<li>
								<div><span class="chat-avatar"><img src="assets/images/faces/face2.png" alt="Avatar"></span><span class="chat-u-info">Florence Douglas<cite>Busy</cite></span>
								</div>
								<span class="chat-u-status"><i class="icon icon-circles"></i></span>
							</li>
							<li class="chat-u-online">
								<div><span class="chat-avatar"><img src="assets/images/faces/face3.png" alt="Avatar"></span><span class="chat-u-info">Jacqueline Howell<cite>Available</cite></span>
								</div>
								<span class="chat-u-status"><i class="icon icon-circles"></i></span>
							</li>
							<li class="chat-u-online">
								<div><span class="chat-avatar"><img src="assets/images/faces/face4.png" alt="Avatar"></span><span class="chat-u-info">Eugine Turner<cite>Occidental in fact...</cite></span>
								</div>
								<span class="chat-u-status"><i class="icon icon-circles"></i></span>
							</li>
							<li class="chat-u-busy">
								<div><span class="chat-avatar"><img src="assets/images/faces/face5.png" alt="Avatar"></span><span class="chat-u-info">Andrew Brewer<cite>Busy</cite></span>
								</div>
								<span class="chat-u-status"><i class="icon icon-circles"></i></span>
							</li>
							<li class="chat-u-away">
								<div><span class="chat-avatar"><img src="assets/images/faces/face6.png" alt="Avatar"></span><span class="chat-u-info">Jonaly Smith<cite>Available</cite></span>
								</div>
								<span class="chat-u-status"><i class="icon icon-circles"></i></span>
							</li>
							<li class="chat-u-online">
								<div><span class="chat-avatar"><img src="assets/images/faces/face7.png" alt="Avatar"></span><span class="chat-u-info">Ann Porter<cite>Available</cite></span>
								</div>
								<span class="chat-u-status"><i class="icon icon-circles"></i></span>
							</li>
							<li class="chat-u-away">
								<div><span class="chat-avatar"><img src="assets/images/faces/face8.png" alt="Avatar"></span><span class="chat-u-info">John Deo<cite>Do not disturb</cite></span>
								</div>
								<span class="chat-u-status"><i class="icon icon-circles"></i></span>
							</li>
							<li>
								<div><span class="chat-avatar"><img src="assets/images/faces/face9.png" alt="Avatar"></span><span class="chat-u-info">Marilyn Romero<cite>On refusa continuar payar...</cite></span>
								</div>
								<span class="chat-u-status"><i class="icon icon-circles"></i></span>
							</li>
							<li>
								<div><span class="chat-avatar"><img src="assets/images/faces/face10.png" alt="Avatar"></span><span class="chat-u-info">Carol Gibson<cite>Gone for a weekend</cite></span>
								</div>
								<span class="chat-u-status"><i class="icon icon-circles"></i></span>
							</li>
							<li>
								<div><span class="chat-avatar"><img src="assets/images/faces/face11.png" alt="Avatar"></span><span class="chat-u-info">Scott Ruiz<cite>At solmen va esser...</cite></span>
								</div>
								<span class="chat-u-status"><i class="icon icon-circles"></i></span>
							</li>
						</ul>						
					</div>		
				</div>
			</aside>
			<!--/Rightbar Chat-->
				
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
	
	<!-- div class="theme-switcher">
		<span class="theme-switcher-icon">
			<i class="icon icon-color-sampler"></i>
		</span>
		
		<div class="themes-container">
			<ul class="switch-theme-colors clearfix">
				<li class="list-title">Light</li>
				<li>
					<div class="theme" id="light">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/light.jpg" alt=""/>
					</div>				
				</li>
				<li class="list-title clearfix">Mirage</li>
				<li>
					<div class="theme pull-left" id="mirage">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/mirage_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="mirage_light">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/mirage_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="mirage_light_sidebar">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/mirage_light_sidebar.jpg" alt=""/>
					</div>				
				</li>										
				<li class="list-title clearfix">Burnt Sienna</li>
				<li>
					<div class="theme pull-left" id="burnt_sienna_dark">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/burnt_sienna_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="burnt_sienna_light">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/burnt_sienna_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="burnt_sienna_light_sidebar">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/burnt_sienna_light_sidebar.jpg" alt=""/>
					</div>				
				</li>		

				<li class="list-title clearfix">Amethyst</li>
				<li>
					<div class="theme pull-left" id="amethyst_dark">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/amethyst_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="amethyst_light">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/amethyst_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="amethyst_light_sidebar">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/amethyst_light_sidebar.jpg" alt=""/>
					</div>				
				</li>		

				<li class="list-title clearfix">Fuchsia Blue</li>
				<li>
					<div class="theme pull-left" id="fuchsiablue_dark">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/fuchsiablue_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="fuchsiablue_light">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/fuchsiablue_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="fuchsiablue_light_sidebar">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/fuchsiablue_light_sidebar.jpg" alt=""/>
					</div>				
				</li>

				<li class="list-title clearfix">Picton Blue</li>
				<li>
					<div class="theme pull-left" id="pictonblue_dark">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/pictonblue_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="pictonblue_light">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/pictonblue_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="pictonblue_light_sidebar">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/pictonblue_light_sidebar.jpg" alt=""/>
					</div>				
				</li>
				
				<li class="list-title clearfix">Jungle Green</li>
				<li>
					<div class="theme pull-left" id="junglegreen_dark">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/junglegreen_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="junglegreen_light">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/junglegreen_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="junglegreen_light_sidebar">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/junglegreen_light_sidebar.jpg" alt=""/>
					</div>				
				</li>
				
				<li class="list-title clearfix">Fern</li>
				<li>
					<div class="theme pull-left" id="fern_dark">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/fern_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="fern_light">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/fern_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="fern_light_sidebar">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/fern_light_sidebar.jpg" alt=""/>
					</div>				
				</li>
				
				<li class="list-title clearfix">Sunglow</li>
				<li>
					<div class="theme pull-left" id="sunglow_dark">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/sunglow_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="sunglow_light">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/sunglow_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="sunglow_light_sidebar">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/sunglow_light_sidebar.jpg" alt=""/>
					</div>				
				</li>
				
				<li class="list-title clearfix">Regent Grey</li>
				<li>
					<div class="theme pull-left" id="regentgrey_dark">

						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/regentgrey_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="regentgrey_light">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/regentgrey_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="regentgrey_light_sidebar">
						<img src="http://localhost/editorberkelas/templates/back-end/penguin/assets/images/themes/regentgrey_light_sidebar.jpg" alt=""/>
					</div>				
				</li>
			</ul>	
		</div>
	</div>

--><a id="scrollTop" href="index1.htm#top"><i class="icon-arrow-up12"></i></a>	

<!-- Global scripts -->
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/jquery.js"></script>	
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/bootstrap.js"></script>
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/jquery.ui.js"></script>
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/nav.accordion.js"></script>	
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/hammerjs.js"></script>
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/jquery.hammer.js"></script>
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/scrollup.js"></script>	
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/jquery.slimscroll.js"></script>	
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/smart-resize.js"></script>
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/blockui.min.js"></script>		
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/wow.min.js"></script>					
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/fancybox.min.js"></script>
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/venobox.js"></script>
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/forms/uniform.min.js"></script>
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/forms/switchery.js"></script>
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/forms/select2.min.js"></script>	
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/core.js"></script>
<!-- /global scripts -->	
    <link rel="stylesheet" href="http://localhost/editorberkelas/templates/back-end/penguin/assets/dist/summernote.css">

    <script type="text/javascript" src="http://localhost/editorberkelas/templates/back-end/penguin/assets/dist/summernote.js"></script>

    <script type="text/javascript" src="http://localhost/editorberkelas/templates/back-end/penguin/assets/dist/summernote-ext-video.js"></script> 

        

    <script type="text/javascript" src="http://localhost/editorberkelas/templates/back-end/penguin/assets/js/jquery.cropit.js"></script>  

    <script src="http://localhost/editorberkelas/templates/back-end/penguin/assets/bootstrap-fileinput/js/fileinput.js"></script>
    <script type="text/javascript" src="http://localhost/editorberkelas/templates/back-end/penguin/assets/js/jquery.input.formatter.js"></script>  


    <script type="text/javascript">        

        $(function () {           

            var isEdit = true;

            $('.image-editor-avatar').cropit({
              smallImage: 'stretch',
              imageState: {
                src: 'http://localhost/editorberkelas/uploads/umum/6874.png',
              }            });
            
            $('.image-editor-logo').cropit({
              smallImage: 'stretch',
              imageState: {
                src: 'http://localhost/editorberkelas/uploads/umum/9316.png',
              }            });

            $('.image-editor-bg').cropit({
              smallImage: 'stretch',
              imageState: {
                src: 'http://localhost/editorberkelas/uploads/umum/9817.png',
              }            });

            
            
            

            $( document ).on( 'click', '.hapus_telepon', function() {

               

                var element = $(this).closest('tr');

                element.remove();

                

            });



            $('#btn_tambah_telepon').click(function() {

                var record = 

                    '<tr>' +

                        '<td style="padding: 5px;" width="100%"><input type="text" value="" name="telepon" class="form-control" placeholder="" /></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><div class="btn btn-danger hapus_telepon">Hapus</div></div></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"></div></td>' +

                    '</tr>';



                $( record ).insertBefore( "#telepon" );

            });

            //-----------------

            
            
            

            $( document ).on( 'click', '.hapus_no_hp', function() {

               

                var element = $(this).closest('tr');

                element.remove();

                

            });



            $('#btn_tambah_no_hp').click(function() {

                var record = 

                    '<tr>' +

                        '<td style="padding: 5px;" width="100%"><input type="text" value="" name="no_hp" class="form-control" placeholder="" /></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><div class="btn btn-danger hapus_no_hp">Hapus</div></div></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"></div></td>' +

                    '</tr>';



                $( record ).insertBefore( "#no_hp" );

            });

            //---------------------

            
            
            

            $( document ).on( 'click', '.hapus_sms', function() {

               

                var element = $(this).closest('tr');

                element.remove();

                

            });



            $('#btn_tambah_sms').click(function() {

                var record = 

                    '<tr>' +

                        '<td style="padding: 5px;" width="100%"><input type="text" value="" name="sms" class="form-control" placeholder="" /></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><div class="btn btn-danger hapus_sms">Hapus</div></div></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"></div></td>' +

                    '</tr>';



                $( record ).insertBefore( "#sms" );

            });

            //------

            

            
            
            

            $( document ).on( 'click', '.hapus_wa', function() {

               

                var element = $(this).closest('tr');

                element.remove();

                

            });



            $('#btn_tambah_wa').click(function() {

                var record = 

                    '<tr>' +

                        '<td style="padding: 5px;" width="100%"><input type="text" value="" name="wa" class="form-control" placeholder="" /></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><div class="btn btn-danger hapus_wa">Hapus</div></div></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"></div></td>' +

                    '</tr>';



                $( record ).insertBefore( "#wa" );

            });

            //-----------------

            
            
            

            $( document ).on( 'click', '.hapus_bbm', function() {

               

                var element = $(this).closest('tr');

                element.remove();

                

            });



            $('#btn_tambah_bbm').click(function() {

                var record = 

                    '<tr>' +

                        '<td style="padding: 5px;" width="100%"><input type="text" value="" name="bbm" class="form-control" placeholder="" /></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><div class="btn btn-danger hapus_bbm">Hapus</div></div></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"></div></td>' +

                    '</tr>';



                $( record ).insertBefore( "#bbm" );

            });

            //---------------------

            
            
            

            $( document ).on( 'click', '.hapus_line', function() {

               

                var element = $(this).closest('tr');

                element.remove();

                

            });



            $('#btn_tambah_line').click(function() {

                var record = 

                    '<tr>' +

                        '<td style="padding: 5px;" width="100%"><input type="text" value="" name="line" class="form-control" placeholder="" /></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><div class="btn btn-danger hapus_line">Hapus</div></div></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"></div></td>' +

                    '</tr>';



                $( record ).insertBefore( "#line" );

            });

            //-----------

            

            $('#propinsi').on('change', function (e) {

                loadKota(this.value, 0);

            });

            

            function loadKota(propinsi, kota) {

                $("#kota").empty();

                //$('<option value="0">-- Pilih Kota --</option>').appendTo('#kota');



                $.ajax({

                    type: 'POST',

                    url: 'http://localhost/editorberkelas/store/getKota.php',

                    data: { 'propinsi': propinsi },

                    dataType: 'json',

                    success: function(data) {

                        var store = data['topics'];

                        var data = ''; //'<option value="0">-- Pilih Kota --</option>';

                        for(var key in store) {

                            data+='<option value="'+store[key]['city_id']+'"'+(store[key]['city_id']==kota?' selected="selected"':'')+'>'+store[key]['city_name']+'</option>';

                        }

                        $("#kota").empty();

                        $(data).appendTo('#kota');

                    }

                });    

            }

            

            loadKota('6', '151');
            $("input.harga").formatInput();    

            $('.summernote').summernote({

                height: 170,

                toolbar: [

                    ['style', ['style']],

                    ['font', ['bold', 'italic', 'underline', 'clear']],

                    //['fontname', ['fontname']],

                    // ['fontsize', ['fontsize']], Still buggy

                    ['color', ['color']],

                    ['para', ['ul', 'ol', 'paragraph']],

                    // ['height', ['height']],

                    ['table', ['table']],

                    ['insert', ['link', 'picture', 'video']],

                    //['view', ['fullscreen' , 'codeview' ]],

                    ['help', ['help']]

                ]

            });



            $(".summernote").code('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&nbsp;');

            

            $('.summernote_syaratkondisi').summernote({

                height: 170,

                toolbar: [

                    ['style', ['style']],

                    ['font', ['bold', 'italic', 'underline', 'clear']],

                    //['fontname', ['fontname']],

                    // ['fontsize', ['fontsize']], Still buggy

                    ['color', ['color']],

                    ['para', ['ul', 'ol', 'paragraph']],

                    // ['height', ['height']],

                    ['table', ['table']],

                    ['insert', ['link', 'picture', 'video']],

                    //['view', ['fullscreen' , 'codeview' ]],

                    ['help', ['help']]

                ]

            });



            $(".summernote_syaratkondisi").code('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');

            function setMessage(type, message) {

                $('#alert_'+type+' .alert').text(message);

                $('#alert_'+type).show('slow');

                setTimeout(function() {

                    $('#alert_'+type).hide('slow');

                }, 5000);

                $("body, html").animate({ 

//                    scrollTop: $('#wrapper').offset().top 

                }, 600);

            }

            

            $('#btn_simpan_syaratkondisi').click(function() {            

                var data = new FormData();

                data.append('syarat_kondisi', $('.summernote_syaratkondisi').summernote().code().replace(/\n/, '<br />'));

                

                setLoading(true, 'syaratkondisi');

                $.ajax({

                    type: 'POST',

                    url: 'updateSyaratkondisi.php',

                    data: data,

                    cache: false,

                    dataType: 'json',

                    processData: false, // Don't process the files

                    contentType: false, // Set content type to false as jQuery will tell the server its a query string request

                    success: function(data) {

                        setLoading(false, 'syaratkondisi');

                        if(data['success']) {

                            setMessage('success', data['message']);  

                        } else {

                            setMessage('error', data['message']);                        

                        }

                    }, 

                    error: function() {

                        setLoading(false, 'syaratkondisi');

                        setMessage('error', 'Kesalahan server. Mohon diulang kembali!');

                    }

                }); 

            });

            

            $('#btn_simpan_livetv').click(function() {            

                var data = new FormData();

                data.append('title', $('[name=title]').val());

                data.append('videoId', $('[name=videoId]').val());

                data.append('is_live', $('[name=is_live]').val());     

                data.append('is_aktif', $('[name=is_live]').val());     

                data.append('duration', $('[name=duration]').val());

                setLoading(true, 'livetv');

                $.ajax({

                    type: 'POST',

                    url: 'updateLivetv.php',

                    data: data,

                    cache: false,

                    dataType: 'json',

                    processData: false, // Don't process the files

                    contentType: false, // Set content type to false as jQuery will tell the server its a query string request

                    success: function(data) {

                        setLoading(false, 'livetv');

                        if(data['success']) {

                            setMessage('success', data['message']);  

                        } else {

                            setMessage('error', data['message']);                        

                        }

                    }, 

                    error: function() {

                        setLoading(false, 'livetv');

                        setMessage('error', 'Kesalahan server. Mohon diulang kembali!');

                    }

                }); 
            });
            
           
            function setNamaPropinsiChange() {

                $('.nama_propinsi').on('change', function (e) {
                    
                    var element = $(this).closest('tr');
                    var kolom_kota = element.find('[name=kota]');

                    loadKotaTujuan(this.value, kolom_kota);

                });
            }

            

            function loadKotaTujuan(propinsi, kolom_kota) {

                kolom_kota.empty();

                $.ajax({

                    type: 'POST',

                    url: 'http://localhost/editorberkelas/store/getKota.php',

                    data: { 'propinsi': propinsi },

                    dataType: 'json',

                    success: function(data) {

                        var store = data['topics'];

                        kolom_kota.empty();
                        for(var key in store) {
                            kolom_kota.append($('<option>', {
                                value: store[key]['city_id'],
                                text: store[key]['city_name']
                            }));
                        }                        
                    }
                });
            }


            

            

            $('#btn_simpan_alamat').click(function() {            

                var data = new FormData();

                data.append('address', $('[name=alamat]').val());

                data.append('propinsi', $('[name=propinsi]').val());

                data.append('nama_propinsi', $("#propinsi option[value='"+$('[name=propinsi]').val()+"']").text());

                data.append('kota', $('[name=kota]').val());

                data.append('nama_kota', $("#kota option[value='"+$('[name=kota]').val()+"']").text());

                data.append('kode_pos', $('[name=kode_pos]').val());                

                data.append('latitude', $('[name=latitude]').val());                

                data.append('longitude', $('[name=longitude]').val());

                

                setLoading(true, 'alamat');

                $.ajax({

                    type: 'POST',

                    url: 'updateAlamat.php',

                    data: data,

                    cache: false,

                    dataType: 'json',

                    processData: false, // Don't process the files

                    contentType: false, // Set content type to false as jQuery will tell the server its a query string request

                    success: function(data) {

                        setLoading(false, 'alamat');

                        if(data['success']) {

                            setMessage('success', data['message']);  

                        } else {

                            setMessage('error', data['message']);                        

                        }

                    }, 

                    error: function() {

                        setLoading(false, 'alamat');

                        setMessage('error', 'Kesalahan server. Mohon diulang kembali!');

                    }

                }); 

            });



            $('#btn_simpan_umum').click(function() {            

                var data = new FormData();

                data.append('judul', $('[name=judul]').val());

                data.append('website', $('[name=website]').val());

                data.append('tagline', $('[name=tagline]').val());

                data.append('detail', $('.summernote').summernote().code().replace(/\n/, '<br />'));

                var imageDataAvatar = $('.image-editor-avatar').cropit('export');

                data.append('filename_avatar', imageDataAvatar==undefined?'':imageDataAvatar);

                var imageDataLogo = $('.image-editor-logo').cropit('export');

                data.append('filename_logo', imageDataLogo==undefined?'':imageDataLogo);

                var imageDataBg = $('.image-editor-bg').cropit('export');

                data.append('filename_bg', imageDataBg==undefined?'':imageDataBg);

                data.append('email', $('[name=email]').val());                

                setLoading(true, 'umum');

                $.ajax({

                    type: 'POST',

                    url: 'updateUmum.php',

                    data: data,

                    cache: false,

                    dataType: 'json',

                    processData: false, // Don't process the files

                    contentType: false, // Set content type to false as jQuery will tell the server its a query string request

                    success: function(data) {

                        setLoading(false, 'umum');

                        if(data['success']) {

                            setMessage('success', data['message']);  

                        } else {

                            setMessage('error', data['message']);                        

                        }

                    }, 

                    error: function() {

                        setLoading(false, 'umum');

                        setMessage('error', 'Kesalahan server. Mohon diulang kembali!');

                    }

                }); 

            });

            function setLoading(isLoading, tab) {

                if(isLoading) {

                    $('#i_loading_'+tab).show();

                    $('#btn_simpan_'+tab).hide();

                } else {

                    $('#i_loading_'+tab).hide();

                    $('#btn_simpan_'+tab).show();                    

                }

            }

            $('#upload_avatar').click(function(){

                $('#fileupload_avatar').trigger('click'); 

                return false;

            });



            $('#upload_logo').click(function(){

                $('#fileupload_logo').trigger('click'); 

                return false;

            });


            $('#upload_bg').click(function() {

                $('#fileupload_bg').trigger('click'); 

                return false;

            });
            

                    

             

        });

    </script>
</body>
</html><?php }} ?>
