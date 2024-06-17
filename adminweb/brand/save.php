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
            
    //get last id kategori
    $_POST["id"] = $db->getLastNumber("brand", "id");
    
    //insert data brand
    $db->mysql_insert("brand", $_POST);
    
    $_SESSION["alert_success"] = "Tambah brand baru berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));