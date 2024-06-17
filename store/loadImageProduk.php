<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    //$_POST["id_produk"] = "4863";    
    $sql_induk = "SELECT nama_file FROM gambar_produk WHERE id_produk='".$_POST["id_produk"]."' ORDER BY urutan";
    $db->mysql_query($sql_induk, $rec_count, $data);
    $db->mysql_close();
     
    $rasult = array(
        "topics" => $data
    );
    
    die(json_encode($rasult));