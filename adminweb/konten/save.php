<?php

    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    function save_image($html_text) {
        global $db, $root;
        
        //COPY FILES
        $doc = new DOMDocument();
        $doc->loadHTML($html_text);
        $tags = $doc->getElementsByTagName('img');
        $img_src = "";
        foreach ($tags as $tag) {
            $src = $tag->getAttribute('src');
            if(substr($src, 0, 10)=="data:image") {
                $ext = substr($src, 11, strpos($src, ";")-strpos($src, "/")-1);
                $img = str_replace(substr($src, 0, strpos($src, ",")), '', $src);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $upload_directory=realpath($root) . "/uploads/konten/";            
                $file_name = $db->create_kode_unik().'.'.$ext;
                file_put_contents($upload_directory.$file_name, $data);
                $html_text = str_replace($src, HOME_URL."/uploads/konten/".$file_name, $html_text);
                $img_src.=$file_name.",";
            }
        }

        return array(
            "text" => $html_text, 
            "img_src" => rtrim($img_src, ",")
        );
    }
    
    $_POST["id"] = $db->getLastNumber("konten", "id");

    //VALIDASI-VALIDASI
    if(strlen($_POST["title"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Judul harus diisi.")));
    }
    
    //INSERT CATEGORY
    if(strlen(trim($_POST["id_kategori"]))>0) {
        $kategori = explode(",", $_POST["id_kategori"]);
        foreach($kategori as $i => $value) {
            $db->mysql_insert("konten_to_category", array(
                "id_konten" => $_POST["id"],
                "id_kategori" => $value
            ));
        }
    }
    unset($_POST["id_kategori"]);
    
    //INSERT BANNER
    if(strlen(trim($_POST["id_banner"]))>0) {
        $banner = explode(",", $_POST["id_banner"]);
        foreach($banner as $i => $value) {
            $db->mysql_insert("konten_to_banner", array(
                "id_konten" => $_POST["id"],
                "id_banner" => $value
            ));
        }
    }
    unset($_POST["id_banner"]);
    
    $temps = save_image($_POST["konten"]);
    $_POST["konten"] = $temps["text"];
    $_POST["konten_img_src"] = $temps["img_src"];

    //banner
    if(strlen($_POST['filename_banner'])>0) {
        $img = $_POST['filename_banner'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $upload_directory=realpath($root) . "/uploads/konten/banner/";            
        $_POST["banner"] = $db->create_kode_unik(4).".png";
        file_put_contents($upload_directory.$_POST["banner"], $data);
    }
    unset($_POST['filename_banner']);
    
    //thumbnail
    if(strlen($_POST['filename_thumbnail'])>0) {
        $img = $_POST['filename_thumbnail'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $upload_directory=realpath($root) . "/uploads/konten/thumbnail/";            
        $_POST["thumbnail"] = $db->create_kode_unik(4).".png";
        file_put_contents($upload_directory.$_POST["thumbnail"], $data);
    }
    unset($_POST['filename_thumbnail']);

    $_POST["tanggal_create"] = date("Y-m-d H:i:s");
    $_POST["tanggal_update"] = $_POST["tanggal_create"];
    
    //UPDATE DATA KONTEN
    $db->mysql_insert("konten", $_POST);   
    $_SESSION["alert_success"] = "Tambah konten berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));