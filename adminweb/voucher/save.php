<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //validasi-validasi
    if(strlen($_POST["kode_voucher"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kode voucher harus diisi.")));
    } else {
        $data = $db->getFieldValue("voucher", array("*"), array("kode_voucher" => $_POST["kode_voucher"]));
        if(count($data)>0) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Kode voucher sudah terpakai.")));
        }
    }
    
    if($_POST["nominal"]==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nominal voucher harus lebih dari 0.")));
    }
    
    if($_POST["tipe_voucher"]=="persentase" && $_POST["nominal"]>100) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nominal voucher tidak bisa melebihi 100%.")));
    }
    
    if(strlen($_POST["batas_valid"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Tanggal harus diisi.")));
    } else {
        if(!$db->dateValidation($_POST["batas_valid"], "d-m-Y")) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Format Tanggal tidak valid.")));
        }
    }
    
    if($_POST["jumlah"]==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Jumlah voucher harus lebih dari 0.")));
    }
    
    $temp = explode("-", $_POST["batas_valid"]);
    $_POST["batas_valid"] = $temp[2]."-".$temp[1]."-".$temp[0];
    $_POST["is_valid"] = "Y";
    
    include $root."includes/php/ClassX.php";
    $tes = new ClassX();
    $int = $_POST["jumlah"];
    unset($_POST["jumlah"]);
    for($i=0; $i<$int; $i++) {
        $_POST["id"] = $db->getLastNumber("voucher", "id");
        $db->mysql_insert("voucher", $_POST);
    
        do {
            
            $_POST["kode_voucher"] = is_numeric($_POST["kode_voucher"])?($_POST["kode_voucher"]+1):$tes->increment($_POST["kode_voucher"], strlen($_POST["kode_voucher"]));
            $data = $db->getFieldValue("voucher", array("COUNT(*) AS TOTAL"), array("kode_voucher" => $_POST["kode_voucher"]));
        } 
        while($data[0]["TOTAL"]>0);
        
    }
    
    $_SESSION["alert_success"] = "Tambah voucher berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));