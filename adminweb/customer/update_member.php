<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    $id = $db->checkIntegerRange($_POST["id"])?$_POST["id"]:0;
    
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
        $email_count = $db->getFieldValue("member", array("COUNT(*) AS TOTAL"), array("email" => $_POST["email"]), array(), 0, 0, "", "id<>'".$id."'");
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
    
    if(strlen($_POST["password"])>0 || strlen($_POST["konfirmasi"])>0) {
        if($_POST["password"]!=$_POST["konfirmasi"]) {
            $_error_message[count($_error_message)] = "- Password tidak valid.";
        } else if(strlen($_POST["password"])<6) {
            $_error_message[count($_error_message)] = "- Password minimal 6 karakter atau lebih.";
        }
    }
    
    if(count($_error_message)>0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => $_error_message)));
    }
        
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
        
    //get data banner update
    $data = $db->getFieldValue(
        "member", 
        array(
            "TRIM(UPPER(CONCAT(first_name, ' ', last_name))) AS nama",
            "photo",
            "password"
        ), 
        array("id" => $id)
    );
    $_new_password = strlen($_POST["password"])>0?$db->acakpassword($_POST["password"]):$data[0]["password"];
    
    if(isset($filename["photo"])) {
        if(file_exists(realpath($root)."/uploads/member/".$data[0]["photo"]) && $data[0]["photo"]!='default.png') {
            unlink(realpath($root)."/uploads/member/".$data[0]["photo"]);
        }
    } else {
        $filename["photo"] = $data[0]["photo"];
    }
    
    $db->mysql_update("member", array(
            "first_name" => $_POST["firstname"],
            "last_name" => $_POST["lastname"],
            "email" => $_POST["email"],
            "jenis_user" => $_POST["jenis_user"],
            "phone" => $_POST["no_hp"],
            "photo" => $filename["photo"],
            "password" => $_new_password        
        ), array(
            "id" => $id
        ));
    
    $data_alamat = $db->getFieldValue("customer_address", array("*"), array("id_member" => $id, "TRIM(UPPER(nama))" => trim(strtoupper($data[0]["nama"]))));
    if(count($data_alamat)>0) {
        $db->mysql_update(
            "customer_address", 
            array(
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
            ), array(
                "id" => $data_alamat[0]["id"]
            )
        );
    } else {
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
    }
        
    $_SESSION["alert_success"] = "Update data member berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));