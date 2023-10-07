<?php
include 'dbconn.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
  ?>

<!DOCTYPE html>
<html lang="en">
<head><?php include('header.php')?></head>
<head>
    <title>KDQG | Product Catalog</title>
    <!-- All CSS -->
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="css/productc_design.css">
</head>
<body>     

    <div class="Product-header">
            <h1>All Products </h1>
    </div>   

    <div class="container-design" style ="background-image: url(img/container.png);">  
        <div class="categories-header">
                <h1>PRODUCT CATEGORIES </h1>
        </div>
        
        <div class="category-container">
            <div class="category">
                <a href="categories.php?category=Smartphone">
                    <i class="bi bi-phone"></i>
                    <p>Smartphones</p>
                </a>
            </div>
    
            <div class="category">
                <a href="categories.php?category=Laptop">
                    <i class="bi bi-laptop"></i>
                    <p>Laptops</p>
                </a>
            </div>
    
            <div class="category">
                <a href="categories.php?category=Accessories">
                    <i class="bi bi-headphones"></i>
                    <p>Accessories</p>
                </a>
            </div>
        </div>
        
        
        <div class="brands-header">
                <h1> PRODUCT BRANDS </h1>
        </div>
        
        <div class=" brands-container">
            <div class="brand">
                <img src="img/apple.png" alt="">
                <a href="brands.php?brand=Apple">Apple</a>
            </div>
            
            <div class="brand">
                <img src="img/xiaomi.png" alt="">
                <a href="brands.php?brand=Xiaomi">MI Xiaomi</a>
            </div>
            
            <div class="brand">
                <img src="img/oppo.png" alt="">
                <a href="brands.php?brand=Oppo">OPPO</a>
            </div>
            
            <div class="brand">
                <img src="img/realme.png" alt="">
                <a href="brands.php?brand=RealMe">Realme</a>
            </div>
            
            <div class="brand">
                <img src="img/vivo.png" alt="">
                <a href="brands.php?brand=Vivo">VIVO</a>
            </div>
            
            <div class="brand">
                <img src="img/itel.png" alt="">
                <a href="brands.php?brand=Itel">Itel</a>
            </div>
            
            <div class="brand">
                <img src="img/dell.png" alt="">
                <a href="brands.php?brand=Dell">DELL</a>
            </div>
            
            <div class="brand">
                <img src="img/lenovo.png" alt="">
                <a href="brands.php?brand=Lenovo">Lenovo</a>
            </div>
            
            <div class="brand">
                <img src="img/acer.png" alt="">
                <a href="brands.php?brand=Acer">ACER</a>
            </div>
            
            <div class="brand">
                <img src="img/hp.png" alt="">
                <a href="brands.php?brand=HP">HP</a>
            </div>
            
            <div class="brand">
                <img src="img/msi.png" alt="">
                <a href="brands.php?brand=MSI">MSI</a>
            </div>
            
            <div class="brand">
                <img src="img/samsung.png" alt="">
                <a href="brands.php?brand=Samgsung">Samsung</a>
            </div>
            
            <div class="brand">
                <img src="img/huawei.png" alt="">
                <a href="brands.php?brand=Huawei">Huawei</a>
            </div>
            
            <div class="brand">
                <img src="img/infinix.png" alt="">
                <a href="brands.php?brand=Infinix">Infinix</a>
            </div>
            
            <div class="brand">
                <img src="img/poco1.png" alt="">
                <a href="brands.php?brand=Poco">POCO</a>
            </div>
            
            <div class="brand">
                <img src="img/tecno.png" alt="">
                <a href="brands.php?brand=TECNO%Mobile">TECNO Mobile</a>
            </div>
        </div>
    </div>
