<?php
    $root = "../../";
    include $root."includes/php/initial.php";    
    if(!isset($_SESSION[ADMIN_SESSION_NAME])) {
        header("location: ".ADMINWEB_URL);
        die();
    }
    include $root."includes/php/classUtama.php";
    include SMARTY_DIR."Smarty.class.php";
    
    
    $smarty = new Smarty;        
    //$smarty->force_compile = true;
    //$smarty->debugging = true;
    $smarty->caching = true;
    $smarty->cache_lifetime = 0;
    
    $smarty->assign("homeurl", HOME_URL); 
    $smarty->assign("adminweburl", ADMINWEB_URL);
    $smarty->assign("data_user", $_SESSION[ADMIN_SESSION_NAME]["user"]);
    $smarty->assign("tpl_dir", HOME_URL."/templates/".BACK_END_TEMPLATE);
    $smarty->assign("include_tpl", BACK_END_TEMPLATE_INCLUDE_PATH);
        
    //DATABASE CONNECTION
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $pagelimit = 5;
    $limit = 20;
    
    $tipe           = (isset($_GET["tipe"])?$_GET["tipe"]:"");
    $query          = (isset($_GET["query"])?$_GET["query"]:"");
    $currentpage    = (!isset($_GET["page"])?1:$_GET["page"]);
    
    $tanggal_dari   = !isset($_GET["tanggal_dari"])?'':$_GET["tanggal_dari"];
    $temp = explode("-", $tanggal_dari);
    if(count($temp)==3) { $tanggal_dari = ($temp[2]."-".$temp[1]."-".$temp[0]); }
    
    $tanggal_sampai   = !isset($_GET["tanggal_sampai"])?'':$_GET["tanggal_sampai"];
    $temp = explode("-", $tanggal_sampai);
    if(count($temp)==3) { $tanggal_sampai = ($temp[2]."-".$temp[1]."-".$temp[0]); }
    
    $is_dropship    = (isset($_GET["jenis"])?$_GET["jenis"]:"0");    
    $is_lunas       = (isset($_GET["status"])?$_GET["status"]:"0");    
    
    $totalrecord = $db->getFieldValue("customer_order_header AS A LEFT JOIN member AS B ON A.id_member=B.id LEFT JOIN customer_order_ongkir AS C ON C.id_header=A.id LEFT JOIN ekspedisi AS D ON C.id_ekspedisi=D.id", array("COUNT(*) AS TOTAL"), array(),  array(), 0, 0, "", " 1 " . 
        (strlen($tanggal_dari)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')>='$tanggal_dari' ":"") .
        (strlen($tanggal_sampai)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')<='$tanggal_sampai' ":"") .
        ($is_dropship!="0"?" AND A.is_dropship='$is_dropship'":"")  .
        ($is_lunas!="0"?(" AND A.status IN ".($is_lunas=="Y"?"('2', '5', '6')":"('0', '1', '3', '7', '8')")):"")  .
        (strlen($query)>0?" AND (B.first_name LIKE '%$query%' OR  B.last_name LIKE '%$query%' OR B.email LIKE '%$query%' OR A.kode LIKE '%$query%' OR A.nama LIKE '%$query%' OR A.no_hp LIKE '%$query%' OR D.kode LIKE '%$query%' OR C.no_resi LIKE '%$query%')":""));
        
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    $listdetail = $db->getFieldValue("customer_order_header AS A LEFT JOIN member AS B ON A.id_member=B.id LEFT JOIN customer_order_ongkir AS C ON C.id_header=A.id LEFT JOIN ekspedisi AS D ON C.id_ekspedisi=D.id", array("A.id", "A.id_member", "A.kode AS kode_pemesanan", "A.pembayaran", "DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y %H:%i:%s') AS tanggal", "A.nama", "A.alamat", "A.no_hp", "B.last_name", "B.first_name", "IF(B.email IS NULL, A.email_notifikasi, B.email) AS email", "A.total", "A.status", "D.kode AS kurir", "C.no_resi", "A.is_dropship"), array(), array(), $limit, $limit*($currentpage-1), " A.kode DESC ",  " 1 " . (strlen($tanggal_dari)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')>='$tanggal_dari' ":"") .
        (strlen($tanggal_sampai)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')<='$tanggal_sampai' ":"") .
        ($is_dropship!="0"?" AND A.is_dropship='$is_dropship'":"")  .
        ($is_lunas!="0"?(" AND A.status IN ".($is_lunas=="Y"?"('2', '5', '6')":"('0', '1', '3', '7', '8')")):"")  .
        (strlen($query)>0?" AND (B.first_name LIKE '%$query%' OR  B.last_name LIKE '%$query%' OR B.email LIKE '%$query%' OR A.kode LIKE '%$query%' OR A.nama LIKE '%$query%' OR A.no_hp LIKE '%$query%' OR D.kode LIKE '%$query%' OR C.no_resi LIKE '%$query%')":""));
    
    foreach($listdetail as $key => $value) {
        $listdetail[$key]["total"] = "Rp. ".number_format($value["total"], 0, '.', ',');
        $listdetail[$key]["histori_status_pemesanan"] = $db->getFieldValue("histori_status_pemesanan", array("id", "id_pemesanan", "DATE_FORMAT(tanggal_jam, '%d-%m-%Y') AS tanggal", "penjelasan"), array("id_pemesanan" => $value["id"]), 0, 0, "tanggal_jam DESC");
        $listdetail[$key]["detail_pemesanan"] = $db->getFieldValue("customer_order_detail AS A LEFT JOIN produk AS B ON A.id_produk=B.id", array("A.kode", "A.nama", "B.gambar_utama AS gambar", "A.ukuran", "A.warna", "A.jumlah", "A.sub_total", "A.grand_total"), array("A.id_header" => $value["id"]), 0, 0, "id ");
        foreach($listdetail[$key]["detail_pemesanan"] as $key_detail_pemesanan => $value_detail_pemesanan) {
            $listdetail[$key]["detail_pemesanan"][$key_detail_pemesanan]["sub_total"] = "Rp. ".number_format($value_detail_pemesanan["sub_total"], 0, '.', ',');
            $listdetail[$key]["detail_pemesanan"][$key_detail_pemesanan]["grand_total"] = "Rp. ".number_format($value_detail_pemesanan["grand_total"], 0, '.', ',');
        }
        $listdetail[$key]["cara_bayar"] = ($value['pembayaran']==1?"Transfer Bank":($value['pembayaran']==2?"Kartu Kredit / Debet":($value['pembayaran']==3?"COD":"")));
    }
    
    $smarty->assign('tanggal_dari', $_GET["tanggal_dari"]); 
    $smarty->assign('tanggal_sampai', $_GET["tanggal_sampai"]);
    $smarty->assign('jenis', $is_dropship);
    $smarty->assign('status', $is_lunas);
    
    $smarty->assign('query', $query);
    $smarty->assign("currentpage", $currentpage);
    $smarty->assign("limitpage", $limit);
    $smarty->assign("totalpage", $totalpage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("frompage", $frompage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("listdetail", $listdetail);
    $smarty->assign("page_selected", "pesanan");
    $smarty->assign("sub_page_selected", "pemesanan");
    $smarty->assign("title", "Pemesanan");
    $smarty->assign("sub_title", "List of Pemesanan");
    
    if(isset($_SESSION["alert_success"])) {
        $smarty->assign("alert_success", $_SESSION["alert_success"]);
        unset($_SESSION["alert_success"]);
    }
    
    $id_menu = 4;
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/pemesanan/list.html");    