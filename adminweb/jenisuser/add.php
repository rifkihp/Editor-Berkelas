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
    
    $data_akses = $db->getFieldValue("menu_akses", array("kode", "keterangan"));
    $array_akses = array();
    foreach ($data_akses as $key => $value) {
        $array_akses[$value["kode"]] = $value["keterangan"];
    }
    
    //$data_menu = $db->getFieldValue("menu AS A LEFT JOIN menu AS B ON A.parent_id=B.id", array("A.*", "B.nama AS parent_nama"), array("A.is_menu" => "Y"), array(), 0, 0, "A.urutan, B.urutan");
    $data_menu = $db->getFieldValue("menu AS A", array("A.*"), array("A.parent_id" => 0), array(), 0, 0, "A.urutan");
    $menu = array();
    foreach ($data_menu as $key => $value) {
        $akses = array();
        for($i=0; $i<strlen($value["akses"]); $i++) {
            $akses[$i] = array(
                "id" => $value["akses"][$i],
                "keterangan" => $array_akses[$value["akses"][$i]]  
            );
        }
        
        $menu[count($menu)] = array(
            "id" => $value["id"],
            "parent_id" => $value["parent_id"],
            "nama" => "<b>".$value["nama"]."</b>",
            "akses" => $akses
        );
        
        $data_submenu = $db->getFieldValue("menu AS A", array("A.*"), array("A.parent_id" => $value["id"]), array(), 0, 0, "A.urutan");
        foreach ($data_submenu as $key_sub => $value_sub) {
            $akses = array();
            for($i=0; $i<strlen($value_sub["akses"]); $i++) {
                $akses[$i] = array(
                    "id" => $value_sub["akses"][$i],
                    "keterangan" => $array_akses[$value_sub["akses"][$i]]  
                );
            }

            $menu[count($menu)] = array(
                "id" => $value_sub["id"],
                "parent_id" => $value_sub["parent_id"], 
                "nama" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$value_sub["nama"], 
                "akses" => $akses
            );

        }
    }
    
    $smarty->assign("menu", $menu);    
    $smarty->assign("page_selected", "managemen_user");
    $smarty->assign("sub_page_selected", "user");
    $smarty->assign("title", "User");
    $smarty->assign("sub_title", "Add new User");
    
    $id_menu = 32; $aksi = "T";
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/jenisuser/edit.html");    