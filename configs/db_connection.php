<?php
    session_start();

    // MySQL
    // $host 	= 'localhost'; 
    $host 	= '192.168.100.59'; 
    $user 	= 'root'; 
    $pass 	= '';
    $dbname = 'db_php_web_dev';
    $conn = mysqli_connect($host, $user, $pass, $dbname);

    // MongoDB 
    require 'vendor/autoload.php';
    $client = new MongoDB\Client("mongodb://192.168.100.59:27017");
    $collection = $client->db_php_web_dev->files;
?>