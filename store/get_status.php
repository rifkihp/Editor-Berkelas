<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect();
    
    if(!isset($_SESSION[SESSION_NAME])) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kesalahan login! Silahkan logout.")));
    }
    
    $message_id   = $_POST["message_id"];
    $sql = "SELECT id, id AS id_trx, provider AS kode, jenis_pulsa AS jenis, provider AS nama, no_hp, nominal, tanggal_jam AS tanggal_jam_trx, "
         . "tanggal_jam_proses AS tanggal_jam_sms_out, '' AS sms_out, tanggal_jam_balasan AS tanggal_jam_sms_in, balasan AS sms_in, "
         . "IF(status_confirm=1, 'GAGAL', IF(status_confirm=2, 'SUKSES', 'MENUNGGU')) AS status FROM mokes_transaksi_beli_pulsa WHERE "
         . "id='".$message_id."'";
    //echo($sql);
    $db->mysql_query($sql, $rec_count, $data);               
    $db->mysql_close();
    
     
    $rasult = array(
        "id" => $message_id,
        "status" => $data[0]["status"]
    );
    
    die(json_encode($rasult));