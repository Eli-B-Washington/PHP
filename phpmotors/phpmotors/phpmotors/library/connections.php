<?php
//connection

function phpmotorsConnect(){
    $server = 'localhost';
    $dbname= 'phpmotors';
    $username = 'iClient';
    $password = ""; 
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
   
    // Create the actual connection object and assign it to a variable
    try {
     $link = new PDO($dsn, $username, $password, $options);
     
     return $link;
    } catch(PDOException $e) {
     header('Location: /enhancement_1/views/500.php');
     //echo "Hey I can't Connect!";
     exit;
    }
   }
   phpmotorsConnect();
?>