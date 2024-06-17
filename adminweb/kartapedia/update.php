<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //validasi-validasi
    if(strlen($_POST["nama"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama kategori harus diisi.")));
    }
    
    $data = $db->getFieldValue("kartapedia", array("header"), array("id" => $_POST["id"]));
    $filename = $data[0]["header"];
    if(strlen($_POST['filename_gambar'])>0) {
        $img = $_POST['filename_gambar'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $upload_directory=realpath($root) . "/uploads/kartapedia/";            
        $filename = strtolower($db->URL_CovertString($_POST["nama"]))."_".$db->create_kode_unik(4).".png";
        file_put_contents($upload_directory.$filename, $data);
    }
    unset($_POST['filename_gambar']);
    $_POST["header"] = $filename;
    
    if(file_exists(realpath($root)."/uploads/kartapedia/".$data[0]["header"]) && $data[0]["header"]!="default.png") {
        unlink(realpath($root)."/uploads/kartapedia/".$data[0]["header"]);
    }
    
    //insert data kartapedia
    $db->mysql_update("kartapedia", $_POST, array("id" => $_POST["id"]));
    
    $_SESSION["alert_success"] = "Edit kartapedia berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));