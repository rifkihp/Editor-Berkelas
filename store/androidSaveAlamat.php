<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    if($_POST["id"]==0) {
        $_POST["id"] = $db->getLastNumber("customer_address", "id");
        $db->mysql_insert("customer_address", $_POST);
    } else {
        $db->mysql_update("customer_address", $_POST, array("id" => $_POST["id"]));
    }
    
    if($_POST["as_default"]==1) { $db->mysql_execute("UPDATE customer_address SET as_default=0 WHERE id<>".$_POST["id"]); }
    
    $db->mysql_close();
    
    die(json_encode(array("success" => true, "message" => "Proses simpan alamat berhasil.", "id" => $_POST["id"])));