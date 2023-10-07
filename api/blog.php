<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type"); 
header('Content-Type: application/json');  
$servername = "localhost";
$username = "eiomraco_ssap";
$password = "Tumaz@1995";
$database = "eiomraco_ssap"; 
$conn = new mysqli($servername, $username, $password, $database); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
$sql = "SELECT * FROM post";

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
    echo json_encode($row) ;
}  

$conn->close();
?>
