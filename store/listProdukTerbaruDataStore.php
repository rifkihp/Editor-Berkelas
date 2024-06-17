<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_limit = 15;    
    $data = $db->getFieldValue("produk AS A", array("A.*"), array("A.status" => 1), array(), $_limit, 0, " A.tanggal_update DESC ");
    foreach($data as $key => $value) {
        $data_gambar = $db->getFieldValue("gambar_produk", array("nama_file"), array("id_produk" => $value["id"]));
        $data[$key]["foto1_produk"] = $data_gambar[0]["nama_file"];        
        $data[$key]["nama"] = $db->limitTextKonten($value["nama"], 15);

        $harga_jual = $value["harga_jual"];
        if(isset($_SESSION[CLIENT_SESSION_NAME]["user"])) {
            $tipe_user = $_SESSION[CLIENT_SESSION_NAME]["user"]["jenis_user"];
            $sql = "SELECT harga_jual FROM harga_jual_user WHERE id_produk='".$value["id"]."' AND tipe_user='$tipe_user' AND harga_jual>0";        
            $db->mysql_query($sql, $rec_count_harga_jual, $data_harga_jual);
            $harga_jual = $rec_count_harga_jual>0?$data_harga_jual[0]["harga_jual"]:$value["harga_jual"];
        }

        $harga_spesial = 0;
        $diskon = str_replace("%", "", $value["persen_diskon"])*0.01;
        if($value["tipe_diskon"]=="persentase" && $diskon>0) {
            $harga_spesial = $harga_jual-($harga_jual*$diskon);
        } else if($value["tipe_diskon"]=="nominal" && $value["harga_diskon"]>0) {
            $harga_spesial = $value["harga_diskon"];   
        }

        $data[$key]["harga_jual"] = $harga_jual>0?("Rp. ".number_format($harga_jual, 0, '.', ',')):"";
        $data[$key]["harga_spesial"] = $harga_spesial>0?("Rp. ".number_format($harga_spesial, 0, '.', ',')):"";
    }  
    $db->mysql_close();
     
    $rasult = array(
        "totalCount" => $nbrows,
        "topics" => $data
    );
    
    die(json_encode($rasult));