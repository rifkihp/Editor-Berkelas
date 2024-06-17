<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect();
    
    $_limit    = 10;
    $_page     = $_POST["page"];
    $_query    = $_POST["query"];
    
    //get total
    $sql = "SELECT COUNT(*) AS TOTAL FROM mokes_pengguna WHERE id<>'".$_SESSION[SESSION_NAME]["id"]."'".(strlen($_query)>0?" AND (nama_lengkap LIKE '%$_query%' OR nama_pengguna LIKE '%$_query%')":"");
    $db->mysql_query($sql, $rec_count, $rs);
    //echo($sql);
    $nbrows = $rs[0]["TOTAL"];
    
    $data = array();
    if($nbrows>0) {
        $sql = "SELECT id, nama_lengkap, nama_pengguna, photo FROM mokes_pengguna WHERE id<>'".$_SESSION[SESSION_NAME]["id"]."' " . 
                (strlen($_query)>0?"AND (nama_lengkap LIKE '%$_query%' OR nama_pengguna LIKE '%$_query%') ":"") .
                "ORDER BY id LIMIT ".(($_page-1)*$_limit).",".$_limit;
        //echo($sql);
        $db->mysql_query($sql, $rec_count, $data);
    }
     $db->mysql_close();
     
    $rasult = array(
        "totalCount" => $nbrows,
        "topics" => $data,
        "next_page" => $_page+1
    );
    
    die(json_encode($rasult));