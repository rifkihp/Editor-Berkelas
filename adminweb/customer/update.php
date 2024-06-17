<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    $status = $_POST["status"];
    $id = explode(",", $_POST["id"]);    
    $db->mysql_update("member", array("aktif" => 1, "admin" => $status), array("id" => $id));
        
    $_SESSION["alert_success"] = "Update status member berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));