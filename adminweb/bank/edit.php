<?php
    $root = "../../";
    include $root."includes/php/initial.php";    
    if(!isset($_SESSION[ADMIN_SESSION_NAME])) {
        header("location: ".ADMINWEB_URL);
        die();
    }
    include $root."includes/php/classUtama.php";
    include SMARTY_DIR."Smarty.class.php";
    
    
    $smarty = new Smarty;        
    //$smarty->force_compile = true;
    //$smarty->debugging = true;
    $smarty->caching = true;
    $smarty->cache_lifetime = 0;
    
    $smarty->assign("homeurl", HOME_URL); 
    $smarty->assign("adminweburl", ADMINWEB_URL); 
    $smarty->assign("data_user", $_SESSION[ADMIN_SESSION_NAME]["user"]);
    $smarty->assign("tpl_dir", HOME_URL."/templates/".BACK_END_TEMPLATE);
    $smarty->assign("include_tpl", BACK_END_TEMPLATE_INCLUDE_PATH);
        
    //DATABASE CONNECTION
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $id = $db->checkIntegerRange($_GET["id"])?$_GET["id"]:0;
    if($id==0) {
        header("location: ".ADMINWEB_URL."/bank/");
        die();
    }
    
    $data = $db->getFieldValue("bank_transfer", array("id", "no_rekening", "nama_pemilik_rekening", "nama_bank", "cabang", "gambar AS logo_bank"), array("id" => $id));
    $smarty->assign("isEdit", true);
    $smarty->assign("data", $data);
    
    $smarty->assign("page_selected", "pengaturan");
    $smarty->assign("sub_page_selected", "bank");    
    $smarty->assign("title", "Metode Pembayaran");
    $smarty->assign("sub_title", "Edit Metode Pembayaran");
    
    $id_menu = 23; $aksi = "E";
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/bank/edit.html");    