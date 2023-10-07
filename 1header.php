<?php

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

    // Initialize notification variables
    $notificationCount = 0;
    $notifications = array();
    
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    
        $notificationQuery = $conn->prepare("SELECT * FROM `tb_notifications` WHERE user_id = ? ORDER BY timestamp DESC LIMIT 5");
        $notificationQuery->execute([$user_id]);
    
        while ($row = $notificationQuery->fetch(PDO::FETCH_ASSOC)) {
            $notifications[] = $row;
        }
    
        $notificationCount = count($notifications);
    
        $notificationMessage = "Your order has been shipped!"; 
        $insertNotificationQuery = $conn->prepare("INSERT INTO `tb_notifications` (user_id, message, timestamp, status) VALUES (?, ?, NOW(), 'unread')");
        $insertNotificationQuery->execute([$user_id, $notificationMessage]);
    }

        $stmt = $conn->prepare("SELECT * FROM tb_wishlist WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $wishlistItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $cart = $conn->prepare("SELECT * FROM tb_cart WHERE user_id = :user_id");
        $cart->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $cart->execute();
        $cartItems = $cart->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION['cartCount'] = count($cartItems);
        $cartCount = $_SESSION['cartCount'];

               if (isset($_SESSION['user_id'])) {
                $_SESSION['wishlistCount'] = count($wishlistItems);
                $_SESSION['cartCount'] = count($cartItems);
            } else {
                $_SESSION['wishlistCount'] = 0; 
                $_SESSION['cartCount'] = 0;
            }
            $wishlistCount = $_SESSION['wishlistCount'];
            $cartCount = $_SESSION['cartCount'];





if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_wishlist'])) {
    if (isset($_SESSION['user_id'])) {
        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];

        // Check if the product is already in the wishlist 
        $check_wishlist_numbers = $conn->prepare("SELECT * FROM `tb_wishlist` WHERE pid = ? AND user_id = ?");
        $check_wishlist_numbers->execute([$pid, $user_id]);

        if ($check_wishlist_numbers->rowCount() > 0) {
            $message = 'Already added to wishlist!';
        } else {
            // Insert the data into the wishlist table
            $insert_wishlist = $conn->prepare("INSERT INTO `tb_wishlist` (user_id, pid, name, price, image) VALUES (?, ?, ?, ?, ?)");
            $insert_wishlist->execute([$user_id, $pid, $name, $price, $image]);
            $_SESSION['item_added_to_wishlist'] = '1';
            $message = 'Added to wishlist!';
        }
    } else {
        
        $message = 'Please log in to add to your wishlist.';
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['user_id'])) {
        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $qty = 1;

        // Check if the product is already in the cart
        $check_cart_numbers = $conn->prepare("SELECT * FROM `tb_cart` WHERE pid = ? AND user_id = ?");
        $check_cart_numbers->execute([$pid, $user_id]);

        if ($check_cart_numbers->rowCount() > 0) {
            $message = 'Already added to cart!';
        } else {
            // Insert the data into the cart table
            $insert_cart = $conn->prepare("INSERT INTO `tb_cart` (user_id, pid, name, price, quantity, image) VALUES (?, ?, ?, ?, ?, ?)");
            $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
            $_SESSION['item_added_to_cart'] = '1';
            $message = 'Added to cart!';
        }

        // Redirect back to the product catalog page with the success message
        header('Location: ' . $_SERVER['PHP_SELF'] . '?message=' . urlencode($message));
        exit();
    } else {
        // Handle the case when the user is not logged in
        $message = 'Please log in to add to your cart.';
    }
}

// Display the success message if it's set
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}



$searchResults = array(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_btn'])) {
    $search_box = '%' . $_POST['search_box'] . '%';
    $stmt = $con->prepare("SELECT p.*, w.price AS wishlist_price FROM `tb_product` p LEFT JOIN `tb_wishlist` w ON p.id = w.pid WHERE p.product_name LIKE :search_box AND p.Stock >= '1' AND p.Status = 'Active'");
    $stmt->bindParam(':search_box', $search_box, PDO::PARAM_STR);
    $stmt->execute();
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
}



// Prompt to login for adding to wishlist
function showWishlistPrompt() {
    echo '<div id="wishlistPrompt" class="modal">';
    echo '<div class="modal-content">';
    echo '<span class="close" id="closeWishlistPrompt">&times;</span>';
    echo '<p>Please log in to add this item to your wishlist.</p>';
    echo '</div>';
    echo '</div>';
}

