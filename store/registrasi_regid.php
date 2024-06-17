<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama(CLIENT_SESSION_NAME);
    $db->mysql_connect();
    
    if(!isset($_SESSION[CLIENT_SESSION_NAME])) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kesalahan login! Silahkan logout.")));
    }
    
    //UPDATE REG ID
    $db->mysql_update("member", array("gcm_regid" => mysql_escape_string($_POST["regid"])), array("id" => $_SESSION[CLIENT_SESSION_NAME]["user"]["id"]));
    $db->mysql_close();
    
    die(json_encode(array("success" => true, "message" => "Proses registrasi regid berhasil.")));