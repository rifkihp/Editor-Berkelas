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
    
    $sql_induk = "
        SELECT 
            A.kode AS kode_pesan, 
            IF(A.id_member=0, 'Tamu', CONCAT(B.first_name, ' ', B.last_name)) AS member, 
            A.tanggal_jam,
            DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y') AS tanggal, 
            COALESCE(C.modal, 0) AS modal, 
            A.grandtotal, 
            A.voucher, 
            A.ongkir, 
            A.total 
        FROM 
            customer_order_header AS A LEFT JOIN 
            member AS B ON A.id_member=B.id LEFT JOIN 
            (SELECT C1.id_header, SUM(C1.jumlah*harga_beli) AS modal, C2.status FROM customer_order_detail AS C1 LEFT JOIN customer_order_header AS C2 ON C1.id_header=C2.id WHERE (C2.status=6 OR C2.status=5 OR C2.status=2) ".
            (strlen($tanggal_dari)>0?" AND DATE_FORMAT(C2.tanggal_jam, '%Y-%m-%d')>='$tanggal_dari'":"") .
            (strlen($tanggal_sampai)>0?" AND DATE_FORMAT(C2.tanggal_jam, '%Y-%m-%d')<='$tanggal_sampai'":"") ." " .
            "GROUP BY C1.id_header) AS C ON A.id=C.id_header 
        WHERE (A.status=6 OR A.status=5 OR A.status=2) " .
            (strlen($tanggal_dari)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')>='$tanggal_dari'":"") .
            (strlen($tanggal_sampai)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')<='$tanggal_sampai'":"");
    
    $sql = "SELECT COUNT(*) AS TOTAL, SUM(modal) AS JUM_MODAL, SUM(grandtotal) AS JUM_GRANDTOT, SUM(voucher) AS JUM_VOUCHER, SUM(ongkir) AS JUM_ONGKIR, SUM(total) AS JUM_TOTAL FROM ($sql_induk) AS T";
    $db->mysql_query($sql, $rec_count, $totalrecord);
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $smarty->assign("modal", number_format($totalrecord[0]["JUM_MODAL"], 0, '.', ','));
    $smarty->assign("grandtotal", number_format($totalrecord[0]["JUM_GRANDTOT"], 0, '.', ','));
    $smarty->assign("voucher", number_format($totalrecord[0]["JUM_VOUCHER"], 0, '.', ','));
    $smarty->assign("ongkir", number_format($totalrecord[0]["JUM_ONGKIR"], 0, '.', ','));
    $smarty->assign("total", number_format($totalrecord[0]["JUM_TOTAL"], 0, '.', ','));
    
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    
    $sql = "SELECT * FROM ($sql_induk) AS T ORDER BY T.tanggal_jam DESC LIMIT ".$limit*($currentpage-1).", ".$limit;
    $db->mysql_query($sql, $rec_count, $listdetail);
    foreach ($listdetail as $key => $value) {
        $listdetail[$key]["modal"] = number_format($value["modal"], 0, '.', ',');
        $listdetail[$key]["grandtotal"] = number_format($value["grandtotal"], 0, '.', ',');
        $listdetail[$key]["voucher"] = number_format($value["voucher"], 0, '.', ',');
        $listdetail[$key]["ongkir"] = number_format($value["ongkir"], 0, '.', ',');
        $listdetail[$key]["total"] = number_format($value["total"], 0, '.', ',');
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
    $smarty->assign("sub_page_selected", "lap_pesanan");    
    $smarty->assign("title", "Laporan Pesanan");
    $smarty->assign("sub_title", "List of Laporan Pesanan");
    
    $id_menu = 19;
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/laporan_pesanan/list.html");    