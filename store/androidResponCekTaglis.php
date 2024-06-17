<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $status_trx = ""; $keterangan_trx = "";
    $status = array("GAGAL.", "terlambat", "Format tdk dikenal", "INQUIRI");
    
    $channel_send = $db->getFieldValue("channel_send", array("*"), array("id_header" => $_POST["id_header"]));
    if(count($channel_send)>0 && $channel_send[0]["channel_id"]) {
        $check = $db->getFieldValue("channel", array("*"), array("replyToMessageId" => $channel_send[0]["channel_id"]));
        foreach($check as $value_check) {
            if(strlen($status_trx)==0) {
                foreach ($status as $key => $contain) {
                    if (($pos = strpos($value_check["text"], $contain)) !== FALSE) {
                        $status_trx = $key>2?"SUCCESS":"FAILED";
                        $keterangan_trx = substr($value_check["text"], strpos($value_check["text"], $contain) + ($key==0?strlen($contain):0)); 
                        break;
                    }
                }
            } else {
                break;
            }        
        }
    }
    
    $db->mysql_close();
    
    if($status_trx=="SUCCESS") {
        $request = explode(".", $channel_send[0]["text"]);
        $id_pelanggan = $request[1];
        $temps = explode("/", $keterangan_trx);
        $temps_0 = explode(" ", $temps[0]);
        $inquiri = $temps_0[1];
        $nama = "";
        for($i=2; $i<count($temps_0); $i++) {
            $nama.=$temps_0[$i]." ";   
        }
        $lembar = $temps[1];
        $periode = $temps[2];
        $kwh = $temps[3];
        
        $temps_4 = explode(" ", $temps[4]);
        $tagihan = (1*(str_replace("Rp", "", str_replace(".", "", $temps_4[0]))))-450;
        $admin = 1500;
        $total = $tagihan+$admin;
        
        die(json_encode(array("success" => true, "status" => $status_trx, "taglis" => array(
            "inquiri" => $inquiri,
            "id_pelanggan" => $id_pelanggan,
            "nama" => trim($nama),
            "lembar" => $lembar,
            "periode" => $periode,
            "kwh" => $kwh,
            "tagihan" => $tagihan,
            "denda" => 0,
            "admin" => $admin,
            "total" => $total
        ))));
    } else if($status_trx=="FAILED") {
        $keterangan_trx = trim(substr($keterangan_trx, 0, strpos($keterangan_trx, ".")));        
        die(json_encode(array("success" => true, "status" => $status_trx, "message" => $keterangan_trx)));
    } else {
        die(json_encode(array("success" => false, "status" => "NONE")));
    }
