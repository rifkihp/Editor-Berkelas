<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //validasi-validasi
    if(strlen($_POST["nama"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama kategori harus diisi.")));
    }
    
    //update data tabpanel
    $db->mysql_update("tabpanel", $_POST, array("id" => $_POST["id"]));
    
    $_SESSION["alert_success"] = "Edit tab menu berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));