<?php include('deals.php')?>  


            <div class="panel" id="phones">
                <h3>SMARTPHONES</h3>
            </div>
    <div class="container-catalog"><!--container-->
        <div class="bottom-adjuster"><!--bottom-->
            <div class="panel-product"><!--product-->
               <?php
                $select_products = $conn->prepare("SELECT p.*, p.price AS wishlist_price FROM `tb_product` p LEFT JOIN `tb_wishlist` w ON p.id = w.pid WHERE p.category='Smartphone' AND p.Stock>='1' AND p.Status='Active'");
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
                                            <p class="product_stock" style="color: red"><em>No. of Stock:</em> <b><?= $fetch_product['Stock']; ?></b></p> <!--color: #003399;-->
                                            <p class="product_desc"><?= substr($fetch_product['product_desc'], 0, 100); ?>...</p>
                                            <a href="product_view.php?pid=<?= $fetch_product['id']; ?>" class="btn btn btn-default add-to-cart">View Now</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                            <h2 class="product_price">₱<?= $fetch_product['Price']; ?>.00</h2>
                                            <p class="product_name"><?= $fetch_product['product_name']; ?></p>
                                            <p class="product_stock"><em>No. of Stock:</em> <b><?= $fetch_product['Stock']; ?></b></p> <!--color: #003399;-->
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
                                        <input type="submit" value="Add to Cart" name="add_to_cart" onclick="return showLoginPrompt(false);">
                                    </ul>
                                </div>
                            </div>
                        </form>
                        
                <?php
                    }
                } else {
                    echo '<p class="empty">No products found!</p>';
                }
                ?>

            </div><!--endproduct-->
            
             <div class="panel" id="laptops">
                <h3>LAPTOPS</h3>
            </div>
            <div class="panel-product"><!--product-->
                <?php
                $select_products = $conn->prepare("SELECT p.*, p.price AS wishlist_price FROM `tb_product` p LEFT JOIN `tb_wishlist` w ON p.id = w.pid WHERE p.category='Laptop' AND p.Stock>='1' AND p.Status='Active'");
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
                                            <p class="product_stock" style="color: red"><em>No. of Stock:</em> <b><?= $fetch_product['Stock']; ?></b></p> <!--color: #003399;-->
                                            <p class="product_desc"><?= substr($fetch_product['product_desc'], 0, 100); ?>...</p>
                                            <a href="product_view.php?pid=<?= $fetch_product['id']; ?>" class="btn btn btn-default add-to-cart">View Now</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2 class="product_price">₱<?= $fetch_product['Price']; ?>.00</h2>
                                                <p class="product_name"><?= $fetch_product['product_name']; ?></p>
                                                <p class="product_stock"><em>No. of Stock:</em> <b><?= $fetch_product['Stock']; ?></b></p> <!--color: #003399;-->
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
                                        <input type="submit" value="Add to Cart" name="add_to_cart" onclick="return showLoginPrompt(false);">
                                    </ul>
                                </div>
                            </div>
                         
                        </form>
                <?php
                    }
                } else {
                    echo '<p class="empty">No products found!</p>';
                }
                ?>


            </div><!--endproduct-->
            
            <div class="panel" id="accessories">
                <h3>ACCESSORIES</h3>
            </div>
            <div class="panel-product"><!--product-->
                <?php
                $select_products = $conn->prepare("SELECT p.*, p.price AS wishlist_price FROM `tb_product` p LEFT JOIN `tb_wishlist` w ON p.id = w.pid WHERE p.category='Accessories' AND p.Stock>='1' AND p.Status='Active'");
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
                                            <p class="product_stock" style="color: red"><em>No. of Stock:</em> <b><?= $fetch_product['Stock']; ?></b></p> <!--color: #003399;-->
                                            <p class="product_desc"><?= substr($fetch_product['product_desc'], 0, 100); ?>...</p>
                                            <a href="product_view.php?pid=<?= $fetch_product['id']; ?>" class="btn btn btn-default add-to-cart">View Now</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2 class="product_price">₱<?= $fetch_product['Price']; ?>.00</h2>
                                                <p class="product_name"><?= $fetch_product['product_name']; ?></p>
                                                <p class="product_stock"><em>No. of Stock:</em> <b><?= $fetch_product['Stock']; ?></b></p> <!--color: #003399;-->
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
                                        <input type="submit" value="Add to Cart" name="add_to_cart" onclick="return showLoginPrompt(false);">
                                    </ul>
                                </div>
                            </div>
                        </form>
                <?php
                    }
                } else {
                    echo '<p class="empty">No products found!</p>';
                }
                ?>



            </div><!--endproduct-->
        </div><!--endbottom-->

        
   
        <div class= "d-none d-sm-block ">
            <br>
            <div class="sidebar">
                <div class="sidebar-announcement-container">
                <p class="sidebar-announcement-text">🎉 Exciting News: Join our community for exclusive updates and events!</p>
                <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image">
                <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                <button class="sidebar-announcement-dismiss" onclick="dismissAnnouncement()">Dismiss</button>
                </div>
            </div>
            <div class="sidebar">
                <div class="sidebar-announcement-container">
                <p class="sidebar-announcement-text">🎉 Exciting News: Join our community for exclusive updates and events!</p>
                <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image">
                <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                <button class="sidebar-announcement-dismiss" onclick="dismissAnnouncement()">Dismiss</button>
                </div>
            </div>
            <div class="sidebar">
                <div class="sidebar-announcement-container">
                <p class="sidebar-announcement-text">🎉 Exciting News: Join our community for exclusive updates and events!</p>
                <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image">
                <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                <button class="sidebar-announcement-dismiss" onclick="dismissAnnouncement()">Dismiss</button>
                </div>
            </div>
            <div class="sidebar">
                <div class="sidebar-announcement-container">
                <p class="sidebar-announcement-text">🎉 Exciting News: Join our community for exclusive updates and events!</p>
                <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image">
                <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                <button class="sidebar-announcement-dismiss" onclick="dismissAnnouncement()">Dismiss</button>
                </div>
            </div>
            <div class="sidebar">
                <div class="sidebar-announcement-container">
                <p class="sidebar-announcement-text">🎉 Exciting News: Join our community for exclusive updates and events!</p>
                <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image">
                <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                <button class="sidebar-announcement-dismiss" onclick="dismissAnnouncement()">Dismiss</button>
                </div>
            </div>
            <div class="sidebar">
                <div class="sidebar-announcement-container">
                <p class="sidebar-announcement-text">🎉 Exciting News: Join our community for exclusive updates and events!</p>
                <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image">
                <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                <button class="sidebar-announcement-dismiss" onclick="dismissAnnouncement()">Dismiss</button>
                </div>
            </div>
            <div class="sidebar">
                <div class="sidebar-announcement-container">
                <p class="sidebar-announcement-text">🎉 Exciting News: Join our community for exclusive updates and events!</p>
                <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image">
                <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                <button class="sidebar-announcement-dismiss" onclick="dismissAnnouncement()">Dismiss</button>
                </div>
            </div>
            <div class="sidebar">
                <div class="sidebar-announcement-container">
                <p class="sidebar-announcement-text">🎉 Exciting News: Join our community for exclusive updates and events!</p>
                <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image">
                <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                <button class="sidebar-announcement-dismiss" onclick="dismissAnnouncement()">Dismiss</button>
                </div>
            </div>
            <div class="sidebar">
                <div class="sidebar-announcement-container">
                <p class="sidebar-announcement-text">🎉 Exciting News: Join our community for exclusive updates and events!</p>
                <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image">
                <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                <button class="sidebar-announcement-dismiss" onclick="dismissAnnouncement()">Dismiss</button>
                </div>
            </div>
            <div class="sidebar">
                <div class="sidebar-announcement-container">
                <p class="sidebar-announcement-text">🎉 Exciting News: Join our community for exclusive updates and events!</p>
                <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image">
                <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                <button class="sidebar-announcement-dismiss" onclick="dismissAnnouncement()">Dismiss</button>
                </div>
            </div>
            <div class="sidebar">
                <div class="sidebar-announcement-container">
                <p class="sidebar-announcement-text">🎉 Exciting News: Join our community for exclusive updates and events!</p>
                <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image">
                <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                <button class="sidebar-announcement-dismiss" onclick="dismissAnnouncement()">Dismiss</button>
                </div>
            </div>
        </div>

