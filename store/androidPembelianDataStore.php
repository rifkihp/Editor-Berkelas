<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    $produk_lain = $db->getFieldValue("produk AS A", array("A.*, IF(A.harga_diskon>0 AND IF(A.from_date_harga_diskon IS NOT NULL, A.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_harga_diskon IS NOT NULL, A.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS harga_promo, IF(A.persen_diskon>0 AND IF(A.from_date_persen_diskon IS NOT NULL, A.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_persen_diskon IS NOT NULL, A.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS diskon_promo"), array("A.status" => 1), array(), 10, 0, " A.tanggal_update DESC ", " A.produk_terbaru=1 ");
        
    foreach ($produk_lain as $key => $value) {
        $produk_lain[$key]["produk_freeongkir"] = $freeongkir[0]["is_aktif"]==0?0:($freeongkir[0]["all_produk"]==1?1:$value["produk_freeongkir"]);
            
        $produk_lain[$key]["foto1_produk"] = $value["gambar_utama"];
        $produk_lain[$key]["nama"] = trim(ucwords(strtolower($value["nama"])));

        $produk_lain[$key]["harga_jual"] = $value[count($data_user)==0?"harga_jual":"harga_jual_khusus"];
        $produk_lain[$key]["persen_diskon"] = $value["diskon_promo"]==1?$value["persen_diskon"]:0;
        $produk_lain[$key]["harga_diskon"] = $value["harga_promo"]==1?$value["harga_diskon"]:0;
        if($value["persen_diskon"]!=0) {
            if($produk_lain[$key]["harga_diskon"]!=0) { $produk_lain[$key]["harga_jual"] = $produk_lain[$key]["harga_diskon"]; }                
            $produk_lain[$key]["harga_diskon"] = $produk_lain[$key]["harga_jual"]-($produk_lain[$key]["persen_diskon"]*($produk_lain[$key]["harga_jual"]*0.01));
        }
            
        $produk_lain[$key]["kategori"] = $db->getFieldValue("produk_to_category AS A LEFT JOIN category AS B ON A.id_kategori=B.id", array("B.id", "B.nama"), array("A.id_produk" => $value["id"]));
        $produk_lain[$key]["category_name"] = "";
        foreach ($produk_lain[$key]["kategori"] as $key_kategori => $value_kategori) {
            $produk_lain[$key]["category_name"] .= $value_kategori["nama"].", ";
        }
        $produk_lain[$key]["category_name"] = rtrim($produk_lain[$key]["category_name"], ", ");
    }
    
    $data = array(
        array("id" => 1, "nama" => "Deposit", "header" => "deposit.png"),
        array("id" => 2, "nama" => "Pulsa", "header" => "pulsa.png"),
        array("id" => 3, "nama" => "Paket Data", "header" => "paket_data.png"),
        array("id" => 4, "nama" => "Telepon", "header" => "telepon.png"),
        
        array("id" => 5, "nama" => "Token Listrik", "header" => "token_listrik.png"),
        array("id" => 6, "nama" => "PLN", "header" => "pln.png"),
        array("id" => 7, "nama" => "PDAM", "header" => "pdam.png"),
        array("id" => 8, "nama" => "Game Online", "header" => "game_online.png"),
        
        array("id" => 9, "nama" => "TV Kabel", "header" => "tv_kabel.png"),
        array("id" => 10, "nama" => "Indi Home", "header" => "indi_home.png"),
        array("id" => 11, "nama" => "Tiket KA", "header" => "tiket_ka.png"),
        array("id" => 12, "nama" => "Pesawat", "header" => "pesawat.png"),
        
        array("id" => 13, "nama" => "Kartu Kredit", "header" => "kartu_kredit.png"),
        array("id" => 14, "nama" => "Cicilan Finance", "header" => "cicilan_finance.png"),
        array("id" => 15, "nama" => "BPJS", "header" => "bpjs.png"),
        array("id" => 16, "nama" => "Asuransi", "header" => "asuransi.png"),
        
        array("id" => 17, "nama" => "Transfer", "header" => "transfer.png"),
        array("id" => 18, "nama" => "Go Pay", "header" => "go_pay.png"),
        array("id" => 19, "nama" => "Pasca Bayar", "header" => "pasca_bayar.png"),
        array("id" => 20, "nama" => "Donasi", "header" => "donasi.png")
        
    );    
        
    $db->mysql_close();
     
    $rasult = array(
        //"banner" => $data_banner, 
        "topics" => $data,
        "topics_terbaru" => $produk_lain
    );
    
    die(json_encode($rasult));