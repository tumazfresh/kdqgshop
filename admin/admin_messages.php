<?php
include("../dbconn.php"); 

try {
    $query = "SELECT COUNT(*) as messageCount FROM tb_feedback"; 
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo $result['messageCount'];
    } else {
        echo "0"; 
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
