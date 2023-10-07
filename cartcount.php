<?php
include 'dbconn.php';

if(isset($_SESSION['tcart'])){
    $itemCount = count($_SESSION['tcart']);
} else {
    $itemCount = 0;
}

echo $itemCount;
?>
