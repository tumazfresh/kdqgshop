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

    <TITLE>KDQG | Brands</TITLE>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="css/1style2.css">
    <script src="home.js"></script>
    
<body>


    <div class="container-catalog"><!--container-->
        <div class="bottom-adjuster"><!--bottom-->
            <div class="panel-product"><!--product-->
                <?php
                if (isset($_GET['brand'])) {
                $brand = $_GET['brand'];
                $select_products = $conn->prepare("SELECT * FROM `tb_product` WHERE brand LIKE '$brand'");
                $select_products->execute();
                if ($select_products->rowCount() > 0) {
                    while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <form action="" method="post" class="box">
                                <div class="product-image-wrapper zoom-effect">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>" class="zoom-effect">
                                            <input type="hidden" name="name" value="<?= $fetch_product['product_name']; ?>" class="zoom-effect">
                                            <input type="hidden" name="price" value="<?= $fetch_product['Price']; ?>" class="zoom-effect">
                                            <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>" class="zoom-effect">
                                            <input type="hidden" name="desc" value="<?= $fetch_product['product_desc']; ?>" class="zoom-effect">
                                            <div class="product-imgsize">
                                                 <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" class="zoom-effect">
                                            </div>
                                            <h2 class="product_price">₱<?= number_format($fetch_product['Price'], 2); ?></h2>
                                            <p class="product_name"><?= $fetch_product['product_name']; ?></p>
                                            <p class="product_stock"> <?= $fetch_product['Stock']; ?></p>
                                            <p class="product_desc"><?= substr($fetch_product['product_desc'], 0, 100); ?>...</p>
                                            <a href="product_view.php?pid=<?= $fetch_product['id']; ?>" class="btn btn btn-default add-to-cart">View Now</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2 class="product_price">₱<?= $fetch_product['Price']; ?>.00</h2>
                                                <p class="product_name"><?= $fetch_product['product_name']; ?></p>
                                                <p class="product_stock"> <?= $fetch_product['Stock']; ?></p>
                                                <p class="product_desc"><?= substr($fetch_product['product_desc'], 0, 100); ?>...</p>
                                                <a href="product_view.php?pid=<?= $fetch_product['id']; ?>" class="btn btn btn-default add-to-cart">View Now</a>
                                            </div>
                                        </div>
                                    </div>
                                <div class="choose">
                                    <ul class="choices">
                                        <input type="submit" value="Add to Wishlist" name="add_to_wishlist" onclick="return showLoginPrompt(false);">
                                    </ul>
                                    <ul class="choices">
                                        <input type="submit" value="Add to Cart" name="add_to_cart" onclick="return showLoginPrompt('This feature requires you to be logged in. Please log in to add to your cart.');">
                                    </ul>
                                </div>
                            </div>
                        </form>
                <?php
                    }
                } else {
                    echo '<p class="empty">No products found!</p>';
                }
            }
                ?>


            </div><!--endproduct-->
        </div><!--endbottom-->

    </div><!--endcontainer-->



    <?php include 'footer.php'; ?>
    
    <script>

        const notification = document.getElementById('notification');
        const closeButton = notification.querySelector('.notification-close');

        // Add a click event listener to the close button
        closeButton.addEventListener('click', function () {
            notification.style.display = 'none';
        });
    </script>
    
    <script>
    function showLoginPrompt(type) {
    if (!<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>) {
        const alertMessage = type ? `Please log in to access ${type}` : 'Please log in to access this feature.';
        const alertDiv = document.createElement('div');
        alertDiv.classList.add('alert');
        alertDiv.textContent = alertMessage;
        document.body.appendChild(alertDiv);
        setTimeout(() => {
            alertDiv.remove();
        }, 3000); 
        return false;
    }
}
</script>
    
</body>
</html>