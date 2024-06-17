<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    //upload gambar
    //die(json_encode(array("success" => false, "message" => $_FILES["photo"]["name"])));
    $_POST["gambar"] = "";
    if (strlen($_FILES["photo"]["name"])>0) {
        if ($_FILES["filename"]['error'] > 0) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Upload gambar tidak valid.")));
        }

        $file=$_FILES["photo"];
        $upload_directory=realpath($root) . "/uploads/kartagram/";
        $ext_str = "jpg,png,gif,bmp";
        $allowed_extensions=explode(',',$ext_str);
        $max_file_size = 1024*1000; //1024bytes = 1kbytes
        $overwrite_file = true;
        
        //get file extension from last sub string from last . character
        $ext = substr($file['name'], strrpos($file['name'], '.') + 1); 
        $_POST["gambar"] = $db->create_kode_unik().".".$ext;

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
        
        if(!move_uploaded_file($file['tmp_name'],$upload_directory.$_POST["gambar"])) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Proses upload photo gagal.")));  //file can't moved with unknown reasons likr cleaning of server temperory files cleaning
        }        
    }
        
    $_POST["id"] = $db->getLastNumber("kartagram", "id");
    $db->mysql_insert("kartagram", array(
        "id" => $_POST["id"],
        "id_member" => $_POST["users_id"],
        "tanggal" => date("Y-m-d"),
        "keterangan" => $_POST["keterangan"],
        "gambar" => $_POST["gambar"],
        "is_aktif" => 1,
        "date_create" => date("Y-m-d H:i:s"),
        "date_update" => date("Y-m-d H:i:s")
    ));
    
    
    $_id_user = $_POST["users_id"];
    
    $data_user = $db->getFieldValue("member", array("gcm_regid"), array(), 0, 0, "", "LENGTH(gcm_regid)>0 AND id<>$_id_user");
    $gcmRegIds = array();
    foreach ($data_user as $key => $value) {
        array_push($gcmRegIds, $value['gcm_regid']);
    }
    
   if(count($gcmRegIds)>0) {
        $data_kartagram = $db->getFieldValue(
            "kartagram AS A "
            . "LEFT JOIN (SELECT id_kartagram, COUNT(*) AS TOTAL FROM kartagram_komentar GROUP BY id_kartagram) AS B ON B.id_kartagram=A.id "
            . "LEFT JOIN member AS C ON A.id_member=C.id ", 
        array("A.id", 
            "DATE_FORMAT(A.tanggal, '%d.%m.%Y') AS tanggal", 
            "A.id_member AS id_owner",
            "CONCAT(C.first_name, ' ', C.last_name) AS owner",
            "A.gambar AS logo",
            "B.TOTAL AS total_responden"), 
        array("A.id" => $_POST["id"]));
        include $root."includes/php/GCM.php";    
        $gcm = new GCM();
        $message = json_encode($data_kartagram[0]);            
        $result = $gcm->send_notification($gcmRegIds, array("tipe" => "kartagram", "message" => $message));
        $db->mysql_update(
            "kartagram", 
            array(
                "push_result" => $result
            ),
            array("id" => $_POST["id"])
        );
    }
    
    $db->mysql_close();
    
    die(json_encode(array("success" => true, "message" => "Proses simpan data kartagram berhasil.")));