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
        $data = $db->getFieldValue("voucher", array("*"), array("kode_voucher" => $_POST["kode_voucher"]), array(), 0, 0, "", " id<>'".$_POST["id"]."'");
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
    
    unset($_POST["jumlah"]);
    $temp = explode("-", $_POST["batas_valid"]);
    $_POST["batas_valid"] = $temp[2]."-".$temp[1]."-".$temp[0];
    
    $db->mysql_update("voucher", $_POST, array("id" => $_POST["id"]));
    
    $_SESSION["alert_success"] = "Edit voucher berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));