<?php
    $root = "../../";
    include $root."includes/php/initial.php";    
    if(!isset($_SESSION[ADMIN_SESSION_NAME])) {
        header("location: ".ADMINWEB_URL);
        die();
    }
    include $root."includes/php/classUtama.php";
    include $root."includes/php/rajaOngkir.php";
    
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
    
    $data = $db->getFieldValue("umum AS A", array("A.id", "A.judul", "A.tagline", "A.email", "A.telepon", "A.website", "A.no_hp", "A.address AS alamat", "A.syarat_kondisi", "A.propinsi", "A.kota", "A.kode_pos", "A.latitude", "A.longitude", "A.detail", "A.avatar", "A.logo", "A.bg", "A.landing_page", "A.tampilkan_shortcut", "A.tampilkan_kategori", "A.aktivasi_sms", "A.aktivasi_admin"));
    $data[0]["detail"] = preg_replace("/\r\n|\r|\n/",'<br/>',addslashes($data[0]["detail"]));
    $data[0]["syarat_kondisi"] = preg_replace("/\r\n|\r|\n/",'<br/>',addslashes($data[0]["syarat_kondisi"]));
     
    $smarty->assign("isEdit", true);
    $smarty->assign("data", $data);
    $smarty->assign("page_selected", "pengaturan");
    $smarty->assign("sub_page_selected", "umum");    
    $smarty->assign("title", "Umum");
    $smarty->assign("sub_title", "Edit Umum");
    
    $id_menu = 22; $aksi = "E";
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/pengaturan/edit.html");    