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
    $_id_kartagram = $_POST["id_kartagram"];
    $_isi_komentar = $_POST["isi_komentar"];
    
    if($_id_kartagram!=1) {        
        $event = $db->getFieldValue("kartagram", array("*"), array("id" => $_id_kartagram));
        if(count($event)==0) {        
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Kartagram tidak valid.")));
        }
    }
    
    $id_komentar = $db->getLastNumber("kartagram_komentar", "id");
    $db->mysql_insert(
        "kartagram_komentar", 
        array(
            "id"           => $id_komentar, 
            "id_kartagram" => $_id_kartagram, 
            "tanggal_jam"  => date("Y-m-d H:i:s"),
            "grup"         => 2, 
            "`from`"       => $_id_user, 
            "pesan"        => $_isi_komentar
        )
    );
    
    $sql = "SELECT 
            A.id, 
            CONCAT(B.first_name, ' ', B.last_name) AS nama, 
            B.phone AS telepon, 
            B.photo,
            A.tanggal_jam AS datetime, 
            A.pesan AS message,
            IF(A.from='".$_id_user."', 1, 0) AS is_self,
            1 AS is_sent        
        FROM 
            kartagram_komentar AS A LEFT JOIN 
            member AS B ON A.from=B.id AND B.id='".$_id_user."' 
    	WHERE 
            A.id=$id_komentar";
    $db->mysql_query($sql, $rec_count, $data);
    $data[0]["issue_id"] = $_POST["id_issue"];
    $data[0]["is_self"]  = $data[0]["is_self"]==1;
    $data[0]["is_sent"]  = $data[0]["is_sent"]==1; 
    
    $gcmRegIds = array();
    $data_user = $db->getFieldValue("member", array("gcm_regid"), array(), array(), 0, 0, "", "LENGTH(gcm_regid)>0 AND id<>$_id_user");
    foreach ($data_user as $key => $value) {
        array_push($gcmRegIds, $value['gcm_regid']);
    }
    
   if(count($gcmRegIds)>0) {
        include $root."includes/php/GCM.php";    
        $gcm = new GCM();
        $kartagram_komentar = json_encode($data[0]);            
        $result = $gcm->send_notification($gcmRegIds, array("tipe" => "kartagram_komentar", "message" => $kartagram_komentar));
        $db->mysql_update(
            "kartagram_komentar", 
            array(
                "push_result" => $result
            ),
            array(
                "id" => $id_komentar
            )
        );
    }
    
    $db->mysql_close();
    echo(json_encode(array("success" => true, "data_message" => $data[0], "message" => "Submit komentar berhasil.")));