<?php
    // define (DB_USER, "admin");
    // define (DB_PASSWORD, "simpan03");
    // define (DB_DATABASE, "db_tweet");
    // define (DB_HOST, "db-tweet.cr00p4kudq0x.ap-southeast-1.rds.amazonaws.com");
    
    
    $mysqli = new mysqli("db-tweet.cr00p4kudq0x.ap-southeast-1.rds.amazonaws.com", 
                        "admin", "simpan03","db_tweet");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    // echo "Connected successfully";
                        
?>