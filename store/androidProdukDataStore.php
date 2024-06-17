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
    
    
    $_limit    = 10;
    $_page     = $_POST["page"];
    $_query    = $_POST["query"];
    $_kategori = $_POST["kategori"];
    $sort_by   = $_POST["sort_by"];
    
    $filter_kategori = $_POST["filter_kategori"];
    $filter_brand    = $_POST["filter_brand"];
    $filter_ukuran   = $_POST["filter_ukuran"];
    $filter_warna    = $_POST["filter_warna"];
    
    $filter_harga_min  = $_POST["filter_harga_min"];
    $filter_harga_max  = $_POST["filter_harga_max"];
    $filter_diskon_min = $_POST["filter_diskon_min"];
    $filter_diskon_max = $_POST["filter_diskon_max"];
    
    $order_by = " A.tanggal_update DESC ";
    if($sort_by=="1") {
        $order_by = " A.tanggal_update DESC ";
    } else 
    if($sort_by=="2") { 
        $order_by = " A.rating DESC ";
    } else 
    if($sort_by=="3") { 
        $order_by = count($data_user)==0?" A.harga_jual ":" harga_jual_khusus ";
    }else 
    if($sort_by=="4") { 
        $order_by = (count($data_user)==0?" A.harga_jual ":" harga_jual_khusus ")." DESC ";
    }
    
    $tag = "";
    if(strlen($_kategori)>0) {
        $data_kategori = $db->getFieldValue("category", array("*"), array("id_parent" => $_kategori));
        foreach ($data_kategori as $key => $value) {
            $tag.= $value["id"].",";
        }
        $tag = "B.id_kategori".(strlen($tag)>0?(" IN (".$tag."".$_kategori.")"):("=".$_kategori));
    }
    
    $filter = " 1 ";
    if(strlen($filter_kategori)>0) {
        $filter .= " AND A.id_kategori IN (".$filter_kategori.")";
    } else
    if(strlen($filter_brand)>0) {
        $filter .= " AND A.id_brand IN (".$filter_brand.")";
    } else
    if(strlen($filter_ukuran)>0) {        
        $filter .= (strlen($filter)>0?" AND ":"") . "A.id IN (SELECT id_produk FROM produk_varian WHERE jumlah>0 AND ukuran IN (".$filter_ukuran."))";
    } else
    if(strlen($filter_warna)>0) {        
        $filter .= (strlen($filter)>0?" AND ":"") . "A.id IN (SELECT id_produk FROM produk_varian WHERE jumlah>0 AND warna IN (".$filter_warna."))";
    } else
    if($filter_harga_min>0) {        
        $filter .= (strlen($filter)>0?" AND ":"") . (count($data_user)==0?"A.harga_jual":"IF(C.harga_jual IS NOT NULL, C.harga_jual, A.harga_jual)") . ">=$filter_harga_min";
    } else
    if($filter_harga_max<1000000 && $filter_harga_min>0) {  
        $filter .= (strlen($filter)>0?" AND ":"") . (count($data_user)==0?"A.harga_jual":"IF(C.harga_jual IS NOT NULL, C.harga_jual, A.harga_jual)") . "<=$filter_harga_max";
    } else
    if($filter_diskon_min>0) {        
        $filter .= (strlen($filter)>0?" AND ":"") . "A.persen_diskon>=$filter_diskon_min";
    } else
    if($filter_diskon_max<100 && $filter_diskon_min>0) {           
        $filter .= (strlen($filter)>0?" AND ":"") . "A.persen_diskon<=$filter_diskon_max";
    } 
    
    //get total
    if(strlen($tag)>0) {
        $sql = "SELECT COUNT(*) AS TOTAL FROM produk_to_category AS B LEFT JOIN produk AS A ON A.id=B.id_produk WHERE ".$tag.(strlen($_query)>0?" AND (A.kode LIKE '%$_query%' OR A.nama LIKE '%$_query%' OR A.keyword LIKE '%$_query%')":"");
    } else {
        $sql = "SELECT COUNT(*) AS TOTAL FROM produk AS A".(count($data_user)>0?" LEFT JOIN (SELECT id_produk, harga_jual FROM harga_jual_user WHERE tipe_user='$tipe_user' AND harga_jual>0 GROUP BY id_produk) AS C ON C.id_produk=A.id":"")." WHERE $filter ".(strlen($_query)>0?" AND (A.kode LIKE '%$_query%' OR A.nama LIKE '%$_query%' OR A.keyword LIKE '%$_query%')":"");
    }
    //die($sql);
    $db->mysql_query($sql, $rec_count, $rs);
    $nbrows = $rs[0]["TOTAL"];
    $data = array();
    if($nbrows>0) {
        if(strlen($tag)>0) {
            $data = $db->getFieldValue("produk_to_category AS B LEFT JOIN produk AS A ON A.id=B.id_produk".(count($data_user)>0?" LEFT JOIN (SELECT id_produk, harga_jual FROM harga_jual_user WHERE tipe_user='$tipe_user' AND harga_jual>0 GROUP BY id_produk) AS C ON C.id_produk=A.id":""), array("A.*, IF(A.harga_diskon>0 AND IF(A.from_date_harga_diskon IS NOT NULL, A.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_harga_diskon IS NOT NULL, A.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS harga_promo, IF(A.persen_diskon>0 AND IF(A.from_date_persen_diskon IS NOT NULL, A.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_persen_diskon IS NOT NULL, A.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS diskon_promo".(count($data_user)>0?", IF(C.harga_jual IS NOT NULL, C.harga_jual, A.harga_jual) AS harga_jual_khusus":"")), array(), array(), $_limit, $_limit*($_page-1), " $order_by ",  $tag . (strlen($_query)>0?" AND (A.kode LIKE '%$_query%' OR A.nama LIKE '%$_query%' OR A.keyword LIKE '%$_query%')":"")); 
        } else {
            $data = $db->getFieldValue("produk AS A".(count($data_user)>0?" LEFT JOIN (SELECT id_produk, harga_jual FROM harga_jual_user WHERE tipe_user='$tipe_user' AND harga_jual>0 GROUP BY id_produk) AS C ON C.id_produk=A.id":""), array("A.*, IF(A.harga_diskon>0 AND IF(A.from_date_harga_diskon IS NOT NULL, A.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_harga_diskon IS NOT NULL, A.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS harga_promo, IF(A.persen_diskon>0 AND IF(A.from_date_persen_diskon IS NOT NULL, A.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_persen_diskon IS NOT NULL, A.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS diskon_promo".(count($data_user)>0?", IF(C.harga_jual IS NOT NULL, C.harga_jual, A.harga_jual) AS harga_jual_khusus":"")), array(), array(), $_limit, $_limit*($_page-1), " $order_by ",  " $filter " . (strlen($_query)>0?" AND (A.kode LIKE '%$_query%' OR A.nama LIKE '%$_query%' OR A.keyword LIKE '%$_query%')":"")); 
        }
        
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
    }
    $db->mysql_close();
     
    $rasult = array(
        "totalCount" => $nbrows,
        "topics" => $data,
        "next_page" => $_page+(count($data)==0?0:1)
    );
    
    die(json_encode($rasult));