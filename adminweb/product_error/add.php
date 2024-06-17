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
            
    $datacategory = array();    
    $category = $db->getFieldValue("category AS A", array("id", "nama", "id_parent"), array("id_parent" => 0));
    foreach ($category as $key => $value) {
        $datacategory[count($datacategory)] = $value;
        $sub_category = $db->getFieldValue("category AS A", array("id", "concat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',nama) AS nama", "id_parent"), array("id_parent" => $value['id']));
        foreach ($sub_category as $key_ => $value_) {
            $datacategory[count($datacategory)] = $value_;
        }
    }
    
    $listgrosir = array(
        array("jumlah_min" => "0", "jumlah_max" => "0", "harga" => "0")     
    );
    
    $listvarian = array(
        array("ukuran" => "", "warna" => "", "jumlah" => "0")     
    );
    
    $listbrand = $db->getFieldValue("brand", array("id", "kode", "nama"));
    
    $listjenisuser = $db->getFieldValue("jenis_user", array("id AS id_jenis_user", "nama AS jenis_user", "0 AS harga_jual"), array(), array(), 0, 0, "", "id>1");
    $smarty->assign("listjenisuser", $listjenisuser);
    $smarty->assign("listvarian", $listvarian);
    $smarty->assign("listbrand", $listbrand);
    $smarty->assign("listgrosir", $listgrosir);
    $smarty->assign("datacategory", $datacategory);
    $smarty->assign("page_selected", "katalog");
    $smarty->assign("sub_page_selected", "product");    
    $smarty->assign("title", "Product");
    $smarty->assign("sub_title", "Add new Product");
    
    $id_menu = 14; $aksi = "T";
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/product/edit.html");    