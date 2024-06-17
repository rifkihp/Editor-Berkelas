<?php

    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    include $root."includes/php/rajaOngkir.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $sql = "SELECT A.* FROM ppob_produk AS A WHERE A.provider='PLN' ORDER BY A.price";
    $db->mysql_query($sql, $rec_count, $data);
    foreach ($data as $key => $value) {
        $data[$key]['nama'] = substr($value["description"], 0, strlen($value["description"])-3)." RB";
        $data[$key]['tarif'] = "Rp ".number_format($value['price'], 0, '.', ',');
        $data[$key]['harga'] = $value['price'];
    }

    $db->mysql_close();
    
    $result = array("topics" => $data);
    die(json_encode($result));
    
    


/*    die("{
        \"response\": \"Success\",
        \"provider\": \"PLNPREPAID\",
        \"pricelist\": [
          {
            \"code\": \"PLN20\",
            \"nama\": \"PLN Voucher 20.000\",
            \"harga\": 19800
          },
          {
            \"code\": \"PLN50\",
            \"nama\": \"PLN Voucher 50.000\",
            \"harga\": 49800
          },
          {
            \"code\": \"PLN100\",
            \"nama\": \"PLN Voucher 100.000\",
            \"harga\": 99800
          },
          {
            \"code\": \"PLN200\",
            \"nama\": \"PLN Voucher 200.000\",
            \"harga\": 199800
          },
          {
            \"code\": \"PLN500\",
            \"nama\": \"PLN Voucher 500.000\",
            \"harga\": 499800
          }
        ]
      }");*/