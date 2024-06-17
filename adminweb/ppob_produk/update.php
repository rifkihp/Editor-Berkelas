<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //validasi-validasi
    if(strlen($_POST["provider"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Produk harus diisi.")));
    }
    
    if(strlen($_POST["provider_sub"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Paket harus diisi.")));
    }
    
    if(strlen($_POST["code"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kode harus diisi.")));
    }
    
    //update data produk
    $db->mysql_update("ppob_produk", $_POST, array("id" => $_POST["id"]));
    
    $_SESSION["alert_success"] = "Edit produk berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));