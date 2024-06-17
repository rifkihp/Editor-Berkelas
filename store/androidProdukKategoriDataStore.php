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
        
    //ID KATEGORI
    $id_kategori = $_POST["id_kategori"];
    if($id_kategori==1) {
        $data = detail_produk($db->getFieldValue("produk AS A".(count($data_user)>0?" LEFT JOIN (SELECT id_produk, harga_jual FROM harga_jual_user WHERE tipe_user='$tipe_user' AND harga_jual>0 GROUP BY id_produk) AS C ON C.id_produk=A.id":""), array("A.*, IF(A.harga_diskon>0 AND IF(A.from_date_harga_diskon IS NOT NULL, A.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_harga_diskon IS NOT NULL, A.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS harga_promo, IF(A.persen_diskon>0 AND IF(A.from_date_persen_diskon IS NOT NULL, A.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_persen_diskon IS NOT NULL, A.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS diskon_promo" . (count($data_user)>0?", IF(C.harga_jual IS NOT NULL, C.harga_jual, A.harga_jual) AS harga_jual_khusus":"")), array("A.status" => 1), array(), 15, 0, " A.tanggal_update DESC ", " A.produk_terbaru=1 "));
    }
    
    if($id_kategori==2) {
        $data = detail_produk($db->getFieldValue("produk AS A".(count($data_user)>0?" LEFT JOIN (SELECT id_produk, harga_jual FROM harga_jual_user WHERE tipe_user='$tipe_user' AND harga_jual>0 GROUP BY id_produk) AS C ON C.id_produk=A.id":""), array("A.*, IF(A.harga_diskon>0 AND IF(A.from_date_harga_diskon IS NOT NULL, A.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_harga_diskon IS NOT NULL, A.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS harga_promo, IF(A.persen_diskon>0 AND IF(A.from_date_persen_diskon IS NOT NULL, A.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_persen_diskon IS NOT NULL, A.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS diskon_promo" . (count($data_user)>0?", IF(C.harga_jual IS NOT NULL, C.harga_jual, A.harga_jual) AS harga_jual_khusus":"")), array("A.status" => 1), array(), 15, 0, " A.tanggal_update DESC ", " IF((A.harga_diskon>0 AND IF(A.from_date_harga_diskon IS NOT NULL, A.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_harga_diskon IS NOT NULL, A.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1)) OR (A.persen_diskon>0 AND IF(A.from_date_persen_diskon IS NOT NULL, A.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_persen_diskon IS NOT NULL, A.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1)), 1, 0)=1 "));
    }
    
    if($id_kategori==3) {
        $data = detail_produk($db->getFieldValue("produk AS A".(count($data_user)>0?" LEFT JOIN (SELECT id_produk, harga_jual FROM harga_jual_user WHERE tipe_user='$tipe_user' AND harga_jual>0 GROUP BY id_produk) AS C ON C.id_produk=A.id":"")." LEFT JOIN (SELECT id_produk, SUM(jumlah) AS qty FROM customer_order_detail GROUP BY id_produk) AS B ON A.id=B.id_produk", 
                                                                                                                                                                                                                                                    array("A.*, IF(A.harga_diskon>0 AND IF(A.from_date_harga_diskon IS NOT NULL, A.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_harga_diskon IS NOT NULL, A.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS harga_promo, IF(A.persen_diskon>0 AND IF(A.from_date_persen_diskon IS NOT NULL, A.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_persen_diskon IS NOT NULL, A.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS diskon_promo" . (count($data_user)>0?", IF(C.harga_jual IS NOT NULL, C.harga_jual, A.harga_jual) AS harga_jual_khusus":"")), array("A.status" => 1), array(), 15, 0, " B.qty DESC ", " B.qty>0 AND B.qty IS NOT NULL "));
    }
     
    
    function detail_produk($data_produk) {
        global $db, $data_user, $freeongkir;
        
        foreach($data_produk as $key => $value) {
            $data_produk[$key]["produk_freeongkir"] = $freeongkir[0]["is_aktif"]==0?0:($freeongkir[0]["all_produk"]==1?1:$value["produk_freeongkir"]);
            
            $data_produk[$key]["foto1_produk"] = $value["gambar_utama"];
            $data_produk[$key]["nama"] = trim(ucwords(strtolower($value["nama"])));

            $data_produk[$key]["harga_jual"] = $value[count($data_user)==0?"harga_jual":"harga_jual_khusus"];
            $data_produk[$key]["persen_diskon"] = $value["diskon_promo"]==1?$value["persen_diskon"]:0;
            $data_produk[$key]["harga_diskon"] = $value["harga_promo"]==1?$value["harga_diskon"]:0;
            if($value["persen_diskon"]!=0) {
                if($data_produk[$key]["harga_diskon"]!=0) { $data_produk[$key]["harga_jual"] = $data_produk[$key]["harga_diskon"]; }                
                $data_produk[$key]["harga_diskon"] = $data_produk[$key]["harga_jual"]-($data_produk[$key]["persen_diskon"]*($data_produk[$key]["harga_jual"]*0.01));
            }
            
            $data_produk[$key]["kategori"] = $db->getFieldValue("produk_to_category AS A LEFT JOIN category AS B ON A.id_kategori=B.id", array("B.id", "B.nama"), array("A.id_produk" => $value["id"]));
            $data_produk[$key]["category_name"] = "";
            foreach ($data_produk[$key]["kategori"] as $key_kategori => $value_kategori) {
                $data_produk[$key]["category_name"] .= $value_kategori["nama"].", ";
            }
            $data_produk[$key]["category_name"] = rtrim($data_produk[$key]["category_name"], ", ");
        }
        
        return $data_produk;
    }
    $db->mysql_close();
     
    $rasult = array(
        "totalCount" => count($data),
        "topics" => $data
    );
    
    die(json_encode($rasult));