<?php
include('dbconn.php');
if (!isset($_SESSION['id'])) {
    $_SESSION['errorMsg']="Sorry, Can't Access the page";
    header('Location: login.php');
}

include('header.php');
$userId=$_SESSION['id'];
$getdata=mysqli_query($db,"SELECT * FROM `tb_customer` WHERE `custid`='$userId' ");
$rrw=mysqli_fetch_assoc($getdata);

?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="css/cart_design.css">
<div class="container text-center" style="padding-bottom:50px;"> 
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
    <div class="col"><?php include('billing.php'); ?></div> 
  </div>
</div>

 
<?php
include('footer.php');
?>