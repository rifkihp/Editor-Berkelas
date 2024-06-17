<?php
    $root = "../";
    include $root."includes/php/initial.php";
    if(strlen($_SESSION['security_code'])==0 || !isset($_SESSION['security_code']) || $_POST["security_code"]!=$_SESSION['security_code']) {
    	die(json_encode(array("success" => false, "message" => "Maaf! Token tidak valid!")));
    }
    unset($_SESSION['security_code']);

    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
     
    $id_header = $db->getLastNumber("ppob_deposit", "id");
    $kode_order = $db->getLastNumber("ppob_deposit", "kode", 4, "DPT-".date("Ymd")."-");
    
    //SAVE DEPOSIT
    $tanggal_jam = date("Y-m-d H:i:s");
    $db->mysql_insert("ppob_deposit", array(
        "id" => $id_header,
        "id_member" => $_POST["user_id"],
        "kode" => $kode_order,
        "tanggal_jam" => $tanggal_jam,
        "pembayaran" => 1,
        "total" => $_POST["jumlah_deposit"],
        "kode_unik" => $_POST["kode_unik"],
        "bank_id" => $_POST["bank_id"],
        "no_rekening" => $_POST["bank_no_rekening"],
        "nama_pemilik_rekening" => $_POST["bank_nama_pemilik_rekening"],
        "nama_bank" => $_POST["bank_nama"],
        "cabang" => $_POST["bank_cabang"],
        "date_update_status" => $tanggal_jam,
        "date_create" => $tanggal_jam,
        "date_update" => $tanggal_jam,
        "status" => "0" 
    ));
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "detail_bank" => $_POST["bank_nama"] . "\n" . $_POST["bank_no_rekening"]." An. ".$_POST["bank_nama_pemilik_rekening"], "detail_jumlah" => "Rp. ". number_format($_POST["jumlah_deposit"]+$_POST["kode_unik"], 0, ".", ","))));