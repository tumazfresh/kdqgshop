<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$server = "localhost";
$username = "root";
$password = "";
$database = "ecommerce_db";

try {
    $conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$serverName="localhost";
$userName="root";
$dbPassword="";
$dbName="ecommerce_db";
$db=mysqli_connect($serverName,$userName,$dbPassword,$dbName);
if(!$db)
{
    die("Connection Failed".mysqli_connect_error());
}
    
$serverNamea="localhost";
$userNamea="root";
$dbPassworda="";
$dbNamea="ecommerce_db";
$dba = new mysqli($serverNamea,$userNamea,$dbPassworda,$dbNamea);

?>