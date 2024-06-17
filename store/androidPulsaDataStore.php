<?php

    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    include $root."includes/php/rajaOngkir.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);

    $phone  = $_POST["nohp"];
    $prefix = substr($phone, 0, 4);
    
    $sql = "SELECT A.id, A.provider, A.provider_sub, A.code, A.description, A.price, 350 AS transaksi, A.jual, B.logo FROM ppob_produk AS A, ppob_provider AS B WHERE A.provider=B.kode AND A.provider_sub='REGULER' AND B.id=(SELECT id_provider FROM ppob_provider_prefix WHERE prefix='".$prefix."') ORDER BY A.jual";
    $db->mysql_query($sql, $rec_count, $data);
    foreach ($data as $key => $value) {
        //$data[$key]['description'] = substr($value["description"], 0, strlen($value["description"])-3)." RB";
        $data[$key]['tarif'] = "Rp ".number_format($value['jual'], 0, '.', ',');
    }

    $db->mysql_close();
    
    $result = array("topics" => $data);
    die(json_encode($result));