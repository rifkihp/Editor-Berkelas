<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_id = $_POST["id"];        
    $sql = "SELECT id, DATE_FORMAT(tanggal, '%d-%m-%Y') AS tgl, judul, konten, gambar FROM mokes_berita WHERE id='$_id' ";
    //echo($sql);
    $db->mysql_query($sql, $rec_count, $data);
    foreach ($data as $key => $value) {
        $data[$key]["header"] = $db->limitTextKonten($data[$key]["konten"], 150);    
    }
        
    $db->mysql_close();
    
    die(json_encode($data[0]));