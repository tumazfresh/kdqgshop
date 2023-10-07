<?php
include 'dbconn.php';

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}


?>

<!DOCTYPE html>
<HTML>
<head><?php include('header.php')?>
</head>
<head>
  <title> Order History</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/boxicons/2.0.7/css/boxicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
  <link rel="stylesheet" href="css/header_design.css">
  <link rel="stylesheet" href="css/orderhistory_design.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
  
  <div class="order-history-container">
    <h3>ORDER HISTORY</h3>
    <?php
    include "dbconn.php";
    $select_products = $conn->prepare("SELECT * FROM `tb_order` WHERE user_id = '$user_id'");
    $select_products->execute();


    if ($select_products->rowCount() > 0) {
      while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
        $pid = $fetch_product['pid'];
        $select_pid = $conn->prepare("SELECT * FROM `tb_product` WHERE id = '$pid'");
        $select_pid->execute();
    ?>
    <form action="feed.php" method="post" class="box">
          <div class="order-item">
            <div class="item-details">
              <div class="item-image">
                <?php if ($select_pid->rowCount() > 0) {
                  while ($fetch_pid = $select_pid->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <img src="uploaded_img/<?= $fetch_pid['image_01']; ?>" alt="">
                <?php
                  }
                } else {
                  echo '<p class="empty">No orders found!</p>';
                }
                ?>
              </div>
              <div class="item-info">
                  <h4><?= $fetch_product['product_name']; ?></h4>
                  <input type="hidden" name="order_id"  value="<?= $fetch_product['order_id']; ?>">
                  <input type="hidden" name="pid"  value="<?= $fetch_product['pid'];; ?>">
                  <input type="hidden" name="user_id" value="<?= $user_id ?>">
                  <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                  <p>Order ID: <span><?= $fetch_product['order_id']; ?></span></p>
                  <p>Order Date: <span><?= $fetch_product['placed_on']; ?></span></p>
                  <p>Quantity: <span><?= $fetch_product['quantity']; ?></span></p>
                  <p>Total Price: <span><?= $fetch_product['total_price']; ?></span></p>
              </div>
            </div>
            <div class="item-actions">
              <div>
                <a class="feedback-button">
                  <button type="button" name="add_review" class="add_review">
                    <i class="fas fa-star"></i> Rate
                  </button>
                </a>
                <a href="#" class="buy-again-button" data-pid="<?= $pid ?>">
                  <button class="buy-again-button">
                    <i class="fas fa-shopping-cart"></i> Buy Again
                  </button>
                </a>
  </div>
  </div>
  </div>
  </div>
  
<div id="review_modal" class="modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title">Submit Review</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	      	    
	    
                  <input type="hidden" name="rating" id="rating" value="0">
	      		   <h4 class="text-center mt-2 mb-4">
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                  </h4>
	        	<div class="form-group">
	        		<textarea name="review" class="review" class="form-control" placeholder="Type Review Here"></textarea>
	        	</div>
	        	<div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-primary" id="save_review">Submit</button>
              </div>
            </div>
    	</div>
  	</div>
</div>
              </form>

<?php
      }
    } else {
      echo '<p class="empty">No orders found!</p>';
    }

?>
<script>
  var rating_data = 0;

  $('.add_review').click(function () {
    $('#review_modal').modal('show');
  });

  $(document).on('mouseenter', '.submit_star', function () {
    var rating = $(this).data('rating');

    reset_background();

    for (var count = 1; count <= rating; count++) {
      $('#submit_star_' + count).addClass('text-warning');
    }
  });

  function reset_background() {
    for (var count = 1; count <= 5; count++) {
      $('#submit_star_' + count).addClass('star-light');
      $('#submit_star_' + count).removeClass('text-warning');
    }
  }

  $(document).on('mouseleave', '.submit_star', function () {
    reset_background();

    for (var count = 1; count <= rating_data; count++) {
      $('#submit_star_' + count).removeClass('star-light');
      $('#submit_star_' + count).addClass('text-warning');
    }
  });

  $(document).on('click', '.submit_star', function () {
    rating_data = $(this).data('rating'); // Set the rating_data variable here
  });

  
</script>

<script>
  $(document).on('click', '.buy-again-button', function () {
    var pid = $(this).data('pid');

    window.location.href = 'product_view.php?pid=' + pid;
  });
</script>




<script src="js/script.js"></script>
<script>
  const notification = document.getElementById('notification');
  const closeButton = notification.querySelector('.notification-close');

  // Add a click event listener to the close button
  closeButton.addEventListener('click', function() {
    notification.style.display = 'none';
  });
</script>
</body>
<?php include 'footer.php'; ?>

</html>
