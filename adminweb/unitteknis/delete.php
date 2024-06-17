<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $id = explode(",", $_POST["id"]);
    $data = $db->getFieldValue("unitteknis", array("header"), array("id" => $id));
    foreach ($data as $key => $value) {    
        if(file_exists(realpath($root)."/uploads/unitteknis/".$value["header"]) && $value["header"]!="default.png") {
            unlink(realpath($root)."/uploads/unitteknis/".$value["header"]);
        }
    }
    $db->mysql_delete("unitteknis", array("id" => $id));
        
    $db->mysql_close();
    $_SESSION["alert_success"] = "Hapus data unitteknis berhasil.";
    die(json_encode(array("success" => true, "message" => "Hapus data unitteknis berhasil.")));