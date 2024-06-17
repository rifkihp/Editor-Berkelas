<?php
    ini_set('max_execution_time', 1500);
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $sql = "SELECT * FROM produk ORDER BY id"; // LIMIT $start, $limit";
    echo $sql."<br />";
    $db->mysql_query($sql, $rec_count, $data);

    foreach ($data as $i => $value) {
        $db->mysql_update("produk", array("nama" => trim(ucwords(strtolower($value["nama"]))), "kode" => $db->getLastNumber("produk", "kode", 6, '')), array("id" => $value["id"]));
    }
    $sql = "UPDATE produk SET kode=CONCAT(SUBSTR(nama, 1, 1), kode)";
    $db->mysql_execute($sql);
    
    $db->mysql_close();
    die("DONE!");