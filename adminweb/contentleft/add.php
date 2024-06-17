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
    
    $data_tipe = array(
        array("tipe" => "Kategori"),
        array("tipe" => "Pembayaran"),
        array("tipe" => "Ekspedisi")
    );
    $smarty->assign("listtipe", $data_tipe);
    
    
    $datacategory = array();    
    $category = $db->getFieldValue("category AS A", array("id", "nama", "id_parent"), array("id_parent" => 0));
    foreach ($category as $key => $value) {
        $datacategory[count($datacategory)] = $value;
        $sub_category = $db->getFieldValue("category AS A", array("id", "concat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',nama) AS nama", "id_parent"), array("id_parent" => $value['id']));
        foreach ($sub_category as $key_ => $value_) {
            $datacategory[count($datacategory)] = $value_;
        }
    }
    $smarty->assign("datacategory", $datacategory);
    $smarty->assign("sidebar_select", array("is_select" => true, "selected" => "category"));
    
    $data = $db->getFieldValue("widget AS A LEFT JOIN category AS B ON A.id_kategori=B.id", array("A.id", "A.judul", "A.tipe", "A.id_kategori", "B.nama"), array("letak" => "Kiri"), array(), 0, 0, " A.urutan ");
    $smarty->assign("listwidget", $data);
    
    $smarty->assign("page_selected", "widget");
    $smarty->assign("sub_page_selected", "contentleft");    
    $smarty->assign("title", "Left Widget");
    $smarty->assign("sub_title", "Add new Left Widget");
    
    $id_menu = 10; $aksi = "T";
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/contentleft/edit.html");  