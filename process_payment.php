<?php
include('dbconn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paymentMethod = $_POST["Payment"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $houseno = $_POST["houseno"];
    $street = $_POST["street"];
    $barangay = $_POST["barangay"];
    $city = $_POST["city"];
    $zipcode = $_POST["zipcode"]; 
    $userid = $_SESSION['id'];
    $payment_method = "Cash On Delivery";
    $rand = mt_rand(0, 31);
    $code = md5($rand . date('YmdHi'));
    $codes = md5($code .rand());  
    $transid = $codes;
    if ($paymentMethod === "Cash") {

        $cartData = $_SESSION['tcart'];
        $cartArray = array();
        $total_price = 0;
        foreach ($cartData as $productID => $product)
        {
            $cartArray[] = array(
                'product_id' => $productID,
                'quantity' => $product['quantity'],
                'img' => $product['img'],
                'product_name' => $product['product_name'],
                );
                $result = $dba->query("SELECT * FROM tb_product WHERE id='$productID' ");
                $row = $result->fetch_assoc();
                $total_price += $row['Price'] * $product['quantity']; 
        }
        $stmt = $dba->prepare("INSERT INTO tb_order (user_id, pid, name, number, email, houseno, street, barangay, city, zipcode, product_name, quantity, total_price, payment_method, picture_image, trx) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        
        foreach ($cartArray as $item)
        {
            $stmt->bind_param("iisssssssssidsss", $userid, $item['product_id'], $name, $number, $email, $houseno, $street, $barangay, $city, $zipcode, $item['product_name'],$item['quantity'], $total_price, $payment_method, $item['img'], $transid);
                $stmt->execute();
        }
        $stmt->close();
        $wa="Location: success.php?id=";
        $qw=$wa.$transid;
        header($qw);
        exit();
    } else if ($paymentMethod === "Online") {
        header("Location: online.php");
        exit();
    }
    else
    {
        echo "No Post found";
    }
}
?>
