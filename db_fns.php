<?php
    function db_connect(){
        require 'dbInfo_fns.php';
        $db = new mysqli($dbhost, $dbuser, $dbpassword, $dbdatabase);
        if(!$db){
            throw new Exception("Could not connect to database");
            return false;
        }
        return $db;
    }
?>
