    <?php
    $url = 'https://javah2h.com/api/connect/';

    $header = array(
    'h2h-userid: H1204',
    'h2h-key: 2684e8581e83b9ca6d476eb733012868', // lihat hasil autogenerate di member area
    'h2h-secret: d76c0001768edc2acbc331ed2654b1720a8f733562a73f934755bde4ee4e0a10', // lihat hasil autogenerate di member area
    );

    $data = array(
    'inquiry' => 'S', // konstan
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);

    echo $result;


