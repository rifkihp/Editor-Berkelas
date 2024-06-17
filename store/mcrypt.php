<?php
    $root = "../";
    
    include $root."includes/php/MCrypt.php";
    
    $mcrypt = new MCrypt();
    if($_POST["action"]=="encrypt") {
        die($mcrypt->encrypt($_POST['text']));
    }
    if($_POST["action"]=="decrypt") {
        die($mcrypt->decrypt($_POST['text']));
    }
    
    