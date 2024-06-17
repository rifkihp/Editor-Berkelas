<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect(true);
    
    $_limit      = 10;
    $query       = mysql_escape_string(isset($_POST["query"])?$_POST["query"]:"");
    
    $sql = "SELECT A.id, CONCAT(A.first_name, ' ', A.last_name) AS nama, A.email FROM member AS A WHERE 1 " . (strlen($query)>0?" AND (CONCAT(A.first_name, ' ', A.last_name) LIKE '%$query%' OR A.email LIKE '%$query%')":"");
    $db->mysql_query($sql, $rs_num, $rs);
    
    $data[count($data)] = array(
        "display" => "Tamu",
        "value" => "Tamu",
        "data" => array("id" =>0, "nama" => "Tamu", "email" => "")
    );
    foreach($rs as $key => $value) {
        $data[count($data)] = array(
            "display" => $value["nama"] . " (" . $value["email"] .")",
            "value" => $value["nama"],
            "data" => $value
        ); 
    }
    
    $db->mysql_close();
    die(json_encode($data));