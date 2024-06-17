<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    //data induk;
    $sql_induk = "SELECT A.id, A.nama, A.penjelasan, COALESCE(B.TOTAL, 0) AS header FROM category AS A LEFT JOIN (SELECT COUNT(*) AS TOTAL, B2.id_parent AS id_kategori FROM produk_to_category AS B1 LEFT JOIN category AS B2 ON B1.id_kategori=B2.id WHERE B2.id_parent IS NOT NULL AND B2.id_parent>0 GROUP BY B2.id_parent) AS B ON A.id=B.id_kategori WHERE A.id_parent=0 ORDER BY A.nama";
    $db->mysql_query($sql_induk, $rec_count, $data);
    $data_kategori = array();
    foreach ($data as $key => $value) {
        //data anak;
        $sql_anak = "SELECT A.id, A.nama, A.penjelasan, COALESCE(B.TOTAL, 0) AS header FROM category AS A LEFT JOIN (SELECT COUNT(*) AS TOTAL, id_kategori FROM produk_to_category GROUP BY id_kategori) AS B ON A.id=B.id_kategori WHERE A.id_parent=".$data[$key]["id"]." ORDER BY A.nama";
        $db->mysql_query($sql_anak, $rec_count, $data[$key]["child"]);
        if($rec_count>0) {
            $data_kategori[count($data_kategori)] = $data[$key];
        }
    }
    
    $data_brand = $db->getFieldValue("brand", array("id", "kode", "nama", "logo"));
    $data_ukuran = $db->getFieldValue("ukuran", array("id", "ukuran", "logo"));
    $data_warna = $db->getFieldValue("warna", array("id", "warna", "logo"));
    
    $db->mysql_close();
     
    $rasult = array(
        "kategori" => $data_kategori,
        "brand" => $data_brand,
        "ukuran" => $data_ukuran,
        "warna" => $data_warna
    );
    
    die(json_encode($rasult));