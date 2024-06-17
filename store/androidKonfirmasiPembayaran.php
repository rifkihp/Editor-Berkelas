<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama(CLIENT_SESSION_NAME);
    $db->mysql_connect(true);
    
    $id_member = $_POST["user_id"];
    $id_guest  = $_POST["guest_id"];
    $data_user = $db->getFieldValue("member", array("*"), array("id" => $id_member));
    
    if(strlen($_POST["kode_pemesanan"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kode transaksi harus diisi.")));
    }
    
    if(strlen($_POST["bank_tujuan"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Bank tujuan harus diisi.")));
    }
    
    if(strlen($_POST["jumlah_transfer"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Jumlah transfer harus diisi.")));
    }
    
    if(strlen($_POST["nama_bank_pengirim"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Bank pengirim harus diisi.")));
    }
    
    if(strlen($_POST["nama_pemilik_rekening"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama pemilik rekening pengirim harus diisi.")));        
    }     
    
    $data = $db->getFieldValue("ppob_trx_deposit", array("id", "kode", "status", "id_member"), array("kode" => str_replace("#", "", $_POST["kode_pemesanan"])));
    if(count($data)==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kode transaksi tidak valid.")));
    } else if($data[0]["status"]==3) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Pembayaran transaksi ".$_POST["kode_pemesanan"]." menunggu validasi admin.")));
    } else if($data[0]["status"]==4) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Transaksi ".$_POST["kode_pemesanan"]." tidak valid.")));
    } else if($data[0]["status"]==2 || $data[0]["status"]==5 || $data[0]["status"]==6) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Pembayaran transaksi ".$_POST["kode_pemesanan"]." sudah lunas.")));
    }
    
    //upload gambar
    if(!empty($_FILES["photo"])) {
        $file = $_FILES["photo"];
        $upload_directory=realpath($root) . "/uploads/konfirmasi/";
        $ext_str = "jpg,png,gif,bmp";
        $allowed_extensions=explode(',',$ext_str);
        $max_file_size = 1024*1000; //1024bytes = 1kbytes
        $overwrite_file = true;
        
        //get file extension from last sub string from last . character
        $ext = substr($file['name'], strrpos($file['name'], '.') + 1); 
        $unik = $db->create_kode_unik();
        $filename = $unik.".".$ext;
        $filename_big = $unik."_big.".$ext;

        /* check allowed extensions here */
        if (!in_array(strtolower($ext), $allowed_extensions)) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Hanya file yang berekstensi '$ext_str' yang bisa di upload.")));
        }

        /* check file size of the file if it exceeds the specified size warn user */
        if($file['size']>=$max_file_size) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Ukuran file tidak boleh melebihi  " . ($max_file_size/1024) . "kb.")));
        }
        
        if(!move_uploaded_file($file['tmp_name'], $upload_directory.$filename)) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Proses upload photo gagal.")));  //file can't moved with unknown reasons likr cleaning of server temperory files cleaning
        }
        
        copy($upload_directory.$filename, $upload_directory.$filename_big);
    }
    
    $_POST["kode_pemesanan"] = $data[0]["kode"];
    $_POST["id"]  = $db->getLastNumber("konfirmasi_pembayaran", "id");
    $_POST["tanggal_jam"]  = date("Y-m-d H:i:s");
    $_POST["photo"] = $filename;
    $_POST["id_member"] = $id_member;
    $_POST["id_guest"] = $id_guest;
    
    unset($_POST["user_id"]);
    unset($_POST["guest_id"]);
    $db->mysql_insert("konfirmasi_pembayaran", $_POST);
    
    $db->mysql_update("customer_order_header", array("status" => 3), array("id" => $data[0]["id"]));
        
    //INSERT HISTORI PEMESANAN
    $db->mysql_insert("histori_status_pemesanan", array(
        "id" => $db->getLastNumber("histori_status_pemesanan", "id"),
        "id_pemesanan" => $data[0]["id"],
        "tanggal_jam" => $_POST["tanggal_jam"],
        "penjelasan" => "Customer melakukan konfirmasi pembayaran sebesar Rp ".number_format($_POST["jumlah_transfer"], 0, '.', ',')."."
    ));

    //SEND EMAIL TO ADMIN
    $data_umum = $db->getFieldValue("umum", array("website", "mask_email"));
    $email_from = $data_umum[0]["mask_email"];
    $from_alias = $data_umum[0]["website"];
    
    $subject = "Konfirmasi Pembayaran Customer";
    $detail_message = "
        Customer ".(count($data_user)=="0"?"Tamu":($data_user[0]["first_name"] . " " . $data_user[0]["last_name"] ." (<a href=\"mailto:".$data_user[0]["email"]."\" target=\"_top\">".$data_user[0]["email"]."</a>)")) . "
        melakukan konfirmasi pembayaran sebesar Rp ".number_format($_POST["jumlah_transfer"], 0, '.', ',')." untuk transaksi <b><a href=\"".ADMINWEB_URL."/konfirmasi/\" target=\"_blank\">#".$data[0]["kode"]."</a></b>.";
    
    $data_admin = $db->getFieldValue("admin_users", array("*"), array("as_notification" => "Y"));
    foreach ($data_admin as $key => $value) {
        $email_to  = $value["email"];
        $to_alias = $data_umum[0]["nama"];
        $db->sendEmail($email_to, $to_alias, $subject, $detail_message, $email_from, $from_alias, $root);
    }
    
    //SEND EMAIL TO USER
//    $subject = "Konfirmasi Pembayaran";
//    $detail_message = "
//        Anda telah melakukan konfirmasi pembayaran sebesar Rp ".number_format($_POST["jumlah_transfer"], 0, '.', ',')." untuk transaksi <b>#".$kode_order."/b> telah berhasil.";
//        
//    $email_to = $_POST["user_id"]>0?$data_user[0]["email"]:$_POST["email"];
//    $to_alias = $_POST["user_id"]>0?($data_user[0]["first_name"] . " " . $data_user[0]["last_name"]):$_POST["email"];
//    $db->sendEmail($email_to, $to_alias, $subject, $detail_message, $email_from, $from_alias, $root);
    
    //NOTIFIKASI USER
    $data_pembayaran[0]["tanggal_jam"] = $_POST["tanggal_jam"];
    $data_pembayaran[0]["judul"] = "Konfirmasi Pembayaran";
    $data_pembayaran[0]["konten"] = "Proses konfirmasi pembayaran dengan nomer pemesanan #".$data[0]["kode"]." telah berhasil.";
    
    $gcmRegIds = array();
    if(strlen($data_user[0]["id"])>0) {
        foreach ($data_user as $key => $value) {
            if(strlen($value['gcm_regid'])>0) {
                array_push($gcmRegIds, $value['gcm_regid']);
            }
        }
    } else {
        $result_gcm = $db->getFieldValue("guest AS A", array("A.gcm_regid"), array("A.id" => $id_guest), array(), 0, 0, "", "LENGTH(A.gcm_regid)>0"); 
        foreach ($result_gcm as $key => $value) {
            array_push($gcmRegIds, $value['gcm_regid']);
        }
    }
    
    if(count($gcmRegIds)>0) {
        include $root."includes/php/GCM.php";    
        $gcm = new GCM();
        $message = json_encode($data_pembayaran[0]);            
        $result = $gcm->send_notification($gcmRegIds, array("tipe" => "pembayaran", "message" => $message));
        $db->mysql_insert(
            "push_notification", 
            array(
                "tipe" => "pembayaran",
                "message" => $message,
                "result" => $result
            )
        );
    }
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "message" => "Proses konfirmasi pembayaran berhasil.")));   
    
   