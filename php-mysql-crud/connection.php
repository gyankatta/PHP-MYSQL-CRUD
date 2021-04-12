<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'gyankatta';

try{
    $connect = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $username, $password);

date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d");

} catch(PDOException $e){
    die( "Connection failed: " . $e->getMessage());
}

?>