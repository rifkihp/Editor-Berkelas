<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $id = explode(",", $_POST["id"]);
    
    //DELETE CATEGORY
    $db->mysql_delete("produk_to_category", array("id_produk" => $id));
    
    //DELETE HARGA JUAL USER
    $db->mysql_delete("harga_jual_user", array("id_produk" => $id));
    
    //DELETE VARIAN
    $db->mysql_delete("produk_varian", array("id_produk" => $id));
    
    //DELETE GAMBAR
    $data_gambar = $db->getFieldValue("gambar_produk", array("*"), array("id_produk" => $id));
    foreach($data_gambar as $i => $value) {
        if(file_exists(realpath($root)."/uploads/produk/".$data_gambar[$i]["nama_file"])) {
            unlink(realpath($root)."/uploads/produk/".$data_gambar[$i]["nama_file"]);
        }
    }
    $db->mysql_delete("gambar_produk", array("id_produk" => $id));
    
    
    //DELETE PRODUK
    $data_produk = $db->getFieldValue("produk", array("*"), array("id" => $id));
    $img_src = explode(",", $data_produk[0]["img_src"]);
    foreach($img_src as $i => $value) {
        if(file_exists(realpath($root)."/uploads/produk/penjelasan/".$value)) {
            unlink(realpath($root)."/uploads/produk/penjelasan/".$value);
        }
    }
    $db->mysql_delete("produk", array("id" => $id));
        
    $db->mysql_close();
    $_SESSION["alert_success"] = "Hapus data produk berhasil.";
    die(json_encode(array("success" => true, "message" => "Hapus data produk berhasil.")));