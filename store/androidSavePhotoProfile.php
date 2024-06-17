<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $id_member = $_POST["id_user"];
    $data_user = $db->getFieldValue("member AS A LEFT JOIN jenis_user AS B ON B.id=A.jenis_user", array("A.id", " A.first_name", " A.last_name", "A.email", "A.phone", "B.nama AS jenis_user", "A.password", "A.photo", "A.aktif"), array("A.id" => $id_member));
    $_photo = $data_user[0]["photo"];
    
    //upload photo
    if(!empty($_FILES["photo"])) {
        $file = $_FILES["photo"];
        $ext = substr($file['name'], strrpos($file['name'], '.') + 1); 
        
        $upload_directory = realpath($root) . "/uploads/member";
        $_photo = $db->create_kode_unik().'.'.$ext;
        move_uploaded_file($file['tmp_name'], $upload_directory."/".$_photo);
        
        if(file_exists(realpath($root)."/uploads/member/".$data_user[0]["photo"]) && $data_user[0]["photo"]!='default.png') {
            unlink(realpath($root)."/uploads/member/".$data_user[0]["photo"]);
        }
    }
    
   $db->mysql_update("member", array(
        "photo" => $_photo
    ), array(
        "id" => $id_member
    ));
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "id" => $id_member, "photo" => $_photo, "message" => "Edit photo profile berhasil.")));