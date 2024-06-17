<?php

    $root = "../../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $sql = "SELECT DATE_FORMAT(tanggal_jam, '%Y-%m-%d') AS tanggal, SUM(total) AS jumlah FROM customer_order_header WHERE (status=5 OR status=6) GROUP BY DATE_FORMAT(tanggal_jam, '%Y-%m-%d') ORDER BY DATE_FORMAT(tanggal_jam, '%Y-%m-%d') DESC LIMIT 0, 7";
    $db->mysql_query($sql, $rec_count, $data);
    $db->mysql_close();
 
    $result = array("totalCount" => $rec_count, "topics" => $data);
    die(json_encode($result));
        
    //die('{"totalCount":15,"topics":[{"id":"1","kelompok":"0-4 Tahun","data1":"2195754","data2":"2071002"},{"id":"2","kelompok":"5-9 Tahun","data1":"2226002","data2":"2132743"},{"id":"3","kelompok":"10-14 Tahun","data1":"2051632","data2":"2136690"},{"id":"4","kelompok":"15-19 Tahun","data1":"2160940","data2":"2141832"},{"id":"5","kelompok":"20-24 Tahun","data1":"2087405","data2":"2097105"},{"id":"6","kelompok":"25-29 Tahun","data1":"2119261","data2":"2094588"},{"id":"7","kelompok":"30-34 Tahun","data1":"2123115","data2":"2183601"},{"id":"8","kelompok":"35-39 Tahun","data1":"2159645","data2":"2200882"},{"id":"9","kelompok":"40-44 Tahun","data1":"2148180","data2":"2100722"},{"id":"10","kelompok":"45-49 Tahun","data1":"2120041","data2":"2159996"},{"id":"11","kelompok":"50-54 Tahun","data1":"2156659","data2":"2221397"},{"id":"12","kelompok":"55-59 Tahun","data1":"2132072","data2":"2166654"},{"id":"13","kelompok":"60-64 Tahun","data1":"2148874","data2":"2171255"},{"id":"14","kelompok":"65-69 Tahun","data1":"2117835","data2":"2106718"},{"id":"15","kelompok":"70+ Tahun","data1":"2245391","data2":"2054712"}]}');