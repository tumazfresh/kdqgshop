<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
include_once 'db.php'; // Include the database connection script.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required data is present in the POST request.
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Hash the password as you did during registration.

        // Check if the user exists in the database.
        $sql = "SELECT id, email, username, phone FROM `users` WHERE `username`=? AND `password`=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // User login successful. Fetch user data.
            $userData = $result->fetch_assoc();
            $_SESSION['userLoggedIn'] = true;
            $_SESSION['userId'] = $userData['id'];
            echo json_encode(['message' => 'Login successful', 'loggedIn' => true]);
        } else {
            echo json_encode(['error' => 'Invalid username or password']);
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Invalid data']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>