// Prompt to login for adding to cart
function showCartPrompt() {
    echo '<div id="cartPrompt" class="modal">';
    echo '<div class="modal-content">';
    echo '<span class="close" id="closeCartPrompt">&times;</span>';
    echo '<p>Please log in to add this item to your cart.</p>';
    echo '</div>';
    echo '</div>';
}
?>




<!DOCTYPE html>
<html lang="en">
    <script>
        function performSearch(query) {
            if (query.trim() !== "") {
                window.location.href = `product_catalog.php?query=${encodeURIComponent(query)}`;
            }
        }

        // Add an event listener to the search button
        document.getElementById("searchButton").addEventListener("click", function() {
            var searchInput = document.getElementById("searchInput");
            performSearch(searchInput.value);
        });

        // Add an event listener to the Enter key in the search input
        document.getElementById("searchInput").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                performSearch(event.target.value);
            }
        });
</script>
<!--divinectorweb.com-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- All CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="script.js"></script>

</head>
<body>
    
<?php if (!empty($message)): ?>
            <div class="login-message">
                <?php echo $message; ?>
            </div>
      <?php endif; ?>


<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>w
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>


    <nav class="navbar navbar-expand-lg navbar-light" style: "background: #368BC1;">
        <div class="container">
          <a><img src="img/logo.png" class="logo" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-10 mb-lg-0">


                 
            <!-- Search Form -->
            <form action="search.php" method="post">
                <div class="search">
                    <label for="searchInput" class="search-label"></label>
                    <input type="text" id="searchInput" name="search-box" class="search-box" placeholder="Search Brands, Products" maxlength="100" required>
                    <button id="searchButton" class="search-btn"><i class="bi bi-search"></i></button>
                </div>
            </form>
            
            
              <li class="nav-item">
                <!-- login -->
                <div class="nav-icons">
                    <div class="nav-icon">
                        <?php if (isset($_SESSION['user_id'])) { ?>
                            <div class="login-dropdown">
                                <a href="#" class="login-dropbtn">
                                    <a class="nav-link"><i class="bi bi-person-fill" ></i>Profile</a>
                                </a>
                                <div class="login-dropdown-content">
                                    <a href="account_profile.php">
                                        <i class="fas fa-user"></i> Account Profile
                                    </a>
                                    <a href="user_logout.php">
                                        <i class="fas fa-sign-out-alt" onclick="return confirm('Logout from the website?');"></i> Logout
                                    </a>
                                </div>
                            </div>
                        <?php } else { ?>
                            <a href="login.php" onclick="return showLoginPromptLogin();" class="nav-link"><i class="bi bi-person-fill" ></i>Login</a>   
                        <?php } ?>
                    </div>
              </li>
              
        <li class="nav-item">
            <!-- wishlist icon marker -->
            <div class="nav-icon">
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <a class="nav-link" href="wishlist.php?user_id=<?= urlencode($user_id); ?>">
                        <i class="bi bi-heart-fill"></i>Wishlist
                        <?php if ($wishlistCount > 0): ?>
                        <span class="icon-count"><?= $wishlistCount; ?></span>
                        <?php endif; ?>
                    </a>
                <?php } else { ?>
                    <a class="nav-link" href="#" onclick="return showLoginPrompt('wishlist');">
                        <i class="bi bi-heart-fill"></i>Wishlist
                        <span class="icon-count"><?= $wishlistCount; ?></span>
                    </a>
                <?php } ?>
            </div>
        </li>

                <!-- cart icon marker -->
                <div class="nav-icon">
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <a class="nav-link" href="cart.php?user_id=<?= urlencode($user_id); ?>">
                            <i class="bi bi-cart-fill"></i>Cart
                            <?php if ($wishlistCount > 0): ?>
                            <span class="icon-count"><?= $cartCount; ?></span>
                            <?php endif; ?>
                        </a>
                    <?php } else { ?>
                        <a class="nav-link" href="#" onclick="return showLoginPrompt('cart');">
                            <i class="bi bi-cart-fill"></i>Cart
                            <span class="icon-count"><?= $cartCount; ?></span>
                        </a>
                    <?php } ?>
                </div>
            </li>
              
              
    <li class="nav-item">
                    <div class="notification-icon">
                        <a href="#">
                            <a class="nav-link" href="#"><i class="bi bi-bell-fill" ></i>Notification</a>
                        </a>
                        <div class="notification-badge"><?= $notificationCount; ?></div>
                        <div class="notification-dropdown">
                            <div class="notification-content">
                                <h3 class="notification-title">New Notifications</h3>
                                <ul class="notification-list">
                                    <?php foreach ($notifications as $notification): ?>
                                        <li class="notification-item <?php echo $notification['status'] === 'unread' ? 'unread' : ''; ?>">
                                            <div class="notification-item-header">
                                                <span class="notification-item-time"><?= $notification['timestamp']; ?></span>
                                                </a>
                                            </div>
                                            <div class="notification-item-message">
                                                <?= $notification['message']; ?>
                                            </div>
                                            <?php if ($notification['status'] === 'unread'): ?>
                                                <a href="#" class="mark-read-btn">Mark as Read</a>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <a href="#" class="notification-link" onclick="expandNotificationDropdown();">View All</a>
                            </div>
                        </div>
                    </div>
              </li>
              
    <div class="custom-notification" id="notification">
                <div class="notification-content">
                    <h3 class="notification-title">New Message</h3>
                    <p class="notification-message">You have received a new message.</p>
                </div>
                <button class="notification-close">Close</button>
            </div> 

        </div>
              
            </ul>

      </nav>

