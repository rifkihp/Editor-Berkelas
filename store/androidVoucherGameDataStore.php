<?php

    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    include $root."includes/php/rajaOngkir.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);

    $jenis  = $_POST["jenis"];
    
    $sql = "SELECT A.* FROM ppob_produk AS A WHERE A.provider='GAME' AND A.operator_sub='$jenis' ORDER BY A.code";
    $db->mysql_query($sql, $rec_count, $data);
    foreach ($data as $key => $value) {
        $data[$key]['nama'] = $value["description"];
        $data[$key]['tarif'] = "Rp ".number_format($value['price'], 0, '.', ',');
        $data[$key]['harga'] = $value['price'];
    }

    $db->mysql_close();
    
    $result = array("topics" => $data);
    die(json_encode($result));