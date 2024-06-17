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
        header("location: ".ADMINWEB_URL."/konten/");
        die();
    }

    //GETCATEGORY
    $datacategory = array();    
    $category = $db->getFieldValue("category AS A LEFT JOIN konten_to_category AS B ON B.id_kategori=A.id AND B.id_konten='$id'", array("A.id", "A.nama", "A.id_parent", "IF(B.id_kategori IS NOT NULL, 'Y', 'N') AS is_select"), array("A.id_parent" => 0));
    foreach ($category as $key => $value) {
        $datacategory[count($datacategory)] = $value;
        $sub_category = $db->getFieldValue("category AS A LEFT JOIN konten_to_category AS B ON B.id_kategori=A.id AND B.id_konten='$id'", array("A.id", "CONCAT('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', A.nama) AS nama", "A. id_parent", "IF(B.id_kategori IS NOT NULL, 'Y', 'N') AS is_select"), array("A.id_parent" => $value['id']));
        foreach ($sub_category as $key_ => $value_) {
            $datacategory[count($datacategory)] = $value_;
            $sub_sub_category = $db->getFieldValue("category AS A LEFT JOIN konten_to_category AS B ON B.id_kategori=A.id AND B.id_konten='$id'", array("A.id", "CONCAT('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', A.nama) AS nama", "A. id_parent", "IF(B.id_kategori IS NOT NULL, 'Y', 'N') AS is_select"), array("A.id_parent" => $value_['id']));
            foreach ($sub_sub_category as $key__ => $value__) {
                $datacategory[count($datacategory)] = $value__;
            }
            
        }
    }
    $smarty->assign("datacategory", $datacategory);

    //GETBANNER
    $databanner = array();    
    $banner = $db->getFieldValue("banner AS A LEFT JOIN konten_to_banner AS B ON B.id_banner=A.id AND B.id_konten='$id'", array("A.id", "A.nama", "IF(B.id_banner IS NOT NULL, 'Y', 'N') AS is_select"));
    foreach ($banner as $key => $value) {
        $databanner[count($databanner)] = $value;
    }
    $smarty->assign("databanner", $databanner);

    //TAB MENU
    $tabmenu = $db->getFieldValue("tabpanel AS A", array("A.id", "A.nama"), array(), array(), 0, 0, " A.id ASC "); 
    $smarty->assign("tabmenu", $tabmenu);
    
    //DATA KONTEN
    $data = $db->getFieldValue("konten", array(
        "id",
        "title",
        "videoId", 
        "duration",
        "konten",
        "link_download",
        "banner",
        "thumbnail",
        "tabpanel_1",
        "tabpanel_2",
        "tabpanel_3", 
        "tabpanel_4", 
        "tabpanel_5", 
        "tabpanel_6", 
        "is_aktif"
    ), array("id" => $id));
    $data[0]["konten"] = preg_replace("/\r\n|\r|\n/",'<br/>',addslashes($data[0]["konten"]));
    
    $smarty->assign("data", $data);
    
    $smarty->assign("isEdit", true);
    $smarty->assign("page_selected", "konten");
    $smarty->assign("sub_page_selected", "konten");
    $smarty->assign("title", "Konten");
    $smarty->assign("sub_title", "Edit Konten");
    
    $id_menu = 41; $aksi = "E";
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/konten/edit.html");    