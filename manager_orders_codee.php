<?php
require 'dbcon.php';

if (isset($_POST['save_order'])) {
    $orderID = mysqli_real_escape_string($con, $_POST['order_id']);
    $usersID = mysqli_real_escape_string($con, $_POST['user_id']);
    $usersID = mysqli_real_escape_string($con, $_POST['user_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $totalproducts = mysqli_real_escape_string($con, $_POST['total_products']);
    $totalprice = mysqli_real_escape_string($con, $_POST['total_price']);
    $placed_on = mysqli_real_escape_string($con, $_POST['placed_on']);
    $delivery_date = mysqli_real_escape_string($con, $_POST['delivery_date']);
    $payment_method = mysqli_real_escape_string($con, $_POST['payment_method']);
    $proof_address = mysqli_real_escape_string($con, $_POST['proof_of_payment_address']);
    $payment_status = mysqli_real_escape_string($con, $_POST['payment_status']);
    $delivery_method = mysqli_real_escape_string($con, $_POST['delivery_method']);

    $image01 = $_FILES['image01']['name'];
    $image01_tmp = $_FILES['image01']['tmp_name'];

    $image_folder = 'uploaded_img/';

    move_uploaded_file($image01_tmp, $image_folder . $image01);

    $query = "INSERT INTO tb_orders (user_id, name, email, address, `total_products`, `total_price`, `placed_on`, `delivery_date`, `payment_method`, `uploadedID`, `proof_of_payment_address`, `payment_status`, `delivery_method`)
              VALUES ('$usersID', '$name', '$email', '$address', '$totalproducts', '$totalprice', '$placed_on', '$delivery_date', '$image01', '$payment_method', '$proof_address', '$payment_status', '$delivery_method')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Order Created Successfully'
        ];
    } else {
        $res = [
            'status' => 500,
            'message' => 'Order Not Created'
        ];
    }

    echo json_encode($res);
    return;

} elseif (isset($_POST['update_order'])) {
    $order_id = mysqli_real_escape_string($con, $_POST['order_id']);
    
    $select_query = "SELECT * FROM tb_orders WHERE order_id='$order_id'";
    $select_result = mysqli_query($con, $select_query);
    
    if ($select_result) {
        $existing_order = mysqli_fetch_assoc($select_result);
        
        // Handle image upload
        $image_folder = 'uploaded_img/';
        $new_image01 = $_FILES['new_image01']['name'];
        $new_image01_tmp = $_FILES['new_image01']['tmp_name'];

        if ($new_image01) {
            // If a new image is provided, update the image filename
            move_uploaded_file($new_image01_tmp, $image_folder . $new_image01);
        } else {
            // If no new image is provided, keep the existing image filename
            $new_image01 = $existing_order['uploadedID'];
        }

    $usersID = mysqli_real_escape_string($con, $_POST['user_id']);
    $productID = mysqli_real_escape_string($con, $_POST['product_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $totalproducts = mysqli_real_escape_string($con, $_POST['name']);
    $totalprice = mysqli_real_escape_string($con, $_POST['total_price']);
    $placed_on = mysqli_real_escape_string($con, $_POST['placed_on']);
    $delivery_date = mysqli_real_escape_string($con, $_POST['delivery_date']);
    $payment_method = mysqli_real_escape_string($con, $_POST['payment_method']);
    $proof_address = mysqli_real_escape_string($con, $_POST['proof_of_payment_address']);
    $payment_status = mysqli_real_escape_string($con, $_POST['payment_status']);
    $delivery_method = mysqli_real_escape_string($con, $_POST['delivery_method']);

    $query = "UPDATE tb_orders SET name='$name', email='$email', address='$address', `total_products`='$totalproducts', `total_price`='$totalprice', `placed_on`='$placed_on', `delivery_date`='$delivery_date', `payment_method`='$payment_method', `uploadedID`='$new_image01', `proof_of_payment_address`='$proof_address', `payment_status`='$payment_status', `delivery_method`='$delivery_method' WHERE order_id='$order_id'";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Order Updated Successfully'
            ];
        } else {
            $res = [
                'status' => 500,
                'message' => 'Order Not Updated'
            ];
        }
    } else {
        // Handle the case where the order does not exist
        $res = [
            'status' => 404,
            'message' => 'Order ID Not Found'
        ];
    }

    echo json_encode($res);
    return;


} elseif (isset($_GET['view_order'])) { 
    $order_id = mysqli_real_escape_string($con, $_GET['view_order']); 

    $query = "SELECT * FROM tb_order WHERE order_id='$order_id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $order = mysqli_fetch_assoc($query_run);

        $res = [
            'status' => 200,
            'message' => 'Order Fetched Successfully by ID',
            'data' => $order
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Order ID Not Found'
        ];
        echo json_encode($res);
        return;
    }

} elseif (isset($_POST['delete_order'])) {
    $order_id = mysqli_real_escape_string($con, $_POST['order_id']);

    // Check if the order exists before deleting
    $check_query = "SELECT * FROM tb_order WHERE order_id='$order_id'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $delete_query = "DELETE FROM tb_order WHERE order_id='$order_id'";
        $delete_result = mysqli_query($con, $delete_query);

        if ($delete_result) {
        $res = [
            'status' => 200,
            'message' => 'Order Deleted Successfully'
        ];
    } else {
        $res = [
            'status' => 500,
            'message' => 'Order Not Deleted'
        ];
    }

    echo json_encode($res);
    return;
}
}

?>