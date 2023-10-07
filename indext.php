<div class="container text-center" style="background-color:#fff;">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
  
<?php
$products = $dba->query("SELECT * FROM tb_product WHERE `Status`='Active' ORDER BY id DESC LIMIT 12");
if($products->num_rows > 0)
{
    while ($pr = $products->fetch_assoc())
    { 
    ?>
       <div class="col" style="padding-top:40px;padding-bottom:40px;">
       <a href="product_view.php?pid=<?php echo $pr['id'];?>" style="text-decoration:none;">
       <div class="card" style="width: 18rem;background-color:#f5f2f4;border-color:transparent;">
           <?php echo "<img src='./uploaded_img/".$pr['image_01']."'  class='card-img-top'>"; ?>
  <div class="card-body">
    <h5 class="card-title"><?php echo $pr['product_name']; ?></h5>
    <p class="card-text">
        
        <div class="container text-center">
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
    <div class="col"><h2>₱<?php echo $pr['Price']; ?></h2></div>
    <div class="col"><?php echo  substr($pr['product_desc'], 0, 100); ?></div>
    <div class="col" style="color:red;"><br/><i><h6><?php echo $pr['Stock']; ?> Pieces Available</i></h6></div>
    </a>
    <div class="col" style="font-size:12px; color:#72797e; padding-top:20px; padding-bottom:30px;"> 
  <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2">
    <div class="col">Add to Wishlist</div>
    <div class="col add-to-car" data-id="<?php echo $pr['id']; ?>">Add to Cart</div> 
  </div> 
</div>
  </div>
</div>

  </div>
</div>
</div>
    <?php
    }
}
?>

  </div>
</div>
<br/><br/>
<div class="container text-center">
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
    <div class="col"><h2>View All</h2></div>  
  </div>
</div>
 
<br/><br/>

