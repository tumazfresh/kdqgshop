<?php
include('dbconn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
        $_SESSION['tcart'][$id]['quantity'] = $quantity;
       
}
?>