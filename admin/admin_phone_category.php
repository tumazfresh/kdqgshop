<?php
include("../dbconn.php"); 

try {
    $query = "SELECT SUM(stock) AS phoneCategoryCount FROM tb_product WHERE category = 'Smartphone';"; 
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo $result['phoneCategoryCount'];
    } else {
        echo "0"; 
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
