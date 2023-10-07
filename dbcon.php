<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$server = "srv1041.hstgr.io";
$username = "u629283545_kdqg_ecommerce";
$password = "iTech1234_kdqg";
$database = "u629283545_ecommerce_db";

$con = mysqli_connect($server, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
