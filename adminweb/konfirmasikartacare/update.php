<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $id = ($db->checkIntegerRange($_POST["id"])?$_POST["id"]:"");
    $status = ($db->checkIntegerRange($_POST["status"])?$_POST["status"]:"");
    $tanggal_jam =  date("Y-m-d H:i:s");
    
    //get data konfirmasi
    $data_konfirmasi = $db->getFieldValue("kartacare_konfirmasi AS A ", array("A.id", "A.id_donasi", "A.status"), array("id" => $id));
    
    //get data donasi
    $data = $db->getFieldValue("kartacare_donasi AS A", array("A.id", "A.status"), array("A.id" => $data_konfirmasi[0]["id_donasi"]));
    
    if(count($data)==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Data donasi tidak ditemukan!")));        
    }
    
    //VALIDASI
    /*if($status==2) {
        if ($data[0]["status"]==$status) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Pembayaran donasi sudah diterima!"))); 
        }
    }*/
    
    $db->mysql_update(
        "kartacare_konfirmasi", 
        array(
            "status" => $status,
            "tanggal_jam_update_status" => $tanggal_jam
        ),      
        array("id" => $id)
    );
    
    $db->mysql_update(
        "kartacare_donasi", 
        array(
            "status" => $status,
            "date_update_status" => $tanggal_jam
        ),      
        array("id" => $data[0]["id"])
    );
    
    $db->mysql_close();
    die(json_encode(array("success" => true)));