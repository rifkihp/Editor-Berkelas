<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
           
    $_id_user = $_POST["id_user"];
    $_limit    = 10;
    $_page     = 1;
    
    $data_banner = $db->getFieldValue("banner", array("id", "nama", "id_kategori AS kategori", "filename AS banner"), array("is_aktif" => "Y"));
    $data_kartapedia = $db->getFieldValue("kartapedia AS A", array("A.id", "A.nama", "A.header"), array(), array(), 0, 0, " A.id ");
    $data_unitteknis = $db->getFieldValue("unitteknis AS A", array("A.id", "A.nama", "A.header"), array(), array(), 0, 0, " A.id ");

    $data_ppob = $db->getFieldValue("menu_payshop", array("id", "nama", "kode", "tipe", "header"), array("tampil" => 1), array(), 0, 0, " urutan ");    
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
    
    $data_kartanewsterbaru = $db->getFieldValue("kartanews AS A LEFT JOIN kartanews_category AS B ON A.kategori_id=B.id", array("A.id", "DATE_FORMAT(A.tanggal, '%d.%m.%Y') AS tanggal", "A.date_create AS sejak", "A.judul", "B.nama AS kategori", "A.gambar"), array("is_new" => 1), array(), $_limit, $_limit*($_page-1), " A.date_create DESC "); 
    foreach($data_kartanewsterbaru as $key => $value) {
        $data_kartanewsterbaru[$key]["sejak"] = $db->dateDiff($value["sejak"], date("Y-m-d H:i:s"));
    } 
    
    $data_kartanews = $db->getFieldValue("kartanews AS A LEFT JOIN kartanews_category AS B ON A.kategori_id=B.id", array("A.id", "DATE_FORMAT(A.tanggal, '%d.%m.%Y') AS tanggal", "A.date_create AS sejak", "A.judul", "B.nama AS kategori", "A.gambar"), array("is_new" => 0), array(), $_limit, $_limit*($_page-1), " A.date_create DESC "); 
    foreach($data_kartanews as $key => $value) {
        $data_kartanews[$key]["sejak"] = $db->dateDiff($value["sejak"], date("Y-m-d H:i:s")); 
    } 
    
    $data_kartacare = $db->getFieldValue("kartacare AS A LEFT JOIN kartacare_gambar AS B ON A.id=B.id_kartacare AND as_default='Y' LEFT JOIN (SELECT id_kartacare, COUNT(*) AS donatur, SUM(total) AS terkumpul FROM kartacare_donasi WHERE status=2 GROUP BY id_kartacare) AS C ON A.id=C.id_kartacare", array("A.id", "A.judul", "DATE_FORMAT(A.tanggal, '%d-%m-%Y') AS tanggal", "A.penjelasan", "A.kontak", "A.nohp", "DATE_FORMAT(A.jatuhtempo, '%d-%m-%Y') AS jatuhtempo", "A.biaya", "COALESCE(C.terkumpul, 0) AS terkumpul", "C.donatur", "(COALESCE(C.terkumpul, 0)/A.biaya)*100 AS pencapaian", "DATEDIFF(A.jatuhtempo, CURDATE()) AS batas_waktu", "B.nama_file AS gambar"), array("A.status" => 1), array(), $_limit, $_limit*($_page-1), " A.date_update DESC "); 
    foreach ($data_kartacare as $key => $value) {
        $data_kartacare[$key]["pencapaian"] = number_format($value["pencapaian"], 2, ".", "");
    }
    $wa =  $db->getFieldValue("umum_contact", array("contact"), array("tipe" => "wa"));
    
    $sql = "SELECT A.id, A.first_name, A.last_name, A.email, A.phone, A.photo, A.saldo FROM member AS A WHERE A.id='".$_id_user."'";
    $db->mysql_query($sql, $rec_count, $user);
    
    $db->mysql_close();
    die(json_encode(array(
        "wa_operator" => str_replace(" ", "", $wa[0]["contact"]), 
        "banner" => $data_banner, 
        "kartapedia" => $data_kartapedia,
        "unitteknis" => $data_unitteknis,
        "ppob" => $data_ppob,
        "produkterbaru" => $produk_lain,
        "kartanewsterbaru" => $data_kartanewsterbaru,
        "kartanews" => $data_kartanews,
        "kartacare" => $data_kartacare,
        "next_page_kartacare" => $_page+(count($data_kartacare)==0?0:1),
        "next_page_kartanews" => $_page+(count($data_kartanews)==0?0:1), 
        "user" => $user[0]
    )));