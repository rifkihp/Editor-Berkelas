<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $id = explode(",", $_POST["id"]);
    $data = $db->getFieldValue("kartanews", array("gambar"), array("id" => $id));
    foreach ($data as $key => $value) {    
        if(file_exists(realpath($root)."/uploads/kartanews/".$value["gambar"]) && $value["gambar"]!="default.png") {
            unlink(realpath($root)."/uploads/kartanews/".$value["gambar"]);
        }
    }
    $db->mysql_delete("kartanews", array("id" => $id));
        
    $db->mysql_close();
    $_SESSION["alert_success"] = "Hapus data kartanews berhasil.";
    die(json_encode(array("success" => true, "message" => "Hapus data kartanews berhasil.")));