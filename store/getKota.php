<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/rajaOngkir.php";

    $token    = $_POST["token"];
    $propinsi = $_POST["propinsi"];
    
    $ro = new rajaOngkir(RAJA_ONGKIR_TYP, RAJA_ONGKIR_KEY);
    $result = array("success" => true, "topics" => $ro->getKota($propinsi), "token" => $token);

    die(json_encode($result));