<?php
include 'dbconn.php';
?>

<!DOCTYPE html>
<html>
  
<head><?php include('header.php') ?>
</head>

<head>
  <title> Checkout</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/boxicons/2.0.7/css/boxicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
  <link rel="stylesheet" href="css/header_design.css">
  <link rel="stylesheet" href="css/checkout.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


</head>

<body>

  <div class="display-orders">
    <h1>Order Summary</h1> 
  <div id="checkout-form-container" class="checkout-container">
    <h1>Checkout Form</h1>
    <?php


    $cashOnDeliveryReminder = "Reminder: If you choose the <span class='cash-on-delivery'>Cash-On-Delivery</span> as your <span class='cash-on-delivery'>payment method,</span> you are required to provide an ID picture and address for verification (kindly click the proof of payment button) to prevent fraudulent activities.";
    ?>
    <p class="cash-on-delivery-reminder"><?php echo $cashOnDeliveryReminder; ?></p>
    <div class="row">
      <div class="column">
        <div class="section-header" style="color: #368BC1;">
          <h2><i class="fas fa-map-marker-alt"></i> BILLING ADDRESS</h2>
        </div>
        <?php
        $user_id=$_SESSION['id'];
        $select_products = $conn->prepare("SELECT * FROM `tb_customer` WHERE custid = '$user_id'");
        $select_products->execute();
        if ($select_products->rowCount() > 0) {
          while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <div class="form-group">
              <label for="name">Full Name:</label>
              <input type="text" id="nameUser" name="nameUser" placeholder="Please Enter your Fullname" minlength="10" maxlength="50" required pattern="^[A-Za-z\s]{10,50}$" title="Please enter a valid name (e.g., Juan Dela Cruz)." value="<?= $fetch_product['name']; ?>" style="width: 300px;">
            </div>

            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" placeholder="Enter your email address" minlength="10" maxlength="50" required pattern="^(?:[a-zA-Z0-9._%+-]+@gmail\.com|[a-zA-Z0-9._%+-]+@my\.jru\.edu)$" title="Please enter a valid email address (e.g., juandc@gmail.com)." value="<?= $fetch_product['email']; ?>" style="width: 300px;">
            </div>

            <div class="form-group">
              <label for="phonenumber">Phone Number:</label>
              <input type="text" id="phonenumber" name="phonenumber" placeholder="Enter your phone number" minlength="11" maxlength="11" required pattern="^09\d{9}$" title="Please enter a valid phone number (e.g., 09261417921)." inputmode="numeric" value="<?= $fetch_product['phone']; ?>" style="width: 300px;">
            </div>

            <div class="form-group">
              <label for="address">House No.:</label>
              <input type="text" id="houseno" name="houseno" placeholder="Enter your house number" minlength="1" maxlength="50" required pattern=".{1,50}" title="Please enter a valid house number (e.g., 1990 )." value="<?= $fetch_product['house_number']; ?>" style="width: 300px;">
            </div>
            <div class="form-group">
              <label for="address">Street:</label>
              <input type="text" id="street" name="street" placeholder="Enter your street" minlength="4" maxlength="50" required pattern=".{4,50}" title="Please enter a valid street (Sunflower St.)." value="<?= $fetch_product['street']; ?>" style="width: 300px;">
            </div>
            <div class="form-group">
              <label for="address">Barangay:</label>
              <input type="text" id="barangay" name="barangay" placeholder="Enter your barangay" minlength="4" maxlength="50" required pattern=".{4,50}" title="Please enter a valid barangay (e.g., Brgy. Mars)." value="<?= $fetch_product['barangay']; ?>" style="width: 300px;">
            </div>
            <div class="form-group">
              <label for="address">City:</label>
              <input type="text" id="city" name="city" placeholder="Enter your city" minlength="5" maxlength="50" required pattern=".{5,50}" title="Please enter a valid city (e.g., Manila City  )." value="<?= $fetch_product['city']; ?>" style="width: 300px;">
            </div>
            <div class="form-group">
              <label for="zipcode">Zip Code:</label>
              <input type="text" id="zipcode" name="zipcode" placeholder="Enter your zip code" minlength="4" maxlength="5" required pattern=".{4,5}" title="Please enter a valid zip code (e.g., 1550)." value="<?= $fetch_product['zip_code']; ?>" style="width: 300px;">
            </div>
        <?php
          }
        }
        ?>

        <div class="form-group">
              <div class="container" style="border: 1px solid #D3D3D3; background-color: #F5F5F5; padding: 10px; border-radius: 5px;">
                <span for="provide" style="color: red;">
                  You are required to upload your valid ID for validation (e.g., 
                  <b><u style="font-weight: bold;">TIN ID</u>, <u>PhilHealth ID</u>, <u style="font-weight: bold;">Postal ID</u>, <u style="font-weight: bold;">Voter's ID</u></b>, and many more as long as it is valid).
                </span>
                </div>

          <label for="picture-image">Upload valid ID:</label>
          <div class="image-upload-container">
            <img id="id-picture-preview" class="img-thumbnail" src="" alt="">
            <div class="input-container">
              <input type="file" id="picture-image" name="picture-image" class="form-control" onchange="previewImage(event, 'id-picture-preview'); setFilePath(this);" accept="image/*" required>
            </div>
          </div>
        </div>

      </div>

      <div class="column">
        <div class="section-header" style="color: #368BC1;">
          <h2><i class="fas fa-truck"></i> COURIER DELIVERY SERVICES</h2>
        </div>
        <div class="form-group">
          <label for="delivery-method">Select Delivery Service:</label>
          <div class="dropdown">
            <input type="radio" class="dropbtn" id="kdqg" name="delivery_service" value="KDQG Delivery">
            <label for="kdqg" class="delivery-option">
              <i class="fas fa-truck"></i> KDQG Delivery
            </label>
            <input type="radio" class="dropbtn" id="jt" name="delivery_service" value="J&T">
            <label for="jt" class="delivery-option">
              <i class="fas fa-truck"></i> J&T
            </label>
            <input type="radio" class="dropbtn" id="grab" name="delivery_service" value="Grab">
            <label for="grab" class="delivery-option">
              <i class="fas fa-truck"></i> Grab
            </label>
            <input type="radio" class="dropbtn" id="lalamove" name="delivery_service" value="Lalamove">
            <label for="lalamove" class="delivery-option">
              <i class="fas fa-truck"></i> Lalamove
            </label>
            <input type="radio" class="dropbtn" id="standard" name="delivery_service" value="Standard Delivery">
            <label for="standard" class="delivery-option">
              <i class="fas fa-truck"></i> Standard Delivery
            </label>
          </div>

          <input type="hidden" id="selected-delivery" name="delivery_method" value="">
        </div>
        <div class="section-header" style="color: #368BC1;">
          <h2><i class="fas fa-credit-card"></i> PAYMENT METHOD</h2>
        </div>
        <div class="section-header" style="color: #368BC1;">
          <h3>Accepted Payment Methods:</h3>
        </div>
        <div class="payment-methods">
          <div class="payment-method">
            <img src="img/bdo.jpg" alt="Credit Card">
          </div>
          <div class="payment-method">
            <img src="img/bpi.jpg" alt="Credit Card">
          </div>
          <div class="payment-method">
            <img src="img/cod.jpg" alt="Cash on Delivery">
          </div>
          <div class="payment-method">
            <img src="img/gcash.jpg" alt="GCash">
          </div>
          <div class="payment-method">
            <img src="img/maya.jpg" alt="PayMaya">
          </div>
        </div>
        <div class="form-group">
          <label for="payment-method">Select Payment Method:</label>
          <div class="dropdown">
            <input type="radio" class="dropbtn" id="cod" name="payment_method" value="Cash On Delivery">
            <label for="cod" class="payment-option">
              <i class="fas fa-truck"></i> Cash On Delivery
            </label>
            <input type="radio" class="dropbtn" id="credit" name="payment_method" value="Credit Card">
            <label for="credit" class="payment-option">
              <i class="fas fa-credit-card"></i> Credit Card
            </label>
            <input type="radio" class="dropbtn" id="debit" name="payment_method" value="Debit Card">
            <label for="debit" class="payment-option">
              <i class="fas fa-credit-card"></i> Debit Card
            </label>
            <input type="radio" class="dropbtn" id="bdo" name="payment_method" value="BDO">
            <label for="bdo" class="payment-option">
              <i class="fas fa-university"></i> BDO
            </label>
            <input type="radio" class="dropbtn" id="bpi" name="payment_method" value="BPI">
            <label for="bpi" class="payment-option">
              <i class="fas fa-university"></i> BPI
            </label>
            <input type="radio" class="dropbtn" id="gcash" name="payment_method" value="GCash">
            <label for="gcash" class="payment-option">
              <i class="fab fa-gripfire"></i> GCash
            </label>
            <input type="radio" class="dropbtn" id="maya" name="payment_method" value="Maya">
            <label for="maya" class="payment-option">
              <i class="fab fa-paypal"></i> Maya
            </label>
          </div>
          <input type="hidden" id="selected-payment" name="selected_payment" value="">
        </div>

        <div class="shipping-option">
          <label for="delivery-date">Estimated Delivery Date and Time:</label>
          <div class="date-time-picker">
            <input type="datetime-local" id="delivery-date" name="delivery-date" required>
          </div>
        </div>
      </div>
    </div>
    <div class="buttons">
  <button type="submit" name="place-order-button" id="place-order-button" class="disabled-button">Place Order</button>
</div>
  </div>

  </form>


  <?php
  // Get the captured content from the output buffer
  $bufferedContent = ob_get_clean();

  // Output the buffered content
  echo $bufferedContent;
  ?>



  <?php include 'footer.php'; ?>

  <script>
    function previewImage(event, previewId) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          var previewElement = document.getElementById(previewId);
          previewElement.setAttribute('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>


</body>



<script>
  const notification = document.getElementById('notification');
  const closeButton = notification.querySelector('.notification-close');

  // Add a click event listener to the close button
  closeButton.addEventListener('click', function() {
    notification.style.display = 'none';
  });
</script>

<script>
  const notification = document.getElementById('notification');
  const closeButton = notification.querySelector('.notification-close');

  });
</script>

<script>
  document.querySelector('.announcement-dismiss').addEventListener('click', function() {
    const announcementContainer = document.querySelector('.announcement-container');
    announcementContainer.style.display = 'none';
  });
</script>

</html>