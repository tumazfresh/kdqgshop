<?php
include('../dbconn.php');
if(isset($_REQUEST['updateproduct']))
{
    $id=mysqli_real_escape_string($db,$_REQUEST['id']); 
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
    
    $getData=mysqli_query($db,"SELECT * FROM `tb_product` WHERE `id`='$id'"); 
    $rowCount=mysqli_fetch_assoc($getData); 
    
    if($image_01 == null)
    {
        $image_01 = $rowCount["image_01"]; 
    global $image_01;

}
 
 if($image_02 == null)
    {
        $image_02 = $rowCount["image_02"]; 
    global $image_02;
}

 if($image_03 == null)
    {
        $image_03 = $rowCount["image_03"]; 
    global $image_03;
}
    $targetfa = "../uploaded_img/".basename($image_01); 
    $targetfea = "../uploaded_img/".basename($image_02);
    $targetfca = "../uploaded_img/".basename($image_03); 
    
    
    //     $query=mysqli_query($db,"UPDATE `tb_product` SET `brand`='$brand' ,`category`='$category',`subcategory`='$subcategory',`product_desc`='$product_desc',`color`='$color',`product_name`='$product_name',`image_01`='$image_01',`image_02`='$image_02',`image_03`='$image_03',`memory`='$memory',`Stock`='$Stock',`Price`='$Price',`Status`='$Status',`Branch`='$Branch' WHERE `id`=$id");
    
       

    // $_SESSION['successMsg']="Product Successfully Updated!";
     $sql = $dba->prepare("UPDATE tb_product SET brand =?,  category =?,  subcategory =?,  product_desc =?,  product_name =?,  image_01 =?,  image_02 =?,  image_03 =?,  Stock =?,  Price =?,  Status =?,  Branch =?,  color =?,  memory =? WHERE ID =? ");
    $sql->bind_param("ssssssssssssssi", $brand,$category,$subcategory,$product_desc,$product_name,$image_01,$image_02,$image_03,$Stock,$Price,$Status,$Branch, $color, $memory, $id);
    if ($sql->execute() === TRUE )
    {
    $_SESSION['successMsg']="Product Successfully Updated!";
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


?>