<?php
require 'dbconn.php';

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

$servername = "srv1041.hstgr.io";
$username = "u629283545_kdqg_ecommerce";
$password = "iTech1234_kdqg";
$dbname = "u629283545_ecommerce_db";

    // Create a PDO connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Prepare and execute the SQL query using placeholders
    $query = "UPDATE tb_customer SET name=:name, email=:email, phone=:phone, address=:address WHERE custid=:user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $res = [
            'status' => 200,
            'message' => 'Profile Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Profile Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}
?>