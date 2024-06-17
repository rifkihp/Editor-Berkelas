<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    
    
    $data = $db->getFieldValue("kartanews", array("gambar"), array("id" => $_POST["id"]));
    
    if(strlen($_POST["filename_gambar"])>0) {
        if(file_exists(realpath($root)."/uploads/kartanews/".$data[0]["gambar"]) && $data[0]["gambar"]!="default.png") {
            unlink(realpath($root)."/uploads/kartanews/".$data[0]["gambar"]);
        }
    } else {
        $_POST["filename_gambar"] = $data[0]["gambar"];
    }
    
    //update data kartanews
    $temps_tanggal = explode("-", $_POST["tanggal"]);
    $db->mysql_update(
        "kartanews", 
        array(
            "judul"       => $_POST["judul"],
            "kategori_id" => $_POST["kategori_id"],
            "is_new"      => $_POST["is_new"],
            "konten"      => $_POST["konten"],
            "tanggal"     => $temps_tanggal[2]."-".$temps_tanggal[1]."-".$temps_tanggal[0],
            "gambar"      => $_POST["filename_gambar"],
            "date_update" => date("Y-m-d H:i:s"),
            "is_aktif"    => 1
        ), 
        array(
            "id" => $_POST["id"]
        )
    );
    
    $_SESSION["alert_success"] = "Edit karta news berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));