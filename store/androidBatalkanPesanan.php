<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $no_trx = $_POST["no_trx"];
    $data_pesanan = $db->getFieldValue("customer_order_header", array("status"), array("kode" => $no_trx));
    
    $status = $data_pesanan[0]["status"];
    if($status==0 || $status==1 || $status==3) {
        $db->mysql_update("customer_order_header", array("status" => 4), array("kode" => $no_trx));
        $result = array("success" => true, "message" => "Proses pembatalan pesanan berhasil.");
    } else {
        $result = array("success" => false, "message" => "Pesanan tidak bisa dibatalkan.");
    }
    $db->mysql_close();
    
    die(json_encode($result));