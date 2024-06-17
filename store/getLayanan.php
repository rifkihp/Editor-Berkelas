<?php

    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    include $root."includes/php/rajaOngkir.php";
    
    //DATABASE CONNECTION
    $db = new classUtama(CLIENT_SESSION_NAME);
    $db->mysql_connect(true);

    $token     = $_POST["token"];
    $kecamatan = $_POST["kecamatan"];
    $kurir     = strtolower($_POST["kurir"]);
    $berat     = $_POST["berat"];
    
    $data_umum = $db->getFieldValue("umum", array("*"));
    $ro = new rajaOngkir(RAJA_ONGKIR_TYP, RAJA_ONGKIR_KEY);
    $layanan = $ro->getCost($data_umum[0]["kota"], 'city', $kecamatan, 'subdistrict', ($berat>0?$berat:1000), $kurir);
    foreach ($layanan as $key => $value) {
        foreach ($value['cost'] as $key_ => $value_) {
            $layanan[$key]['cost'][$key_]['tarif'] = "Rp ".number_format($value_["value"], 0, '.', ',');
        }
    }
    $db->mysql_close();
    
    $result = array("success" => true, "topics" => $layanan, "token" => $token);
    die(json_encode($result));