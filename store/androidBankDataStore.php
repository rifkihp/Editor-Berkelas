<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    $data = $db->getFieldValue("bank_transfer", array("id", "no_rekening", "nama_pemilik_rekening", "nama_bank", "cabang", "gambar"), array("is_aktif" => "Y"));
    
    $db->mysql_close();
    die(json_encode(array("kode_unik" => $db->create_kode_unik(2), "topics" => $data)));