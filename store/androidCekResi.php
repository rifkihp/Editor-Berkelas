<?php
        
    //print_r($_POST);

    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    include $root."includes/php/rajaOngkir.php";
        
    //GET ONGKIR
    $kurir   = $_POST["kurir"];   
    $waybill = $_POST["no_resi"]; 
    
    //$kurir   = "TIKI";
    //$waybill = "030075453135"; 
    
    $ro = new rajaOngkir(RAJA_ONGKIR_TYP, RAJA_ONGKIR_KEY);
    $delivered = $ro->getWaybill($waybill, strtolower($kurir));
   
    $manifest = $delivered["manifest"];
    
    $data = array();
    foreach ($manifest as $key => $value) {
        $data[$key] = $value;
        //echo($value["manifest_date"] ." " . $value["manifest_time"] . " -> ". $value["manifest_description"]. "<br />");
    }
    
    $result = array("topics" => $data, "kurir" => $kurir, "no_resi" => $waybill);  
    die(json_encode($result));
