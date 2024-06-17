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
        header("location: ".ADMINWEB_URL."/kartanews/");
        die();
    }
    
    $data = $db->getFieldValue("kartanews AS A", array("A.id", "A.kategori_id", "A.is_new","DATE_FORMAT(A.tanggal, '%d-%m-%Y') AS tanggal", "A.judul", "A.konten", "A.gambar AS file_gambar"), array("id" => $id));
    $data[0]["konten"] = addcslashes(preg_replace("/\r\n|\r|\n/", '', $data[0]["konten"]), "'") ;
    
    $data_kategori = $db->getFieldValue("kartanews_category", array("id", "nama"));
    
    $smarty->assign("datacategory", $data_kategori);
    
    $smarty->assign("isEdit", true);
    $smarty->assign("data", $data);
    $smarty->assign("page_selected", "konten");
    $smarty->assign("sub_page_selected", "kartanews");    
    $smarty->assign("title", "Kartanews");
    $smarty->assign("sub_title", "Edit Kartanews");
    
    $id_menu = 37; $aksi = "E";
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/kartanews/edit.html");    