<?php
session_start();  
$servername = "localhost";
$username = "eiomraco_ssap";
$password = "Tumaz@1995";
$database = "eiomraco_ssap";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>