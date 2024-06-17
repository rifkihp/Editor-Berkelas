<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $db->mysql_delete("customer_address", array("id" => $_POST["id"]));
    $db->mysql_close();
    
    die(json_encode(array("success" => true, "message" => "Proses hapus alamat berhasil.")));