<?php
include('dbconn.php');
include('./header.php');
include('./mainpage/header.php');
$pid=$_GET["pid"];
$getData=mysqli_query($db, "SELECT * FROM tb_product WHERE `id`='$pid' ");
$row=mysqli_fetch_assoc($getData);
include('./mainpage/prdview.php');
?>






    <?php include 'deals.php';
  include 'slide.php';
  include 'footer.php'; ?>