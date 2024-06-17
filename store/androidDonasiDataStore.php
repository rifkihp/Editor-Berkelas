<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    
    $data = $db->getFieldValue("kartacare_donasi AS A LEFT JOIN kartacare AS B ON A.id_kartacare=B.id LEFT JOIN bank_transfer AS C ON A.bank_id=C.id", array("A.id", "B.judul", "A.total+A.kode_unik AS jumlah", "A.bank_id AS id_bank", "C.no_rekening", "C.nama_pemilik_rekening", "C.nama_bank", "C.cabang", "C.gambar"), array("A.status" => "0", "A.id_member" => $_POST["user_id"]));
    
    $db->mysql_close();
    die(json_encode(array("topics" => $data)));