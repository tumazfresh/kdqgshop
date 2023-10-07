<div class="container text-center" style="padding-top:50px;padding-bottom:50px;">
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
    <div class="col" >
          <h1> Checkout Out</h1> 
    </div> 
  </div>
</div>
 
<form action="process_payment.php" method="post">
    
<div class="container text-center" style="padding-bottom:50px;"> 
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
    <div class="col text-start">
        <!-- user details --> 
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1" style="font-weight:700;"> 
  <div class="col text-center" style="font-weight:400;"><h1>User Details</h1></div>
  <div class="col">
              <label for="name">Full Name:</label>
              <input class="form-control alert-info" type="text" name="name" required value="<?= $rrw['name']; ?>">
            <br/></div>

            <div class="col">
              <label for="email">Email:</label>
              <input class="form-control alert-info" type="email" name="email" value="<?= $rrw['email']; ?>">
              <br/></div>

            <div class="col">
              <label for="phonenumber">Phone Number:</label>
              <input class="form-control alert-info" type="text" name="number" required  value="<?= $rrw['phone']; ?>">
              <br/></div>

            <div class="col">
              <label for="address">House No.:</label>
              <input class="form-control alert-info" type="text" name="houseno" required value="<?= $rrw['house_number']; ?>">
              <br/></div>
            <div class="col">
              <label for="address">Street:</label>
              <input class="form-control alert-info" type="text" name="street" required value="<?= $rrw['street']; ?>">
              <br/></div>
            <div class="col">
              <label for="address">Barangay:</label>
              <input class="form-control alert-info" type="text" name="barangay" required value="<?= $rrw['barangay']; ?>">
              <br/></div>
            <div class="col">
              <label for="address">City:</label>
              <input class="form-control alert-info" type="text" name="city" required value="<?= $rrw['city']; ?>">
              <br/></div>
            <div class="col">
              <label for="zipcode">Zip Code:</label>
              <input class="form-control alert-info" type="text" name="zipcode" required value="<?= $rrw['zip_code']; ?>">
              <br/></div>
        
</div>
</div>
<!-- user details -->


<!-- Cart details -->

<div class="col"> 
    <div class="container text-center" style="padding-bottom:20px;">
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
    <div class="col" >
          <h1>Order Summary</h1>
        
    </div> 
  </div>
</div>

<!-- cart continues -->

<div class="container text-center" >
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1"> 
    <div class="col"> 

    <div class="table-responsive">   
    <table class="cart-items">
            <tr>
                <th>Item</th>
                <th>Price</th>  
            </tr>
<?php
if (!empty($_SESSION['tcart']))
{ 
    $total = 0;
    foreach ($_SESSION['tcart'] as $productID => $quantity)
    { 
        $result = $dba->query("SELECT * FROM tb_product WHERE id='$productID' ");
        $product = $result->fetch_assoc();
        
        
        if(isset($_SESSION['tcart'][$productID]['quantity']))
        {
            $quantity = $_SESSION['tcart'][$productID]['quantity'];
        }
        else
        {
            $quantity = 1;
        }
        
        $subtotal = $product['Price'] * $quantity;
        $total += $subtotal;
        echo "<div class='product'> 
         <tr>
                        
                        <td>
                                    <img src='uploaded_img/{$product['image_01']}' alt='' style='width:75px;height:75px;'>
                                    <br><b>{$product['product_name']}</b>
                        </td>

                        <td class='item-price'>{$product['Price']} X {$quantity} = {$subtotal}</td> 
                        </tr>
                    </div>";
         } 
}

else
{
    echo "<p> Your cart is empty!</p>";
}
?>
</table>
</div>
            </div>
            
    <div class='col text-end'><br/><b> <h4>Total: ₱<?php echo $total; ?></h4></b><br/> </div>
 
    <div class="col text-start" >
          <h5><i class="fas fa-credit-card"></i> Payment Method</h5> 
    </div> 
    <div class="col text-start"><br/> 
            <img src="img/bdo.jpg" alt="Credit Card" style='width:35px;height:35px;'> &nbsp;&nbsp;
            <img src="img/bpi.jpg" alt="Credit Card" style='width:35px;height:35px;'> &nbsp;&nbsp;
            <img src="img/cod.jpg" alt="Cash on Delivery" style='width:35px;height:35px;'> &nbsp;&nbsp;
            <img src="img/gcash.jpg" alt="GCash" style='width:35px;height:35px;'>&nbsp;&nbsp; 
            <img src="img/maya.jpg" alt="PayMaya" style='width:35px;height:35px;'> &nbsp;&nbsp;
</div>

  <div class="col text-start"><br/> 
  <div class="form-check">
        <input class="form-check-input" type="radio" name="Payment" id="Cash" value="Cash">
        <label class="form-check-label" for="Cash">
            <i class="fas fa-truck"></i> Cash On Delivery
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="Payment" id="Online" value="Online" checked>
        <label class="form-check-label" for="Online">
            <i class="fas fa-credit-card"></i> Online Payment
        </label>
    </div>

</div>

         
  </div>
</div> 


<!-- cart ends -->

  
 
   


<br/>
    <button type="submit" class="btn btn-danger">PROCEED</button>
</form>
</div>
</div>   </div> 