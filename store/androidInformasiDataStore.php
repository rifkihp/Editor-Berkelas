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
    
    $_limit    = 10;
    $_page     = $_POST["page"];
    
    
    //get total
    $sql = "SELECT COUNT(*) AS TOTAL FROM informasi AS A";
    $db->mysql_query($sql, $rec_count, $rs);
    $nbrows = $rs[0]["TOTAL"];
    $data = array();
    if($nbrows>0) {
        $data = $db->getFieldValue("informasi AS A", array("A.id", "DATE_FORMAT(A.tanggal, '%d-%m-%Y') AS tanggal", "A.judul", "A.konten", "A.gambar"), array(), array(), $_limit, $_limit*($_page-1), " A.tanggal DESC "); 
        foreach($data as $key => $value) {
            //$data[$key]["tanggal"] = $db->dateDiff(date("Y-m-d H:i:s"), $value["tanggal"]);
            $data[$key]["header"]  = preg_replace( "/\r|\n/", "", $db->limitTextKonten($value["konten"], 150));
        }
    }
    $db->mysql_close();
     
    $rasult = array(
        "totalCount" => $nbrows,
        "topics" => $data,
        "next_page" => $_page+(count($data)==0?0:1)
    );
    
    die(json_encode($rasult));