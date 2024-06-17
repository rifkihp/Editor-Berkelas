<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect(true);
    
    $_limit      = 5;
    $query       = mysql_escape_string(isset($_POST["query"])?$_POST["query"]:"");
    $id_member   = $_POST["id_memeber"];
     
    $data_user = $db->getFieldValue("member", array("jenis_user"), array("id" => $id_member));
    $tipe_user = $data_user[0]["jenis_user"];
    
    $sql = "SELECT A.id, A.kode, A.nama, A.harga_modal AS harga_beli, " . (count($data_user)>0?"IF(C.harga_jual IS NOT NULL, C.harga_jual, A.harga_jual) AS harga_jual_khusus":"A.harga_jual") . ", A.harga_diskon, A.persen_diskon, A.berat, IF(A.harga_diskon>0 AND IF(A.from_date_harga_diskon IS NOT NULL, A.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_harga_diskon IS NOT NULL, A.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS harga_promo, IF(A.persen_diskon>0 AND IF(A.from_date_persen_diskon IS NOT NULL, A.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_persen_diskon IS NOT NULL, A.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS diskon_promo FROM produk AS A".(count($data_user)>0?" LEFT JOIN (SELECT id_produk, harga_jual FROM harga_jual_user WHERE tipe_user='$tipe_user' AND harga_jual>0 GROUP BY id_produk) AS C ON C.id_produk=A.id":"")." WHERE A.status=1 " . (strlen($query)>0?" AND (A.kode LIKE '%$query%' OR A.nama LIKE '%$query%' OR A.keyword LIKE '%$query%')":"");
    $db->mysql_query($sql, $rs_num, $rs);
    foreach($rs as $key => $value) {
    
        //GET LIST UKURAN
        $sql = "SELECT UPPER(CONCAT(ukuran, '|', warna)) AS kode, ukuran, warna, jumlah FROM produk_varian WHERE id_produk='".$value["id"]."'";
        $db->mysql_query($sql, $rs_num_varian, $rs[$key]["list_ukuran_warna"]);
    
        //LIST GROSIR
        $rs[$key]["list_grosir"] = '';
        $data_grosir = $db->getFieldValue("produk_grosir", array("CONCAT(jumlah_min, '|', jumlah_max, '|', harga) AS harga_grosir"), array("id_produk" => $value["id"]), array(), 0, 0, "jumlah_min DESC");
        foreach ($data_grosir as $key_grosir => $value_grosir) {
            $rs[$key]["list_grosir"] .= (strlen($rs[$key]["list_grosir"])>0?'\n':'').$value_grosir["harga_grosir"];
        }
        
        $rs[$key]["harga_jual"]    = $value[count($data_user)>0?"harga_jual_khusus":"harga_jual"];        
        $rs[$key]["persen_diskon"] = $value["diskon_promo"]==1?$value["persen_diskon"]:0;
        $rs[$key]["harga_diskon"]  = $value["harga_promo"]==1?$value["harga_diskon"]:0;

        $harga_jual = $rs[$key]["harga_diskon"]>0?$rs[$key]["harga_diskon"]:$rs[$key]["harga_jual"];
        $rs[$key]["sub_total"] = $harga_jual-($harga_jual*($rs[$key]["persen_diskon"]*0.01));
        
        $rs[$key]["harga_jual"]   = number_format($rs[$key]["harga_jual"], 0, '.', ',');
        $rs[$key]["harga_diskon"] = number_format($rs[$key]["harga_diskon"], 0, '.', ',');
        $rs[$key]["sub_total"]    = number_format($rs[$key]["sub_total"], 0, '.', ',');
        
        $data[$key] = array(
            "display" => $value["kode"] . " - " . $value["nama"],
            "value" => $value["nama"],
            "data" => $rs[$key]
        ); 
    }
    
    $db->mysql_close();
    die(json_encode($data));