<?php /* Smarty version Smarty-3.1.21-dev, created on 2021-06-14 12:11:08
         compiled from "..\..\templates\back-end\penguin\konten\edit.html" */ ?>
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
  ),
  'nocache_hash' => '110554854260bd50382e3fa5-86537198',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_60bd5038332830_12184383',
  'variables' => 
  array (
    'title' => 0,
    'adminweburl' => 0,
    'sub_title' => 0,
    'isEdit' => 0,
    'data' => 0,
    'datacategory' => 0,
    'entry' => 0,
    'databanner' => 0,
    'tabmenu' => 0,
    'tpl_dir' => 0,
    'homeurl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_60bd5038332830_12184383')) {function content_60bd5038332830_12184383($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['include_tpl']->value)."/includes/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


<!--sidebar-->
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['include_tpl']->value)."/includes/sidebar.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

<!--/sidebar-->

<!--Page Container-->
<section class="main-container">	
    
    <!--Page Header-->
    <div class="header">
        <div class="header-content">
            <div class="page-title">
                <i class="icon-table position-left"></i> <?php echo $_smarty_tpl->tpl_vars['title']->value;?>

            </div>
            <ul class="breadcrumb">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['adminweburl']->value;?>
">Beranda</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['adminweburl']->value;?>
/dashboard/"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
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

                    <div class="panel-body">
                        <div id="wrapper" class="row" style="margin: 5px;">                    
                            <div id="alert_error" class="form-group" style="display: none;">
                                <div class="alert alert-danger">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label for="title">Judul:</label>
                                <input type="text" value="<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['title'];
}?>" class="form-control" name="title" placeholder="" />
                            </div>
                            
                            <div class="form-group">
                                <label for="konten">Detail Konten:</label>
                                <div class="summernote"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="title">Link Download:</label>
                                <input type="text" value="<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['link_download'];
}?>" class="form-control" name="link_download" placeholder="" />
                            </div>

                            <div class="form-group">
                                <label for="videoId">Video ID Youtube:</label>
                                <input type="text" value="<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['videoId'];
}?>" class="form-control" name="videoId" placeholder="" />
                            </div>

                            <div class="form-group">
                                <label for="duration">Durasi Video:</label>
                                <input type="text" value="<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['duration'];
}?>" class="form-control" name="duration" placeholder="" />
                            </div>
                            
                            <div class="form-group">
                                <label for="kategori">Kategori Konten:</label>
                                <select multiple class="form-control" name="id_kategori" style="height: 200px;">
                                    <?php  $_smarty_tpl->tpl_vars['entry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['datacategory']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->key => $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->_loop = true;
?>
                                        <option <?php if ($_smarty_tpl->tpl_vars['entry']->value['id_parent']==0) {?>style="font-weight: bold;"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['entry']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true&&$_smarty_tpl->tpl_vars['entry']->value['is_select']=='Y') {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['entry']->value['nama'];?>
</option>                                        
                                    <?php } ?>                            
                                </select>
                                <label>Gunakan tombol Ctrl untuk pilih lebih dari 1 kategori.</label>
                            </div>

                            <div class="form-group">
                                <label for="banner">Banner yang Terkait:</label>
                                <select multiple class="form-control" name="id_banner" style="height: 200px;">
                                    <?php  $_smarty_tpl->tpl_vars['entry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['databanner']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->key => $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->_loop = true;
?>
                                        <option style="font-weight: bold;" value="<?php echo $_smarty_tpl->tpl_vars['entry']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true&&$_smarty_tpl->tpl_vars['entry']->value['is_select']=='Y') {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['entry']->value['nama'];?>
</option>                                        
                                    <?php } ?>                            
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
                                <label class="control-label"><input type="checkbox" name="tabpanel_1" <?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true&&$_smarty_tpl->tpl_vars['data']->value[0]['tabpanel_1']==1) {?>checked<?php }?> />&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['tabmenu']->value[0]['nama'];?>
