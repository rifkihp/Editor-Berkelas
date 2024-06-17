<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama(CLIENT_SESSION_NAME);
    $db->mysql_connect(true);
    
    $id_donasi = $db->checkIntegerRange($_POST["id_donasi"])?$_POST["id_donasi"]:"";
    
    if(strlen($id_donasi)==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Pilih salah satu donasi.")));
    } else {
        $data = $db->getFieldValue("kartacare_donasi AS A", array("A.id", "A.status"), array("A.id" => $id_donasi));
        if(count($data)==0) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Donasi tidak valid.")));
        } else
        /*if($data[0]["status"]==1) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Pembayaran donasi tidak diterima.")));
        } else*/
        if($data[0]["status"]==2) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Pembayaran donasi sudah diterima.")));
        } else
        if($data[0]["status"]==3) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Pembayaran donasi sudah dikonfirmasi.")));
        }
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
    
    $_POST["id"]  = $db->getLastNumber("kartacare_konfirmasi", "id");
    $_POST["tanggal_jam"]  = date("Y-m-d H:i:s");
    $_POST["photo"] = $filename;
    
    $db->mysql_insert("kartacare_konfirmasi", $_POST);
    $db->mysql_update("kartacare_donasi", array("status" => 3, "date_update_status" => $tanggal_jam), array("id" => $_POST["id_donasi"]));
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "message" => "Proses konfirmasi berhasil.")));   
    
   