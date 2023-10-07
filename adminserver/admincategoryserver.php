<?php
include('../dbconn.php');
if(isset($_REQUEST['addproduct']))
{

    $category=mysqli_real_escape_string($db,$_REQUEST['category']);
    
    $sql = $dba->prepare("INSERT INTO tb_category (catename) VALUES (?)");
    $sql->bind_param("s",$category);
    if ($sql->execute() === TRUE )
    {
    $_SESSION['successMsg']="Category Successfully Published!";
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
 $dba->close();

?>