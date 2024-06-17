<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_limit    = 20;
    $_page     = $_POST["page"];
    $_query    = $_POST["query"];
    
    $data = $db->getFieldValue("kartacare AS A LEFT JOIN kartacare_gambar AS B ON A.id=B.id_kartacare AND as_default='Y' LEFT JOIN (SELECT id_kartacare, COUNT(*) AS donatur, SUM(total) AS terkumpul FROM kartacare_donasi WHERE status=2 GROUP BY id_kartacare) AS C ON A.id=C.id_kartacare", array("A.id", "A.judul", "DATE_FORMAT(A.tanggal, '%d-%m-%Y') AS tanggal", "A.penjelasan", "A.kontak", "A.nohp", "DATE_FORMAT(A.jatuhtempo, '%d-%m-%Y') AS jatuhtempo", "A.biaya", "COALESCE(C.terkumpul, 0) AS terkumpul",  "C.donatur", "(COALESCE(C.terkumpul, 0)/A.biaya)*100 AS pencapaian", "DATEDIFF(A.jatuhtempo, CURDATE()) AS batas_waktu", "B.nama_file AS gambar"), array("A.status" => 1), array(), $_limit, $_limit*($_page-1), " A.date_update DESC ", " 1 " . (strlen($_query)>0?" AND A.judul LIKE '%$_query%' ":"")); 
    foreach ($data as $key => $value) {
        $data[$key]["pencapaian"] = number_format($value["pencapaian"], 2, ".", "");
    }
                
    $db->mysql_close();
     
    $result = array(
        "topics" => $data,
        "next_page" => $_page+(count($data)==0?0:1)
    );
    
    die(json_encode($result));