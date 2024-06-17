<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_limit        = 100;
    $_id_user      = $_POST["id_user"];
    $_id_kartagram = $_POST["id_kartagram"];
    
    $data = array();
    $sql = "SELECT COUNT(*) AS TOTAL FROM kartagram_komentar WHERE id_kartagram=$_id_kartagram";
    //echo $sql;
    $db->mysql_query($sql, $rec_count, $totalrecord);
    $nbrows = $totalrecord[0]["TOTAL"];
    $_page =  ceil($nbrows/$_limit);    

    if($nbrows>0) {
        $sql = "SELECT 
            A.id, 
            A.pesan AS message, 
            A.tanggal_jam AS datetime,
            DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y %H:%i:%s') AS tanggal_komentar, 
            CONCAT(B.first_name, ' ', B.last_name) AS nama, 
            B.photo,
            A.user_read=0 AS is_new_komentar,
            IF(A.from='".$_id_user."', 1, 0) AS is_self,
            1 AS is_sent
        FROM 
            kartagram_komentar AS A LEFT JOIN 
            member AS B ON A.from=B.id
        WHERE 
            A.id_kartagram=$_id_kartagram
        ORDER BY 
            A.id 
        LIMIT ".(($_page-1)*$_limit).",".$_limit;
            
        $db->mysql_query($sql, $rec_count, $data);
        foreach ($data as $key => $value) {
            if($value["is_new_komentar"]=='new') { $db->mysql_update("kartagram_komentar", array("user_read" => 1), array("id" => $value["id"])); }                
            $data[$key]["is_self"] = $data[$key]["is_self"]==1;
            $data[$key]["is_sent"] = $data[$key]["is_sent"]==1;
        }
    }
    $db->mysql_close();
     
    $rasult = array(
        "topics" => $data
    );
    
    die(json_encode($rasult));