<?php /* Smarty version Smarty-3.1.21-dev, created on 2020-11-10 14:03:58
         compiled from "D:\www\wtvindonesia\templates\back-end\penguin\includes\sidebar.html" */ ?>
<?php /*%%SmartyHeaderCode:2160153545fa998b8537945-02355955%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb6565f707d8128c78d1473f962285089a5d3245' => 
    array (
      0 => 'D:\\www\\wtvindonesia\\templates\\back-end\\penguin\\includes\\sidebar.html',
      1 => 1604991837,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2160153545fa998b8537945-02355955',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5fa998b855c3e6_35136546',
  'variables' => 
  array (
    'homeurl' => 0,
    'adminweburl' => 0,
    'data_user' => 0,
    'listmenu' => 0,
    'page_selected' => 0,
    'entry' => 0,
    'submenu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa998b855c3e6_35136546')) {function content_5fa998b855c3e6_35136546($_smarty_tpl) {?>	<aside class="sidebar">
            <div class="left-aside-container">
                <div class="user-profile-container">
                    <div class="user-profile clearfix">
                        <div class="admin-user-thumb">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['homeurl']->value;?>
/uploads/umum/default_logo.png" alt="admin" class="img-circle">
                        </div>
                        <div class="admin-user-info">
                            <ul class="user-info">
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['adminweburl']->value;?>
/logout.php" class="text-semibold text-size-large"><?php echo $_smarty_tpl->tpl_vars['data_user']->value['nama'];?>
</a></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['adminweburl']->value;?>
/logout.php"><small>Content Management</small></a></li>
                            </ul>
                            <div class="logout-icon"><a href="<?php echo $_smarty_tpl->tpl_vars['adminweburl']->value;?>
/logout.php"><i class="icon-exit2"></i></a></div>
                        </div>
                    </div>				
                </div>
                
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active fadeIn" id="menu">
                        <ul class="sidebar-accordion">
                            <li><br />&nbsp;&nbsp;&nbsp;</li>
                            <?php  $_smarty_tpl->tpl_vars['entry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listmenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->key => $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->_loop = true;
?>

                                <li<?php if ($_smarty_tpl->tpl_vars['page_selected']->value==$_smarty_tpl->tpl_vars['entry']->value['page_name']) {?> class="active acc-parent-li"<?php }?>>

                                    <a <?php if ($_smarty_tpl->tpl_vars['entry']->value['is_menu']!='Y') {?>class="acc-parent active"<?php }?> href="<?php if ($_smarty_tpl->tpl_vars['entry']->value['is_menu']=='Y') {
echo $_smarty_tpl->tpl_vars['adminweburl']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['entry']->value['url'];
} else { ?>#<?php }?>"><i class="icon-<?php echo $_smarty_tpl->tpl_vars['entry']->value['icon'];?>
"></i> <?php echo $_smarty_tpl->tpl_vars['entry']->value['nama'];?>
 <?php if (count($_smarty_tpl->tpl_vars['entry']->value['submenu'])>0) {?><span class="fa arrow"></span><?php }?></a>

                                    <?php if (count($_smarty_tpl->tpl_vars['entry']->value['submenu'])>0) {?>

                                        <ul>

                                        <?php  $_smarty_tpl->tpl_vars['submenu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['submenu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entry']->value['submenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['submenu']->key => $_smarty_tpl->tpl_vars['submenu']->value) {
$_smarty_tpl->tpl_vars['submenu']->_loop = true;
?>

                                            <li>

                                                <a href="<?php echo $_smarty_tpl->tpl_vars['adminweburl']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['submenu']->value['url'];?>
"><i class="fa fa-<?php echo $_smarty_tpl->tpl_vars['submenu']->value['icon'];?>
"></i> <?php echo $_smarty_tpl->tpl_vars['submenu']->value['nama'];?>
</a>

                                            </li>

                                        <?php } ?>

                                        </ul>

                                    <?php }?>

                                </li>

                            <?php } ?>						
                        </ul>
                    </div>
                </div>          
            </div>
	</aside>
<?php }} ?>
