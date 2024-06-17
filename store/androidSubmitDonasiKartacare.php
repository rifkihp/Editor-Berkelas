<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $id_header  = $db->getLastNumber("kartacare_donasi", "id");
    $kode_order = $db->getLastNumber("kartacare_donasi", "kode", 6);
    
    //SAVE KARTACARE DONASI
    $tanggal_jam = date("Y-m-d H:i:s");
    $db->mysql_insert("kartacare_donasi", array(
        "id" => $id_header,
        "id_member" => $_POST["user_id"],
        "id_kartacare" => $_POST["id_kartacare"],
        "kode" => $kode_order,
        "tanggal_jam" => $tanggal_jam,
        "pembayaran" => 1,
        "keterangan" => $_POST["keterangan"],
        "total" => $_POST["jumlah_donasi"],
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
    die(json_encode(array("success" => true, "detail_bank" => $_POST["bank_nama"] . "\n" . $_POST["bank_no_rekening"]." An. ".$_POST["bank_nama_pemilik_rekening"], "detail_jumlah" => "Rp. ". number_format($_POST["jumlah_donasi"]+$_POST["kode_unik"], 0, ".", ","))));