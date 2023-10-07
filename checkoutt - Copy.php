<?php
include('dbconn.php');
include('header.php');

if (!empty($_SESSION['tcart']))
{
    echo "<h2>Shopping Cart</h2>";
    $cartData = $_SESSION['tcart'];
    $cartArray = array();
    $total_price = 0;
    foreach ($cartData as $productID => $product)
    {
        $cartArray[] = array(
            'product_id' => $productID,
            'quantity' => $product['quantity']
            );
            $result = $dba->query("SELECT * FROM tb_product WHERE id='$productID' ");
            $row = $result->fetch_assoc();
            $total_price += $row['Price'] * $product['quantity'];
    }
    $stmt = $dba->prepare("INSERT INTO tb_order (pid, quantity, total_price) VALUES (?, ?, ?)");
    
    
    foreach ($cartArray as $item)
    {
       $stmt->bind_param("iid", $item['product_id'], $item['quantity'], $total_price);
        $stmt->execute();
    }
    $stmt->close();
    // unset($_SESSION['tcart']);
    echo "<p> Total Price: P$total_price</p>";
}
else
{
    echo "<p> Your cart is empty!</p>";
}

include('footer.php');
?>