<?php
include('../dbconn.php');
if(isset($_REQUEST['updateproduct']))
{
    $id=mysqli_real_escape_string($db,$_REQUEST['id']);
    $brand=mysqli_real_escape_string($db,$_REQUEST['brand_name']);
    
    
    $getData=mysqli_query($db,"SELECT * FROM `tb_brand` WHERE `id`='$id'"); 
    $rowCount=mysqli_fetch_assoc($getData); 
    

       

    // $_SESSION['successMsg']="Product Successfully Updated!";
     $sql = $dba->prepare("UPDATE tb_brand SET brandname =? WHERE id = ?");
    $sql->bind_param("ss", $brand, $id);
    if ($sql->execute() === TRUE )
    {
    $_SESSION['successMsg']="Product Successfully Updated!";
    }
    else
    { 
    }
}  

else
{
    $_SESSION['errorMsg']="Please submit the form";
}
header('location:../admin/admin_brands.php');


?>