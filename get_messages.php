<?php
include("dbconn.php"); 


if (!isset($_SESSION['branch'])) {
    // Handle the case where the branch is not set in the session
    echo "0"; 
    exit();
}

$branch = $_SESSION['branch']; 

try {
    $query = "SELECT COUNT(*) as messageCount FROM tb_feedback WHERE branch IS NULL";
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
