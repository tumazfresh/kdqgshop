<?php
include('../dbconn.php');
if(isset($_REQUEST['addproduct']))
{

    $brand=mysqli_real_escape_string($db,$_REQUEST['brand']);
    $category=mysqli_real_escape_string($db,$_REQUEST['category']); 
    $subcategory=mysqli_real_escape_string($db,$_REQUEST['subcategory']); 
    $product_name=mysqli_real_escape_string($db,$_REQUEST['product_name']);
    $product_desc=mysqli_real_escape_string($db,$_REQUEST['product_desc']);
    $color=serialize($_POST['color']);
    $memory=serialize($_POST['memory']);
    $Stock=mysqli_real_escape_string($db,$_REQUEST['Stock']);
    $Price=mysqli_real_escape_string($db,$_REQUEST['Price']);
    $Status=mysqli_real_escape_string($db,$_REQUEST['Status']);
    $Branch=mysqli_real_escape_string($db,$_REQUEST['branch']);
    $image_01=$_FILES['image_01']['name'];
    $image_02=$_FILES['image_02']['name'];
    $image_03=$_FILES['image_03']['name']; 
    
    $targetfa = "../uploaded_img/".basename($image_01); 
    $targetfea = "../uploaded_img/".basename($image_02);
    $targetfca = "../uploaded_img/".basename($image_03);  
    
        // $query=mysqli_query($db,"INSERT into `tb_product` (`brand`,`category`,`subcategory`,`product_desc`,`product_name`,`image_01`,`image_02`,`image_03`,`Stock`,`Price`,`Status`,`Branch`,`color`,`memory` ) 
        // VALUES ('$brand','$category','$subcategory','$product_desc','$product_name','$image_01','$image_02','$image_03','$Stock','$Price','$Status','$Branch','$color',$memory' )");
    
       
    $sql = $dba->prepare("INSERT INTO tb_product (brand, category, subcategory, product_desc, product_name, image_01, image_02, image_03, Stock, Price, Status, Branch, color, memory) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssssssssssss", $brand,$category,$subcategory,$product_desc,$product_name,$image_01,$image_02,$image_03,$Stock,$Price,$Status,$Branch, $color, $memory);
    if ($sql->execute() === TRUE )
    {
    $_SESSION['successMsg']="Product Successfully Published!";
    }
    else
    { 
    }

        
    if (move_uploaded_file($_FILES['image_01']['tmp_name'], $targetfa)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    } 
   
    if (move_uploaded_file($_FILES['image_02']['tmp_name'], $targetfea)) {
        $emsg = "Image uploaded successfully";
    }else{
        $emsg = "Failed to upload image";
    }
    
     if (move_uploaded_file($_FILES['image_03']['tmp_name'], $targetfca)) {
        $mwsg = "Image uploaded successfully";
    }else{
        $mwsg = "Failed to upload image";
    }
}
else
{
    $_SESSION['errorMsg']="Please submit the form";
}
header('location:../admin/admin_products.php');
 $dba->close();

?>