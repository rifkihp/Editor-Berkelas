<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $id = explode(",", $_POST["id"]);
    $stok = explode(",", $_POST["stok"]);
    
    foreach ($id as $key => $value) {
        $db->mysql_update("produk_varian", array("jumlah" => $stok[$key]), array("id" => $value));
    }
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "message" => "Update stok produk berhasil.")));