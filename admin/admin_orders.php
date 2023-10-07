<?php
include("../dbconn.php"); 

try {
    $query = "SELECT COUNT(*) as orderCount FROM tb_order WHERE Branch IS NULL"; 
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo $result['orderCount'];
    } else {
        echo "0";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
