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
    
    //GET PROPINSI
    $ro = new rajaOngkir(RAJA_ONGKIR_TYP, RAJA_ONGKIR_KEY);
    $smarty->assign("listpropinsi", $ro->getPropinsi());
    
    //GET KURIR
    $ekspdisi = $db->getFieldValue("ekspedisi", array("kode", "nama"), array("is_aktif" => 'Y'));
    $smarty->assign("listkurir", $ekspdisi);
    
    //GET BANK
    $data_bank = $db->getFieldValue("bank_transfer", array("*"), array("is_aktif" => "Y"));
    $smarty->assign("list_bank", $data_bank);
    
    $smarty->assign("current_date", date("d-m-Y"));
    
    //GET METODE PEMBAYARAN
    $cara_bayar = array(
        array('kode' => 1, 'nama' => 'Transfer Bank'),
        array('kode' => 2, 'nama' => 'Kartu Kredit / Debet'),
        array('kode' => 3, 'nama' => 'Cash on Delivery (COD)')
    );
    $smarty->assign("cara_bayar", $cara_bayar);
    
    $smarty->assign("page_selected", "pesanan");
    $smarty->assign("sub_page_selected", "pemesanan");
    $smarty->assign("title", "Pemesanan");
    $smarty->assign("sub_title", "Add Pemesanan");
    $smarty->assign("from_page", $_GET["from_page"]);
    
    $id_menu = 5; $aksi = "T";
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/pemesanan/edit.html");    