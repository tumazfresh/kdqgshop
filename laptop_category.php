<?php
include("dbconn.php");


if (!isset($_SESSION['branch'])) {
    // Handle the case where the branch is not set in the session
    echo "0";
    exit();
}

$branch = $_SESSION['branch'];

try {
    $query = "SELECT COUNT(*) as laptopCategoryCount FROM tb_product WHERE branch = :branch AND category = 'Laptop'";
    $statement = $conn->prepare($query);
    $statement->bindParam(':branch', $branch, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo $result['laptopCategoryCount'];
    } else {
        echo "0";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
