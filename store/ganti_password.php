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
        
    $data_user  = $db->getFieldValue("mokes_pengguna", array("*"), array("id" => $_SESSION[SESSION_NAME]["id"])); 
    
    //validasi
    if($db->acakpassword($_POST["old_password"])!=$data_user[0]["password"]) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Password lama tidak sesuai.")));
    }
    
    $db->mysql_update("mokes_pengguna", array("password" => $db->acakPassword($_POST["new_password"])), array("id" => $data_user[0]["id"]));
    $db->mysql_close();
    die(json_encode(array("success" => true, "message" => "Proses ganti password berhasil.")));