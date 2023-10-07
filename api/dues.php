<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
include_once 'db.php'; // Include the database connection script.

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user'])) {
    $username = $_GET['user'];

    // Replace 'users' with your actual database table name and adjust the SQL query accordingly.
    $sql = "SELECT id, dueuser, duesgrade, duesamount, userid, transid, status, expiredate, paiddate	
     FROM `dues` WHERE `userid`=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username); // Use "s" for string parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $userData = $result->fetch_assoc();
        echo json_encode($userData);
    } else {
        echo json_encode(['error' => 'User not found']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>
