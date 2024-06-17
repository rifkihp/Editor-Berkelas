<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    //TIPE USER
    $data_user = $db->getFieldValue("member", array("*"), array("id" => $_POST["id_user"]));
    $tipe_user = count($data_user)>0?$data_user[0]["jenis_user"]:0;
    $freeongkir = $db->getFieldValue("freeongkir_setting", array("is_aktif", "all_produk"));
    
    
    //$_POST["id_produk"] = 33;
    $data = $db->getFieldValue("produk AS A", array("A.*, IF(A.harga_diskon>0 AND IF(A.from_date_harga_diskon IS NOT NULL, A.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_harga_diskon IS NOT NULL, A.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS harga_promo, IF(A.persen_diskon>0 AND IF(A.from_date_persen_diskon IS NOT NULL, A.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_persen_diskon IS NOT NULL, A.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS diskon_promo"), array("A.id" => $_POST["id_produk"])); 
        
        
        foreach($data as $key => $value) {
            $data[$key]["produk_freeongkir"] = $freeongkir[0]["is_aktif"]==0?0:($freeongkir[0]["all_produk"]==1?1:$value["produk_freeongkir"]);
            
            $data[$key]["foto1_produk"] = $value["gambar_utama"];
            $data[$key]["nama"] = trim(ucwords(strtolower($value["nama"])));

            $data[$key]["harga_jual"] = $value[count($data_user)==0?"harga_jual":"harga_jual_khusus"];
            $data[$key]["persen_diskon"] = $value["diskon_promo"]==1?$value["persen_diskon"]:0;
            $data[$key]["harga_diskon"] = $value["harga_promo"]==1?$value["harga_diskon"]:0;
            if($value["persen_diskon"]!=0) {
                if($data[$key]["harga_diskon"]!=0) { $data[$key]["harga_jual"] = $data[$key]["harga_diskon"]; }                
                $data[$key]["harga_diskon"] = $data[$key]["harga_jual"]-($data[$key]["persen_diskon"]*($data[$key]["harga_jual"]*0.01));
            }
            
            
            $data[$key]["kategori"] = $db->getFieldValue("produk_to_category AS A LEFT JOIN category AS B ON A.id_kategori=B.id", array("B.id", "B.nama"), array("A.id_produk" => $value["id"]));
            $data[$key]["category_name"] = "";
            foreach ($data[$key]["kategori"] as $key_kategori => $value_kategori) {
                $data[$key]["category_name"] .= $value_kategori["nama"].", ";
            }
            $data[$key]["category_name"] = rtrim($data[$key]["category_name"], ", ");
        }
    
    
    $wa =  $db->getFieldValue("umum_contact", array("contact"), array("tipe" => "wa"));
    
    $db->mysql_close();
     
    $rasult = array(
        
        "topics" => $data[0],
        "wa_operator" => str_replace(" ", "", $wa[0]["contact"])
    );
    
    die(json_encode($rasult));