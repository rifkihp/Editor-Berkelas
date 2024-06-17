<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_limit    = 3;
    $_page     = $_POST["page"];
    $_id_grup  = $_POST["id_grup"];
    

    $sql = "SELECT 
        C.id,
        C.videoId,
        C.title,
        C.duration
    FROM 
        video_to_category AS A LEFT JOIN
        category AS B ON A.id_kategori=B.id LEFT JOIN 
        video AS C ON A.id_video=C.id
    WHERE 
        B.id_parent=".$_id_grup."
    GROUP BY 
        C.id
    ORDER BY 
        C.id
    LIMIT
        ".$_limit*($_page-1).", ".$_limit."";
    $db->mysql_query($sql, $rec_count, $data);
    $db->mysql_close();
     
    $result = array(
        "topics" => $data,
        "next_page" => $_page+(count($data)==0?0:1)
    );
    
    die(json_encode($result));