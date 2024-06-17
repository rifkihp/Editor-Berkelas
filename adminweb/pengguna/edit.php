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
    
    $data = $db->getFieldValue(
        "user AS A LEFT JOIN usergrup AS B ON A.idgrup=B.id", 
        array(
            "A.id",
            "A.nama",
            "A.email",
            "A.idgrup",
            "A.userid"
        ), 
        array("A.id" => $_GET["id"])
    );
    $data_grup = $db->getFieldValue("usergrup AS A", array("id", "nama", "keterangan"));
    
    $smarty->assign('isEdit', true);
    $smarty->assign('data', $data);
    $smarty->assign("grupuser", $data_grup);   
    $smarty->assign("page_selected", "managemen_user");
    $smarty->assign("sub_page_selected", "user");
    $smarty->assign("title", "User");
    $smarty->assign("sub_title", "Edit User");
    
    $id_menu = 33; $aksi = "E";
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/pengguna/edit.html");    