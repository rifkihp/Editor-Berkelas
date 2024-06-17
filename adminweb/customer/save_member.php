<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    
   //validasi-validasi
    $_message = array();
    if(strlen($_POST["firstname"])==0) {
        $_error_message[count($_error_message)] = "- Nama depan harus diisi!";
    } 
    if(strlen($_POST["lastname"])==0) {
        $_error_message[count($_error_message)] = "- Nama belakang harus diisi!";
    }
    
    if(strlen($_POST["email"])==0) {
        $_error_message[count($_error_message)] = "- Alamat email harus diisi!";
    } else 
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $_error_message[count($_error_message)] = "- Alamat email tidak valid!";
    } else {
        $email_count = $db->getFieldValue("member", array("COUNT(*) AS TOTAL"), array("email" => $_POST["email"]));
        if($email_count[0]["TOTAL"]>0) {
            $_error_message[count($_error_message)] =  "- Alamat email sudah terpakai.";
        }
    }

    if(strlen($_POST["no_hp"])==0) {
        $_error_message[count($_error_message)] = "- No HP harus diisi.";
    }
    
    if(strlen($_POST["alamat"])==0) {
        $_error_message[count($_error_message)] = "- Alamat harus diisi.";
    }
        
    if(strlen($_POST["propinsi"])==0 || $_POST["id_propinsi"]=="0") {
        $_error_message[count($_error_message)] = "- Propinsi harus harus diisi.";
    }
    
    if(strlen($_POST["kota"])==0 || $_POST["id_kota"]=="0") {
        $_error_message[count($_error_message)] = "- Kota harus diisi.";
    }
    
    if(strlen($_POST["kecamatan"])==0 || $_POST["id_kecamatan"]=="0") {
        $_error_message[count($_error_message)] = "- Kecamatan harus diisi.";
    }
    
    if(strlen($_POST["kode_pos"])==0) {
        $_error_message[count($_error_message)] = "- Kode Pos harus diisi.";
    }
    
    if(strlen($_POST["password"])<6) {
        $_error_message[count($_error_message)] = "- Password minimal 6 karakter atau lebih.";
    } else  if($_POST["password"]!=$_POST["konfirmasi"]) {
         $_error_message[count($_error_message)] = "- Password tidak valid.";
    }
    
    if(count($_error_message)>0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => $_error_message)));
    }
        
    $id = $db->getLastNumber("member", "id");
    
    //upload photo
    $upload_array = array("photo");
    foreach ($upload_array as $value) {
        $img = $_POST["filename_".$value];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $upload_directory=realpath($root) . "/uploads/member/";    
        $filename[$value] = $db->create_kode_unik().".png";
        file_put_contents($upload_directory.$filename[$value], $data);
    }
    
    $db->mysql_insert(
        "member", 
        array(
            "id" => $id,
            "first_name" => $_POST["firstname"],
            "last_name" => $_POST["lastname"],
            "jenis_user" => $_POST["jenis_user"],
            "email" => $_POST["email"],
            "phone" => $_POST["no_hp"],
            "photo" => $filename["photo"],
            "tanggal_jam_create" => date('Y-m-d H:i:s'),
            "password" => $db->acakpassword($_POST["password"])
        )
    );
    
    $db->mysql_insert(
        "customer_address", 
        array(
            "id_member" => $id,
            "nama" => trim($_POST["firstname"] ." ". $_POST["lastname"]),
            "alamat" => $_POST["alamat"],
            "no_hp" => $_POST["no_hp"],
            "id_propinsi" => $_POST["propinsi"],
            "nama_propinsi" => $_POST["nama_propinsi"],
            "id_kota" => $_POST["kota"],
            "nama_kota" =>  $_POST["nama_kota"],        
            "id_kecamatan" => $_POST["kecamatan"],
            "nama_kecamatan" =>  $_POST["nama_kecamatan"],
            "kode_pos" => $_POST["kode_pos"]
        )
    );
        
    $_SESSION["alert_success"] = "Tambah member berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));