<?php

    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);

    $destAreaCode = $_POST["city_id"];
    $kecamatan    = $_POST["subdistrict_id"];
    $kurir        = strtolower($_POST["kurir"]);
    $berat        = $_POST["berat"];
    
    $data_umum = $db->getFieldValue("umum", array("*"));
    /*if($kurir=="jnt") {
        include $root."includes/php/jnt.php";
        $jnt = new jnt();
        $layanan = $jnt->getCost(strtoupper($data_umum[0]["nama_kota"]), strtoupper($destAreaCode), $berat);
        //print_r($layanan);
        foreach ($layanan as $key => $value) {
            $layanan[$key] = array(
                "service" => $value["name"],
                "description" => $value["name"],
                "cost" => array(
                    array(
                        "value"  => $value["cost"],
                        "etd"  => "",
                        "note"  => "",
                        "tarif" => "Rp ".number_format($value["cost"], 0, '.', ',')
                    )
                )
            );
        }
    } else {*/
    
    
    $jne_service = array("REG", "OKE", "YES");
    $tiki_service = array("ONS", "REG", "EKO");
    
    include $root."includes/php/rajaOngkir.php";
    $ro = new rajaOngkir(RAJA_ONGKIR_TYP, RAJA_ONGKIR_KEY);
    $temp_layanan = $ro->getCost($data_umum[0]["kota"], 'city', $kecamatan, 'subdistrict', ($berat>0?$berat:1000), $kurir);
    $layanan = array();
    foreach ($temp_layanan as $key => $value) {
        foreach ($value['cost'] as $key_ => $value_) {
            $value['cost'][$key_]['tarif'] = "Rp ".number_format($value_["value"], 0, '.', ',');
        }
        if($kurir=="jne") {
            if(array_search($value["service"], $jne_service)!==false) { $layanan[count($layanan)] = $value; }
        } else if($kurir=="tiki") {
            if(array_search($value["service"], $tiki_service)!==false) { $layanan[count($layanan)] = $value; }
        } else {
            $layanan[count($layanan)] = $value;            
        }
    }
    
    //}
    $db->mysql_close();
    
    $result = array("topics" => $layanan);
    die(json_encode($result));