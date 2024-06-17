<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_limit    = 20;
    $_page     = $_POST["page"];
    
    $data = $db->getFieldValue("kartacare_donasi AS A LEFT JOIN kartacare AS B ON A.id_kartacare=B.id", array("A.id", "DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y %H:%i') AS tanggal", "B.judul", "A.keterangan", "A.total AS jumlah", "A.total+A.kode_unik AS transfer", "A.bank_id AS id_bank", "A.no_rekening", "A.nama_pemilik_rekening", "A.nama_bank", "A.cabang", "A.status"), array("A.id_member" => $_POST["id_user"]), array(), $_limit, $_limit*($_page-1), " A.tanggal_jam DESC ");          
    $db->mysql_close();
     
    $result = array(
        "topics" => $data,
        "next_page" => $_page+(count($data)==0?0:1)
    );
    
    die(json_encode($result));