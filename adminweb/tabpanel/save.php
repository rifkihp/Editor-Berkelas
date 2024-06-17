<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //validasi-validasi
    $data = $db->getFieldValue("tabpanel AS A", array("COUNT(*) AS TOTAL"));
    if($data[0]["TOTAL"]>=6) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Tab Menu tidak bisa lebih dari 6.")));    
    }
    
    if(strlen($_POST["nama"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama kategori harus diisi.")));
    }
    
    //get last id kategori
    $_POST["id"] = $db->getLastNumber("tabpanel", "id");
    
    //insert data tabpanel
    $db->mysql_insert("tabpanel", $_POST);
    
    $_SESSION["alert_success"] = "Tambah tab menu berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));