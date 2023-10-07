<?php
include 'dbconn.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_SESSION['wishlistCount'])) {
    $wishlistCount = $_SESSION['wishlistCount'];
} else {
    $wishlistCount = 0; // or any default value you want
}

if (isset($_SESSION['cartCount'])) {
    $cartCount = $_SESSION['cartCount'];
} else {
    $cartCount = 0; // or any default value you want
}

if (isset($_POST['checkout']) && isset($_POST['item_select'])) {
    header('Location: Checkout.php');
    exit;
}

$selectedItemIds = [];
$select_cart = $conn->prepare("SELECT * FROM `tb_cart` WHERE user_id = ?");
$select_cart->execute([$user_id]);
$cartItems = $select_cart->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['delete_item'])) {
    if (isset($_SESSION['user_id'])) {
        $selectedItems = isset($_POST['delete_item']) ? $_POST['delete_item'] : [];

        foreach ($selectedItems as $id) {
            $id = intval($id);

            // Delete the item from the cart table
            $delete_item = $conn->prepare("DELETE FROM `tb_cart` WHERE id = ?");
            $delete_item->execute([$id]);
        }

        $message = 'Items deleted from the cart.';
        header('Location: cart.php');
        exit;
    }
}

if (isset($_POST['add_to_wishlist']) && isset($_POST['item_select'])) {
    $selected_items = $_POST['item_select'];

    foreach ($selected_items as $cart_id) {

        // Fetch cart item data
        $fetch_cart_query = $conn->prepare("SELECT * FROM `tb_cart` WHERE id = ? AND user_id = ?");
        $fetch_cart_query->execute([$cart_id, $user_id]);
        $cart_item = $fetch_cart_query->fetch(PDO::FETCH_ASSOC);

        if ($cart_item) {
            // Check if the product is already in the wishlist
            $check_wishlist_numbers = $conn->prepare("SELECT * FROM `tb_wishlist` WHERE pid = ? AND user_id = ?");
            $check_wishlist_numbers->execute([$cart_item['pid'], $user_id]);

            if ($check_wishlist_numbers->rowCount() > 0) {
                // Item is already in the wishlist
                $message = 'This item is already in your wishlist.';
            } else {
                // Insert the data into the wishlist table
                $insert_wishlist = $conn->prepare("INSERT INTO `tb_wishlist` (user_id, pid, name, price, image) VALUES (?, ?, ?, ?, ?)");
                $insert_wishlist->execute([$user_id, $cart_item['pid'], $cart_item['name'], $cart_item['price'], $cart_item['image']]);
                $message = 'Item added to wishlist!';
            }
        }
    }

    // Redirect back to the cart page after adding to wishlist
    header('Location: cart.php');
    exit;
}

if (isset($_POST['remove_item'])) {
    $remove_cart_id = $_POST['remove_item'];
    deleteCartItem($remove_cart_id);
    header('Location: cart.com.php');
    exit;
}

// Function to delete a cart item
function deleteCartItem($cart_id) {
    global $conn, $user_id;
    $delete_query = $conn->prepare("DELETE FROM `tb_cart` WHERE id = ? AND user_id = ?");
    $delete_query->execute([$cart_id, $user_id]);
}

if (isset($_POST['checkout']) && isset($_POST['item_select'])) {
    header('Location: checkout.com.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('header.php')?>
    <title>Shopping Cart | KDQG</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="css/cart_design.css">
</head>
<body>
<div class="cart-container">
    <h1><i class="fas fa-shopping-cart"></i> My Shopping Cart</h1>
    <form method="post" action="">
        <table class="cart-items">
            <tr>
                <th></th>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
            </tr>

            <?php
            $grand_total = 0;

            $select_cart = $conn->prepare("SELECT * FROM `tb_cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            $cartItems = $select_cart->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($cartItems)) {
                foreach ($cartItems as $fetch_cart) {
                    $grand_total += $fetch_cart['price'];
                    $id = $fetch_cart['id']; // Define $id here
                    ?>
                    <tr>
                        <td>
                            <div class="">
                                <input type="checkbox" name="item_select[]" id="item<?= $id; ?>" value="<?= $id; ?>">
                                <label for="item<?= $id; ?>"></label>
                            </div>
                        </td>
                        <td>
                            <div class="cart-item-details">
                                <div class="cart-item-image">
                                    <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                                </div>
                            </div>
                            <div class="cart-item-name"><?= $fetch_cart['name']; ?></div>
                        </td>

                        <td class="item-price"><?= number_format($fetch_cart['price'], 2); ?></td>
                        <td>
                            <input type="number" name="quantity" class="quantity" min="1" max="10"
                                   value="<?= $fetch_cart['quantity']; ?>" onkeypress="if(this.value.length == 2) return false;" value="1">
                        </td>

                        <td class="item-total"><?= number_format($fetch_cart['price'], 2); ?></td>
                        <td>
                            <div class="item-actions">
                                <button type="submit" class="wishlist-button" name="add_to_wishlist"
                                        onclick="return confirm('Add this item to wishlist?');"><i
                                            class="fas fa-heart"></i> Add to Wishlist
                                </button>

                                <input type="hidden" name="remove_item" value="<?= $id; ?>">
                                <button type="submit" class="remove-button" name="delete_item"
                                        onclick="return confirm('Delete this item from cart?');"><i
                                            class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php
                }
            } else {
                echo '<tr><td colspan="6" class="empty">Your cart is empty</td></tr>';
            }
            ?>
        </table>

        <div class="cart-summary">
            <div class="subtotal">
                <p>Subtotal: <?= number_format($grand_total, 2); ?></p>
            </div>
        </div>
        <button class="checkout-button" type="submit" onclick="prepareCheckout()">Checkout</button>
    </form>
</div>

<?php include 'footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>

<script>
    function updateSelectedItems() {
        var selectedItems = [];
        var checkboxes = document.querySelectorAll('input[name="item_select[]"]:checked');
        checkboxes.forEach(function (checkbox) {
            selectedItems.push(checkbox.value);
        });
        document.getElementById('selectedItems').value = selectedItems.join(',');
    }

    // Attach the event listener to update selected items when checkboxes are clicked
    var checkboxes = document.querySelectorAll('input[name="item_select[]"]');
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('click', updateSelectedItems);
    });
</script>
</body>
</html>
