<?php
    $root = "../";
    include $root."includes/php/initial.php";
    die(json_encode(array("islogin" => isset($_SESSION[SESSION_NAME]))));