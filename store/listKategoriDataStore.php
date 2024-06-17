<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $id = $_POST["id"];
    //cek id kategori
    $data = $db->getFieldValue("category AS A LEFT JOIN (SELECT COUNT(*) AS TOTAL, id_kategori FROM produk_to_category GROUP BY id_kategori) AS B ON A.id=B.id_kategori", array("A.id", "A.id_parent", "CONCAT('All - ', A.nama) AS nama", "A.penjelasan", "COALESCE(B.TOTAL, 0) AS header"), array("A.id" => $id));
    if($data[0]["id_parent"]==0) {
        $data_sub = $db->getFieldValue("category AS A LEFT JOIN (SELECT COUNT(*) AS TOTAL, id_kategori FROM produk_to_category GROUP BY id_kategori) AS B ON A.id=B.id_kategori", array("A.id", "A.id_parent", "A.nama", "A.penjelasan", "COALESCE(B.TOTAL, 0) AS header"), array("A.id_parent" => $data[0]["id"]));
    } else {
        $data_sub = $db->getFieldValue("category AS A LEFT JOIN (SELECT COUNT(*) AS TOTAL, id_kategori FROM produk_to_category GROUP BY id_kategori) AS B ON A.id=B.id_kategori", array("A.id", "A.id_parent", "A.nama", "A.penjelasan", "COALESCE(B.TOTAL, 0) AS header"), array("A.id_parent" => $data[0]["id_parent"]));
        $data = $db->getFieldValue("category AS A LEFT JOIN (SELECT COUNT(*) AS TOTAL, id_kategori FROM produk_to_category GROUP BY id_kategori) AS B ON A.id=B.id_kategori", array("A.id", "A.id_parent", "CONCAT('All - ', A.nama) AS nama", "A.penjelasan", "COALESCE(B.TOTAL, 0) AS header"), array("A.id" => $data[0]["id_parent"]));
    }
    $data_kategori = array();
    foreach ($data as $key => $value) {
        $data_kategori[count($data_kategori)] = $value;
    }
    foreach ($data_sub as $key => $value) {
        $data_kategori[count($data_kategori)] = $value;
    }
    $db->mysql_close();
     
    $rasult = array(
        "totalCount" => count($data_kategori),
        "topics" => $data_kategori
    );
    
    die(json_encode($rasult));