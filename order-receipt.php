<?php
include 'dbconn.php';

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}


?> 
<script>
  function toggleOtherReason() {
    var cancelReasonsDropdown = document.getElementById("cancel-reasons");
    var otherReasonTextbox = document.getElementById("other-reason-container");
    var cancelReasonInput = document.getElementById("cancel_reason"); // New line to get the hidden input field

    // Check if the selected option is "Others"
    if (cancelReasonsDropdown.value === "others") {
      otherReasonTextbox.style.display = "block"; // Show the textbox
      cancelReasonInput.value = ""; // Clear the hidden input
    } else {
      otherReasonTextbox.style.display = "none"; // Hide the textbox
      cancelReasonInput.value = cancelReasonsDropdown.value; // Set the hidden input with the selected reason
    }
  }
</script>


<!DOCTYPE html>
<html lang="en">

<head><?php include('header.php') ?>
</head>

<head>
  <title> Order Receipt</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/boxicons/2.0.7/css/boxicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
  <link rel="stylesheet" href="css/header_design.css">
  <link rel="stylesheet" href="css/receipt_style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <style>

  </style>
</head>

<body>

  <div class="order-receipt-container">
    <?php
    if (isset($_POST['place-order-button'])) {
      // Retrieve form data
      $pid = $_POST['pid'];
      $name = $_POST['name'];
      $price = $_POST['price'];
      $quantity = $_POST['quantity'];
      $image = $_POST['image01'];
      $nameUser = $_POST['nameUser'];
      $email = $_POST['email'];
      $phonenumber = $_POST['phonenumber'];
      $houseno = $_POST['houseno'];
      $street = $_POST['street'];
      $barangay = $_POST['barangay'];
      $city = $_POST['city'];
      $zipcode = $_POST['zipcode'];
      $total_products = $_POST['total_products'];
      $total_price = $_POST['total_price'];
      $delivery_method = $_POST['delivery_service'];
      $delivery_date = $_POST['delivery-date'];
      $selected_payment = $_POST['payment_method'];

      $image = $_FILES['picture-image']['name'];
      $image_tmp_name = $_FILES['picture-image']['tmp_name'];
      $image_folder = 'uploaded_img/' . $image;
      move_uploaded_file($image_tmp_name, $image_folder);


      // Perform database insertion
      $insert_order = $conn->prepare("INSERT INTO `tb_order` (user_id, pid, name, email, number, houseno, street, barangay, city, zipcode, product_name, quantity, picture_image, price, total_price, payment_method, delivery_date, delivery_method ) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $insert_order->execute([$user_id, $pid, $nameUser, $email, $phonenumber, $houseno, $street, $barangay, $city, $zipcode, $name, $quantity, $image, $price, $total_price, $selected_payment, $delivery_date, $delivery_method]);


      $updateStocks = $conn->prepare("UPDATE `tb_product` SET Stock = Stock - 1 WHERE id = ?;");
      $updateStocks->execute([$pid]);

      // Clear the shopping cart or perform other necessary actions
      // ...

      // Redirect to a thank you page or display a success message

    ?>

      <h2>Order Receipt</h2>
      <p>The following are the generated details for the order receipt:</p>

      <!-- Customer Details Table -->
      <div class="customer-table-container">
        <table class="customer-table">
          <tr>
            <th>Customer Name</th>
            <td><?php echo $nameUser; ?></td>
          </tr>
          <tr>
            <th>Email</th>
            <td><?php echo $email; ?></td>
          </tr>
          <tr>
            <th>Address</th>
            <td><?php echo $houseno . ' ' . $street . ' ' . $barangay . ' ' . $city . ' ' . $zipcode; ?>
            </td>
          </tr>
          <tr>
            <th>Phone Number</th>
            <td><?php echo $phonenumber; ?></td>
          </tr>
        </table>
      </div>

      <!-- Order Items Table -->
      <div class="item-table-container">
        <table class="item-table">
          <tr>
            <th>Product Image</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
            <th>Delivery Method</th>
            <th>Delivery Date and Time</th>
            <th>Payment Method</th>
            <th>Proof of payment address</th>
            <th>Replacement Information</th>
            <th>Warranty Information</th>
          </tr>
          <tr>
            <td><img src="uploaded_img/<?php echo $image; ?>" alt="<?php echo $name; ?>" class="product-image"></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $quantity; ?></td>
            <td><?php echo $price; ?></td>
            <td><?php echo $total_price; ?></td>
            <td><?php echo $delivery_method; ?></td>
            <td><?php echo $delivery_date; ?></td>
            <td><?php echo $selected_payment; ?></td>
            <td><?php echo $houseno;
                echo $street;
                echo $barangay;
                echo $city;
                echo $zipcode; ?></td>
            <td>7-Days Replacement</td>
            <td>1-Year Warranty</td>
          </tr>
        <?php } ?>
        </table>
      </div>

      <div class="row justify-content-end">
  <div class="col-md-2">
    <a href="index.php" class="btn btn-primary btn-block my-4">Proceed to Home</a>
  </div>
  <div class="col-md-2">
    <!-- Button to trigger the modal -->
    <button type="button" class="btn btn-danger btn-block my-4" data-toggle="modal" data-target="#myModal">
      Cancel Order
    </button>
  </div>
</div>






      <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="cancel_order.php" method="POST" id="cancelOrderForm">
          <input type="hidden" name="order_id" id="order_id" value="">
          <input type="hidden" name="cancel_reason" id="cancel_reason" value="">
          <input type="hidden" name="product_id" value="<?php echo $pid; ?>"> <!-- Add product_id to the form data -->
          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"> <!-- Add user_id to the form data -->
          <p>Are you sure you want to cancel the order?</p>
          <div class="form-group">
            <label for="cancel-reasons">Reasons for Cancellation:</label>
            <select id="cancel-reasons" name="cancel_reason" onchange="toggleOtherReason()" class="form-control custom-select mb-2">
              <option value="" disabled selected class="text-muted">Select Reason</option>
              <option value="want-change">Want to change payment method</option>
              <option value="duplicate-order">Duplicate order</option>
              <option value="change-mind">Change of mind</option>
              <option value="alternative-product">Decided for an alternative product</option>
              <option value="fee-cost">Fees-shipping costs</option>
              <option value="others">Others</option>
            </select>
          </div>
          <div id="other-reason-container" style="display: none;">
            <div class="form-group">
              <label for="other-reason">Please specify:</label>
              <input type="text" id="other-reason" name="other_reason" placeholder="Provide your reason" class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>






      <?php

      exit();
      ?>




      <?php include 'footer.php'; ?>
      <script src="js/script.js"></script>
     
      <script>
        $('.cancel-order-button').click(function() {
          $('#cancel-order-modal').modal('show');
        });

        // Get the modal and buttons
        var cancelOrderModal = document.getElementById("cancel-order-modal");
        var cancelOrderButton = document.querySelector(".cancel-order-button");
        var closeModalButton = document.querySelector(".close");
        var cancelYesButton = document.getElementById("cancel-yes");
        var cancelNoButton = document.getElementById("cancel-no");
        var cancelReasonsDropdown = document.getElementById("cancel-reasons");
        var otherReasonContainer = document.getElementById("other-reason-container");

        // Close the modal when the close button is clicked
        closeModalButton.addEventListener("click", function() {
          cancelOrderModal.style.display = "none";
        });

        // Close the modal when the No button is clicked
        cancelNoButton.addEventListener("click", function() {
          cancelOrderModal.style.display = "none";
        });

        // Handle the selection change in the cancel reasons dropdown
        cancelReasonsDropdown.addEventListener("change", function() {
          if (this.value === "others") {
            otherReasonContainer.style.display = "block";
          } else {
            otherReasonContainer.style.display = "none";
          }
        });

        // Handle the cancellation when the Yes button is clicked
        cancelYesButton.addEventListener("click", function() {
          // Perform any cancel order logic here
          cancelOrderModal.style.display = "none";
        });
      </script>

      <script>
        const notification = document.getElementById('notification');
        const closeButton = notification.querySelector('.notification-close');

        // Add a click event listener to the close button
        closeButton.addEventListener('click', function() {
          notification.style.display = 'none';
        });
      </script>
      
      <script>
    // Handle the cancellation when the Submit button is clicked
$('#cancel-submit').on('click', function() {
  // Get the selected reason
  var selectedReason = $('#cancel-reasons').val();
  
  // Get the other reason if "Other" is selected
  var otherReason = '';
  if (selectedReason === 'others') {
    otherReason = $('#other-reason').val();
  }

  $('#cancel_reason').val(selectedReason);

  $.ajax({
    type: 'POST',
    url: 'cancel_order.php',
    data: {
      order_id: $('#order_id').val(), // Corrected order_id value
      cancel_reason: selectedReason,
      other_reason: otherReason,
      product_id: '<?php echo $pid; ?>',
      user_id: '<?php echo $user_id; ?>'
    },
    success: function(response) {
      console.log(response);
      $('#myModal').modal('hide');
      // You can add code here to handle the success message or redirect
    },
    error: function(error) {
      console.error(error);
    }
  });
});


</script>




</body>

</html>