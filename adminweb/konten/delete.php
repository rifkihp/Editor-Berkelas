<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $id = explode(",", $_POST["id"]);
    
    //DELETE CATEGORY
    $db->mysql_delete("konten_to_category", array("id_konten" => $id));

    //DELETE BANNER
    $db->mysql_delete("konten_to_banner", array("id_konten" => $id));

    $data = $db->getFieldValue("konten", array("banner", "thumbnail"), array("id" => $id));
    foreach ($data as $key => $value) {
        if(file_exists(realpath($root)."/uploads/konten/banner/".$value["banner"])) {
            unlink(realpath($root)."/uploads/konten/banner/".$value["banner"]);
        }

        if(file_exists(realpath($root)."/uploads/konten/thumbnail/".$value["thumbnail"])) {
            unlink(realpath($root)."/uploads/konten/thumbnail/".$value["thumbnail"]);
        }
    }
    $db->mysql_delete("konten", array("id" => $id));
        
    $db->mysql_close();
    $_SESSION["alert_success"] = "Hapus data konten berhasil.";
    die(json_encode(array("success" => true, "message" => "Hapus data konten berhasil.")));