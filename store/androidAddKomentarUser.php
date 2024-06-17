<?php
    $root = "../";
    include $root."includes/php/initial.php";
    if(strlen($_SESSION['security_code'])==0 || !isset($_SESSION['security_code']) || $_POST["security_code"]!=$_SESSION['security_code']) {
    	die(json_encode(array("success" => false, "message" => "Maaf! Token tidak valid!")));
    }
    unset($_SESSION['security_code']);

    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_id_user      = $_POST["user_id"];
    $_id_guest     = $_POST["guest_id"];
    $_id_produk    = $_POST["id_produk"];
    $_id_head      = $_POST["id_laporan"];
    $_isi_komentar = $_POST["isi_komentar"];
    
    $data = $db->getFieldValue("message_head", array("*"), array("id" => $_id_head));
    if(count($data)==0) {        
        $produk = $db->getFieldValue("produk", array("*"), array("id" => $_id_produk));
        if(count($produk)==0) {        
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Produk tidak valid.")));
        } else {
            //CHEKC BY PRODUK
            $data = $db->getFieldValue("message_head", array("*"), array("id_produk" => $_id_produk, "id_member" => $_id_user,  "id_guest" => $_id_guest));
            if(count($data)==0) { 
                $_id_head = $db->getLastNumber("message_head", "id");
                $db->mysql_insert(
                    "message_head", 
                    array(
                        "id" => $_id_head, 
                        "id_produk" => $_id_produk, 
                        "id_member" => $_id_user, 
                        "id_guest" => $_id_guest
                    )
                );
            } else {
                $_id_head = $data[0]["id"];
            }            
        }
    }
    
    $id_komentar = $db->getLastNumber("message", "id");
    $db->mysql_insert(
        "message", 
        array(
            "id"          => $id_komentar, 
            "id_head"     => $_id_head, 
            "tanggal_jam" => date("Y-m-d H:i:s"),
            "grup"        => ($_id_user>0?2:3), 
            "`from`"      => ($_id_user>0?$_id_user:$_id_guest), 
            "pesan"       => $_isi_komentar
        )
    );
    
    $db->mysql_update(
        "message_head", 
        array(
            "datetime_update" => date("Y-m-d H:i:s")
        ),
        array(
            "id" => $_id_head 
        )
    );
    
    $sql = "SELECT 
            A.id, 
            CONCAT(B.first_name, ' ', B.last_name) AS nama, 
            B.phone AS telepon, 
            B.photo, 
            A.tanggal_jam AS datetime, 
            A.pesan AS message,
            IF(A.from='".($_id_user>0?$_id_user:$_id_guest)."', 1, 0) AS is_self,
            1 AS is_sent        
        FROM 
            message AS A LEFT JOIN 
            member AS B ON A.from=B.id AND B.id='".($_id_user>0?$_id_user:$_id_guest)."' 
    	WHERE 
            A.id=$id_komentar";
    $db->mysql_query($sql, $rec_count, $data);
    $data[0]["is_self"] = $data[0]["is_self"]==1;
    $data[0]["is_sent"] = $data[0]["is_sent"]==1;
    $data[0]["photo"] = $data[0]["path_photo"]."/".$data[0]["photo"]; 
        
    $db->mysql_close();
    echo(json_encode(array("success" => true, "data_message" => $data[0], "message" => "Submit komentar berhasil.")));