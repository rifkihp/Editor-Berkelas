<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_limit    = 20;
    $_page     = $_POST["page"];
    $_id_user = $_POST["id_user"];
    
    $data = $db->getFieldValue("kartagram AS A LEFT JOIN member AS B ON A.id_member=B.id LEFT JOIN (SELECT id_kartagram, COUNT(*) AS likes FROM kartagram_like GROUP BY id_kartagram) AS C ON A.id=C.id_kartagram LEFT JOIN kartagram_like AS D ON A.id=D.id_kartagram AND D.id_member='".$_id_user."'", array("A.id", "B.id AS id_owner", "CONCAT(B.first_name, ' ', B.last_name) AS ownner", "DATE_FORMAT(A.tanggal, '%d.%m.%Y') AS tanggal", "A.gambar", "A.keterangan", "B.photo", "C.likes", "IF(D.id_member IS NULL, 0, 1) AS favorite"), array(), array(), $_limit, $_limit*($_page-1), " A.tanggal DESC "); 
    $db->mysql_close();
     
    $result = array(
        "topics" => $data,
        "next_page" => $_page+(count($data)==0?0:1)
    );
    
    die(json_encode($result));