</label><br />
                                <label class="control-label"><input type="checkbox" name="tabpanel_2" <?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true&&$_smarty_tpl->tpl_vars['data']->value[0]['tabpanel_2']==1) {?>checked<?php }?> />&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['tabmenu']->value[1]['nama'];?>
</label><br />
                                <label class="control-label"><input type="checkbox" name="tabpanel_3" <?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true&&$_smarty_tpl->tpl_vars['data']->value[0]['tabpanel_3']==1) {?>checked<?php }?> />&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['tabmenu']->value[2]['nama'];?>
</label><br />
                                <label class="control-label"><input type="checkbox" name="tabpanel_4" <?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true&&$_smarty_tpl->tpl_vars['data']->value[0]['tabpanel_4']==1) {?>checked<?php }?> />&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['tabmenu']->value[3]['nama'];?>
</label><br />
                                <label class="control-label"><input type="checkbox" name="tabpanel_5" <?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true&&$_smarty_tpl->tpl_vars['data']->value[0]['tabpanel_5']==1) {?>checked<?php }?> />&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['tabmenu']->value[4]['nama'];?>
</label><br />
                                <label class="control-label"><input type="checkbox" name="tabpanel_6" <?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true&&$_smarty_tpl->tpl_vars['data']->value[0]['tabpanel_6']==1) {?>checked<?php }?> />&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['tabmenu']->value[5]['nama'];?>
</label><br />
                            </div>

                            <div class="form-group">
                                <label for="is_aktif">Tampilkan:</label>
                                <select name="is_aktif" class="form-control">
                                    <option value="0" <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['is_aktif']==0) {?> selected="selected" <?php }?>>TIDAK</option>
                                    <option value="1" <?php if ($_smarty_tpl->tpl_vars['data']->value[0]['is_aktif']==1) {?> selected="selected" <?php }?>>YA</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td width="100%">&nbsp;</td> 
                                            <td nowrap>
                                                <div id="i_loading" class="G-btn-animation" style="display: none;"><img src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/img/loading.gif" /></div>                  
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
    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['include_tpl']->value)."/includes/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

    <!--/Footer-->
		
</section>
<!--/Page Container-->

<a id="scrollTop" href="index1.htm#top"><i class="icon-arrow-up12"></i></a>	

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

<!-- Page scripts -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/js/jquery.cropit.js"><?php echo '</script'; ?>
>

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

<!-- Page scripts -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/bootstrap-fileinput/js/fileinput.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/js/jquery.input.formatter.js"><?php echo '</script'; ?>
>  

<!-- include summernote -->
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
<link href="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/datepick/jquery.datepick.css" rel="stylesheet">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/datepick/jquery.plugin.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/assets/datepick/jquery.datepick.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">
    $(function () {

        var isEdit = <?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {?>true<?php } else { ?>false<?php }?>;
        $('.image-editor-banner').cropit({
          smallImage: 'stretch'<?php if ($_smarty_tpl->tpl_vars['data']->value[0]['banner']!='') {?>,
          imageState: {
            src: '<?php echo $_smarty_tpl->tpl_vars['homeurl']->value;?>
/uploads/konten/banner/<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['banner'];?>
',
          }<?php }?>
        });
        
        $('.image-editor-thumbnail').cropit({
          smallImage: 'stretch'<?php if ($_smarty_tpl->tpl_vars['data']->value[0]['thumbnail']!='') {?>,
          imageState: {
            src: '<?php echo $_smarty_tpl->tpl_vars['homeurl']->value;?>
/uploads/konten/thumbnail/<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['thumbnail'];?>
',
          }<?php }?>
        });


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

        $(".summernote").code('<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['konten'];
}?>');

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
            data.append('id', isEdit?'<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['id'];?>
':'');
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
<?php echo '</script'; ?>
>
</body>
</html><?php }} ?>
