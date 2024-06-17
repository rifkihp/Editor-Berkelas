<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    //id bank transfer
    $id = explode(",", $_POST["id"]);
    $data = $db->getFieldValue("bank_transfer", array("gambar"), array("id" => $id));
    foreach ($data as $key => $value) {    
        if(file_exists(realpath($root)."/uploads/bank/".$value["gambar"])) {
            unlink(realpath($root)."/uploads/bank/".$value["gambar"]);
        }
    }
    $db->mysql_delete("bank_transfer", array("id" => $id));
        
    $db->mysql_close();
    $_SESSION["alert_success"] = "Hapus data bank transfer berhasil.";
    die(json_encode(array("success" => true, "message" => "Hapus data bank transfer berhasil.")));