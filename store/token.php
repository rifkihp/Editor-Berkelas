<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/MCrypt.php";
    
    function generateCode($characters) {
        /* list all possible characters, similar looking characters and vowels have been removed */
        $possible = '23456789bcdfhkmnrstvwx';
        $code = '';
        $i = 0;
        while ($i < $characters) {
                $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
                $i++;
        }
        return $code;
    }

    
    $_SESSION['security_code'] = generateCode(9);
    
    $mcrypt = new MCrypt();
    
    die(json_encode(array("security_code" => $mcrypt->encrypt($_SESSION['security_code'])) ));