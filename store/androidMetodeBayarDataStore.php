<?php
    $root = "../";
    include $root."includes/php/initial.php";
    
    $data = array(
        array(
            "id" => 1,
            "nama" =>  "Transfer Bank"          
        ) //,
        /*array(
            "id" => 2,
            "nama" =>  "Kartu Kredit / Debit"          
        ),
        array(
            "id" => 3,
            "nama" =>  "Cash on Delivery (COD)"          
        )*/
    );
    
    $result = array("topics" => $data);
    die(json_encode($result));