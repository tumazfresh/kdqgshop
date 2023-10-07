<?php
include("../dbconn.php"); 

try {
    $query = "SELECT SUM(stock) AS accessoryCategoryCount FROM tb_product WHERE category = 'Accessories';"; 
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo $result['accessoryCategoryCount'];
    } else {
        echo "0"; 
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
