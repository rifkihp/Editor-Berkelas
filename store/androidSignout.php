<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $db->mysql_update("member", array("gcm_regid" => ""), array("id" => $_POST["id_user"]));
    $db->mysql_close();
    
    die(json_encode(array("success" => true, "message" => "Anda berhasil keluar.")));