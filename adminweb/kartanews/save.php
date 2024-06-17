<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    $id = $db->getLastNumber("kartanews", "id");
    $temps_tanggal = explode("-", $_POST["tanggal"]);
    
    $db->mysql_insert(
        "kartanews", 
        array(
            "id"          => $id,
            "judul"       => $_POST["judul"],
            "konten"      => $_POST["konten"],
            "kategori_id" => $_POST["kategori_id"],
            "is_new"      => $_POST["is_new"],
            "tanggal"     => $temps_tanggal[2]."-".$temps_tanggal[1]."-".$temps_tanggal[0],
            "date_create" => date("Y-m-d H:i:s"),
            "gambar"      => $_POST["filename_gambar"],
            "date_update" => date("Y-m-d H:i:s"),
            "is_aktif"    => 1  
        )      
    );
    
    $_SESSION["alert_success"] = "Tambah data karta news berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));