<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect(true);
    
    $_limit      = 10;
    $query       = mysql_escape_string(isset($_POST["query"])?$_POST["query"]:"");
    
    $sql = "SELECT * FROM customer_address AS A WHERE A.id_member='".$_SESSION[CLIENT_SESSION_NAME]["user"]["id"]."' ".(strlen($query)>0?" AND A.nama_alamat LIKE '%$query%'":"");
    $db->mysql_query($sql, $rs_num, $rs);
    $data = array();
    foreach($rs as $key => $value) {
        $data[$key] = array(
            "display" => $value["nama_alamat"],
            "value" => $value["nama_alamat"],
            "data" => $value
        ); 
    }
    
    $db->mysql_close();
    die(json_encode($data));