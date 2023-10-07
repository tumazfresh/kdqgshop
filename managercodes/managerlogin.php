<?php
include("dbconn.php");

if (isset($_SESSION['id'])) {
    $branch = $_SESSION['branch'];
    //echo $branch;
} else {
    header('store_manager_login.php');
}
$message = [];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$managerCredentials = array(
    'manager1@gmail.com' => array('password' => 'managerbranch1', 'branch' => 'Munoz'),
    'manager2@gmail.com' => array('password' => 'managerbranch2', 'branch' => 'Cubao'),
    'manager3@gmail.com' => array('password' => 'managerbranch3', 'branch' => 'QuezonCity'),
    'manager4@gmail.com' => array('password' => 'managerbranch4', 'branch' => 'Glorietta'),
    'manager5@gmail.com' => array('password' => 'managerbranch5', 'branch' => 'SMMegamall'),
    'manager6@gmail.com' => array('password' => 'managerbranch6', 'branch' => 'SMNorthAnnex'),
);

if (isset($_POST['submit'])) {
    $inputEmail = strtolower(trim($_POST['email']));
    $inputPassword = trim($_POST['password']);

    if (isset($managerCredentials[$inputEmail]) && $inputPassword === $managerCredentials[$inputEmail]) {

        // Set the login time and insert into the database
        $loginTime = date('Y-m-d H:i:s');
       

        header("location: store_manager_dashboard.php");
        exit();
    } else {
        $message['password'] = 'Invalid email or password. Please try again.';
    }
}

if (isset($_GET['logout']) && isset($_SESSION['id'])) {
    // Get the current time for logout
    $logoutTime = date('Y-m-d H:i:s');

    // Update the database with logout time and status
    $updateQuery = "UPDATE tb_manager SET logout_time = :logout_time, status = 'inactive' WHERE id = :id";
    $updateStatement = $conn->prepare($updateQuery);
    $updateStatement->bindValue(':logout_time', $logoutTime, PDO::PARAM_STR);
    $updateStatement->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
    $updateSuccess = $updateStatement->execute();

    if ($updateSuccess) {
        // Destroy the session
        session_destroy();

        // Redirect to login page
        header("location: store_manager_login.php");
        exit();
    } else {
        // Handle database update error
        // You might want to display an error message here
    }
}
?>