<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_limit    = 20;
    $_page     = $_POST["page"];
    //$_POST["id_user"] = 30;
    
    $data = $db->getFieldValue("ppob_transaksi AS A LEFT JOIN ppob_cetak_faktur AS B ON A.code=B.code LEFT JOIN channel_send AS C ON C.id_header=A.id", array("A.id", "A.kode", "A.description", "DATE_FORMAT(tanggal_jam, '%d-%m-%Y %H:%i') AS tanggal", "IF(C.status_trx=68, 'PENDING', CONCAT(A.status_trx, IF(A.status_trx='SUCCESS', ' ', ''))) AS status_trx", "IF(C.status_trx=68, 'Transaksi Sedang Diproses.', A.keterangan_trx) AS keterangan_trx", "A.nomer_tujuan", "A.total", "IF(C.status_trx=4,COALESCE(B.url, ''), '') AS url"), array("A.id_member" => $_POST["id_user"]), array(), $_limit, $_limit*($_page-1), " A.tanggal_jam DESC ");          
    $db->mysql_close();
     
    $result = array(
        "topics" => $data,
        "next_page" => $_page+(count($data)==0?0:1)
    );
    
    die(json_encode($result));