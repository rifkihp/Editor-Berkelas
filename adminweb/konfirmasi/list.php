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
    
    $tipe        = (isset($_GET["tipe"])?$_GET["tipe"]:"");
    $query       = (isset($_GET["query"])?$_GET["query"]:"");
    $currentpage = (!isset($_GET["page"])?1:$_GET["page"]);
    $filter_status = (isset($_GET["status"])?$_GET["status"]:3);
    
    $tanggal_dari   = !isset($_GET["tanggal_dari"])?'':$_GET["tanggal_dari"];
    $temp = explode("-", $tanggal_dari);
    if(count($temp)==3) { $tanggal_dari = ($temp[2]."-".$temp[1]."-".$temp[0]); }
    
    $tanggal_sampai   = !isset($_GET["tanggal_sampai"])?'':$_GET["tanggal_sampai"];
    $temp = explode("-", $tanggal_sampai);
    if(count($temp)==3) { $tanggal_sampai = ($temp[2]."-".$temp[1]."-".$temp[0]); }
    
    $totalrecord = $db->getFieldValue("konfirmasi_pembayaran AS A LEFT JOIN member AS B ON A.id_member=B.id", array("COUNT(*) AS TOTAL"), array(),  array(), 0, 0, "", " 1 " . 
        (strlen($tanggal_dari)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')>='$tanggal_dari' ":"") .
        (strlen($tanggal_sampai)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')<='$tanggal_sampai' ":"") .
        ($filter_status<3?" AND A.status='$filter_status' ":"") . 
        (strlen($query)>0?" AND (B.first_name LIKE '%$query%' OR  B.last_name LIKE '%$query%' OR B.email LIKE '%$query%' OR A.nama_bank_pengirim LIKE '%$query%' OR A.nama_pemilik_rekening LIKE '%$query%' OR A.kode_pemesanan LIKE '%$query%')":""));
    
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    $listdetail = $db->getFieldValue("konfirmasi_pembayaran AS A LEFT JOIN member AS B ON A.id_member=B.id LEFT JOIN bank_transfer AS C ON A.bank_tujuan=C.id", array("A.id", "A.kode_pemesanan", "DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y %H:%i:%s') AS tgl_jam", "A.nama_bank_pengirim AS bank_pengirim", "A.nama_pemilik_rekening AS nama_pengirim", "A.jumlah_transfer", "B.last_name", "B.first_name", "IF(B.email IS NULL, 'Guest', B.email) AS email", "A.status", "C.nama_pemilik_rekening AS nama_penerima", "C.nama_bank AS bank_tujuan", "A.photo"), array(), array(), $limit, $limit*($currentpage-1), " A.tanggal_jam DESC ",  " 1 " .
        (strlen($tanggal_dari)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')>='$tanggal_dari' ":"") .
        (strlen($tanggal_sampai)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')<='$tanggal_sampai' ":"") .
        ($filter_status<3?" AND A.status='$filter_status' ":""). 
        (strlen($query)>0?" AND (B.first_name LIKE '%$query%' OR  B.last_name LIKE '%$query%' OR B.email LIKE '%$query%' OR A.nama_bank_pengirim LIKE '%$query%' OR A.nama_pemilik_rekening LIKE '%$query%' OR A.kode_pemesanan LIKE '%$query%')":"")); 
    foreach($listdetail as $key => $value) {
        $listdetail[$key]["jumlah_transfer"] = number_format($value["jumlah_transfer"], 0, '.', ',');
    }
    
    $smarty->assign('tanggal_dari', $_GET["tanggal_dari"]); 
    $smarty->assign('tanggal_sampai', $_GET["tanggal_sampai"]);
    $smarty->assign('query', $query);
    $smarty->assign('filter_status', $filter_status);
    $smarty->assign("currentpage", $currentpage);
    $smarty->assign("limitpage", $limit);
    $smarty->assign("totalpage", $totalpage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("frompage", $frompage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("listdetail", $listdetail);
    $smarty->assign("page_selected", "konfirmasi");
    $smarty->assign("sub_page_selected", "konfirmasi");    
    $smarty->assign("title", "Konfirmasi Pembayaran");
    $smarty->assign("sub_title", "List of Konfirmasi Pembayaran");
    
    if(isset($_SESSION["alert_success"])) {
        $smarty->assign("alert_success", $_SESSION["alert_success"]);
        unset($_SESSION["alert_success"]);
    }
    
    $id_menu = 6;
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/konfirmasi_pembayaran/list.html");    