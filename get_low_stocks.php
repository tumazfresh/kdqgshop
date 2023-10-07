<?php
include("dbconn.php"); 

if (!isset($_SESSION['branch'])) {
    // Handle the case where the branch is not set in the session
    echo "0"; 
    exit();
}

$branch = $_SESSION['branch']; 
$lowStockThreshold = 3; 

try {
    $query = "SELECT COUNT(*) as lowStockCount FROM tb_product WHERE branch = :branch AND stock <= :threshold";
    $statement = $conn->prepare($query);
    $statement->bindParam(':branch', $branch, PDO::PARAM_STR);
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
