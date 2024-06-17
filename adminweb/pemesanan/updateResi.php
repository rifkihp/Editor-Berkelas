<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $id      = $_POST["id"];
    $status  = $_POST["status"];
    $no_resi = $_POST["no_resi"];
    
    $db->mysql_update("customer_order_ongkir", array("no_resi" => $_POST["no_resi"]), array("id_header" => $id));    
    $db->mysql_update("customer_order_header", array("status" => $_POST["status"], "date_update_status" => date("Y-m-d H:i:s"), "is_open" => "N"), array("id" => $id)); 
    
    $data_order  = $db->getFieldValue("customer_order_header", array("*"), array("id" => $id));
    $id_member   = $data_order[0]["id_member"];
    $id_guest    = $data_order[0]["id_guest"];
    $kode_order  = $data_order[0]["kode"]; 
    
    $data_user = $db->getFieldValue("member", array("*"), array("id" => $id_member));
    
    $tanggal_jam = date("Y-m-d H:i:s");
    $data_notifikasi = array();
    if($status==2) {
        $db->mysql_insert("histori_status_pemesanan", array(
            "id" => $db->getLastNumber("histori_status_pemesanan", "id"),
            "id_pemesanan" => $id,
            "tanggal_jam"  => $tanggal_jam,
            "penjelasan"   => "Pesanan dalam proses."
        ));
        
        $data_notifikasi = array(
            "tanggal_jam" => $tanggal_jam,
            "judul"       => "Status Pesanan",
            "konten"      => "Pemesanan dengan nomer #".$kode_order." sedang dalam proses."
        );
    }
    
    if($status==5) {
        $db->mysql_insert("histori_status_pemesanan", array(
            "id" => $db->getLastNumber("histori_status_pemesanan", "id"),
            "id_pemesanan" => $id,
            "tanggal_jam" => $tanggal_jam,
            "penjelasan" => "Pesanan sudah diterima."
        ));
        
        $data_notifikasi = array(
            "tanggal_jam" => $tanggal_jam,
            "judul"       => "Status Pesanan",
            "konten"      => "Pemesanan dengan nomer #".$kode_order." sudah sampai".(strlen($no_resi)>0?" dengan no. resi pengiriman $no_resi":"")."."
        );
    }
    
    if($status==6) {
        $db->mysql_insert("histori_status_pemesanan", array(
            "id" => $db->getLastNumber("histori_status_pemesanan", "id"),
            "id_pemesanan" => $id,
            "tanggal_jam" => $tanggal_jam,
            "penjelasan" => "Pesanan sudah dikirim".(strlen($no_resi)>0?" dengan no. resi pengiriman $no_resi":"")."."
        ));
        
        $data_notifikasi = array(
            "tanggal_jam" => $tanggal_jam,
            "judul"       => "Status Pesanan",
            "konten"      => "Pemesanan dengan nomer #".$kode_order." sudah dikirm".(strlen($no_resi)>0?" dengan no. resi pengiriman $no_resi":"")."."
        );
    }
    
    if(count($data_notifikasi)) {        
        $gcmRegIds = array();
        if(strlen($data_user[0]["id"])>0) {
            foreach ($data_user as $key => $value) {
                if(strlen($value['gcm_regid'])>0) { 
                    array_push($gcmRegIds, $value['gcm_regid']); 
                }
            }
        } else {
            $result_gcm = $db->getFieldValue("guest AS A", array("A.gcm_regid"), array("A.id" => $id_guest), array(), 0, 0, "", "LENGTH(A.gcm_regid)>0"); 
            foreach ($result_gcm as $key => $value) {
                array_push($gcmRegIds, $value['gcm_regid']);
            }
        }

        if(count($gcmRegIds)>0) {
            include $root."includes/php/GCM.php";    
            $gcm = new GCM();
            $message = json_encode($data_notifikasi);            
            $result = $gcm->send_notification($gcmRegIds, array("tipe" => "pemesanan", "message" => $message));
            $db->mysql_insert(
                "push_notification", 
                array(
                    "tipe" => "pemesanan",
                    "message" => $message,
                    "result" => $result
                )
            );
        }
    }
        
    $db->mysql_close();
    die(json_encode(array("success" => true)));