<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    //TIPE USER
    $data_user = $db->getFieldValue("member", array("*"), array("id" => $_POST["id_user"]));
    $tipe_user = count($data_user)>0?$data_user[0]["jenis_user"]:0;
    
    $total_qty = 0;
    $total = 0;
    $cart = array();
    $row = explode("\n", $_POST["cart"]);
    foreach($row as $i => $value) {
        $col = explode("\t", $value);    
        $id_produk = $col[0];
        $ukuran    = $col[1];
        $warna     = $col[2];
        $qty       = $col[3];
        
        $qty_komulatif = $qty;
        foreach($row as $i_ => $value_) {
            $col_ = explode("\t", $value_);    
            if($i!=$i_ && $id_produk==$col_[0]) {
                $qty_komulatif+=$col_[3];
            }
        }
        
        //GET LIST UKURAN DAN WARNA
        $list_ukuran = $list_warna = array();
        $data_ukuran_warna = $db->getFieldValue("produk_varian", array("*"), array("id_produk" => $id_produk), array(), 0, 0, "", "jumlah>0");
        $jumlah_stok = 0;
        if(count($data_ukuran_warna)==1 && $data_ukuran_warna[0]["ukuran"]=="" && $data_ukuran_warna[0]["warna"]=="") {
            $jumlah_stok = $data_ukuran_warna[0]["jumlah"];
        } else {
            //GET LIST UKURAN
            foreach($data_ukuran_warna as $i => $value) {        
                $jumlah_stok+=$value["jumlah"];
                if(strlen($value["ukuran"])>0) {
                    $add_ukuran = true;
                    foreach ($list_ukuran as $i_ukuran => $v_ukuran) {
                        if($v_ukuran["ukuran"]==$value["ukuran"]) {
                            $add_ukuran = false;
                            break;
                        }
                    }            
                    if($add_ukuran) { $list_ukuran[count($list_ukuran)]["ukuran"] = $value["ukuran"]; }
                }

                if(strlen($value["warna"])>0) {
                    $add_warna = true;
                    foreach ($list_warna as $i_warna => $v_warna) {
                        if($v_warna["warna"]==$value["warna"]) {
                            $add_warna = false;
                            break;
                        }
                    }
                    if($add_warna) { $list_warna[count($list_warna)]["warna"] = $value["warna"]; }
                }
            }
        }
        
        //CEK AVIABYLITY PRODUK
        $sql = "SELECT A.id, A.kode, A.nama, A.harga_modal AS harga_beli, ".(count($data_user)>0?"IF(C.harga_jual IS NOT NULL, C.harga_jual, A.harga_jual) AS harga_jual_khusus":"A.harga_jual").", A.harga_diskon, A.persen_diskon, A.berat, IF(A.harga_diskon>0 AND IF(A.from_date_harga_diskon IS NOT NULL, A.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_harga_diskon IS NOT NULL, A.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS harga_promo, IF(A.persen_diskon>0 AND IF(A.from_date_persen_diskon IS NOT NULL, A.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_persen_diskon IS NOT NULL, A.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS diskon_promo FROM produk AS A".(count($data_user)>0?" LEFT JOIN (SELECT id_produk, harga_jual FROM harga_jual_user WHERE tipe_user='$tipe_user' AND harga_jual>0 GROUP BY id_produk) AS C ON C.id_produk=A.id":"")." WHERE A.id='".$id_produk."'";
        $db->mysql_query($sql, $rec_count, $data);
        if($rec_count>0) {
            $data_grosir = array();
            $sql = "SELECT * FROM produk_grosir WHERE id_produk='".$id_produk."' AND jumlah_min<='$qty_komulatif' ORDER BY jumlah_min DESC LIMIT 0, 1";
            $db->mysql_query($sql, $rec_count, $data_grosir);
            
            $data[0]["persen_diskon"] = $data[0]["diskon_promo"]==1?$data[0]["persen_diskon"]:0;
            $data[0]["harga_diskon"]  = $data[0]["harga_promo"]==1?$data[0]["harga_diskon"]:0;
            $data[0]["harga_jual"]    = count($data_grosir)>0?$data_grosir[0]["harga"]:($data[0]["harga_diskon"]>0?$data[0]["harga_diskon"]:$data[0][count($data_user)==0?"harga_jual":"harga_jual_khusus"]);
            $data[0]["subtotal"]      = $data[0]["harga_jual"]-($data[0]["harga_jual"]*$data[0]["persen_diskon"]*0.01);    
            $data[0]["grandtotal"]    = $qty*$data[0]["subtotal"];

            $key = count($cart);
            $cart[$key]["id"]            = $col[0];
            $cart[$key]["ukuran"]        = $col[1];
            $cart[$key]["warna"]         = $col[2];
            $cart[$key]["jumlah"]        = $col[3];
            $cart[$key]["berat"]         = $data[0]["berat"];
            $cart[$key]["harga_beli"]    = $data[0]["harga_beli"];
            $cart[$key]["harga_jual"]    = $data[0]["harga_jual"];
            $cart[$key]["harga_diskon"]  = $data[0]["harga_diskon"];
            $cart[$key]["persen_diskon"] = $data[0]["persen_diskon"];
            $cart[$key]["subtotal"]      = $data[0]["subtotal"];
            $cart[$key]["grandtotal"]    = $data[0]["grandtotal"];
            $cart[$key]["list_stok"]     = $data_ukuran_warna;
            
            $total+=$cart[$key]["grandtotal"];
            $total_qty+=$cart[$key]["jumlah"];
        }
    }
    
    //getExpedisiLogo
    $data_expedisi = $db->getFieldValue("ekspedisi AS A", array("A.gambar"), array("A.kode" => $_POST["kurir"]));
    
    $db->mysql_close();
    die(json_encode(array("topics" => $cart, "expedisi_logo" => $data_expedisi[0]["gambar"], "qty" => $total_qty, "jumlah" => $total)));