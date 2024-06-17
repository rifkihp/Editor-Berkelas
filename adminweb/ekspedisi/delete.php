<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    //id ekspedisi transfer
    $id = explode(",", $_POST["id"]);
    $data = $db->getFieldValue("ekspedisi", array("gambar"), array("id" => $id));
    foreach ($data as $key => $value) {    
        if(file_exists(realpath($root)."/uploads/ekspedisi/".$value["gambar"])) {
            unlink(realpath($root)."/uploads/ekspedisi/".$value["gambar"]);
        }
    }
    $db->mysql_delete("ekspedisi", array("id" => $id));
        
    $db->mysql_close();
    $_SESSION["alert_success"] = "Hapus data ekspedisi transfer berhasil.";
    die(json_encode(array("success" => true, "message" => "Hapus data ekspedisi berhasil.")));