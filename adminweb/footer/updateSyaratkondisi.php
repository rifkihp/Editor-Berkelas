<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    function save_image($html_text, $folder) {
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
                $upload_directory=realpath($root) . "/uploads/".$folder."/";            
                $file_name = $db->create_kode_unik().'.'.$ext;
                file_put_contents($upload_directory.$file_name, $data);
                $html_text = str_replace($src, HOME_URL."/uploads/".$folder."/".$file_name, $html_text);
                $img_src.=$file_name.",";
            }
        }

        return array(
            "text" => $html_text, 
            "img_src" => rtrim($img_src, ",")
        );
    }
    
    $temps = save_image($_POST["syarat_kondisi"], "syaratkondisi");
    $_POST["syarat_kondisi"] = $temps["text"];
    $_POST["syarat_kondisi_img_src"] = $temps["img_src"];
    
    //update data umum
    $db->mysql_update("umum", $_POST);
    
    
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "message" => "Update syarat &amp; ketentuan berhasil.")));