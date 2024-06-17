<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama(CLIENT_SESSION_NAME);
    $db->mysql_connect();
    
    $data_wishlist = $db->getFieldValue("customer_wishlist AS A LEFT JOIN produk AS B ON B.id=A.id_produk", array("B.*", "A.id_produk", "A.ukuran", "A.warna", "A.jumlah"), array("A.id_member" => $_SESSION[CLIENT_SESSION_NAME]["user"]["id"]), array(), 0, 0 , " A.id DESC ", " A.id_produk IS NOT NULL ");
    foreach($data_wishlist as $key => $value) {
        $data_gambar = $db->getFieldValue("gambar_produk", array("nama_file"), array("id_produk" => $value["id"]));
        $data_wishlist[$key]["foto1_produk"] = $data_gambar[0]["nama_file"];        
        $data_wishlist[$key]["nama"] = $db->limitTextKonten($value["nama"], 15);
        
        $harga_jual = $value["harga_jual"];
        if(isset($_SESSION[CLIENT_SESSION_NAME]["user"])) {
            $tipe_user = $_SESSION[CLIENT_SESSION_NAME]["user"]["jenis_user"];
            $sql = "SELECT harga_jual FROM harga_jual_user WHERE id_produk='$id_produk' AND tipe_user='$tipe_user' AND harga_jual>0";        
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
        
        $data_wishlist[$key]["harga_jual"] = $harga_jual>0?("Rp. ".number_format($harga_jual, 0, '.', ',')):"";
        $data_wishlist[$key]["harga_spesial"] = $harga_spesial>0?("Rp. ".number_format($harga_spesial, 0, '.', ',')):"";
    }
    $db->mysql_close();
     
    $rasult = array(
        "totalCount" => count($data_wishlist),
        "topics" => $data_wishlist
    );
    
    die(json_encode($rasult));