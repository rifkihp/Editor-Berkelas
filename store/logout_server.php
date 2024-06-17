<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect(true);
    
    if(!isset($_SESSION[SESSION_NAME])) {
        $db->mysql_close();
        die(json_encode(array("success" => true, "message" => "Anda berhasil keluar.")));
    }
    
    $db->mysql_update("mokes_pengguna", array("gcm_regid" => ""), array("id" => $_SESSION[SESSION_NAME]["id"]));
    $db->mysql_close();
    
    unset($_SESSION[SESSION_NAME]);
    die(json_encode(array("success" => true, "message" => "Anda berhasil keluar.")));