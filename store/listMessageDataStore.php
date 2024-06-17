<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama(CLIENT_SESSION_NAME);
    $db->mysql_connect();
    
    $_limit    = 10;
    $_page     = $_POST["page"];
    
    //get total
    $sql = "SELECT COUNT(*) AS TOTAL FROM message AS A WHERE A.to='".$_SESSION[CLIENT_SESSION_NAME]["user"]["id"]."'";
    $db->mysql_query($sql, $rec_count, $rs);
    $nbrows = $rs[0]["TOTAL"];
    
    $data = array();
    if($nbrows>0) {
        $data = $db->getFieldValue("message AS A", array("A.id", "A.pesan AS message", "A.tanggal_jam AS datetime", "A.status"), array("A.to" => $_SESSION[CLIENT_SESSION_NAME]["user"]["id"]), array(), $_limit, $_limit*($_page-1), " A.tanggal_jam DESC "); 
        foreach($data as $key => $value) {
            $data[$key]["isRead"] = $value["status"]==0?false:true;
        }
    }
    $db->mysql_close();
     
    $rasult = array(
        "totalCount" => $nbrows,
        "topics" => $data,
        "next_page" => $_page+(count($data)==0?0:1)
    );
    
    die(json_encode($rasult));