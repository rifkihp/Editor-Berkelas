<?php /* Smarty version Smarty-3.1.21-dev, created on 2020-11-10 18:59:08
         compiled from "..\..\templates\back-end\penguin\pengaturan\edit.html" */ ?>
<?php /*%%SmartyHeaderCode:20735020435fa998bd903009-60030487%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '39fdfaf9d069497f4ea8b9164e573ac118e8c651' => 
    array (
      0 => '..\\..\\templates\\back-end\\penguin\\pengaturan\\edit.html',
      1 => 1605009545,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20735020435fa998bd903009-60030487',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5fa998bda09e75_89764843',
  'variables' => 
  array (
    'adminweburl' => 0,
    'title' => 0,
    'sub_title' => 0,
    'isEdit' => 0,
    'data' => 0,
    'tpl_dir' => 0,
    'array_akses' => 0,
    'listpropinsi' => 0,
    'entry' => 0,
    'livetv' => 0,
    'homeurl' => 0,
    'listtelepon' => 0,
    'no' => 0,
    'listno_hp' => 0,
    'listsms' => 0,
    'listwa' => 0,
    'listbbm' => 0,
    'listline' => 0,
    'alert_success' => 0,
    'alert_error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa998bda09e75_89764843')) {function content_5fa998bda09e75_89764843($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['include_tpl']->value)."/includes/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

	<!--sidebar-->
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['include_tpl']->value)."/includes/sidebar.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

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
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['adminweburl']->value;?>
">Beranda</a></li>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['adminweburl']->value;?>
/pengaturan/"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</a></li>
						<li class="active"><?php echo $_smarty_tpl->tpl_vars['sub_title']->value;?>
</li>
					</ul>					
				</div>
			</div>		
			<!--/Page Header-->
			
			<div class="container-fluid page-content">
				
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h3 class="panel-title"><strong><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</strong></h3>				
								<h5 class="panel-title"><?php echo $_smarty_tpl->tpl_vars['sub_title']->value;?>
</h5>			
							</div>

							<div class="panel-body no-padding-bottom">
                    <div class="form-group">

                        <ul id="myTab" class="nav nav-tabs">                                

                            <li class="active">

                                <a href="#umum" data-toggle="tab"><b>Utama</b></a>

                            </li>                                 

                            <li>

                                <a href="#alamat" data-toggle="tab"><b>Alamat</b></a>

                            </li>

                            <li>

                                <a href="#livetv" data-toggle="tab"><b>Live TV</b></a>

                            </li>

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

                                <input type="text" value="<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['judul'];
}?>" class="form-control" name="judul" placeholder="" />

                            </div>



                            <div class="form-group">

                                <label for="tagline">Tag Line:</label>

                                <input type="text" value="<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['tagline'];
}?>" class="form-control" name="tagline" placeholder="" />

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

                                <input type="text" value="<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['email'];
}?>" class="form-control" name="email" placeholder="" />

                            </div>

                            <div class="form-group">&nbsp;</div>

                            <div class="form-group">

                                <div id="i_loading_umum" class="G-btn-animation" style="display: none;"><img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/img/loading.gif" /></div>                  

                                <?php if (in_array('E',$_smarty_tpl->tpl_vars['array_akses']->value)) {?><div id="btn_simpan_umum" class="btn btn-primary">Update</div><?php }?>

                            </div>

                            

                        </div>

                        <div class="tab-pane fade" id="alamat">

                            <div class="form-group">&nbsp;</div>

                            <div class="form-group">

                                <label for="alamat">Alamat:</label>

                                <textarea class="form-control" style="height: 50px;" name="alamat"><?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['alamat'];
}?></textarea>

                            </div>

                            
                            <div class="form-group">

                                <label for="propinsi">Propinsi:</label>

                                <select id="propinsi" name="propinsi" class="form-control">

                                    <?php  $_smarty_tpl->tpl_vars['entry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listpropinsi']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->key => $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->_loop = true;
?>

                                        <option value="<?php echo $_smarty_tpl->tpl_vars['entry']->value['province_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['entry']->value['province_id']==$_smarty_tpl->tpl_vars['data']->value[0]['propinsi']) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['entry']->value['province'];?>
</option>

                                    <?php } ?>

                                </select>

                            </div>



                            <div class="form-group">

                                <label for="kota">Kota:</label>

                                <select id="kota" name="kota" class="form-control"></select>

                            </div>

                            

                            <div class="form-group">

                                <label for="kode_pos">Kode Pos:</label>

                                <input type="text" value="<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['kode_pos'];
}?>" class="form-control" name="kode_pos" />

                            </div>

                            <div class="form-group">

                                <label for="latitude">Latitude:</label>

                                <input type="text" value="<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['latitude'];
}?>" class="form-control" name="latitude" />

                            </div>

                            <div class="form-group">

                                <label for="longitude">Longitude:</label>

                                <input type="text" value="<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['longitude'];
}?>" class="form-control" name="longitude" />

                            </div>

                            

                            <div class="form-group">&nbsp;</div>

                            <div class="form-group">

                                <div id="i_loading_alamat" class="G-btn-animation" style="display: none;"><img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/img/loading.gif" /></div>                  

                                <?php if (in_array('E',$_smarty_tpl->tpl_vars['array_akses']->value)) {?><div id="btn_simpan_alamat" class="btn btn-primary">Update</div><?php }?>

                            </div>

                        </div>

                        <div class="tab-pane fade" id="livetv">

                            <div class="form-group">
                                <?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {?>
                                    <img src="https://img.youtube.com/vi/<?php echo $_smarty_tpl->tpl_vars['livetv']->value[0]['videoId'];?>
/maxresdefault.jpg" height="235px" />
                                <?php }?>
                            </div>

                            <div class="form-group">

                                <label for="title">Judul:</label>

                                <input type="text" value="<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['livetv']->value[0]['title'];
}?>" class="form-control" name="title" placeholder="" />

                            </div>

                            <div class="form-group">

                                <label for="videoId">Video ID:</label>

                                <input type="text" value="<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['livetv']->value[0]['videoId'];
}?>" class="form-control" name="videoId" placeholder="" />

                            </div>

                            <div class="form-group">

                                <label for="duration">Durasi:</label>

                                <input type="text" value="<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['livetv']->value[0]['duration'];
}?>" class="form-control" name="duration" placeholder="" />

                            </div>
                            

                            <div class="form-group">

                                <label for="is_live">Tampilkan:</label>

                                <select name="is_live" class="form-control">

                                    <option value="0" <?php if ($_smarty_tpl->tpl_vars['livetv']->value[0]['is_live']==0) {?> selected="selected" <?php }?>>TIDAK</option>
                                    <option value="1" <?php if ($_smarty_tpl->tpl_vars['livetv']->value[0]['is_live']==1) {?> selected="selected" <?php }?>>YA</option>
                                    
                                </select>
                            </div>

                            <div class="form-group">&nbsp;</div>

                            <div class="form-group">

                                <div id="i_loading_livetv" class="G-btn-animation" style="display: none;"><img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/img/loading.gif" /></div>                  

                                <?php if (in_array('E',$_smarty_tpl->tpl_vars['array_akses']->value)) {?><div id="btn_simpan_livetv" class="btn btn-primary">Update</div><?php }?>

                            </div>

                            

                        </div>

                        <div class="tab-pane fade" id="syaratkondisi">

                            <div class="form-group">

                                <div class="summernote_syaratkondisi"></div>

                            </div>

                            <div class="form-group">&nbsp;</div>

                            <div class="form-group">

                                <div id="i_loading_syaratkondisi" class="G-btn-animation" style="display: none;"><img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/img/loading.gif" /></div>                  

                                <?php if (in_array('E',$_smarty_tpl->tpl_vars['array_akses']->value)) {?><div id="btn_simpan_syaratkondisi" class="btn btn-primary">Update</div><?php }?>

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
		<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['include_tpl']->value)."/includes/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

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
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/light.jpg" alt=""/>
					</div>				
				</li>
				<li class="list-title clearfix">Mirage</li>
				<li>
					<div class="theme pull-left" id="mirage">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/mirage_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="mirage_light">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/mirage_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="mirage_light_sidebar">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/mirage_light_sidebar.jpg" alt=""/>
					</div>				
				</li>										
				<li class="list-title clearfix">Burnt Sienna</li>
				<li>
					<div class="theme pull-left" id="burnt_sienna_dark">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/burnt_sienna_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="burnt_sienna_light">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/burnt_sienna_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="burnt_sienna_light_sidebar">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/burnt_sienna_light_sidebar.jpg" alt=""/>
					</div>				
				</li>		

				<li class="list-title clearfix">Amethyst</li>
				<li>
					<div class="theme pull-left" id="amethyst_dark">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/amethyst_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="amethyst_light">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/amethyst_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="amethyst_light_sidebar">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/amethyst_light_sidebar.jpg" alt=""/>
					</div>				
				</li>		

				<li class="list-title clearfix">Fuchsia Blue</li>
				<li>
					<div class="theme pull-left" id="fuchsiablue_dark">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/fuchsiablue_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="fuchsiablue_light">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/fuchsiablue_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="fuchsiablue_light_sidebar">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/fuchsiablue_light_sidebar.jpg" alt=""/>
					</div>				
				</li>

				<li class="list-title clearfix">Picton Blue</li>
				<li>
					<div class="theme pull-left" id="pictonblue_dark">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/pictonblue_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="pictonblue_light">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/pictonblue_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="pictonblue_light_sidebar">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/pictonblue_light_sidebar.jpg" alt=""/>
					</div>				
				</li>
				
				<li class="list-title clearfix">Jungle Green</li>
				<li>
					<div class="theme pull-left" id="junglegreen_dark">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/junglegreen_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="junglegreen_light">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/junglegreen_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="junglegreen_light_sidebar">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/junglegreen_light_sidebar.jpg" alt=""/>
					</div>				
				</li>
				
				<li class="list-title clearfix">Fern</li>
				<li>
					<div class="theme pull-left" id="fern_dark">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/fern_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="fern_light">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/fern_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="fern_light_sidebar">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/fern_light_sidebar.jpg" alt=""/>
					</div>				
				</li>
				
				<li class="list-title clearfix">Sunglow</li>
				<li>
					<div class="theme pull-left" id="sunglow_dark">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/sunglow_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="sunglow_light">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/sunglow_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="sunglow_light_sidebar">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/sunglow_light_sidebar.jpg" alt=""/>
					</div>				
				</li>
				
				<li class="list-title clearfix">Regent Grey</li>
				<li>
					<div class="theme pull-left" id="regentgrey_dark">

						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/regentgrey_dark.jpg" alt=""/>
					</div>				
				</li>			
				<li>
					<div class="theme pull-left" id="regentgrey_light">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/regentgrey_light.jpg" alt=""/>
					</div>				
				</li>
				<li>
					<div class="theme pull-left" id="regentgrey_light_sidebar">
						<img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/images/themes/regentgrey_light_sidebar.jpg" alt=""/>
					</div>				
				</li>
			</ul>	
		</div>
	</div>

--><a id="scrollTop" href="index1.htm#top"><i class="icon-arrow-up12"></i></a>	

<!-- Global scripts -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/jquery.js"><?php echo '</script'; ?>
>	
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/bootstrap.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/jquery.ui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/nav.accordion.js"><?php echo '</script'; ?>
>	
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/hammerjs.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/jquery.hammer.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/scrollup.js"><?php echo '</script'; ?>
>	
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/jquery.slimscroll.js"><?php echo '</script'; ?>
>	
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/smart-resize.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/blockui.min.js"><?php echo '</script'; ?>
>		
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/wow.min.js"><?php echo '</script'; ?>
>					
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/fancybox.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/venobox.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/forms/uniform.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/forms/switchery.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/forms/select2.min.js"><?php echo '</script'; ?>
>	
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/core.js"><?php echo '</script'; ?>
>
<!-- /global scripts -->	
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/dist/summernote.css">

    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/dist/summernote.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/dist/summernote-ext-video.js"><?php echo '</script'; ?>
> 

        

    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/js/jquery.cropit.js"><?php echo '</script'; ?>
>  

    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/bootstrap-fileinput/js/fileinput.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/js/jquery.input.formatter.js"><?php echo '</script'; ?>
>  


    <?php echo '<script'; ?>
 type="text/javascript">        

        $(function () {           

            var isEdit = <?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {?>true<?php } else { ?>false<?php }?>;

            $('.image-editor-avatar').cropit({
              smallImage: 'stretch'<?php if ($_smarty_tpl->tpl_vars['data']->value[0]['avatar']!='') {?>,
              imageState: {
                src: '<?php echo $_smarty_tpl->tpl_vars['homeurl']->value;?>
/uploads/umum/<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['avatar'];?>
',
              }<?php }?>
            });
            
            $('.image-editor-logo').cropit({
              smallImage: 'stretch'<?php if ($_smarty_tpl->tpl_vars['data']->value[0]['logo']!='') {?>,
              imageState: {
                src: '<?php echo $_smarty_tpl->tpl_vars['homeurl']->value;?>
/uploads/umum/<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['logo'];?>
',
              }<?php }?>
            });

            $('.image-editor-bg').cropit({
              smallImage: 'stretch'<?php if ($_smarty_tpl->tpl_vars['data']->value[0]['bg']!='') {?>,
              imageState: {
                src: '<?php echo $_smarty_tpl->tpl_vars['homeurl']->value;?>
/uploads/umum/<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bg'];?>
',
              }<?php }?>
            });

            <?php $_smarty_tpl->tpl_vars["no"] = new Smarty_variable(1, null, 0);?>

            <?php  $_smarty_tpl->tpl_vars['entry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listtelepon']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->key => $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->_loop = true;
?>

                var record = 

                    '<tr>' +

                        '<td style="padding: 5px;" width="100%"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['entry']->value['telepon'];?>
" name="telepon" class="form-control" placeholder="" /></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><?php if ($_smarty_tpl->tpl_vars['no']->value>1) {?><div class="btn btn-danger hapus_telepon">Hapus</div><?php }?></div></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><?php if ($_smarty_tpl->tpl_vars['no']->value==1) {?><div id="btn_tambah_telepon" class="btn btn-primary">Tambah</div><?php }?></div></td>' +

                    '</tr>';



                $( record ).insertBefore( "#telepon" );

                <?php $_smarty_tpl->tpl_vars["no"] = new Smarty_variable($_smarty_tpl->tpl_vars['no']->value+1, null, 0);?>

            <?php } ?>

            

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

            <?php $_smarty_tpl->tpl_vars["no"] = new Smarty_variable(1, null, 0);?>

            <?php  $_smarty_tpl->tpl_vars['entry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listno_hp']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->key => $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->_loop = true;
?>

                var record = 

                    '<tr>' +

                        '<td style="padding: 5px;" width="100%"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['entry']->value['no_hp'];?>
" name="no_hp" class="form-control" placeholder="" /></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><?php if ($_smarty_tpl->tpl_vars['no']->value>1) {?><div class="btn btn-danger hapus_no_hp">Hapus</div><?php }?></div></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><?php if ($_smarty_tpl->tpl_vars['no']->value==1) {?><div id="btn_tambah_no_hp" class="btn btn-primary">Tambah</div><?php }?></div></td>' +

                    '</tr>';



                $( record ).insertBefore( "#no_hp" );

                <?php $_smarty_tpl->tpl_vars["no"] = new Smarty_variable($_smarty_tpl->tpl_vars['no']->value+1, null, 0);?>

            <?php } ?>

            

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

            <?php $_smarty_tpl->tpl_vars["no"] = new Smarty_variable(1, null, 0);?>

            <?php  $_smarty_tpl->tpl_vars['entry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listsms']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->key => $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->_loop = true;
?>

                var record = 

                    '<tr>' +

                        '<td style="padding: 5px;" width="100%"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['entry']->value['sms'];?>
" name="sms" class="form-control" placeholder="" /></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><?php if ($_smarty_tpl->tpl_vars['no']->value>1) {?><div class="btn btn-danger hapus_sms">Hapus</div><?php }?></div></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><?php if ($_smarty_tpl->tpl_vars['no']->value==1) {?><div id="btn_tambah_sms" class="btn btn-primary">Tambah</div><?php }?></div></td>' +

                    '</tr>';



                $( record ).insertBefore( "#sms" );

                <?php $_smarty_tpl->tpl_vars["no"] = new Smarty_variable($_smarty_tpl->tpl_vars['no']->value+1, null, 0);?>

            <?php } ?>

            

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

            

            <?php $_smarty_tpl->tpl_vars["no"] = new Smarty_variable(1, null, 0);?>

            <?php  $_smarty_tpl->tpl_vars['entry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listwa']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->key => $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->_loop = true;
?>

                var record = 

                    '<tr>' +

                        '<td style="padding: 5px;" width="100%"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['entry']->value['wa'];?>
" name="wa" class="form-control" placeholder="" /></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><?php if ($_smarty_tpl->tpl_vars['no']->value>1) {?><div class="btn btn-danger hapus_wa">Hapus</div><?php }?></div></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><?php if ($_smarty_tpl->tpl_vars['no']->value==1) {?><div id="btn_tambah_wa" class="btn btn-primary">Tambah</div><?php }?></div></td>' +

                    '</tr>';



                $( record ).insertBefore( "#wa" );

                <?php $_smarty_tpl->tpl_vars["no"] = new Smarty_variable($_smarty_tpl->tpl_vars['no']->value+1, null, 0);?>

            <?php } ?>

            

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

            <?php $_smarty_tpl->tpl_vars["no"] = new Smarty_variable(1, null, 0);?>

            <?php  $_smarty_tpl->tpl_vars['entry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listbbm']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->key => $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->_loop = true;
?>

                var record = 

                    '<tr>' +

                        '<td style="padding: 5px;" width="100%"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['entry']->value['bbm'];?>
" name="bbm" class="form-control" placeholder="" /></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><?php if ($_smarty_tpl->tpl_vars['no']->value>1) {?><div class="btn btn-danger hapus_bbm">Hapus</div><?php }?></div></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><?php if ($_smarty_tpl->tpl_vars['no']->value==1) {?><div id="btn_tambah_bbm" class="btn btn-primary">Tambah</div><?php }?></div></td>' +

                    '</tr>';



                $( record ).insertBefore( "#bbm" );

                <?php $_smarty_tpl->tpl_vars["no"] = new Smarty_variable($_smarty_tpl->tpl_vars['no']->value+1, null, 0);?>

            <?php } ?>

            

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

            <?php $_smarty_tpl->tpl_vars["no"] = new Smarty_variable(1, null, 0);?>

            <?php  $_smarty_tpl->tpl_vars['entry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listline']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->key => $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->_loop = true;
?>

                var record = 

                    '<tr>' +

                        '<td style="padding: 5px;" width="100%"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['entry']->value['line'];?>
" name="line" class="form-control" placeholder="" /></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><?php if ($_smarty_tpl->tpl_vars['no']->value>1) {?><div class="btn btn-danger hapus_line">Hapus</div><?php }?></div></td>' +

                        '<td style="padding: 5px;"><div style="text-align: center;  white-space: nowrap;"><?php if ($_smarty_tpl->tpl_vars['no']->value==1) {?><div id="btn_tambah_line" class="btn btn-primary">Tambah</div><?php }?></div></td>' +

                    '</tr>';



                $( record ).insertBefore( "#line" );

                <?php $_smarty_tpl->tpl_vars["no"] = new Smarty_variable($_smarty_tpl->tpl_vars['no']->value+1, null, 0);?>

            <?php } ?>

            

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

                    url: '<?php echo $_smarty_tpl->tpl_vars['homeurl']->value;?>
/store/getKota.php',

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

            

            <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['propinsi']>0) {?>loadKota('<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['propinsi'];?>
', '<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['kota'];?>
');<?php }?>

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



            $(".summernote").code('<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['detail'];
}?>');

            

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



            $(".summernote_syaratkondisi").code('<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['syarat_kondisi'];
}?>');

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

                    url: '<?php echo $_smarty_tpl->tpl_vars['homeurl']->value;?>
/store/getKota.php',

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
            

            <?php if ($_smarty_tpl->tpl_vars['alert_success']->value!='') {?>setMessage('success', '<?php echo $_smarty_tpl->tpl_vars['alert_success']->value;?>
');<?php }?>        

            <?php if ($_smarty_tpl->tpl_vars['alert_error']->value!='') {?>setMessage('error', '<?php echo $_smarty_tpl->tpl_vars['alert_error']->value;?>
');<?php }?> 

        });

    <?php echo '</script'; ?>
>
</body>
</html><?php }} ?>
