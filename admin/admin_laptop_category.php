<?php
include("../dbconn.php"); 

try {
    $query = "SELECT SUM(stock) AS laptopCategoryCount FROM tb_product WHERE category = 'Laptop'"; 
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        //echo "testing if working";
        echo $result['laptopCategoryCount'];
    } else {
        echo "0"; 
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
