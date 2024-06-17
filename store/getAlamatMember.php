<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect(true);
    
    $_limit = 10;
    $query = mysql_escape_string(isset($_POST["query"])?$_POST["query"]:"");
    
    $data_alamat = $db->getFieldValue("customer_address", array("*"), array("id_member" => $_POST["id"]), array(), $_limit, 0, "", (strlen($query)>0?" nama LIKE '%$query%' ":""));
    foreach($data_alamat as $key => $value) {
        $data[$key] = array(
            "display" => $value["nama"],
            "value" => $value["nama"],
            "data" => $value
        ); 
    }
    
    $db->mysql_close();
    die(json_encode($data));
    
    //die(json_encode(array("alamat" => $data_alamat)));