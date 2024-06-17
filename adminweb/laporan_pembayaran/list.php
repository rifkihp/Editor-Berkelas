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
    
    $currentpage   = (!isset($_GET["page"])?1:$_GET["page"]);
    
    $tanggal_dari   = !isset($_GET["tanggal_dari"])?'':$_GET["tanggal_dari"];
    $temp = explode("-", $tanggal_dari);
    if(count($temp)==3) { $tanggal_dari = ($temp[2]."-".$temp[1]."-".$temp[0]); }
    
    $tanggal_sampai   = !isset($_GET["tanggal_sampai"])?'':$_GET["tanggal_sampai"];
    $temp = explode("-", $tanggal_sampai);
    if(count($temp)==3) { $tanggal_sampai = ($temp[2]."-".$temp[1]."-".$temp[0]); }
    
    $sql = "SELECT COUNT(*) AS TOTAL, SUM(jumlah_transfer) AS JUMLAH FROM konfirmasi_pembayaran A WHERE A.status=2".
        (strlen($tanggal_dari)>0?" AND DATE_FORMAT(A.tanggal_jam_update_status, '%Y-%m-%d')>='$tanggal_dari'":"") .
        (strlen($tanggal_sampai)>0?" AND DATE_FORMAT(A.tanggal_jam_update_status, '%Y-%m-%d')<='$tanggal_sampai'":"");
    $db->mysql_query($sql, $rec_count, $totalrecord);
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $smarty->assign("jumlah", number_format($totalrecord[0]["JUMLAH"], 0, '.', ','));
    
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    
    $sql = "SELECT A.id, A.kode_pemesanan AS kode_pesan, IF(A.id_member=0, 'Tamu', CONCAT(B.first_name, ' ', B.last_name)) AS member, 
            DATE_FORMAT(A.tanggal_jam_update_status, '%d-%m-%Y') AS tanggal_bayar, C.nama_bank, C.cabang, C.no_rekening, C.nama_pemilik_rekening, 
            A.jumlah_transfer FROM konfirmasi_pembayaran AS A LEFT JOIN member AS B ON A.id_member=B.id LEFT JOIN bank_transfer AS C ON A.bank_tujuan=C.id
            WHERE A.status=2 ". (strlen($tanggal_dari)>0?"AND DATE_FORMAT(A.tanggal_jam_update_status, '%Y-%m-%d')>='$tanggal_dari' ":"") .
            (strlen($tanggal_sampai)>0?"AND DATE_FORMAT(A.tanggal_jam_update_status, '%Y-%m-%d')<='$tanggal_sampai' ":"")."ORDER BY A.tanggal_jam_update_status DESC LIMIT ".$limit*($currentpage-1).", ".$limit;
    $db->mysql_query($sql, $rec_count, $listdetail);
    foreach ($listdetail as $key => $value) {
        $listdetail[$key]["jumlah_transfer"] = number_format($value["jumlah_transfer"], 0, '.', ',');
    }  
    
    $smarty->assign('tanggal_dari', $_GET["tanggal_dari"]); 
    $smarty->assign('tanggal_sampai', $_GET["tanggal_sampai"]);
    $smarty->assign("currentpage", $currentpage);
    $smarty->assign("limitpage", $limit);
    $smarty->assign("totalpage", $totalpage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("frompage", $frompage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("listdetail", $listdetail);
    $smarty->assign("page_selected", "laporan");
    $smarty->assign("sub_page_selected", "lap_pembayaran");    
    $smarty->assign("title", "Laporan Pembayaran");
    $smarty->assign("sub_title", "List of Laporan Pembayaran");
    
    $id_menu = 19;
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/laporan_pembayaran/list.html");    