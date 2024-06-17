<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //validasi-validasi
    if(strlen($_POST["judul"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Judul harus diisi.")));
    }
    
    if(strlen($_POST["posisi"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Letak menu harus diisi.")));
    }
    
    if(strlen($_POST["keyword"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kata kunci pencarian harus diisi.")));
    }
    
    //get last id menu_page
    $_POST["id"] = $db->getLastNumber("menu_page", "id");
    
    $doc = new DOMDocument();
    $doc->loadHTML($_POST["konten"]);
    $tags = $doc->getElementsByTagName('img');
    
    //COPY FILES
    $doc = new DOMDocument();
    $doc->loadHTML($_POST["konten"]);
    $tags = $doc->getElementsByTagName('img');
    $img_src = "";
    foreach ($tags as $tag) {
        $src = $tag->getAttribute('src');
        if(substr($src, 0, 10)=="data:image") {
            $ext = substr($src, 11, strpos($src, ";")-strpos($src, "/")-1);
            $img = str_replace(substr($src, 0, strpos($src, ",")), '', $src);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $upload_directory=realpath($root) . "/uploads/menupage/";            
            $file_name = $db->create_kode_unik().'.'.$ext;
            file_put_contents($upload_directory.$file_name, $data);
            $_POST["konten"] = str_replace($src, HOME_URL."/uploads/menupage/".$file_name, $_POST["konten"]);
            $img_src.=$file_name.",";
        }
    }
    
    $_POST["img_src"] = rtrim($img_src, ",");
            
    //insert data menu_page
    $db->mysql_insert("menu_page", $_POST);
    
    $_SESSION["alert_success"] = "Tambah data menu berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));