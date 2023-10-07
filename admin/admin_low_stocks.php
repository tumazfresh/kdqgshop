<?php
include("../dbconn.php"); 

try {
    $lowStockThreshold = 3; 

    $query = "SELECT COUNT(*) as lowStockCount FROM tb_product WHERE stock <= :threshold";
    
    $statement = $conn->prepare($query);
    $statement->bindParam(':threshold', $lowStockThreshold, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo $result['lowStockCount'];
    } else {
        echo "0"; 
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
