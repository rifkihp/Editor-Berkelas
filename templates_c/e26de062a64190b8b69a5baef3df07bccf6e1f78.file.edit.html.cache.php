<?php /* Smarty version Smarty-3.1.21-dev, created on 2021-06-07 11:18:36
         compiled from "..\..\templates\back-end\penguin\category\edit.html" */ ?>
<?php /*%%SmartyHeaderCode:157357872560bd4fd7779f31-79716360%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e26de062a64190b8b69a5baef3df07bccf6e1f78' => 
    array (
      0 => '..\\..\\templates\\back-end\\penguin\\category\\edit.html',
      1 => 1623039510,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157357872560bd4fd7779f31-79716360',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_60bd4fd7806b96_61957167',
  'variables' => 
  array (
    'title' => 0,
    'adminweburl' => 0,
    'sub_title' => 0,
    'isEdit' => 0,
    'data' => 0,
    'datacategory' => 0,
    'entry' => 0,
    'tpl_dir' => 0,
    'homeurl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_60bd4fd7806b96_61957167')) {function content_60bd4fd7806b96_61957167($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['include_tpl']->value)."/includes/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

	
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
/category/"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
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
                    
                    <div class="form-group panel-body no-padding-bottom">
                        <div id="alert_error" class="form-group" style="display: none;">
                            <div class="alert alert-danger">&nbsp;</div>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Kategori:</label>
                            <input type="text" value="<?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['nama'];
}?>" class="form-control" name="nama" placeholder="" />
                        </div>

                        <!-- div class="form-group">
                            <label for="penjelasan">Penjelasan:</label>
                            <textarea class="form-control" style="height: 120px" name="penjelasan"><?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {
echo $_smarty_tpl->tpl_vars['data']->value[0]['penjelasan'];
}?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="induk">Induk Kategori:</label>
                            <select class="form-control" name="id_parent">
                                <option value="0" <?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true&&$_smarty_tpl->tpl_vars['data']->value[0]['id_parent']=="0") {?> selected="selected" <?php }?>>Tidak Ada</option>
                                <?php  $_smarty_tpl->tpl_vars['entry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['datacategory']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->key => $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['entry']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true&&$_smarty_tpl->tpl_vars['data']->value[0]['id_parent']==$_smarty_tpl->tpl_vars['entry']->value['id']) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['entry']->value['nama'];?>
</option>                                        
                                <?php } ?>
                            </select>
                        </div -->

                        <div class="form-group">
                            <label for="gambar">Gambar:</label>                        
                            <style type="text/css">
                                .cropit-image-preview {
                                    border:1px solid #a6bac4;
                                    width: 300px;
                                    height: 300px;
                                    cursor: move;
                                }

                                .H-new-kol-post-img {
                                    width: 300px;
                                    height: 300px;
                                }
                            </style>

                            <div class="H-new-kol-post-img image-editor">
                                <input id="fileupload_gambar" type="file" name="fileupload_gambar" style="display:none;" class="cropit-image-input" />
                                <div class="cropit-image-preview"></div>
                            </div>
                            <label>Ukuran 300 X 300 px</label><br />   
                            <div id="upload_gambar" class="btn btn-primary">Upload</div>
                        </div><div class="form-group">
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
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/jquery.cropit.js"><?php echo '</script'; ?>
>  

<?php echo '<script'; ?>
 type="text/javascript">
    $(function () {
        var isEdit = <?php if ($_smarty_tpl->tpl_vars['isEdit']->value==true) {?>true<?php } else { ?>false<?php }?>;
        $('.image-editor').cropit({
          smallImage: 'stretch',
          imageState: {
            src: '<?php echo $_smarty_tpl->tpl_vars['homeurl']->value;?>
/uploads/category/<?php if ($_smarty_tpl->tpl_vars['data']->value[0]['header']!='') {
echo $_smarty_tpl->tpl_vars['data']->value[0]['header'];
} else { ?>default.png<?php }?>',
          }
        });

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
            data.append('id', isEdit?'<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['id'];?>
':'');
            data.append('nama', $('[name=nama]').val());
            //data.append('penjelasan', $('[name=penjelasan]').val());
            //data.append('id_parent', $('[name=id_parent]').val());
            
            var imageData = $('.image-editor').cropit('export');
            data.append('filename_gambar', imageData==undefined?'':imageData);

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

        $('#upload_gambar').click(function(){
            $('#fileupload_gambar').trigger('click'); 
            return false;
        });

    });
<?php echo '</script'; ?>
>
</body>
</html><?php }} ?>
