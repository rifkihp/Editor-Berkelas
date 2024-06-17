<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    $id = $db->checkIntegerRange($_POST["id"])?$_POST["id"]:"";
    
    //validasi-validasi
    if(strlen($_POST["tanggal"])==0) { 
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Tanggal harus diisi.")));
    } else if(!$db->dateValidation($_POST["tanggal"], "d-m-Y")) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Format tanggal tidak benar.")));
    }
    
    if(strlen($_POST["judul"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Judul harus diisi.")));
    }
    
    if(strlen($_POST["konten"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Konten harus diisi.")));
    }
    
    
    if(strlen($_POST['filename_gambar'])>0) {
        $img = $_POST['filename_gambar'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $upload_directory=realpath($root) . "/uploads/informasi/";            
        $filename["gambar"] =  $db->create_kode_unik() . '.png';
        file_put_contents($upload_directory.$filename["gambar"], $data);
    }
    
    //get data detail klien update
    $data = $db->getFieldValue(
        "informasi", 
        array(
            "gambar"
        ), 
        array("id" => $id)
    );
    
    if(strlen($data[0]["gambar"])>0 && file_exists(realpath($root)."/uploads/informasi/".$data[0]["gambar"])) {
        unlink(realpath($root)."/uploads/informasi/".$data[0]["gambar"]);
    }
        
    //update data informasi
    $temps_tanggal = explode("-", $_POST["tanggal"]);
    $db->mysql_update(
       "informasi", 
        array(
            "id" => $id,
            "tanggal" => ($temps_tanggal[2]."-".$temps_tanggal[1]."-".$temps_tanggal[0]),
            "judul" => $_POST["judul"],
            "konten" =>$_POST["konten"],
            "gambar"  => (isset($filename["gambar"])?$filename["gambar"]:"") //,
            //"is_notif" => $_POST["is_notif"]  
        ),
        array("id" => $id)
    );
    
    //if($_POST["is_notif"]=="Y") {
        $data_informasi = $db->getFieldValue("informasi", array("id", "DATE_FORMAT(tanggal, '%d-%m-%Y') AS tanggal", "judul", "konten", "gambar"), array("id" => $id));  
        $data_informasi[0]["header"] = $db->limitTextKonten($data_informasi[0]["konten"], 150);
        $data_informasi[0]["success"] = true;
        $data_informasi[0]["konten"] = "";

        $result_gcm = $db->getFieldValue("gcm_to_user AS A", array("A.gcm_regid")); 
        $gcmRegIds = array();
        foreach ($result_gcm as $key => $value) {
            if(strlen($value['gcm_regid'])>0) array_push($gcmRegIds, $value['gcm_regid']);
        }
        if(count($gcmRegIds)>0) {
            include $root."includes/php/GCM.php";    
            $gcm = new GCM();
            $message = json_encode($data_informasi[0]);            
            $result = $gcm->send_notification($gcmRegIds, array("tipe" => "informasi", "message" => $message));
            $db->mysql_update(
                "informasi", 
                array(
                    "push_result" => $result           
                ),
                array("id" => $id)
            );
            //echo($result);
        }
    //}
    $db->mysql_close();
    $_SESSION["alert_success"] = "Edit data informasi berhasil.";
    die(json_encode(array("success" => true)));