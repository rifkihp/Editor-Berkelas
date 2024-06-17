<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //validasi-validasi
    if(strlen($_POST["jatuh_tempo"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Jatuh Tempo pesanan harus diisi.")));
    }
    
    //update data pengaturan
    $db->mysql_update("pengaturan", $_POST);
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "message" => "Update pengaturan berhasil.")));