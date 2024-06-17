<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    //id klien update
    $id = $_POST["id"];    
    $data = $db->getFieldValue(
        "informasi", 
        array("gambar"), 
        array("id" => $id)
    );
            
    $db->mysql_delete("informasi", array("id" => $id));    
    if(file_exists(realpath($root)."/uploads/informasi/".$data[0]["gambar"])) {
        unlink(realpath($root)."/uploads/informasi/".$data[0]["gambar"]);
    }
    
    $db->mysql_close();
    $_SESSION["alert_success"] = "Hapus data informasi berhasil.";
    die(json_encode(array("success" => true, "message" => "Hapus data informasi berhasil.")));