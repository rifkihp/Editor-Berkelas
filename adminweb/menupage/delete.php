<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $id = explode(",", $_POST["id"]);
    
    //DELETE MENU PAGE
    $data_menupage = $db->getFieldValue("menu_page", array("*"), array("id" => $_POST["id"]));
    
    $img_src = explode(",", $data_menupage[0]["img_src"]);
    foreach($img_src as $i => $value) {
        if(file_exists(realpath($root)."/uploads/menupage/".$value)) {
            unlink(realpath($root)."/uploads/menupage/".$value);
        }
    }
    $db->mysql_delete("produk", array("id" => $id));
        
    $db->mysql_close();
    $_SESSION["alert_success"] = "Hapus data halaman menu berhasil.";
    die(json_encode(array("success" => true, "message" => "Hapus data halaman menu berhasil.")));