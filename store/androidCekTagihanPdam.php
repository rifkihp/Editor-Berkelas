<?php
    $root = "../";
    include $root."includes/php/initial.php";
    if(strlen($_SESSION['security_code'])==0 || !isset($_SESSION['security_code']) || $_POST["security_code"]!=$_SESSION['security_code']) {
    	die(json_encode(array("success" => false, "message" => "Maaf! Token tidak valid!")));
    }
    unset($_SESSION['security_code']);

    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $id_pel    = trim($_POST["id_pel"]);
    if(strlen($_POST["id_pel"])==14) {
        $id_pel = strtoupper(substr($_POST["id_pel"], 0, 5). substr($_POST["id_pel"], 6, 3). substr($_POST["id_pel"], 10));
        $convert = array("A", "B", "C", "D", "E");
        foreach ($convert as $key => $value) {
            $id_pel = str_replace($value, ($key+1), $id_pel);
        }
    }
    $command   = "PDAMC.".$id_pel.".2255";
    $tanggal   = date("Y-m-d"); 
    
    $status_trx = ""; $keterangan_trx = "";
    $status = array("GAGAL.", "Format tdk dikenal", "INQUIRI");
    
    $channel_send = $db->getFieldValue("channel_send", array("*"), array("`text`" => $command, "DATE_FORMAT(tanggal_jam, '%Y-%m-%d')" => $tanggal));
    if(count($channel_send)>0) {
        $check = $db->getFieldValue("channel", array("*"), array("replyToMessageId" => $channel_send[0]["channel_id"]));
        foreach($check as $value_check) {
            if(strlen($status_trx)==0) {
                foreach ($status as $key => $contain) {
                    if (($pos = strpos($value_check["text"], $contain)) !== FALSE) {
                        $status_trx = $key>1?"SUCCESS":"FAILED";
                        $keterangan_trx = substr($value_check["text"], strpos($value_check["text"], $contain) + ($key==0?strlen($contain):0)); 
                        break;
                    }
                }
            } else {
                break;
            }        
        }
        $id_header = $channel_send[0]["id_header"];
    } else {
        $id_header = $db->create_kode_unik(8);
        $db->mysql_insert("channel_send", array(
            "channel_id" => 0,
            "message_id" => 0,
            "chatId" => "298749586",
            "text" => $command,
            "messagedate" => 0,
            "tanggal_jam" => date("Y-m-d H:i:s"),
            "status" => "WAITING",
            "id_header" => $id_header 
        ));
    }
        
    //cek tagihan PDAM PDAMC.530400100196 SKSES.SN:INQUIRI 23753339 ACHMAD ZUHDI/1Lbr/Periode:201812/Rp.58900. Sldo 44,828,781 - 50 = 44,828,731@05/12 08:40:58
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
        $temps_2 = str_replace("Periode:", "", $temps[2]);
        $periode = substr($temps_2, 4)."-".substr($temps_2, 0, 4);
        $temps_3 = explode(" ", $temps[3]);
        $tagihan = (1*(str_replace("Rp", "", str_replace(".", "", $temps_3[0]))))-450;
        $admin = 1500;
        $total = $tagihan+$admin;
        
        $result = array("success" => true, "status" => $status_trx, "taglis" => array(
            "inquiri" => $inquiri,
            "id_pelanggan" => $id_pelanggan,
            "nama" => trim($nama),
            "lembar" => $lembar,
            "periode" => $periode,
            "tagihan" => $tagihan,
            "denda" => 0,
            "admin" => $admin,
            "total" => $total
        ));
    } else if($status_trx=="FAILED") {
        $keterangan_trx = trim(substr($keterangan_trx, 0, strpos($keterangan_trx, ".")));        
        $result = array("success" => true, "status" => $status_trx, "message" => $keterangan_trx);
    } else {
        
        
        $result = array("success" => true, "id_header" => $id_header);
    }
    $db->mysql_close();
    
    die(json_encode($result));