<?php
include('../dbconn.php');
if(isset($_REQUEST['updateproduct']))
{
    $id=mysqli_real_escape_string($db,$_REQUEST['id']);
    $category=mysqli_real_escape_string($db,$_REQUEST['category_name']);
    
    
    $getData=mysqli_query($db,"SELECT * FROM `tb_category` WHERE `id`='$id'"); 
    $rowCount=mysqli_fetch_assoc($getData); 
    

       

    // $_SESSION['successMsg']="Product Successfully Updated!";
     $sql = $dba->prepare("UPDATE tb_category SET catename =? WHERE id = ?");
    $sql->bind_param("ss", $category, $id);
    if ($sql->execute() === TRUE )
    {
    $_SESSION['successMsg']="Category Successfully Updated!";
    }
    else
    { 
    }
}  

else
{
    $_SESSION['errorMsg']="Please submit the form";
}
header('location:../admin/admin_category.php');


?>