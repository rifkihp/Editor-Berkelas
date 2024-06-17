<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $id = explode(",", $_POST["id"]);    
    
    $data = $db->getFieldValue(
        "member", 
        array(
            "photo"
        ), 
        array("id" => $id)
    );
    
    foreach ($data as $key => $value) {
        if(file_exists(realpath($root)."/uploads/member/".$value["photo"]) && $value["photo"]!="default.png") {
            unlink(realpath($root)."/uploads/member/".$value["photo"]);
        }
    }
    
    $db->mysql_delete("member", array("id" => $id));
    $db->mysql_delete("customer_address", array("id_member" => $id));
    
        
    $db->mysql_close();
    $_SESSION["alert_success"] = "Hapus data customer berhasil.";
    die(json_encode(array("success" => true, "message" => "Hapus data customer berhasil.")));