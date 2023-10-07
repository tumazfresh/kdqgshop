<?php
include('dbconn.php');
include('header.php');
?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="css/cart_design.css">
<div class="container text-center" style="padding-top:40px;padding-bottom:40px;">
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
    <div class="col"> <h1><i class="fas fa-shopping-cart"></i> My Shopping Cart</h1></div>
    <div class="col">
        
    <div class="table-responsive">  
    <table class="cart-items">
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Actions</th>
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
                            <div class='cart-item-details'>
                                <div class='cart-item-image'>
                                    <img src='uploaded_img/{$product['image_01']}' alt=''>
                                </div>
                            </div>
                            <div class='cart-item-name'>{$product['product_name']}</div>
                        </td>

                        <td class='item-price'>{$product['Price']}</td>
                        <td>
                            <input type='number' class='quantity' value='$quantity' data-id='$productID' min='1'> 
                        </td>

                        <td class='item-total'>{$subtotal}</td>
                        <td>
                            <div class='item-actions'>
                                <button type='submit' class='wishlist-button'><i
                                            class='fas fa-heart'></i> Add to Wishlist
                                </button> 
                                <button type='submit' class='remove-button' ><i
                                            class='fas fa-trash'></i> Remove
                                </button>
                            </div>
                        </td>
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
            
    <div class='col text-end'><b> Subtotal: ₱<?php echo $total; ?></b><br/>
         <a href='checkoutt.php' class='mlink'>
         <button class='checkout-button' type='submit'>Checkout</button>
         </a> </div>
         
  </div>
</div>
<?php
include('footer.php');
?>

 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
<script>
    $(document).ready(function()
    {
        $('.quantity').click(function()
        {
            var productID = $(this).data('id');
            var newQuantity = $(this).val();
             $.post('updatecart.php', {id: productID, quantity: newQuantity}, function()
             {
                 location.reload();
             });
        });
    });
</script>

<?php
include('footer.php');
?>