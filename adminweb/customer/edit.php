<?php
    $root = "../../";
    include $root."includes/php/initial.php";    
    if(!isset($_SESSION[ADMIN_SESSION_NAME])) {
        header("location: ".ADMINWEB_URL);
        die();
    }
    include $root."includes/php/classUtama.php";
    include SMARTY_DIR."Smarty.class.php";
    include $root."includes/php/rajaOngkir.php";
    
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
        header("location: ".ADMINWEB_URL."/customer/");
        die();
    }
    
    $jenis_user = $db->getFieldValue("jenis_user", array("id", "nama"));
    $smarty->assign("jenis_user", $jenis_user);
    
    //GET PROPINSI
    $ro = new rajaOngkir(RAJA_ONGKIR_TYP, RAJA_ONGKIR_KEY);
    $smarty->assign("listpropinsi", $ro->getPropinsi());
    
    $detail = $db->getFieldValue("member AS A LEFT JOIN customer_address AS B ON A.id=B.id_member AND TRIM(UPPER(CONCAT(A.first_name, ' ', A.last_name)))=TRIM(UPPER(B.nama))", 
            array("A.id", "A.first_name", "A.last_name", "A.email", "A.jenis_user", "A.photo", "IF(A.aktif=1 AND admin=1, 1, 0) AS aktif", "B.alamat", "B.no_hp", "B.id_propinsi", "B.nama_propinsi", "B.id_kota", "B.nama_kota", "B.id_kecamatan", "B.nama_kecamatan", "B.kode_pos"), 
            array("A.id" => $id));
    
    $db->mysql_update("member", array("is_open" => 1), array("id" => $id));
    $smarty->assign("isEdit", true);
    $smarty->assign("data", $detail);
    
    $smarty->assign("page_selected", "customer");
    $smarty->assign("sub_page_selected", "customer");    
    $smarty->assign("title", "Customer");
    $smarty->assign("sub_title", "Edit Customer");
    
    $id_menu = 7; $aksi = "E";
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/customer/edit.html");    