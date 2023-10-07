<?php
include("dbconn.php"); 

session_start();
if (!isset($_SESSION['id'])) {
    // Handle the case where the user is not logged in
    echo "0"; 
    exit();
}

$id = $_SESSION['id']; 

try {
    $query = "SELECT COUNT(*) as productCount FROM tb_product WHERE id = :id"; 
    $statement = $conn->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_INT); 
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo $result['productCount'];
    } else {
        echo "0";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
