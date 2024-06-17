<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $kode_voucher = $_POST["kode_voucher"];    
    $data = $db->getFieldValue("voucher", array("*"), array("kode_voucher" => $kode_voucher, "is_valid" => "Y"), array(), 0, 0 , "", "batas_valid>=DATE_FORMAT(NOW(), '%Y-%m-%d')");
    
    if(count($data)==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "No. voucher $kode_voucher tidak valid!")));
    }
        
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "kode_voucher" => $data[0]["kode_voucher"], "nominal" => $data[0]["nominal"], "tipe_voucher" => $data[0]["tipe_voucher"], "jenis_voucher" => $data[0]["jenis_voucher"])));
    