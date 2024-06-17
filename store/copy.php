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
        $nama_file = "default.png";
        if(file_exists(realpath($root)."/uploads/temps/".$data[$i]["id_member"]."/".$data[$i]["foto1_produk"])) {
            echo realpath($root)."/uploads/temps/".$data[$i]["id_member"]."/".$data[$i]["foto1_produk"]."<br />";            
            $ext = substr($data[$i]["foto1_produk"], strrpos($data[$i]["foto1_produk"], '.') + 1);
            $nama_file = strtolower($db->URL_CovertString($data[$i]["nama"])."_".$db->create_kode_unik(4).".".$ext);
            copy(
                realpath($root)."/uploads/temps/".$data[$i]["id_member"]."/".$data[$i]["foto1_produk"], 
                realpath($root)."/uploads/produk/".$nama_file
            );
        }

        $db->mysql_update("produk", array("foto1_produk" => $nama_file), array("id" => $data[$i]["id"]));
    }
    
    $db->mysql_close();
    die("DONE!");