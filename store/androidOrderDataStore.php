<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $id_order = $_POST["order"];
    $id_cat = $_POST["id_cat"];
    
    //0: Menunggu Pembayaran; 1: Pembayaran Ditolak; 2: Pembayaran Diterima; 3: Konfirmasi Pembayaran; 4: Dibatalkan; 5: pesanan diterima; 6: pesanan sedang dikirim
    $filter = "";
    if($id_cat==1) {
        $filter = " A.status IN (0, 1) ";
    } else if($id_cat==2) {
        $filter = " A.status IN (2, 3) ";
    } else if($id_cat==3) {
        $filter = " A.status=6 ";
    } else if($id_cat==4) {
        $filter = " A.status=5 ";
    } else if($id_cat==5) {
        $filter = " A.status=4 ";
    }
        
    if(strlen($id_order)>0) {
        $data_order = $db->getFieldValue("customer_order_header AS A LEFT JOIN customer_order_ongkir AS B ON A.id=B.id_header LEFT JOIN ekspedisi AS C ON B.id_ekspedisi=C.id", 
            array("A.kode AS no_transaksi", "DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y %H:%i') AS tgl_transaksi", "A.pembayaran", "A.nama", "A.total_qty AS qty", "A.total AS jumlah", "B.etd AS estimasi", "C.kode AS kode_kurir", "CONCAT(C.kode, ' ', B.kode_layanan) AS kurir", "B.no_resi AS noresi", "A.status", "C.gambar"), array(), array(), 0, 0, " A.id DESC ", "A.kode IN (".$id_order.")" . (strlen($filter)>0?" AND $filter":""));
    } else {
        $data_order = array();
    }
    
    //foreach ($data_order as $key => $value) {
        //$data_order[$key]["tgl_transaksi"] = $db->dateDiff(date("Y-m-d H:i:s"), $value["tanggal_jam"]);
    //}
    
   
    $db->mysql_close();
    die(json_encode(array("topics" => $data_order)));