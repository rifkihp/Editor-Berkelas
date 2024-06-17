<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

     //validasi-validasi
    if(strlen($_POST["kode"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kode brand harus diisi.")));
    }
    
    if(strlen($_POST["nama"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama brand harus diisi.")));
    }
    
    if(strlen($_POST['filename_gambar'])>0) {
        $img = $_POST['filename_gambar'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $upload_directory=realpath($root) . "/uploads/brand/";            
        $filename = strtolower($db->URL_CovertString($_POST["nama"]))."_".$db->create_kode_unik(4).".png";
        file_put_contents($upload_directory.$filename, $data);
    }
    unset($_POST['filename_gambar']);
    $_POST["logo"] = $filename;
    
    $data = $db->getFieldValue("brand", array("logo"), array("id" => $_POST["id"]));
    if(file_exists(realpath($root)."/uploads/brand/".$data[0]["logo"])) {
        unlink(realpath($root)."/uploads/brand/".$data[0]["logo"]);
    }
    
    //update data brand transfer
    $db->mysql_update("brand", $_POST, array("id" => $_POST["id"]));
    
    $_SESSION["alert_success"] = "Edit brand berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));