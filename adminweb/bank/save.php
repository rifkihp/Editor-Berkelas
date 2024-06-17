<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //validasi-validasi
    if(strlen($_POST["nama_bank"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama bank harus diisi.")));
    }
    
    if(strlen($_POST["cabang"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Cabang harus diisi.")));
    }
    
    if(strlen($_POST["no_rekening"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "No. Rekening harus diisi.")));
    }
    
    if(strlen($_POST["nama_pemilik_rekening"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Atas nama harus diisi.")));
    }
    
    if(strlen($_POST['filename_gambar'])>0) {
        $img = $_POST['filename_gambar'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $upload_directory=realpath($root) . "/uploads/bank/";            
        $filename = strtolower($db->URL_CovertString($_POST["nama_bank"]))."_".$db->create_kode_unik(4).".png";
        file_put_contents($upload_directory.$filename, $data);
    }
    unset($_POST['filename_gambar']);
    $_POST["gambar"] = $filename;
            
    //get last id kategori
    $_POST["id"] = $db->getLastNumber("bank_transfer", "id");
    
    //insert data bank
    $db->mysql_insert("bank_transfer", $_POST);
    
    $_SESSION["alert_success"] = "Tambah bank baru berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));