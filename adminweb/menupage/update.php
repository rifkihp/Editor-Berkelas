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
    
    
    $data_menupage = $db->getFieldValue("menu_page", array("*"), array("id" => $_POST["id"]));
    $doc = new DOMDocument();
    $doc->loadHTML($_POST["konten"]);
    $tags = $doc->getElementsByTagName('img');
    
    //CEK DELETE FILES
    $temps = explode(",", $data_menupage[0]["img_src"]);
    foreach ($temps as $key => $value) {
        $isdelete = true;
        foreach ($tags as $tag) {
            $src = $tag->getAttribute('src');
            if(substr($src, 0, 10)!="data:image") {
                $namefile = substr(strrchr($path, "/"), 1);
                if($namefile==$value) {
                    $isdelete = false;
                    break;
                }
            }
        }
        
        if($isdelete && file_exists(realpath($root)."/uploads/menupage/".$value)) {
            unlink(realpath($root)."/uploads/menupage/".$value);
        }
    }
    
    //COPY FILES
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
    
    //update data menu_page
    $db->mysql_update("menu_page", $_POST, array("id" => $_POST["id"]));    
    $_SESSION["alert_success"] = "Edit data menu berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));