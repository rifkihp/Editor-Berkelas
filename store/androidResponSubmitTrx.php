<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $ppob_trx = $db->getFieldValue("ppob_transaksi", array("status_trx", "keterangan_trx"), array("id" => $_POST["id_header"]));
    $status_trx = $ppob_trx[0]["status_trx"]; $keterangan_trx = $ppob_trx[0]["keterangan_trx"];   
    $db->mysql_close();
    
    if($status_trx=="SUCCESS") {
        die(json_encode(array("success" => true, "status" => $status_trx, "message" => $keterangan_trx)));
    } else if($status_trx=="FAILED") {
        /*$keterangan_trx = trim(substr($keterangan_trx, 0, strpos($keterangan_trx, ".")));*/        
        die(json_encode(array("success" => true, "status" => $status_trx, "message" => $keterangan_trx)));
    } else {
        die(json_encode(array("success" => false, "status" => "NONE")));
    }
