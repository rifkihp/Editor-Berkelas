<?php /* Smarty version Smarty-3.1.21-dev, created on 2021-06-07 05:21:47
         compiled from "..\..\templates\back-end\penguin\video\list.html" */ ?>
<?php /*%%SmartyHeaderCode:30021716060bd4a7bec43e2-16991670%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a613f430a16dadec0547b6223a8519757604e51' => 
    array (
      0 => '..\\..\\templates\\back-end\\penguin\\video\\list.html',
      1 => 1606019785,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30021716060bd4a7bec43e2-16991670',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'adminweburl' => 0,
    'sub_title' => 0,
    'query' => 0,
    'array_akses' => 0,
    'listdetail' => 0,
    'entry' => 0,
    'limitpage' => 0,
    'currentpage' => 0,
    'no' => 0,
    'homeurl' => 0,
    'totalpage' => 0,
    'jenis_kartacare' => 0,
    'frompage' => 0,
    'untilpage' => 0,
    'item' => 0,
    'tpl_dir' => 0,
    'alert_success' => 0,
    'alert_error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_60bd4a7c06c417_00485605',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_60bd4a7c06c417_00485605')) {function content_60bd4a7c06c417_00485605($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['include_tpl']->value)."/includes/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


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
        <div class="panel panel-flat">

            <div class="form-group panel-body no-padding-bottom">
                <div class="form-group">
                    <table style="width: 100%;">
                        <tr>
                            <td width="100%">
                                <table>
                                    <tr>
                                        <td width="100%"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['query']->value;?>
" class="form-control" name="query" id="query" placeholder="Masukan kata kunci pencarian..." /></td>
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
                    <?php if (in_array('T',$_smarty_tpl->tpl_vars['array_akses']->value)) {?><div id='btn_add' class="btn btn-primary">Baru</div><?php }?>
                    <?php if (in_array('E',$_smarty_tpl->tpl_vars['array_akses']->value)) {?><div id='btn_edit' class="btn btn-success disabled">Edit</div><?php }?>
                    <?php if (in_array('H',$_smarty_tpl->tpl_vars['array_akses']->value)) {?><div id='btn_delete' class="btn btn-danger disabled">Hapus</div><?php }?>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-togglable table-hover">
                    <thead>
                        <tr>
                            <th  width="1%"><input type="checkbox" id="select_all" /></th>
                            <th data-toggle="false" width="1%"><div style="text-align: center;">No.</div></th>
                            <th width="15%"><div style="text-align: center;">Thumbnail</div></th>                            
                            <th width="67%"><div style="text-align: left;">Detail</div></th>
                            <th width="5%"><div style="text-align: center;">Tampil</div></th>

                            <th data-hide="phone, tablet" width="10%"><div style="text-align: center;">Aksi</div></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $_smarty_tpl->tpl_vars["no"] = new Smarty_variable(1, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['entry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listdetail']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->key => $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->_loop = true;
?>
                            <tr id="baris_<?php echo $_smarty_tpl->tpl_vars['entry']->value['id'];?>
">
                                <td align="center"><input type="checkbox" id_select="<?php echo $_smarty_tpl->tpl_vars['entry']->value['id'];?>
" name="select_<?php echo $_smarty_tpl->tpl_vars['entry']->value['id'];?>
" class="select" /></td>
                                <td align="center"><small><?php echo $_smarty_tpl->tpl_vars['limitpage']->value*($_smarty_tpl->tpl_vars['currentpage']->value-1)+$_smarty_tpl->tpl_vars['no']->value;?>
</small></td>
                                <td align="left">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['homeurl']->value;?>
/store/centercrop_3.php?id=<?php echo $_smarty_tpl->tpl_vars['entry']->value['videoId'];?>
" height="135px" />
                                </td>
                                <td style="text-align: left; vertical-align: top;">
                                    
                                        <div style="margin-bottom: 3px;"><b><i><?php echo $_smarty_tpl->tpl_vars['entry']->value['title'];?>
</i></b></div>
                                        <?php if ($_smarty_tpl->tpl_vars['entry']->value['tv_show']==1) {?><span class="btn label bg-green">TV SHOW</span><?php }?>
                                    
                                        <?php if ($_smarty_tpl->tpl_vars['entry']->value['movies']==1) {?><span class="btn label bg-yellow">MOVIES</span><?php }?>
                                    
                                        <?php if ($_smarty_tpl->tpl_vars['entry']->value['cultures']==1) {?><span class="btn label bg-red">NEWS: Culture</span><?php }?>
                                    
                                        <?php if ($_smarty_tpl->tpl_vars['entry']->value['politics']==1) {?><span class="btn label bg-red">NEWS: Politics</span><?php }?>
                                    
                                        <?php if ($_smarty_tpl->tpl_vars['entry']->value['entertainment']==1) {?><span class="btn label bg-red">NEWS: Entertainment</span><?php }?>
                                    
                                        <?php if ($_smarty_tpl->tpl_vars['entry']->value['others']==1) {?><span class="btn label bg-red">NEWS: Others</span><?php }?>
                                
                                </td>

                                <td style="text-align: center; vertical-align: top;">
                                    
                                    <?php if ($_smarty_tpl->tpl_vars['entry']->value['is_aktif']==1) {?>
                                        <span class="btn bg-green">ON</span>
                                    <?php } else { ?>
                                        <span class="btn bg-red">OFF</span>
                                    <?php }?>
                                
                                </td>

                                <td style="text-align: center; vertical-align: top;"><div style="text-align: center;  white-space: nowrap;">
                                    <?php if (in_array('E',$_smarty_tpl->tpl_vars['array_akses']->value)) {?>
                                        <div id_select="<?php echo $_smarty_tpl->tpl_vars['entry']->value['id'];?>
" class="btn btn-success edit">Edit</div>
                                    <?php }?>
                                    <?php if (in_array('H',$_smarty_tpl->tpl_vars['array_akses']->value)) {?><div id_select="<?php echo $_smarty_tpl->tpl_vars['entry']->value['id'];?>
" class="btn btn-danger hapus">Hapus</div><?php }?>                                                        
                                </div></td>
                            </tr>
                            <?php $_smarty_tpl->tpl_vars["no"] = new Smarty_variable($_smarty_tpl->tpl_vars['no']->value+1, null, 0);?>
                        <?php } ?>
                    </tbody>

                    <?php if ($_smarty_tpl->tpl_vars['totalpage']->value>1) {?>
                    <tfoot><tr><th colspan="7">
                        <div style="text-align: center;">
                            <?php if ($_smarty_tpl->tpl_vars['currentpage']->value>1) {?>                                
                                <a class="btn btn-default" href="list.php?page=<?php echo $_smarty_tpl->tpl_vars['currentpage']->value-1;
if ($_smarty_tpl->tpl_vars['query']->value!='') {?>&query=<?php echo $_smarty_tpl->tpl_vars['query']->value;
}
if ($_smarty_tpl->tpl_vars['jenis_kartacare']->value!='') {?>&jenis_kartacare=<?php echo $_smarty_tpl->tpl_vars['jenis_kartacare']->value;
}?>">&larr; Prev</a>
                            <?php }?>
                            <?php $_smarty_tpl->tpl_vars["item"] = new Smarty_variable($_smarty_tpl->tpl_vars['frompage']->value, null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int) ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? $_smarty_tpl->tpl_vars['untilpage']->value+1 - ($_smarty_tpl->tpl_vars['frompage']->value) : $_smarty_tpl->tpl_vars['frompage']->value-($_smarty_tpl->tpl_vars['untilpage']->value)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0) {
for ($_smarty_tpl->tpl_vars['foo']->value = $_smarty_tpl->tpl_vars['frompage']->value, $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++) {
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration == 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration == $_smarty_tpl->tpl_vars['foo']->total;?>
                                <?php if ($_smarty_tpl->tpl_vars['item']->value==$_smarty_tpl->tpl_vars['currentpage']->value) {?>
                                    <span class="btn btn-info"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</span>                                
                                <?php } else { ?>
                                    <a class="btn btn-default" href="list.php?page=<?php echo $_smarty_tpl->tpl_vars['item']->value;
if ($_smarty_tpl->tpl_vars['query']->value!='') {?>&query=<?php echo $_smarty_tpl->tpl_vars['query']->value;
}
if ($_smarty_tpl->tpl_vars['jenis_kartacare']->value!='') {?>&jenis_kartacare=<?php echo $_smarty_tpl->tpl_vars['jenis_kartacare']->value;
}?>"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</a>
                                <?php }?>
                                <?php $_smarty_tpl->tpl_vars["item"] = new Smarty_variable($_smarty_tpl->tpl_vars['item']->value+1, null, 0);?>                                
                            <?php }} ?>
                            <?php if ($_smarty_tpl->tpl_vars['totalpage']->value>$_smarty_tpl->tpl_vars['currentpage']->value) {?>                                
                                <a class="btn btn-default" href="list.php?page=<?php echo $_smarty_tpl->tpl_vars['currentpage']->value+1;
if ($_smarty_tpl->tpl_vars['query']->value!='') {?>&query=<?php echo $_smarty_tpl->tpl_vars['query']->value;
}
if ($_smarty_tpl->tpl_vars['jenis_kartacare']->value!='') {?>&jenis_kartacare=<?php echo $_smarty_tpl->tpl_vars['jenis_kartacare']->value;
}?>">Next &rarr;</a>
                            <?php }?>
                        </div>
                    </th></tr></tfoot>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>

    <!--Footer -->
    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['include_tpl']->value)."/includes/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

    <!--/Footer-->

</section>
<!--/Page Container-->

<a id="scrollTop" href="tables_responsive.htm#top"><i class="icon-arrow-up12"></i></a>	

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
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/moment.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/legacy.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/forms/daterangepicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/forms/picker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/forms/picker.date.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/forms/picker.time.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/forms/spectrum.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/pages/pickers.js"><?php echo '</script'; ?>
>
<!-- Page scripts -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/tables/footable.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl_dir']->value;?>
/js/pages/tables_responsive.js"><?php echo '</script'; ?>
>

<!-- /page scripts -->
<?php echo '<script'; ?>
 type="text/javascript">

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
                            window.location='list.php<?php if ($_smarty_tpl->tpl_vars['query']->value!='') {?>?query=<?php echo $_smarty_tpl->tpl_vars['query']->value;
}?>';
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
                        window.location='list.php<?php if ($_smarty_tpl->tpl_vars['query']->value!='') {?>?query=<?php echo $_smarty_tpl->tpl_vars['query']->value;
}?>';
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

        <?php if ($_smarty_tpl->tpl_vars['alert_success']->value!='') {?>setMessage('success', '<?php echo $_smarty_tpl->tpl_vars['alert_success']->value;?>
');<?php }?>        
        <?php if ($_smarty_tpl->tpl_vars['alert_error']->value!='') {?>setMessage('error', '<?php echo $_smarty_tpl->tpl_vars['alert_error']->value;?>
');<?php }?> 
    });
<?php echo '</script'; ?>
>
</body>
</html><?php }} ?>
