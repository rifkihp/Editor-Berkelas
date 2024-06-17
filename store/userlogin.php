<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect();
    
    if(!isset($_SESSION[SESSION_NAME])) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kesalahan login! Silahkan logout.")));
    }
    
    $data = $db->getFieldValue("mokes_pengguna", array("id", "nama_lengkap", "nama_pengguna", "phone AS no_telepon", "email", "saldo", "photo"), array("id" => $_SESSION[SESSION_NAME]["id"]));
    foreach($data as $key => $value) {
        $data[$key]["saldo"] = "Rp. ".number_format($value["saldo"], 0, '.', ',')." ,-";
    }
    $db->mysql_close();
    
    die(json_encode(array("success" => true, "data" => $data[0])));