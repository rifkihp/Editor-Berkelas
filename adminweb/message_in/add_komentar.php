<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    $data_message_head = $db->getFieldValue("message_head", array("*"), array("id" => $_POST["id_head"]));
    $_id_user  = $data_message_head[0]["id_member"];
    $_id_guest = $data_message_head[0]["id_guest"];
    
    
    $_POST["id"]          = $db->getLastNumber("message", "id");
    $_POST["id_head"]     = $_POST["id_head"];
    $_POST["tanggal_jam"] = date("Y-m-d H:i:s");
    $_POST["grup"]        = 1;
    $_POST["`from`"]      = $_SESSION[ADMIN_SESSION_NAME]["user"]["id"];
    $_POST["pesan"]       = $_POST["komentar"];
    unset($_POST["komentar"]);
    
    $db->mysql_insert("message", $_POST);
    
    //PUSH NOTIFICATION TO USER
    include $root."includes/php/GCM.php";    
    $gcm = new GCM();
    $gcmRegIds = array();

    if($_id_user>0) {
        $data_users = $db->getFieldValue("member", array("gcm_regid"), array("id" => $_id_user), array(), 0, 0, "", "LENGTH(gcm_regid)>0");
        foreach ($data_users as $key => $value) {
            array_push($gcmRegIds, $value['gcm_regid']);
        }
    } else
    if($_id_guest>0) {
        $data_guest = $db->getFieldValue("guest", array("gcm_regid"), array("id" => $_id_guest), array(), 0, 0, "", "LENGTH(gcm_regid)>0");
        foreach ($data_guest as $key => $value) {
            array_push($gcmRegIds, $value['gcm_regid']);
        }
    }
    
    $sql = "SELECT 
        A.id,
        B.nama,
        'admin.png' AS photo,
        A.tanggal_jam AS datetime, 
        DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y %H:%i:%s') AS tanggal_komentar,
        A.pesan AS komentar,
        A.pesan AS message,
        0 AS is_self,
        1 AS is_sent        
    FROM 
        message AS A LEFT JOIN 
        user AS B ON A.from=B.id
    WHERE 
        A.id=".$_POST["id"];
    $db->mysql_query($sql, $rec_count, $data_message);
    $data_message[0]["is_self"] = $data_message[0]["is_self"]==1;
    $data_message[0]["is_sent"] = $data_message[0]["is_sent"]==1;
        
    $sql = "SELECT 
            A.id,
            A.id_produk,
            B.kode, 
            B.nama, 
            B.gambar_utama AS gambar, 
            C.pesan, 
            C.tanggal_jam, 
            C.`from` AS from_id, 
            IF(C.grup=1, D.nama, IF(C.grup=2, TRIM(CONCAT(E.first_name, ' ', E.last_name)), CONCAT('Guest ', F.id)))  AS from_nama, 
            IF(C.grup=1, 'admin.png', IF(C.grup=2, D.photo, 'default.png'))  AS from_photo
        FROM 
            message_head AS A LEFT JOIN 
            produk AS B ON A.id_produk=B.id LEFT JOIN (
            SELECT 
                n.* 
            FROM 
                message n INNER JOIN (
                SELECT 
                    id_head, 
                    MAX(tanggal_jam) AS tanggal_jam
                FROM 
                    message 
                GROUP BY 
                    id_head
                ) AS MAX USING (id_head, tanggal_jam)
            ) AS C ON C.id_head=A.id LEFT JOIN
            user AS D ON C.from=D.id LEFT JOIN     
            member AS E ON C.from=E.id LEFT JOIN     
            guest AS F ON C.from=F.id
            
        WHERE 
            A.id='".$_POST["id_head"]."'";
    
    $db->mysql_query($sql, $rec_count, $data_laporan);
    $data_laporan[0]["pesan"]   = preg_replace( "/\r|\n/", "", $db->limitTextKonten($data_laporan[0]["pesan"], 150));
    
    if(count($gcmRegIds)>0) {
        $db->mysql_update(
            "message", 
            array(
                "push_result" => $gcm->send_notification($gcmRegIds, array("tipe" => "message", "laporan" => json_encode($data_laporan[0]), "message" => json_encode($data_message[0])))           
            ),
            array("id" => $_POST["id"])
        );
    }
    	
    $db->mysql_close();
    die(json_encode(array("success" => true, "last_id_komentar" => $_POST["id"], "message" => $data_message[0] )));
