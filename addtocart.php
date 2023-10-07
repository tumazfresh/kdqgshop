<?php
session_start();
include('dbconn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $id = $_POST['id'];
    $result = $dba->query("SELECT * FROM tb_product WHERE id='$id' ");
    $row = $result->fetch_assoc();
    if($row)
    {
        if(isset($_SESSION['tcart'][$id]))
        {
            $_SESSION['tcart'][$id]['quantity'] += 1;
        }
        else
        {
            $row['quantity'] = 1;
            $row['img'] = $row['image_01']; // Fetch 'image_01' value
            $_SESSION['tcart'][$id] = $row;
        }
    }
}
?>
