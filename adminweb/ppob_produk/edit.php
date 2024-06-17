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
        header("location: ".ADMINWEB_URL."/ppob_produk/");
        die();
    }
    
    $listprovider = $db->getFieldValue("ppob_provider", array("kode"));
    $smarty->assign("listprovider", $listprovider);
    
    $data = $db->getFieldValue("ppob_produk", array("id", "provider", "provider_sub", "code", "description", "price", "jual"), array("id" => $id));
    $data[0]["price"] = number_format($data[0]["price"], 0, '.', ',');
    $data[0]["jual"] = number_format($data[0]["jual"], 0, '.', ',');
    $smarty->assign("isEdit", true);
    $smarty->assign("data", $data);
    
    $smarty->assign("page_selected", "ppob");
    $smarty->assign("sub_page_selected", "ppob_produk");    
    $smarty->assign("title", "PPOB");
    $smarty->assign("sub_title", "Edit Produk");
    
    $id_menu = 45; $aksi = "E";
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/ppob_produk/edit.html");    