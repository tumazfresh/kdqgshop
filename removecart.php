<?php
include('dbconn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $id = $_POST['id'];
    if(isset($_SESSION['tcart'][$id]))
    {
        unset($_SESSION['tcart'][$id]);
        echo "removed";
    }
    else
    {
        echo "not found";
    }
        
       
}
?>