<?php /*%%SmartyHeaderCode:110554854260bd50382e3fa5-86537198%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5921ddab4ee8e10fd9425cc183b88a0c1f9e560' => 
    array (
      0 => '..\\..\\templates\\back-end\\penguin\\konten\\edit.html',
      1 => 1623647367,
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
  'nocache_hash' => '110554854260bd50382e3fa5-86537198',
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_6366ccaf338679_56042694',
  'has_nocache_code' => false,
  'cache_lifetime' => 0,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6366ccaf338679_56042694')) {function content_6366ccaf338679_56042694($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Editor Berkelas Preset</title>
	
	<!-- Global stylesheets -->	
	<link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/fonts/fonts.css">
        <link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/icons/icomoon/icomoon.css">
        <link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/css/animate.min.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/css/bootstrap.css">   
	<link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/css/core.css">	
	<link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/css/layout.css">	
	<link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/css/bootstrap-extended.css">	    
	<link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/css/components.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/css/plugins.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/css/loaders.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/css/responsive.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/css/color-system.css">		
	<link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/css/fancybox/jquery.fancybox.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/sweetalert2/sweetalert2.min.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/bootstrap-fileinput/css/fileinput.min.css">
	<link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/css/burnt_sienna_light.css">	
        <link type="text/css" rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/css/AdminLTE.css" />
	<link type="text/css" rel="stylesheet" href="0" id="theme">
	<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/sweetalert2/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script>
		var base_tpl_url = "http://192.168.1.9/editorberkelas/templates/back-end/penguin/css/themes/";
		var base_url = "http://192.168.1.9/editorberkelas/";
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
						<a href="http://192.168.1.9/editorberkelas/adminweb#" class="btn-user dropdown-toggle hidden-xs" data-toggle="dropdown"><img src="http://192.168.1.9/editorberkelas/uploads/umum/default_logo.png" class="img-circle user" alt=""/></a>
						<a href="http://192.168.1.9/editorberkelas/adminweb#" class="dropdown-toggle visible-xs" data-toggle="dropdown"><i class="icon-more"></i></a>
						<div class="dropdown-menu">	
							<div class="text-center"><img src="http://192.168.1.9/editorberkelas/uploads/umum/default_logo.png" class="img-circle img-70" alt=""/></div>
							<h5 class="text-center"><b>Hi! Administrator</b></h5>
							<ul class="more-apps">
								<!-- li><a href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/material/user_profile_social.html"><i class="icon-profile"></i> My profile</a></li -->
								<!-- li><a href="http://192.168.1.9/editorberkelas/adminweb#"><i class="icon-envelop5"></i> Inbox <span class="badge badge-danger pull-right">4</span></a></li -->
								<li><a href="http://192.168.1.9/editorberkelas/adminweb/editprofile/"><i class="icon-profile"></i> My Profile</a></li>
								<li><a href="http://192.168.1.9/editorberkelas/adminweb/gantipassword/"><i class="icon-lock5"></i> Ganti Password</a></li>
							</ul>
							<div class="text-center"><a href="http://192.168.1.9/editorberkelas/adminweb/logout.php" class="btn btn-sm btn-info"><i class="icon-exit3 i-16 position-left"></i> Logout</a></div>
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
                            <img src="http://192.168.1.9/editorberkelas/uploads/umum/default_logo.png" alt="admin" class="img-circle">
                        </div>
                        <div class="admin-user-info">
                            <ul class="user-info">
                                <li><a href="http://192.168.1.9/editorberkelas/adminweb/logout.php" class="text-semibold text-size-large">Administrator</a></li>
                                <li><a href="http://192.168.1.9/editorberkelas/adminweb/logout.php"><small>Content Management</small></a></li>
                            </ul>
                            <div class="logout-icon"><a href="http://192.168.1.9/editorberkelas/adminweb/logout.php"><i class="icon-exit2"></i></a></div>
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

                                                <a href="http://192.168.1.9/editorberkelas/adminweb/banner/"><i class="fa fa-folder"></i> Banner</a>

                                            </li>

                                        
                                            <li>

                                                <a href="http://192.168.1.9/editorberkelas/adminweb/tabpanel/"><i class="fa fa-folder"></i> Tab Menu</a>

                                            </li>

                                        
                                            <li>

                                                <a href="http://192.168.1.9/editorberkelas/adminweb/category/"><i class="fa fa-folder"></i> Kategori</a>

                                            </li>

                                        
                                            <li>

                                                <a href="http://192.168.1.9/editorberkelas/adminweb/konten/"><i class="fa fa-folder"></i> Konten</a>

                                            </li>

                                        
                                        </ul>

                                    
                                </li>

                            
                                <li>

                                    <a class="acc-parent active" href="#"><i class="icon-cog3"></i> Pengaturan <span class="fa arrow"></span></a>

                                    
                                        <ul>

                                        
                                            <li>

                                                <a href="http://192.168.1.9/editorberkelas/adminweb/pengaturan/"><i class="fa fa-edit"></i> Umum</a>

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
                <i class="icon-table position-left"></i> Konten
            </div>
            <ul class="breadcrumb">
                <li><a href="http://192.168.1.9/editorberkelas/adminweb">Beranda</a></li>
                <li><a href="http://192.168.1.9/editorberkelas/adminweb/dashboard/">Konten</a></li>
                <li class="active">Edit Konten</li>
            </ul>					
        </div>
    </div>		
    <!--/Page Header-->

    <div class="container-fluid page-content">				
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Konten</strong></h3>				
                        <h5 class="panel-title">Edit Konten</h5>				
                    </div>

                    <div class="panel-body">
                        <div id="wrapper" class="row" style="margin: 5px;">                    
                            <div id="alert_error" class="form-group" style="display: none;">
                                <div class="alert alert-danger">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label for="title">Judul:</label>
                                <input type="text" value="BELAJAR DULU DEKðŸ¤£" class="form-control" name="title" placeholder="" />
                            </div>
                            
                            <div class="form-group">
                                <label for="konten">Detail Konten:</label>
                                <div class="summernote"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="title">Link Download:</label>
                                <input type="text" value="https://drive.google.com/drive/folders/15_Voemwwk9ppZUhGiWv1cXeke_OpR4QP?usp=sharing" class="form-control" name="link_download" placeholder="" />
                            </div>

                            <div class="form-group">
                                <label for="videoId">Video ID Youtube:</label>
                                <input type="text" value="btgwgCWDQ28" class="form-control" name="videoId" placeholder="" />
                            </div>

                            <div class="form-group">
                                <label for="duration">Durasi Video:</label>
                                <input type="text" value="" class="form-control" name="duration" placeholder="" />
                            </div>
                            
                            <div class="form-group">
                                <label for="kategori">Kategori Konten:</label>
                                <select multiple class="form-control" name="id_kategori" style="height: 200px;">
                                                                            <option style="font-weight: bold;" value="42" >FFEC ID</option>                                        
                                                                            <option style="font-weight: bold;" value="40" >Preset 3D</option>                                        
                                                                            <option style="font-weight: bold;" value="34"  selected="selected" >Preset Baru</option>                                        
                                                                            <option style="font-weight: bold;" value="39" >Preset Bucin</option>                                        
                                                                            <option style="font-weight: bold;" value="41" >Preset Guild</option>                                        
                                                                            <option style="font-weight: bold;" value="38"  selected="selected" >Preset Kalimat</option>                                        
                                                                            <option style="font-weight: bold;" value="36" >Preset Lobby</option>                                        
                                                                            <option style="font-weight: bold;" value="37" >Preset Profil</option>                                        
                                                                            <option style="font-weight: bold;" value="35"  selected="selected" >Preset Trending</option>                                        
                                                                
                                </select>
                                <label>Gunakan tombol Ctrl untuk pilih lebih dari 1 kategori.</label>
                            </div>

                            <div class="form-group">
                                <label for="banner">Banner yang Terkait:</label>
                                <select multiple class="form-control" name="id_banner" style="height: 200px;">
                                                                            <option style="font-weight: bold;" value="6" >Tutorial</option>                                        
                                                                            <option style="font-weight: bold;" value="8" >Opening</option>                                        
                                                                
                                </select>
                                <label>Gunakan tombol Ctrl untuk pilih lebih dari 1 banner.</label>
                            </div>

                            <div class="form-group">
                                <label for="banner">Banner Konten:</label>                        
                                <style type="text/css">
                                    #div-banner .cropit-image-preview {
                                        margin-bottom: 5px;
                                        background-color: #a6bac4;
                                        width: 1000px;
                                        height: 500px;
                                        cursor: move;
                                    }
    
                                    #div-banner .H-new-kol-post-img {
                                        margin-bottom: 5px;
                                        width: 1000px;
                                        height: 500px;                                
                                    }
                                </style>
    
                                <div id="div-banner" class="H-new-kol-post-img image-editor-banner">
                                    <input id="fileupload_banner" type="file" name="fileupload_banner" style="display:none;" class="cropit-image-input" />
                                    <div class="cropit-image-preview"></div>
                                </div>
    
                                <div id="upload_banner" class="btn btn-primary">Upload</div>
                            </div>

                            <div class="form-group">
                                <label for="thumbnail">Thumbnail Konten:</label>                        
                                <style type="text/css">
                                    #div-thumbnail .cropit-image-preview {
                                        margin-bottom: 5px;
                                        background-color: #a6bac4;
                                        width: 512px;
                                        height: 512px;
                                        cursor: move;
                                    }
    
                                    #div-thumbnail .H-new-kol-post-img {
                                        margin-bottom: 5px;
                                        width: 512px;
                                        height: 512px;                                
                                    }
                                </style>
    
                                <div id="div-thumbnail" class="H-new-kol-post-img image-editor-thumbnail">
                                    <input id="fileupload_thumbnail" type="file" name="fileupload_thumbnail" style="display:none;" class="cropit-image-input" />
                                    <div class="cropit-image-preview"></div>
                                </div>
    
                                <div id="upload_thumbnail" class="btn btn-primary">Upload</div>
                            </div>

                            <div class="form-group">
                                <label class="control-label"><input type="checkbox" name="tabpanel_1" checked />&nbsp;&nbsp;&nbsp;PRESET BARU</label><br />
                                <label class="control-label"><input type="checkbox" name="tabpanel_2"  />&nbsp;&nbsp;&nbsp;FILM</label><br />
                                <label class="control-label"><input type="checkbox" name="tabpanel_3"  />&nbsp;&nbsp;&nbsp;BUDAYA</label><br />
                                <label class="control-label"><input type="checkbox" name="tabpanel_4"  />&nbsp;&nbsp;&nbsp;POLITIK</label><br />
                                <label class="control-label"><input type="checkbox" name="tabpanel_5"  />&nbsp;&nbsp;&nbsp;HIBURAN</label><br />
                                <label class="control-label"><input type="checkbox" name="tabpanel_6"  />&nbsp;&nbsp;&nbsp;LAINNYA</label><br />
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
                                                <div id="i_loading" class="G-btn-animation" style="display: none;"><img src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/img/loading.gif" /></div>                  
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
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/jquery.js"></script>	
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/bootstrap.js"></script>
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/jquery.ui.js"></script>
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/nav.accordion.js"></script>	
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/hammerjs.js"></script>
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/jquery.hammer.js"></script>
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/scrollup.js"></script>	
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/jquery.slimscroll.js"></script>	
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/smart-resize.js"></script>
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/blockui.min.js"></script>		
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/wow.min.js"></script>					
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/fancybox.min.js"></script>
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/venobox.js"></script>
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/forms/uniform.min.js"></script>
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/forms/switchery.js"></script>
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/forms/select2.min.js"></script>	
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/js/core.js"></script>
<!-- /global scripts -->

<!-- Page scripts -->
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/js/jquery.cropit.js"></script>

<link rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/dist/summernote.css">
<script type="text/javascript" src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/dist/summernote.js"></script>
<script type="text/javascript" src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/dist/summernote-ext-video.js"></script> 

<!-- Page scripts -->
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/bootstrap-fileinput/js/fileinput.js"></script>
<script type="text/javascript" src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/js/jquery.input.formatter.js"></script>  

<!-- include summernote -->
<link rel="stylesheet" href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/dist/summernote.css">
<script type="text/javascript" src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/dist/summernote.js"></script>
<script type="text/javascript" src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/dist/summernote-ext-video.js"></script> 
<link href="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/datepick/jquery.datepick.css" rel="stylesheet">
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/datepick/jquery.plugin.js"></script>
<script src="http://192.168.1.9/editorberkelas/templates/back-end/penguin/assets/datepick/jquery.datepick.js"></script>

<script type="text/javascript">
    $(function () {

        var isEdit = true;
        $('.image-editor-banner').cropit({
          smallImage: 'stretch',
          imageState: {
            src: 'http://192.168.1.9/editorberkelas/uploads/konten/banner/6913.png',
          }        });
        
        $('.image-editor-thumbnail').cropit({
          smallImage: 'stretch',
          imageState: {
            src: 'http://192.168.1.9/editorberkelas/uploads/konten/thumbnail/8792.png',
          }        });


        $('.summernote').summernote({
            height: 170,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                //['fontname', ['fontname']],
                //['fontsize', ['fontsize']], Still buggy
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                //['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                //['view', ['fullscreen' , 'codeview' ]],
                ['help', ['help']]
            ]
        });

        $(".summernote").code('<p>Katanya \"Udah kalah banyak cakap, alasannya sendalnya jelek, kalah kalah aja, belajar dulu dek\"&nbsp;ðŸ¤£ðŸ¤£ gas download!</p><p><br></p><p><br></p><p>-Premium (diatas 5mb) : <a href=\"https://alight.link/nZ8uVm7CL94dMH4z8\">https://alight.link/nZ8uVm7CL94dMH4z8</a></p><p>-Gratis (dibawah 5mb) : <a href=\"https://alight.link/hPAUaigydFAeCPuv8\">https://alight.link/hPAUaigydFAeCPuv8</a></p><p><br></p><p>Download dan pakai Presetnya dari YouTube Channel \"FF Pororo\", gas!</p><p>Link Channel FF Pororo : <a href=\"https://www.youtube.com/c/FfPororo/videos\">https://www.youtube.com/c/FfPororo/videos</a><br><br><br><br><br>_</p>');

        function setErrorMessage(message) {
            $('#alert_error .alert').text(message);
            $('#alert_error').show('slow');
            setTimeout(function() {
                $('#alert_error').hide('slow');
            }, 5000);
            $("body, html").animate({ 
                scrollTop: $('#wrapper').offset().top - 70
            }, 600);
        }
        
        $('#btn_simpan').click(function() {            
            var data = new FormData();
            data.append('id', isEdit?'22':'');
            data.append('title', $('[name=title]').val());
            data.append('videoId', $('[name=videoId]').val());
            data.append('duration', $('[name=duration]').val());
            data.append('konten', $('.summernote').summernote().code().replace(/\n/, '<br />'));
            data.append('link_download', $('[name=link_download]').val());
            var imageDataBanner = $('.image-editor-banner').cropit('export');
            data.append('filename_banner', imageDataBanner==undefined?'':imageDataBanner);
            var imageDataThumbnail = $('.image-editor-thumbnail').cropit('export');
            data.append('filename_thumbnail', imageDataThumbnail==undefined?'':imageDataThumbnail);
            data.append('is_aktif', $('[name=is_aktif]').val());

            var kategori = $('[name=id_kategori]').val();
            var id_kategori = '';
            for(var key in kategori) {
                id_kategori+=(key>0?',':'')+kategori[key]
            }
            data.append('id_kategori', id_kategori);

            var banner = $('[name=id_banner]').val();
            var id_banner = '';
            for(var key in banner) {
                id_banner+=(key>0?',':'')+banner[key]
            }
            data.append('id_banner', id_banner);

            data.append('tabpanel_1', $('[name=tabpanel_1]').is(':checked')?'1':'0');
            data.append('tabpanel_2', $('[name=tabpanel_2]').is(':checked')?'1':'0');
            data.append('tabpanel_3', $('[name=tabpanel_3]').is(':checked')?'1':'0');
            data.append('tabpanel_4', $('[name=tabpanel_4]').is(':checked')?'1':'0');
            data.append('tabpanel_5', $('[name=tabpanel_5]').is(':checked')?'1':'0');
            data.append('tabpanel_6', $('[name=tabpanel_6]').is(':checked')?'1':'0');

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
                    setLoading(false);
                    if(data['success']) {
                        swal('Sukses', 'Record Data Batal Disimpan', 'success')
                        window.location = 'list.php';                    
                    } else {
                        setErrorMessage(data['message']);                        
                    }
                }, 

                error: function() {
                    setLoading(false);
                    setErrorMessage('Proses simpan data tidak berhasil!');
                }

            });
        });

        $('#upload_banner').click(function(){
            $('#fileupload_banner').trigger('click'); 
            return false;
        });

        $('#upload_thumbnail').click(function(){
            $('#fileupload_thumbnail').trigger('click'); 
            return false;
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
