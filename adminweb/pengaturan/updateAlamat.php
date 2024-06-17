<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //validasi-validasi
    if(strlen($_POST["address"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Alamat harus diisi.")));
    }
    
    if(strlen($_POST["propinsi"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Propinsi website harus diisi.")));
    }
    
    if(strlen($_POST["kota"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kota harus diisi.")));
    }
    
    if(strlen($_POST["kode_pos"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kode pos harus diisi.")));
    }
    
    //update data umum
    $db->mysql_update("umum", $_POST);
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "message" => "Update alamat berhasil.")));