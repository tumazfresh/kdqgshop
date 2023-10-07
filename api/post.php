<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the 'id' parameter is provided in the URL
    if (isset($_GET['id'])) {
        $postId = intval($_GET['id']); // Convert to integer to prevent SQL injection
        
        // Query the database to retrieve the post with the specified ID
        $sql = "SELECT * FROM blog WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $post = $result->fetch_assoc();
            echo json_encode($post);
        } else {
            echo json_encode(['error' => 'Post not found']);
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Invalid request']);
    }
}

$conn->close();
?>
