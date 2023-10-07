<?php
include 'dbconn.php';


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}


$select_wishlist = $conn->prepare("SELECT * FROM `tb_wishlist` WHERE user_id = ?");
$select_wishlist->execute([$user_id]);
$wishlistItems = $select_wishlist->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['delete'])) {
    $wishlist_id = $_POST['wishlist_id'];

    $delete_query = $conn->prepare("DELETE FROM `tb_wishlist` WHERE id = ?");
    $delete_query->execute([$wishlist_id]);

    header('Location: wishlist.php');
    exit;
}

if (isset($_POST['add_to_cart']) && isset($_POST['wishlist_id'])) {
    $wishlist_id = $_POST['wishlist_id'];
    $quantity = $_POST['quantity'];

    // Fetch wishlist item data
    $fetch_wishlist_query = $conn->prepare("SELECT * FROM `tb_wishlist` WHERE id = ? AND user_id = ?");
    $fetch_wishlist_query->execute([$wishlist_id, $user_id]);
    $wishlist_item = $fetch_wishlist_query->fetch(PDO::FETCH_ASSOC);

    if ($wishlist_item) {
        // Check if the item already exists in the cart
        $check_cart_query = $conn->prepare("SELECT * FROM `tb_cart` WHERE user_id = ? AND pid = ?");
        $check_cart_query->execute([$user_id, $wishlist_item['pid']]);
        $cart_item = $check_cart_query->fetch(PDO::FETCH_ASSOC);

        if ($cart_item) {
            // Item already exists in the cart, so update the quantity
            $new_quantity = $cart_item['quantity'] + $quantity;
            $update_cart = $conn->prepare("UPDATE `tb_cart` SET quantity = ? WHERE id = ?");
            $update_cart->execute([$new_quantity, $cart_item['id']]);
        } else {
            // Item is not in the cart, so add it
            $insert_cart = $conn->prepare("INSERT INTO `tb_cart` (user_id, pid, name, price, quantity, image) VALUES (?, ?, ?, ?, ?, ?)");
            $insert_cart->execute([$user_id, $wishlist_item['pid'], $wishlist_item['name'], $wishlist_item['price'], $quantity, $wishlist_item['image']]);
        }

        // Delete item from wishlist
        $delete_query = $conn->prepare("DELETE FROM `tb_wishlist` WHERE id = ?");
        $delete_query->execute([$wishlist_id]);
    }

    header('Location: cart.php');
    exit;
}

?>

<!DOCTYPE html>

<html lang="en">
<head><?php include('header.php')?>
</head>
<head>
    <title>Favorites | KDQG</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="css/wishlist_design.css">
</head>
<body>
  <div class="wishlist-container">
    <h3 class="wishlist-heading">WISHLIST</h3>

    <?php
    if (!empty($wishlistItems)) {
        foreach ($wishlistItems as $fetch_wishlist) {
    ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid']; ?>">
                <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
                <input type="hidden" name="name" value="<?= $fetch_wishlist['name']; ?>">
                <input type="hidden" name="price" value="<?= $fetch_wishlist['price']; ?>">
                <input type="hidden" name="image" value="<?= $fetch_wishlist['image']; ?>">
                <div class="wishlist-item">
                    <div class="wishlist-item-details">
                          <div class="wishlist-item-image">
                            <img src="uploaded_img/<?= $fetch_wishlist['image']; ?>" alt="Product Image" />
                          </div>
                              <div class="item-info">
                                <h4><?= $fetch_wishlist['name']; ?></h4>
                                    <div class="flex">
                                      <p>Product Price: <span><?= number_format($fetch_wishlist['price']); ?></span></p>
                                        <div class="quantity-container">
                                          <input type="number" name="quantity" class="quantity" min="1" max="10" onkeypress="if(this.value.length == 2) return false;" value="1">
                                        </div>
                                    </div>
                              </div>
                    </div>
                    <input type="hidden" name="action" value="add_to_cart">
                    <div class="item-actions">
                      <button type="submit" class="cart-button" name="add_to_cart" onclick="return confirm('Add this item to cart?');"><i class="fas fa-cart-plus"></i></button>
                      <button type="submit" class="remove-button" name="delete" onclick="return confirm('Delete this from wishlist?');"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
          </form>

<?php
        }
    } else {
        echo '<p class="empty">Your wishlist is empty</p>';
    }
    if (isset($_POST['delete'])) {
      $wishlist_id = $_POST['wishlist_id'];
  
  
      header('Location: wishlist.php'); 
      exit;
  }
  
?>
</div>
  <?php include 'footer.php'; ?>
  
</body>
    <script>

        const notification = document.getElementById('notification');
        const closeButton = notification.querySelector('.notification-close');

        // Add a click event listener to the close button
        closeButton.addEventListener('click', function () {
            notification.style.display = 'none';
        });
    </script>
    
    <script>
    document.querySelector('.announcement-dismiss').addEventListener('click', function() {
        const announcementContainer = document.querySelector('.announcement-container');
        announcementContainer.style.display = 'none';
    });
    </script>
</html>