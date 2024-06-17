<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $id = explode(",", $_POST["id"]);
    
    $db->mysql_update("produk", array("tanggal_update" => date("Y-m-d H:i:s")), array("id" => $id));
    $db->mysql_close();
        
    $_SESSION["alert_success"] = "Up produk berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));