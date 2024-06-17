<?php
    $transactionId   = $_POST["transactionId"];
    $keyTotalBelanja = $_POST["keyTotalBelanja"];


    $params = array(
        "merchantId" => "DAMAY0012134234231",
        "merchantSecret" => "asdasdijhjlkaskooOIOIJOUHasd012lknashdlHNMasodija",
        "function" => "dana.payment",
        "transactionId" => $transactionId,
        "orderNumber" => $transactionId,
        "orderTitle" => "Toko Koperasi",
        "orderCurrency" => "IDR",
        "orderAmount" => $keyTotalBelanja,
        "orderType" => "S",
        "orderMemo" => "Toko Koperasi",
        "productCode" => "51051000100000000001",
        "envSourcePlatform" => "IPG",
        "envTerminalType" => "APP"
    );

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "app.damay.id:3000/orders/createOrder",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => http_build_query($params),
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/x-www-form-urlencoded"
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;