<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect(true);
    
    
    
    $sql = "SELECT * FROM konten;
    ";
    $db->mysql_query($sql, $rs_num, $rs);
    $data = array();
    foreach($rs as $key => $value) {
        $data[$key] = array(
            "display" => $value["nama_alamat"],
            "value" => $value["nama_alamat"],
            "data" => $value
        ); 
    }
    
    $db->mysql_close();
    die(json_encode($data));