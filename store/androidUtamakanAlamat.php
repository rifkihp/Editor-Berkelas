<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $db->mysql_update("customer_address", array("as_default" => 1), array("id" => $_POST["id"]));
    $db->mysql_execute("UPDATE customer_address SET as_default=0 WHERE id<>".$_POST["id"]);
    $db->mysql_close();
    
    die(json_encode(array("success" => true, "message" => "Proses update alamat berhasil.", "id" => $_POST["id"])));