<div class="container text-center">
  <div class="row row-cols-1 row-cols-sm-3 row-cols-md-6" style="margin-top: 20px">
            <div class="col"><a href="index.php" class="link">Home</a></div>
            <div class="col"><a href="ProductCatalog.php" class="link">Product Catalog</a></div>
            <div class="col"><div class="dropdown">
                <button class="dropbtn">

                        <a href="#" class="link">Shop Brands<i class="fa fa-caret-down"></i>
                        </a>

                </button>
                <div class="dropdown-content">
                <a href="brands.php?brand=Apple">
                <img src="img/apple.png" alt=""> Apple
                </a>
                
                <a href="brands.php?brand=Xiaomi">
                <img src="img/xiaomi.png" alt=""> MI Xiaomi
                </a>
                
                <a href="brands.php?brand=Oppo">
                <img src="img/oppo.png" alt=""> Oppo
                </a>
                
                <a href="brands.php?brand=RealMe">
                <img src="img/realme.png" alt=""> Realme
                </a>
                
                <a href="brands.php?brand=Vivo">
                <img src="img/vivo.png" alt=""> Vivo
                </a>
                
                <a href="brands.php?brand=Itel">
                <img src="img/itel.png" alt=""> Itel
                </a>
                
                <a href="brands.php?brand=DELL">
                <img src="img/dell.png" alt=""> DELL
                </a>
                
                <a href="brands.php?brand=Lenovo">
                <img src="img/lenovo.png" alt=""> Lenovo
                </a>
                
                <a href="brands.php?brand=ACER">
                <img src="img/acer.png" alt=""> ACER
                </a>
                
                <a href="brands.php?brand=HP">
                <img src="img/hp.png" alt=""> HP
                </a>
                
                <a href="brands.php?brand=MSI">
                <img src="img/msi.png" alt=""> MSI
                </a>
                
                <a href="brands.php?brand=Samsung">
                <img src="img/samsung.png" alt=""> Samsung
                </a>
                
                <a href="brands.php?brand=Huawei">
                <img src="img/huawei.png" alt=""> Huawei
                </a>
                
                <a href="brands.php?brand=Infinix"> 
                <img src="img/infinix.png" alt=""> Infinix
                </a>
                
                <a href="brands.php?brand=Poco">
                <img src="img/poco1.png" alt=""> Poco
                </a>
                
                <a href="brands.php?brand=TECNO%Mobile">
                <img src="img/tecno.png" alt=""> TECNO Mobile
                </a>
                </div>
            </div>
            </div>

            <div class="col"><a href="about_us.php" class="link">About Us</a></div>
            <div class="col"><a href="contact_us.php" class="link">Contact Us</a></div>
            <div class="col"><a href="faq.php" class="link">FAQs</a></div>

  </div>
</div>

<script>
        function performSearch(query) {
            if (query.trim() !== "") {
                window.location.href = `product_catalog.php?query=${encodeURIComponent(query)}`;
            }
        }

        // Add an event listener to the search button
        document.getElementById("searchButton").addEventListener("click", function() {
            var searchInput = document.getElementById("searchInput");
            performSearch(searchInput.value);
        });

        // Add an event listener to the Enter key in the search input
        document.getElementById("searchInput").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                performSearch(event.target.value);
            }
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
        return true; 
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