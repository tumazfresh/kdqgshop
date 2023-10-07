<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
include_once 'db.php'; // Include the database connection script.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required data is present in the POST request.
    if (isset($_POST['username']) && isset($_POST['email'])) {
        $username = $_POST['username'];        
        $walletid = md5($username); // Generate walletid based on username
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = md5($_POST['password']);
        $dob = $_POST['dob']; 

        // Check for existing records
        $getDataa = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`='$username'");
        $getData = mysqli_query($conn, "SELECT * FROM `users` WHERE `email`='$email'");
        $getDatea = mysqli_query($conn, "SELECT * FROM `users` WHERE `phone`='$phone'");
        $rowCount = mysqli_num_rows($getData);
        $rowCounta = mysqli_num_rows($getDataa);
        $rowCountea = mysqli_num_rows($getDatea);

        if ($rowCount != 0) {
            echo json_encode(['error' => 'Username already exists']);
        } 
        elseif ($rowCounta != 0) {
            echo json_encode(['error' => 'Email already exists']);
        } 
        else {
            // Insert the new record into the "users" table.
            $sql = "INSERT INTO users (username, email, phone, password, dob, walletid) VALUES (?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $username, $email, $phone, $password, $dob, $walletid);
            
            if ($stmt->execute()) {
                echo json_encode(['message' => 'Record created successfully']);
            } else {
                echo json_encode(['error' => 'Failed to create record']);
            }
            
            $stmt->close();
        }
    } else {
        echo json_encode(['error' => 'Invalid data']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>
