<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_limit    = 10;
    $_id_kartacare = $_POST["id_kartacare"];
    $_page     = $_POST["page"];
    
    //get total
    $sql = "SELECT COUNT(*) AS TOTAL FROM kartacare_donasi AS A WHERE A.status=2 AND A.id_kartacare='".$_id_kartacare."'";
    $db->mysql_query($sql, $rec_count, $rs);
    $nbrows = $rs[0]["TOTAL"];
    $data = array();
    if($nbrows>0) {
        $data = $db->getFieldValue("kartacare_donasi AS A LEFT JOIN member AS B ON A.id_member=B.id", array("A.id", "CONCAT(B.first_name, ' ', last_name) AS nama", "DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y %H:%i') AS tanggal", "B.photo", "A.keterangan", "A.total AS jumlah"), array("A.status" => 2, "A.id_kartacare" => $_id_kartacare), array(), $_limit, $_limit*($_page-1), " A.tanggal_jam DESC "); 
    }
    $db->mysql_close();
    
    $rasult = array(
        "topics" => $data,
        "next_page" => $_page+(count($data)==0?0:1)
    );
    
    die(json_encode($rasult));