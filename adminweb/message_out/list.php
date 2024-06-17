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
    $query = isset($_GET["query"])?$_GET["query"]:"";
    $currentpage = !isset($_GET["page"])?1:$_GET["page"];
    $totalrecord = $db->getFieldValue("message AS A LEFT JOIN member AS B ON A.to=B.id", array("COUNT(*) AS TOTAL"), array("A.from" => 0),  array(), 0, 0, "", " 1 " . (strlen($query)>0?" AND (CONCAT(B.first_name, ' ', B.last_name) LIKE '%$query%' OR B.email LIKE '%$query%' OR A.judul LIKE '%$query%' OR A.pesan LIKE '%$query%')":""));
    
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    $listdetail = $db->getFieldValue("message AS A LEFT JOIN member AS B ON A.to=B.id", array("A.id", "DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y %H:%i:%s') AS tanggal", "CONCAT(B.first_name, ' ', B.last_name) AS to_name", "B.email AS from_email", "A.judul", "A.pesan", "A.status"), array("A.from" => 0), array(), $limit, $limit*($currentpage-1), " A.id DESC ", " 1 " . (strlen($query)>0?" AND (CONCAT(B.first_name, ' ', B.last_name) LIKE '%$query%' OR B.email LIKE '%$query%' OR A.judul LIKE '%$query%' OR A.pesan LIKE '%$query%')":"")); 
    foreach ($listdetail as $key => $value) {
        $listdetail[$key]["pesan"] = $db->limitTextKonten($value["pesan"], 500);
    }
    
    $smarty->assign('query', $query);
    $smarty->assign("currentpage", $currentpage);
    $smarty->assign("limitpage", $limit);
    $smarty->assign("totalpage", $totalpage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("frompage", $frompage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("listdetail", $listdetail);
    $smarty->assign("page_selected", "message");
    $smarty->assign("sub_page_selected", "message");    
    $smarty->assign("title", "Message");
    $smarty->assign("sub_title", "List of Message");
    
    if(isset($_SESSION["alert_success"])) {
        $smarty->assign("alert_success", $_SESSION["alert_success"]);
        unset($_SESSION["alert_success"]);
    }
    
    $id_menu = 17;
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/message/message_out.html");