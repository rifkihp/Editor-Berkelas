<?php
    $ip = $_SERVER['SERVER_NAME'];
    session_start();
    error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
    
    // SET TIMEZONE
    date_default_timezone_set("Asia/Jakarta");
    
    define ("ROOT_PATH", realpath($root));
    define ("HOME_URL", "http://".$ip."/editorberkelas");
    define ("ADMINWEB_URL", "http://".$ip."/editorberkelas/adminweb");
    define ("SMARTY_DIR", $root."includes/Smarty-3.1.21/libs/");
    
    //FRONTEND TEMPLATE
    define ("FRONT_END_TEMPLATE", "front-end/welldone");
    define ("FRONT_END_TEMPLATE_PATH", $root."templates/".FRONT_END_TEMPLATE);
    define ("FRONT_END_TEMPLATE_INCLUDE_PATH", ROOT_PATH."/templates/".FRONT_END_TEMPLATE);
    
    //BACKEND TEMPLATE
    define ("BACK_END_TEMPLATE", "back-end/penguin");
    define ("BACK_END_TEMPLATE_PATH", $root."templates/".BACK_END_TEMPLATE);
    define ("BACK_END_TEMPLATE_INCLUDE_PATH", ROOT_PATH."/templates/".BACK_END_TEMPLATE);    
    
    //DATABASE CONFIG VARIABLE
    define("ADMIN_SESSION_NAME", "EDITORBERKELAS_ADMIN");
    define("CLIENT_SESSION_NAME", "EDITORBERKELAS_CLIENT");
	
    //LOCAL SETTINGS
    define("DB_HOST", "localhost:3305");
    define("DB_USER", "root");
    define("DB_PASSWORD", "qwe123");
    define("DB_DATABASE", "editorberkelas");