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
    
    $id = $db->checkIntegerRange($_GET["id"])?$_GET["id"]:"";
    $data = $db->getFieldValue("informasi AS A", 
        array(
            "A.id", 
            "DATE_FORMAT(A.tanggal, '%d-%m-%Y') AS tanggal", 
            "A.judul", 
            "A.konten", 
            "A.gambar", 
            "A.is_notif"
        ), 
        array("A.id" => $id)
    );
    
    if($id==0) {
        header("location: ".ADMINWEB_URL."/informasi/");
        die();
    }
    
    $smarty->assign("data", $data);
    $smarty->assign("page_selected", "informasi");
    $smarty->assign("sub_page_selected", "informasi");    
    $smarty->assign("title", "Informasi");
    $smarty->assign("sub_title", "Add new Informasi");
    $smarty->assign("isEdit", true);
    $smarty->assign("kode_token", $db->create_kode_unik());
    
    $id_menu = 26; $aksi = "T";
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/informasi/edit.html");    