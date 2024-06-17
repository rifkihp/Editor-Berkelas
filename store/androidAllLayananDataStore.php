<?php

    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    include $root."includes/php/rajaOngkir.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);

    $destAreaCode  = $_POST["city_id"];
    $kecamatan     = $_POST["subdistrict_id"];
    $berat         = $_POST["berat"];
    $total         = $_POST["total"];
        
    $data_umum = $db->getFieldValue("umum", array("*"));
    $data_kurir = $db->getFieldValue("ekspedisi", array("*"), array("is_aktif" => "Y"));
    
    $freeongkir = $db->getFieldValue("freeongkir_setting", array("is_aktif", "all_produk", "min_pembelian", "all_kurir", "all_tujuan"));
    $is_freeongkir = $freeongkir[0]["is_aktif"]==1&&$freeongkir[0]["all_produk"]==1&&($total>=$freeongkir[0]["min_pembelian"]);
    if($freeongkir[0]["is_aktif"]==1&&$freeongkir[0]["all_produk"]==0&&($total>=$freeongkir[0]["min_pembelian"])) {
        $is_freeongkir=true;
        $row = explode("\n", $_POST["cart"]);
        foreach($row as $i => $value) {
            $col = explode("\t", $value);    
            $id_produk = $col[1];
            $produk_freeongkir = $db->getFieldValue("produk", array("produk_freeongkir"), array("id" => $id_produk));
            if($produk_freeongkir[0]["produk_freeongkir"]==0) {
                $is_freeongkir = false;
                break;
            }
        }
    }
    
    $kurir_freeongkir = array();
    if($is_freeongkir&&$freeongkir[0]["all_kurir"]==0) {
        $data_kurir_freeongkir = $db->getFieldValue("freeongkir_kurir AS A LEFT JOIN ekspedisi AS B ON A.id_kurir=B.id", array("B.id", "B.kode", "B.nama"), array("B.is_aktif" => "Y"));
        foreach ($data_kurir_freeongkir as $key => $value) {
            $kurir_freeongkir[$key] = $value["kode"];
        }
    }
        
    if($is_freeongkir) {
        $data_s = $db->getFieldValue("freeongkir_tujuan", array("COUNT(*) AS TOTAL"));
        $is_freeongkir = $data_s[0]["TOTAL"]==0;
        
        if(!$is_freeongkir) {
            $data_s = $db->getFieldValue("freeongkir_tujuan", array("COUNT(*) AS TOTAL"), array("id_kota" => $destAreaCode));
            $is_freeongkir = $data_s[0]["TOTAL"]>0;
        }        
    }
        
    $jne_service = array("REG", "OKE", "YES");
    $tiki_service = array("ONS", "REG", "EKO");
    $layanan = array();
    if($data_umum[0]["kota"]==$destAreaCode) {
        $data_kurir_cod = $db->getFieldValue("ekspedisi", array("*"), array("is_aktif" => "Y", "kode" => "COD"));
    
        $index = count($layanan);
        $layanan[$index]["id_kurir"] = $data_kurir_cod[0]["id"];
        $layanan[$index]["kode_kurir"] = $data_kurir_cod[0]["kode"];
        $layanan[$index]["nama_kurir"] = $data_kurir_cod[0]["kode"];
        $layanan[$index]["kode_service"] = $data_kurir_cod[0]["kode"];
        $layanan[$index]["nama_service"] = $data_kurir_cod[0]["nama"];
        $layanan[$index]['nominal'] = 0;
        $layanan[$index]['tarif'] = "Gratis";
        $layanan[$index]['etd'] = "";
        $layanan[$index]["gambar_kurir"] = $data_kurir_cod[0]["gambar"];
    }
    
    $ro = new rajaOngkir(RAJA_ONGKIR_TYP, RAJA_ONGKIR_KEY);
    foreach ($data_kurir as $keys => $value_kurir) {
        $kurir = strtolower($value_kurir["kode"]); 
        
        $data_layanan = $ro->getCost($data_umum[0]["kota"], 'city', $kecamatan, 'subdistrict', ($berat>0?$berat:1000), $kurir);
        foreach ($data_layanan as $key => $value) {
            $is_add = false;
            if($value_kurir["kode"]=="JNE") {
                $is_add = array_search($value["service"], $jne_service)!==false;
            } else if($value_kurir["kode"]=="TIKI") {
                $is_add = array_search($value["service"], $tiki_service)!==false;
            } else {
                $is_add = true;         
            }
            if($is_add) {
                $index = count($layanan);
                $layanan[$index]["id_kurir"] = $value_kurir["id"];
                $layanan[$index]["kode_kurir"] = $value_kurir["kode"];
                $layanan[$index]["nama_kurir"] = $value_kurir["nama"];
                $layanan[$index]["kode_service"] = $value["service"];
                $layanan[$index]["nama_service"] = $value["description"];
                $layanan[$index]['nominal'] = $value['cost'][0]["value"];
                $layanan[$index]['tarif'] = "Rp ".number_format($value['cost'][0]["value"], 0, '.', ',');
                $layanan[$index]['etd'] = $value['cost'][0]["etd"];
                $layanan[$index]["gambar_kurir"] = $value_kurir["gambar"];
                
                if($is_freeongkir) {
                    if($freeongkir[0]["all_kurir"]==0) {
                        if(array_search($value_kurir["kode"], $kurir_freeongkir)!==false) {
                            $layanan[$index]['nominal'] = 0;
                            $layanan[$index]['tarif'] = "Gratis";
                        }
                    } else {
                        $layanan[$index]['nominal'] = 0;
                        $layanan[$index]['tarif'] = "Gratis";
                    }
                }
            }
        }
    
    }
    $db->mysql_close();
    
    $result = array("topics" => $layanan);
    die(json_encode($result));