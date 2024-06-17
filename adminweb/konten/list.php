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
    
    $currentpage  = (!isset($_GET["page"])?1:$_GET["page"]);
    $query        = (isset($_GET["query"])?$_GET["query"]:"");
    
    $totalrecord = $db->getFieldValue("konten AS A", array("COUNT(*) AS TOTAL"), array(),  array(), 0, 0, "", " 1 " . $tag . (strlen($query)>0?" AND (A.title LIKE '%$query%')":""));
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    $listdetail = $db->getFieldValue("konten AS A", array("A.id", "A.title", "A.banner", "A.thumbnail", "A.videoId", "A.tabpanel_1", "A.tabpanel_2", "A.tabpanel_3", "A.tabpanel_4", "A.tabpanel_5", "A.tabpanel_6", "A.is_aktif"), array(), array(), $limit, $limit*($currentpage-1), " A.id DESC ",  " 1 " . $tag . (strlen($query)>0?" AND (A.title LIKE '%$query%')":"")); 
    
    $tabmenu = $db->getFieldValue("tabpanel AS A", array("A.id", "A.nama"), array(), array(), 0, 0, " A.id ASC "); 
    $smarty->assign("tabmenu", $tabmenu);

    $smarty->assign('query', $query);
    $smarty->assign("currentpage", $currentpage);
    $smarty->assign("limitpage", $limit);
    $smarty->assign("totalpage", $totalpage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("frompage", $frompage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("listdetail", $listdetail);

    $smarty->assign("page_selected", "konten");
    $smarty->assign("sub_page_selected", "konten");
    $smarty->assign("title", "Konten");
    $smarty->assign("sub_title", "Data Konten");
    
    if(isset($_SESSION["alert_success"])) {
        $smarty->assign("alert_success", $_SESSION["alert_success"]);
        unset($_SESSION["alert_success"]);
    }
    
    $id_menu = 41;
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/konten/list.html");    