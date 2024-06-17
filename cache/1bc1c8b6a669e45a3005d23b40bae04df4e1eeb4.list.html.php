<?php /*%%SmartyHeaderCode:185794687460bd4f5daf2088-74939568%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1bc1c8b6a669e45a3005d23b40bae04df4e1eeb4' => 
    array (
      0 => '..\\..\\templates\\back-end\\penguin\\konten\\list.html',
      1 => 1623135567,
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
  'nocache_hash' => '185794687460bd4f5daf2088-74939568',
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_66703460b18b61_02897035',
  'has_nocache_code' => false,
  'cache_lifetime' => 0,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_66703460b18b61_02897035')) {function content_66703460b18b61_02897035($_smarty_tpl) {?><!doctype html>
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
                            
                                <li class="active acc-parent-li">

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

                            
                                <li>

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
                <i class="icon-table position-left"></i> Konten
            </div>
            <ul class="breadcrumb">
                <li><a href="http://localhost/editorberkelas/adminweb">Beranda</a></li>
                <li><a href="http://localhost/editorberkelas/adminweb/dashboard/">Konten</a></li>
                <li class="active">Data Konten</li>
            </ul>					
        </div>
    </div>		
    <!--/Page Header-->

    <div class="container-fluid page-content">
        <div class="panel panel-flat">

            <div class="form-group panel-body no-padding-bottom">
                <div class="form-group">
                    <table style="width: 100%;">
                        <tr>
                            <td width="100%">
                                <table>
                                    <tr>
                                        <td width="100%"><input type="text" value="" class="form-control" name="query" id="query" placeholder="Masukan kata kunci pencarian..." /></td>
                                        <td width="5px">&nbsp;</td> 
                                        <td><div id="btn_cari" type="submit" class="btn btn-primary">Cari</div></td>
                                        <td width="5px">&nbsp;</td> 
                                        <td><a class="btn btn-default" href="list.php">Reset</a></td>  
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="form-group">
                    <div id='btn_add' class="btn btn-primary">Baru</div>                    <div id='btn_edit' class="btn btn-success disabled">Edit</div>                    <div id='btn_delete' class="btn btn-danger disabled">Hapus</div>                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-togglable table-hover">
                    <thead>
                        <tr>
                            <th  width="1%"><input type="checkbox" id="select_all" /></th>
                            <th data-toggle="false" width="1%"><div style="text-align: center;">No.</div></th>
                            <th width="10%"><div style="text-align: center;">Thumbnail</div></th>                            
                            <th width="52%"><div style="text-align: left;">Detail</div></th>
                            <th width="10%"><div style="text-align: center;">Tampil</div></th>

                            <th data-hide="phone, tablet" width="10%"><div style="text-align: center;">Aksi</div></th>
                        </tr>
                    </thead>

                    <tbody>
                                                                            <tr id="baris_22">
                                <td align="center"><input type="checkbox" id_select="22" name="select_22" class="select" /></td>
                                <td align="center"><small>1</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/2793.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=4mvkksHziVw" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>BELAJAR DULU DEKðŸ¤£</i></b></div>
                                        <span class="btn label bg-green">PRESET BARU</span>                                                                                                                                                                                                                                        </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="22" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="22" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_21">
                                <td align="center"><input type="checkbox" id_select="21" name="select_21" class="select" /></td>
                                <td align="center"><small>2</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/8413.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=mG1OR0wvc9A" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>LOVELY - INSANE FREE FIRE 3D ANDROID EDITS</i></b></div>
                                                                                                                                                                                                                                                                                </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="21" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="21" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_20">
                                <td align="center"><input type="checkbox" id_select="20" name="select_20" class="select" /></td>
                                <td align="center"><small>3</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/4896.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=6Gwfj8wgN_A" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>Ain't my fault - Free Fire Insane Edit</i></b></div>
                                                                                                                                                                                                                                                                                </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="20" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="20" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_19">
                                <td align="center"><input type="checkbox" id_select="19" name="select_19" class="select" /></td>
                                <td align="center"><small>4</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/2189.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=MG1EhBzvKmA" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>Free fire Edit - Harko</i></b></div>
                                                                                                                                                                                                                                                                                </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="19" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="19" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_18">
                                <td align="center"><input type="checkbox" id_select="18" name="select_18" class="select" /></td>
                                <td align="center"><small>5</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/2879.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=HhV-enPXqNY" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>Telepati (FREE FIRE EDIT)</i></b></div>
                                                                                                                                                                                                                                                                                </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="18" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="18" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_17">
                                <td align="center"><input type="checkbox" id_select="17" name="select_17" class="select" /></td>
                                <td align="center"><small>6</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/3871.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=A9ngp45lxgI" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i> CHANGE - ANDROID EDITING - RENOO.MP4</i></b></div>
                                                                                                                                                                                                                                                                                </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="17" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="17" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_16">
                                <td align="center"><input type="checkbox" id_select="16" name="select_16" class="select" /></td>
                                <td align="center"><small>7</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/9248.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=qXfLu8UHaDw" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>UDAH GEDE MAIN EPEP? UDAH GEDE BLM SUKSES? #8</i></b></div>
                                        <span class="btn label bg-green">PRESET BARU</span>                                                                                                                                                                                                                                        </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="16" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="16" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_15">
                                <td align="center"><input type="checkbox" id_select="15" name="select_15" class="select" /></td>
                                <td align="center"><small>8</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/8269.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=Z_0AMPdX-lI" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>- B e A l r i g h t -</i></b></div>
                                                                                                                                                                                                                                                                                </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="15" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="15" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_14">
                                <td align="center"><input type="checkbox" id_select="14" name="select_14" class="select" /></td>
                                <td align="center"><small>9</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/7196.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=JYx4vxZo0WA" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>Tiltmachine | free fire edit | gmv</i></b></div>
                                                                                                                                                                                                                                                                                </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="14" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="14" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_13">
                                <td align="center"><input type="checkbox" id_select="13" name="select_13" class="select" /></td>
                                <td align="center"><small>10</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/4978.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=A92GcobJ1Tg" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>AS THE WORLD CAVES IN - SONY VEGAS EDITING</i></b></div>
                                                                                                                                                                                                                                                                                </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="13" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="13" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_12">
                                <td align="center"><input type="checkbox" id_select="12" name="select_12" class="select" /></td>
                                <td align="center"><small>11</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/2318.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=1CYMmHMd_fM" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>RUOK - GET YOU THE MOON - AFTER EFFECT EDITING</i></b></div>
                                                                                                                                                                                                                                                                                </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="12" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="12" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_11">
                                <td align="center"><input type="checkbox" id_select="11" name="select_11" class="select" /></td>
                                <td align="center"><small>12</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/3649.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=gAdNvyWpUAI" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>Gmv FreeFire - Here Alessia Clara (Lucian Remix)</i></b></div>
                                                                                                                                                                                                                                                                                </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="11" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="11" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_10">
                                <td align="center"><input type="checkbox" id_select="10" name="select_10" class="select" /></td>
                                <td align="center"><small>13</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/2739.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=LCstNQWt2IU" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>FREE FIRE EDIT RUOK FF GASTOD EDITZZ</i></b></div>
                                                                                                                                                                                                                                                                                </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="10" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="10" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_9">
                                <td align="center"><input type="checkbox" id_select="9" name="select_9" class="select" /></td>
                                <td align="center"><small>14</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/1793.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=SoJsZwxu528" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>444+222 | Insane FreeFire Edit</i></b></div>
                                                                                                                                                                                                                                                                                </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="9" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="9" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_8">
                                <td align="center"><input type="checkbox" id_select="8" name="select_8" class="select" /></td>
                                <td align="center"><small>15</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/2673.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=uFIXe60S3ss" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>CLOCK PUNK - FULL 3D INSANE FREE FIRE EDIT</i></b></div>
                                                                                                                                                                                                                                                                                </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="8" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="8" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_7">
                                <td align="center"><input type="checkbox" id_select="7" name="select_7" class="select" /></td>
                                <td align="center"><small>16</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/6172.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=1h_72yZ0Jww" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>PRESET EYOO CAN'T I GETT AAA KAWAN #7</i></b></div>
                                        <span class="btn label bg-green">PRESET BARU</span>                                                                                                                                                                                                                                        </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="7" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="7" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_6">
                                <td align="center"><input type="checkbox" id_select="6" name="select_6" class="select" /></td>
                                <td align="center"><small>17</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/8347.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=t6H4TEZD6NY" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>INI KALAU KU BANTE DIE NI BUBAR GUILD DIE NI #6</i></b></div>
                                        <span class="btn label bg-green">PRESET BARU</span>                                                                                                                                                                                                                                        </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="6" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="6" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_5">
                                <td align="center"><input type="checkbox" id_select="5" name="select_5" class="select" /></td>
                                <td align="center"><small>18</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/9413.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=pYYH6JgQTck" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>KALO MISALKAN GUA PENSI - PRESET FF #5</i></b></div>
                                        <span class="btn label bg-green">PRESET BARU</span>                                                                                                                                                                                                                                        </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="5" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="5" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_4">
                                <td align="center"><input type="checkbox" id_select="4" name="select_4" class="select" /></td>
                                <td align="center"><small>19</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/9438.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=rv_qlqouWDQ" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>TEMAN GUA BAIK BANGET - PRESET FF #4</i></b></div>
                                        <span class="btn label bg-green">PRESET BARU</span>                                                                                                                                                                                                                                        </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="4" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="4" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                                <tr id="baris_3">
                                <td align="center"><input type="checkbox" id_select="3" name="select_3" class="select" /></td>
                                <td align="center"><small>20</small></td>
                                <td align="left">
                                    <img src="http://localhost/editorberkelas/uploads/konten/thumbnail/3426.png" height="120px" />
                                </td>
                                <!-- td align="left">
                                    <img src="http://localhost/editorberkelas/store/centercrop_3.php?id=b6nH1P_69dk" height="135px" />
                                </td -->
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i>PRESET FF 3D - DJ MIRACLES X RIVER FLOWS IN YOU #3</i></b></div>
                                        <span class="btn label bg-green">PRESET BARU</span>                                                                                                                                                                                                                                        </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <span style="font-weight: bold; color: green;">Aktif</span>                                                        
                                </div></td>
                                
                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                                                            <div id_select="3" class="btn btn-success edit">Edit</div>
                                                                        <div id_select="3" class="btn btn-danger hapus">Hapus</div>                                                        
                                </div></td>
                            </tr>
                                                                        </tbody>

                                        <tfoot><tr><th colspan="7">
                        <div style="text-align: center;">
                                                                                                                                                        <span class="btn btn-info">1</span>                                
                                                                                                
                                                                                                <a class="btn btn-default" href="list.php?page=2">2</a>
                                                                                                
                                                                                        
                                <a class="btn btn-default" href="list.php?page=2">Next &rarr;</a>
                                                    </div>
                    </th></tr></tfoot>
                                    </table>
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

<a id="scrollTop" href="tables_responsive.htm#top"><i class="icon-arrow-up12"></i></a>	

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
<script type="text/javascript" src="http://localhost/editorberkelas/templates/back-end/penguin/js/moment.min.js"></script>
<script type="text/javascript" src="http://localhost/editorberkelas/templates/back-end/penguin/js/legacy.js"></script>
<script type="text/javascript" src="http://localhost/editorberkelas/templates/back-end/penguin/js/forms/daterangepicker.js"></script>
<script type="text/javascript" src="http://localhost/editorberkelas/templates/back-end/penguin/js/forms/picker.js"></script>
<script type="text/javascript" src="http://localhost/editorberkelas/templates/back-end/penguin/js/forms/picker.date.js"></script>
<script type="text/javascript" src="http://localhost/editorberkelas/templates/back-end/penguin/js/forms/picker.time.js"></script>
<script type="text/javascript" src="http://localhost/editorberkelas/templates/back-end/penguin/js/forms/spectrum.js"></script>
<script type="text/javascript" src="http://localhost/editorberkelas/templates/back-end/penguin/js/pages/pickers.js"></script>
<!-- Page scripts -->
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/tables/footable.min.js"></script>
<script src="http://localhost/editorberkelas/templates/back-end/penguin/js/pages/tables_responsive.js"></script>

<!-- /page scripts -->
<script type="text/javascript">

    $(function () {
        var delete_selected = "";
        $( "#btn_add" ).click(function() {
            window.location='add.php';
        });

        $( "#btn_edit" ).click(function() {
            window.location='edit.php?id='+delete_selected;
        });

        $( "#btn_delete" ).click(function() {
            prosesDelete(delete_selected);
        });
        
        var proses_cari = function() {
            var query = $( "#query" ).val();
            window.location='list.php?'+(query.length>0?'&query='+query:'');
        };

        $( "#btn_cari" ).click(function() {
            proses_cari();
        });
            
        $( ".up" ).click(function() {                
            var id = this.getAttribute('id_select');
            prosesUp(id);                
        });

        $( ".hapus" ).click(function() {
            var id = this.getAttribute('id_select');
            prosesDelete(id);                
        });
         
        $( ".edit" ).click(function() {
            var id = this.getAttribute('id_select');
            window.location='edit.php?id='+id;
        });
        
        $( "#select_all" ).change(function() {
            var is_checked = $( "#select_all" ).is(':checked');
            var element = $( ".select" );
            var lengh = element.size();
            delete_selected = '';
            for(var i=0; i<lengh; i++) {
                var id = element[i].getAttribute('id_select');
                var nama = element[i].getAttribute('name');
                $('[name='+nama+']').prop('checked', is_checked);                    
                if(is_checked) delete_selected+=(delete_selected==''?'':',')+(is_checked?id:"");
            }

            setButton();
        });

        $( ".select" ).change(function() {
            var id = this.getAttribute('id_select');
            var nama = this.getAttribute('name');
            var is_checked = $( '[name='+nama+']').is(':checked');
            var temps = delete_selected.split(',');
            delete_selected='';
            for(var key in temps) {
                if(temps[key]!=id) delete_selected+=(delete_selected.length>0?",":"")+temps[key];
            }
            delete_selected+=(delete_selected.length>0?",":"")+(is_checked?id:""); 
            setButton();
        });
            
        function setButton() {
            var temp = new Array();
            if(delete_selected.length>0) temp = delete_selected.split(',');                
            $( "#btn_edit" ).removeClass('disabled').addClass(temp.length==1?'':'disabled');
            $( "#btn_delete" ).removeClass('disabled').addClass(temp.length>0?'':'disabled');
        }

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
        
        function prosesDelete(id) {
            swal({
              title: 'Menghapus Data',
              text: 'Apakah Anda Yakin Akan Menghapus Record Data Ini?',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Hapus Sekarang!',
              cancelButtonText: 'Batal',
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              buttonsStyling: false
            }).then(function () {
                $.ajax({
                    url: 'delete.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { id: id },
                    success: function(data, textStatus, jqXHR) {
                        if(data['success']) {
                            swal('Terhapus!', 'Record Data Telah Berhasil Dihapus!', 'success')
                            window.location='list.php';
                        } else {
                            swal('Error', data['message'], 'error')
                            setMessage('error', data['message']);
                        }
                    },

                    error: function(jqXHR, textStatus, errorThrown) {
                        swal('Error', 'Terjadi Kesalahan System', 'error')
                    }
                });
            }, function (dismiss) {
                // dismiss can be 'cancel', 'overlay', 'close', 'timer'
                if (dismiss === 'cancel') {
                    swal('Cancelled', 'Record Data Batal Dihapus', 'error')
                }
            });
        }
        
        function prosesUp(id) {
           //$('#detail').mask('Hapus...');
            $.ajax({
                url: 'up.php',
                type: 'POST',
                dataType: 'json',
                data: { id: id },
                success: function(data, textStatus, jqXHR) {
                    if(data['success']) {
                        window.location='list.php';
                    } else {
                        //$('#detail').unmask();
                        setMessage('error', data['message']);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //$('#detail').unmask();
                    setMessage('error', 'Terjadi kesalahan system.');
                }
            });
        }

                
         
    });
</script>
</body>
</html><?php }} ?>
