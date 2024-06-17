<?php
    $root = "../";
    include $root."includes/php/initial.php";
    
    $cartdetail = $_SESSION[CLIENT_SESSION_NAME]["cart"]["detail"];
    $total_count_items = 0;
    foreach($cartdetail as $key => $value) {
        $total_count_items+=$value["jumlah"];
    }
    
    die(json_encode(array("count_cart" => $total_count_items)));