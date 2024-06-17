<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //get last id message
    $id = $db->getLastNumber("message", "id");
    
    if($_POST["semua"]=="Y") {
        $sql = "INSERT INTO message(tanggal_jam, `to`, `from`, pesan, `status`) SELECT 
               '". date("Y-m-d H:i:s")."', id, '0', \"".($_POST["pesan"])."\", '0' FROM member WHERE aktif=1";
        $db->mysql_execute($sql);
    }  else {
        //insert data message
        $db->mysql_insert(
            "message", 
            array(
                "id" => $id,
                "tanggal_jam" => date("Y-m-d H:i:s"),
                "`to`" => $_POST["to"],
                "`from`" => 0,
                "pesan" => $_POST["pesan"],
                "`status`" => 0            
            )
        );
    }
    
    $data_umum = $db->getFieldValue("umum", array("website", "mask_email"));
    $data = $db->getFieldValue("member", array("gcm_regid"), $_POST["semua"]=="Y"?array("aktif=1"):array("id" =>  $_POST["to"]), array(), 0, 0, "", "LENGTH(gcm_regid)>0");
    
    //PUSH NOTIFICATION:
    include $root."includes/php/GCM.php";    
    $gcm = new GCM();            
    //PUSH NOTIFICATION USER
    $gcmRegIds = array();
    foreach ($data as $key => $value) {
        if(strlen($value["gcm_regid"])>0) {
            array_push($gcmRegIds, $value['gcm_regid']);
        }
    }
    if(count($gcmRegIds)>0) {
        $message = json_encode(
            array(
                "success" => true,
                "from" => "Admin: ".$data_umum[0]["website"],
                "judul" => "Admin: ".$data_umum[0]["website"],
                "message" => $db->limitTextKonten($_POST["pesan"]),
                "tanggal_jam" => $_POST["tanggal_jam"]
            )
        );            
        $result = $gcm->send_notification($gcmRegIds, array("tipe" => "message", "message" => $message));
        $db->mysql_update(
            "message", 
            array(
                "push_result" => $result           
            ),
            array("id" => $id)
        );
        //echo($result);
    }
    
    $_SESSION["alert_success"] = "Pesan berhasil dikirim.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));