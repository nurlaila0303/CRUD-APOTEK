<?php

$dbserver = 'localhost';
$dbname = 'uaspweb2022';
$dbusername = 'root';
$dbpassword = '';
$message = '';
$dsn = "mysql:host={$dbserver};dbname={$dbname}";

$connection = null;

try {
    $connection = new PDO($dsn, $dbusername, $dbpassword);

            return $connection;
        }catch (PDOException $e){
            echo "ERROR : " .$e->getMessage();
        }

?>
   