</div><!--endcontainer-->




<?php include('slide.php')?>    
<?php include('footer.php');?>   

    <!-- All Js -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>


    <script>

        const notification = document.getElementById('notification');
        const closeButton = notification.querySelector('.notification-close');

        // Add a click event listener to the close button
        closeButton.addEventListener('click', function () {
            notification.style.display = 'none';
        });
    </script>
    
    <script>
    // Function to hide the message
    function hideMessage() {
        var messageElement = document.querySelector('.login-message');
        if (messageElement) {
            messageElement.style.display = 'none';
        }
    }

    // Add an event listener to hide the message when the close button is clicked
    document.addEventListener('DOMContentLoaded', function () {
        var closeButton = document.querySelector('.close-button');
        if (closeButton) {
            closeButton.addEventListener('click', hideMessage);
        }

        // Hide the message after a certain time period (e.g., 3 seconds)
        setTimeout(hideMessage, 3000); 
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


    <script>
    // Function to show the cart prompt
    function showCartPrompt() {
        var cartPrompt = document.getElementById('cartPrompt');
        cartPrompt.style.display = 'block';
        return false; 
    }

    // Function to show the wishlist prompt
    function showWishlistPrompt() {
        var wishlistPrompt = document.getElementById('wishlistPrompt');
        wishlistPrompt.style.display = 'block';
        return false; 
    }

    // Close the prompts when the close buttons are clicked
    document.getElementById('closeCartPrompt').addEventListener('click', function() {
        var cartPrompt = document.getElementById('cartPrompt');
        cartPrompt.style.display = 'none';
    });

    document.getElementById('closeWishlistPrompt').addEventListener('click', function() {
        var wishlistPrompt = document.getElementById('wishlistPrompt');
        wishlistPrompt.style.display = 'none';
    });
    </script>
    <script>
        const notification = document.getElementById('notification');
        const closeButton = notification.querySelector('.notification-close');

        // Add a click event listener to the close button
        closeButton.addEventListener('click', function () {
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
    
    <script>
        var loggedIn = "<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>";
    var message = "";

            if (action === 'login') {
                message = "This feature requires you to be logged in. Please log in to access this page.";
            } else if (action === 'wishlist') {
                message = "This feature requires you to be logged in. Please log in to access your wishlist.";
            } else if (action === 'cart') {
                message = "This feature requires you to be logged in. Please log in to access your cart.";
            }
    
            if (loggedIn === 'false') {
            var loginPrompt = document.createElement("div");
            loginPrompt.className = "login-prompt";
            loginPrompt.innerHTML = `
                <div class="login-prompt-content">
                    <h2>Please Log In</h2>
                    <p>${message}</p>
                    <a href="login.php">Log In</a>
                </div>
            `;
            document.body.appendChild(loginPrompt);
            return false; // Prevent the link from navigating
        }
        return true; // Allow the link to navigate
    }
        
    </script>
    
</body>
</html>
