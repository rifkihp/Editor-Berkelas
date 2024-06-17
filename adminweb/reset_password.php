<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    include SMARTY_DIR."Smarty.class.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    $db->mysql_close();
    
    $smarty = new Smarty;        
    $smarty->assign("homeurl", HOME_URL);
    $smarty->assign("tpl_dir", HOME_URL."/templates/".BACK_END_TEMPLATE);
    $smarty->assign("include_tpl", BACK_END_TEMPLATE_INCLUDE_PATH);
    
    //$smarty->force_compile = true;
    //$smarty->debugging = true;
    $smarty->caching = true;
    $smarty->cache_lifetime = 0;
    
    $smarty->assign("email", $_GET["email"]);
    $smarty->assign("kode_reset", $_GET["hash"]);
    $smarty->display(BACK_END_TEMPLATE_PATH."/reset_password.html");