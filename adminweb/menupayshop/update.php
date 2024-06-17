<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //validasi-validasi
    if(strlen($_POST["nama"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama shortcut harus diisi.")));
    }
    
    $data = $db->getFieldValue("menu_payshop", array("header"), array("id" => $_POST["id"]));
    $filename = $data[0]["icon"];
    if(strlen($_POST['filename_gambar'])>0) {
        $img = $_POST['filename_gambar'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $upload_directory=realpath($root) . "/uploads/ppob/";            
        $filename = strtolower($db->URL_CovertString($_POST["nama"]))."_".$db->create_kode_unik(4).".png";
        file_put_contents($upload_directory.$filename, $data);
    }
    unset($_POST['filename_gambar']);
    $_POST["header"] = $filename;
    
    if(file_exists(realpath($root)."/uploads/ppob/".$data[0]["icon"]) && $data[0]["icon"]!="default.png") {
        unlink(realpath($root)."/uploads/ppob/".$data[0]["icon"]);
    }
    
    //insert data shortcut
    $db->mysql_update("menu_payshop", $_POST, array("id" => $_POST["id"]));
    
    $_SESSION["alert_success"] = "Edit shortcut berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));