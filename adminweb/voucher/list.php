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
    
    $totalrecord = $db->getFieldValue("voucher AS A", array("COUNT(*) AS TOTAL"), array(),  array(), 0, 0, "", " 1 " . (strlen($query)>0?" AND (A.kode_voucher LIKE '%$query%')":""));
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    $listdetail = $db->getFieldValue("voucher AS A", array("A.id", "A.kode_voucher", "A.nominal", "A.tipe_voucher, A.jenis_voucher", "DATE_FORMAT(A.batas_valid, '%d-%m-%Y') AS tanggal_valid", "is_valid", "IF(A.batas_valid>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 'Y', 'N') AS valid"), array(), array(), $limit, $limit*($currentpage-1), " id DESC ",  " 1 " . (strlen($query)>0?" AND (A.kode_voucher LIKE '%$query%')":"")); 
    foreach ($listdetail as $key => $value) {
        $listdetail[$key]["nominal"] = ($value["tipe_voucher"]=="nominal"?"Rp.":"") . number_format($value["nominal"], 0, '.', ',') . ($value["tipe_voucher"]=="nominal"?"":" %");
        $listdetail[$key]["jenis"] = ($value["jenis_voucher"]=="ongkir"?"Ongkos Kirim":"Belanja");
        $listdetail[$key]["status"] = ($value["is_valid"]=="Y"?"Belum Terpakai":"Terpakai");
        $listdetail[$key]["valid"] = ($value["valid"]=="Y"?"Aktif":"Tidak Aktif");
    }
    
    $smarty->assign('query', $query);
    $smarty->assign("currentpage", $currentpage);
    $smarty->assign("limitpage", $limit);
    $smarty->assign("totalpage", $totalpage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("frompage", $frompage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("listdetail", $listdetail);
    $smarty->assign("page_selected", "vaoucher");
    $smarty->assign("sub_page_selected", "voucher");    
    $smarty->assign("title", "Voucher");
    $smarty->assign("sub_title", "List of Voucher");
    
    if(isset($_SESSION["alert_success"])) {
        $smarty->assign("alert_success", $_SESSION["alert_success"]);
        unset($_SESSION["alert_success"]);
    }
    
    $id_menu = 16;
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/voucher/list.html");    