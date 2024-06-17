<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    
    $sql = "SELECT A.id, A.nama, A.header FROM unitteknis AS A ORDER BY A.id";
    $db->mysql_query($sql, $rec_count, $data);    
    $db->mysql_close();
     
    $rasult = array( 
        "topics" => $data
    );
    
    die(json_encode($rasult));