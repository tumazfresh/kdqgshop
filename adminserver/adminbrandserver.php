<?php
include('../dbconn.php');
if(isset($_REQUEST['addproduct']))
{

    $brand=mysqli_real_escape_string($db,$_REQUEST['brand']);
    
    $sql = $dba->prepare("INSERT INTO tb_brand (brandname) VALUES (?)");
    $sql->bind_param("s",$brand);
    if ($sql->execute() === TRUE )
    {
    $_SESSION['successMsg']="Brand Successfully Published!";
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
 $dba->close();

?>