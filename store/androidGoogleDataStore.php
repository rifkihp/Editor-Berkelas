<?php

    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    include $root."includes/php/rajaOngkir.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $sql = "SELECT A.id, A.provider, A.provider_sub, A.code, A.description, A.price, 350 AS transaksi, A.jual, B.logo FROM ppob_produk AS A, ppob_provider AS B WHERE A.provider=B.kode AND A.provider='GOOGLE PLAY' ORDER BY A.operator_sub, A.jual";
    $db->mysql_query($sql, $rec_count, $data);
    foreach ($data as $key => $value) {
        //$data[$key]['description'] = substr($value["description"], 0, strlen($value["description"])-3)." RB";
        $data[$key]['tarif'] = "Rp ".number_format($value['jual'], 0, '.', ',');
    }

    $db->mysql_close();
    
    $result = array("topics" => $data);
    die(json_encode($result));