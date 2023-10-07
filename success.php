<?php
include('dbconn.php');
include('header.php');
?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="css/cart_design.css">

<div class="container text-center" style="padding-top:50px;padding-bottom:50px;">
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
    <div class="col" >
          <h1> Successful!</h1> 
    </div> 
  </div>
</div>
 

<div class="container text-center" style="padding-bottom:50px;"> 
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
     
    <div class="col"> 

    <div class="table-responsive">   
    <table class="cart-items">
            <tr>
                <th>Item</th>
                <th>Price</th> 
                <th>Subtotal</th> 
            </tr>

            

    <?php
    $trx=$_GET[ "id" ];
    
$getdata=mysqli_query($db,"SELECT * FROM `tb_order` WHERE `trx`='$trx' ");
$rrw=mysqli_fetch_assoc($getdata);
 $qresult = mysqli_query($db,"SELECT * FROM tb_order WHERE `trx`='$trx' ");
 if (mysqli_num_rows($qresult) > 0) {
 $i=0;
 while($qrow = mysqli_fetch_array($qresult)) {
?>
<tr>
        <td>
        <?php echo "<img src='./uploaded_img/".$qrow['picture_image']."' style='width:75px;height:75px;'>";?>
        <br><b><?php echo $qrow['product_name']; ?></b>
        </td>
        <td class='item-price'><?php echo $qrow['quantity']; ?></td> 
        <td class='item-price'><?php echo $qrow['total_price']; ?></td> 
        </tr>
        <?php  
$i++;
}
?>

</table>
</div>
            </div>
            
    <div class='col text-end'><br/><b> <h4>Total: ₱<?php echo $rrw['total_price']; ?></h4></b><br/> </div>
 
<?php
}
else{
echo "No Post Yet!!!";
}
?> 
</div>
</div>
</div>
</div>
 

<?php
include('footer.php');
?>