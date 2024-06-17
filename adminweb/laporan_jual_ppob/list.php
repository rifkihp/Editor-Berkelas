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
    
    $query = (isset($_GET["query"])?$_GET["query"]:"");
    
    $sql = "SELECT 
                COUNT(*) AS TOTAL, 
                SUM(IF(A.jenis_trx='BELI', A.beli, A.tagihan+A.denda)) AS JUM_BELI, 
                SUM(A.total) AS JUM_JUAL, 
                SUM((A.total-IF(A.jenis_trx='BELI', A.beli, A.tagihan+A.denda))) AS JUM_LABA 
            FROM 
                ppob_transaksi AS A LEFT JOIN 
                member AS B ON A.id_member=B.id  
            WHERE 
                A.status=2 AND     
                A.status_trx<>'FAILED' " .
                (strlen($query)>0?" AND LOWER(B.email)='".strtolower($query)."'":"") .
                (strlen($tanggal_dari)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')>='$tanggal_dari'":"") .
                (strlen($tanggal_sampai)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')<='$tanggal_sampai'":"");
    
    $db->mysql_query($sql, $rec_count, $totalrecord);
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $smarty->assign("beli", number_format($totalrecord[0]["JUM_BELI"], 0, '.', ','));
    $smarty->assign("jual", number_format($totalrecord[0]["JUM_JUAL"], 0, '.', ','));
    $smarty->assign("laba", number_format($totalrecord[0]["JUM_LABA"], 0, '.', ','));
    
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    
    $sql = "SELECT
            A.kode, 
            DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y %H:%i:%s') AS tanggal, 
            A.provider AS produk, 
            A.provider_sub AS jenis_produk, 
            A.code, 
            A.description,  
            A.nomer_tujuan,
            IF(A.jenis_trx='BELI', A.beli, A.tagihan+A.denda) AS beli,
            A.total AS jual,
            (A.total-IF(A.jenis_trx='BELI', A.beli, A.tagihan+A.denda)) AS laba, 
            B.email 
        FROM 
            ppob_transaksi AS A LEFT JOIN 
            member AS B ON A.id_member=B.id 
        WHERE 
            A.status=2 AND     
            A.status_trx<>'FAILED' " .
            (strlen($query)>0?" AND LOWER(B.email)='".strtolower($query)."'":"") .
            (strlen($tanggal_dari)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')>='$tanggal_dari'":"") .
            (strlen($tanggal_sampai)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')<='$tanggal_sampai'":"") ." 
        ORDER BY 
            B.email, 
            A.jenis_trx DESC,
            A.code ASC,
            A.tanggal_jam DESC 
        LIMIT 
            ".$limit*($currentpage-1).", ".$limit;
    $db->mysql_query($sql, $rec_count, $listdetail);
    foreach ($listdetail as $key => $value) {
        $listdetail[$key]["beli"] = number_format($value["beli"], 0, '.', ',');
        $listdetail[$key]["jual"] = number_format($value["jual"], 0, '.', ',');
        $listdetail[$key]["laba"] = number_format($value["laba"], 0, '.', ',');
    } 
    
    $smarty->assign('query', $query);
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
    $smarty->assign("sub_page_selected", "lap_jual_ppob");    
    $smarty->assign("title", "Laporan Penjualan PPOB");
    $smarty->assign("sub_title", "List of Laporan Penjualan PPOB");
    
    $id_menu = 46;
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/laporan_jual_ppob/list.html");    