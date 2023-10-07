<?php
include 'dbconn.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $selected_reason = $_POST['cancel_reason'];
    $other_reason = $_POST['other_reason'];
    
    if (!empty($order_id)) {
        $check_order = $conn->prepare("SELECT * FROM tb_order WHERE order_id = ? AND user_id = ?;");
        $check_order->execute([$order_id, $user_id]);

        if ($check_order->rowCount() > 0) {
            if (!empty($selected_reason) || !empty($other_reason)) {

                $cancel_order = $conn->prepare("UPDATE tb_order SET cancel_order = 1, cancel_reason = ? WHERE order_id = ?;");
                $cancel_order->execute([$selected_reason !== 'others' ? $selected_reason : $other_reason, $order_id]);
                echo "Order canceled successfully with reason: " . ($selected_reason !== 'others' ? $selected_reason : $other_reason);
            } else {
                echo "Please provide a reason for cancellation.";
            }
        } else {
            echo "Invalid order ID or the order does not belong to the user.";
        }
    } else {
        echo "Please select an order to cancel.";
    }
} else {
    echo "No order ID provided.";
}


?>
