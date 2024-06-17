<?php
$url = 'https://portalpulsa.com/api/connect/';

$header = array(
'portal-userid: P71700',
'portal-key: ddeecd6eacd0072f9dc80271fb3a0c17', // lihat hasil autogenerate di member area
'portal-secret: f98bfe9b620b720502a42936494015c7755b3a39adb66cdaeb6e5e0fc0f5b8dc', // lihat hasil autogenerate di member area
);

$data = array(
'inquiry' => 'HARGA', // konstan
'code' => 'GAME', // pilihan: pln, pulsa, game
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch);

$root = "../";
include $root."includes/php/initial.php";    
include $root."includes/php/classUtama.php";

////DATABASE CONNECTION
//$db = new classUtama(ADMIN_SESSION_NAME);
//$db->mysql_connect(true);
//    
//$datas = json_decode($result,true);
////print_r($datas);
////echo $datas["message"];
//
//$db->mysql_execute("TRUNCATE TABLE ppob_produk");
//foreach ($datas["message"] as $key => $value) {
//    //print_r($value);
//    echo($value["provider"]."<br />");
//    $db->mysql_insert("ppob_produk", $value);
//}
//$db->mysql_close();

echo $result;


//{ "provider": "AXIS", "provider_sub": "REGULER", "operator": "AXIS", "operator_sub": "AX", "code": "AX5", "description": "AXIS 5000", "price": "5585", "status": "normal" }