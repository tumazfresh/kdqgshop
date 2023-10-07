<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
session_start();

if (isset($_SESSION['userLoggedIn']) && $_SESSION['userLoggedIn'] === true) {
    echo json_encode(['loggedIn' => true, 'userId' => $_SESSION['userId']]);
} else {
    echo json_encode(['loggedIn' => false]);
}

?>
