<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/rajaOngkir.php";

    //GET PROPINSI
    $ro = new rajaOngkir(RAJA_ONGKIR_TYP, RAJA_ONGKIR_KEY);
    $result = array("topics" => $ro->getPropinsi());
    
    die(json_encode($result));