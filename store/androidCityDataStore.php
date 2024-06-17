<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/rajaOngkir.php";

    $propinsi = $_POST["province_id"];
    $ro = new rajaOngkir(RAJA_ONGKIR_TYP, RAJA_ONGKIR_KEY);
    $result = array("topics" => $ro->getKota($propinsi));

    die(json_encode($result));