<?php
include('../dbconn.php');
if(isset($_REQUEST['addproduct']))
{

    $type=mysqli_real_escape_string($db,$_REQUEST['type']);
    $header=mysqli_real_escape_string($db,$_REQUEST['header']); 
    $text=mysqli_real_escape_string($db,$_REQUEST['text']); 

    $image_01=$_FILES['image_01']['name'];

    
    $targetfa = "../uploaded_img/".basename($image_01); 
  
    
        // $query=mysqli_query($db,"INSERT into `tb_product` (`brand`,`category`,`subcategory`,`product_desc`,`product_name`,`image_01`,`image_02`,`image_03`,`Stock`,`Price`,`Status`,`Branch`,`color`,`memory` ) 
        // VALUES ('$brand','$category','$subcategory','$product_desc','$product_name','$image_01','$image_02','$image_03','$Stock','$Price','$Status','$Branch','$color',$memory' )");
    
       
    $sql = $dba->prepare("INSERT INTO tb_announcement (type, header, text, image) VALUES (?, ?, ?, ?)");
    $sql->bind_param("ssss", $type,$header,$text,$image_01);
    if ($sql->execute() === TRUE )
    {
    $_SESSION['successMsg']="Announcement Successfully Published!";
    }
    else
    { 
    }

        
    if (move_uploaded_file($_FILES['image_01']['tmp_name'], $targetfa)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    } 
   
}
else
{
    $_SESSION['errorMsg']="Please submit the form";
}
header('location:../admin/admin_announcement.php');
 $dba->close();

?>