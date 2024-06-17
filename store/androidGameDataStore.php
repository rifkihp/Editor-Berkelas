<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $sql = "SELECT A.id, A.provider, A.provider_sub, A.code, A.description, A.price, A.jual, 'karta_default.png' logo FROM ppob_produk AS A WHERE A.operator_sub='".$_POST["nohp"]."' ORDER BY A.jual";
    $db->mysql_query($sql, $rec_count, $data);
    foreach ($data as $key => $value) {
        //$data[$key]['description'] = substr($value["description"], 0, strlen($value["description"])-3)." RB";
        $data[$key]['tarif'] = "Rp ".number_format($value['jual'], 0, '.', ',');
    }

    $db->mysql_close();
    
    $result = array("topics" => $data);
    die(json_encode($result));