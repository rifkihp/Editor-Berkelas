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
        $db->mysql_close();
        header("location: ".ADMINWEB_URL."/message_out/");
        die();
    }
    
    $data = $db->getFieldValue("message AS A LEFT JOIN member AS B ON A.to=B.id", array("A.id", "DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y %H:%i:%s') AS tanggal", "A.from", "CONCAT(B.first_name, ' ', B.last_name) AS to_name", "B.email AS to_email", "A.judul", "A.pesan", "A.status"), array("A.id" => $id));
    if(count($data)==0) {
        $db->mysql_close();
        header("location: ".ADMINWEB_URL."/message_out/");
        die();
    }
        
    
    $smarty->assign("data", $data[0]);
    $smarty->assign("isEdit", true);
    $smarty->assign("page_selected", "message");
    $smarty->assign("sub_page_selected", "message");    
    $smarty->assign("title", "Message");
    $smarty->assign("sub_title", "Detail Message Out");
    
    $id_menu = 17;
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/message/detail.html");    