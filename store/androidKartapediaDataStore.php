<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    //$data_banner = $db->getFieldValue("banner", array("id", "nama", "id_kategori AS kategori", "filename AS banner"), array("is_aktif" => "Y"));
    
    //data induk;
    $sql_induk = "SELECT A.id, A.nama, A.header FROM kartapedia AS A ORDER BY A.id";
    $db->mysql_query($sql_induk, $rec_count, $data);


    $sql = "SELECT A.id, A.nama, A.header FROM unitteknis AS A ORDER BY A.id";
    $db->mysql_query($sql, $rec_count, $data_ut);
    
    $db->mysql_close();
     
    $rasult = array(
        "unit_teknis" => $data_ut, 
        "topics" => $data
    );
    
    die(json_encode($rasult));