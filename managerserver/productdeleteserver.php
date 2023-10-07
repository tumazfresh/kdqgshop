<?php
include('../dbconn.php');
if(isset($_REQUEST['deleteproduct']))
{
    $id=mysqli_real_escape_string($db,$_REQUEST['id']); 
    
        $query=mysqli_query($db,"DELETE FROM `tb_product` WHERE `id`='$id' ");
    
       

    $_SESSION['successMsg']="Product Successfully Deleted!"; 
}
else
{
    $_SESSION['errorMsg']="Something went wrong!";
}
header('location:../store_manager_productstest.php');


?>