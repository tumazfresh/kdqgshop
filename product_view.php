<?php
include 'dbconn.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

$isOutOfStock = false;

$pid = $_GET["pid"];
$getData = mysqli_query($db, "SELECT * FROM tb_product WHERE `id`='$pid' ");
$row = mysqli_fetch_assoc($getData);
?>
<!DOCTYPE html>
<html lang="en">

<head><?php include('header.php') ?>
</head>

<head>

    <title> Product View | KDQG</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link href="product_view.css" rel="stylesheet">
</head>

<body>

    <div class="d-none d-sm-block"> <!-- WEB VIEW-->
        <div class="heading">
            <h2>PRODUCT VIEWhello</h2>
        </div>
        <!-- Product View -->
        <div class="product-container"><!--container-->
            <section class="quick-view">

                <?php
                include "dbconn.php";
                $pid = $_GET['pid'];
                $z = 0;
                $select_products = $conn->prepare("SELECT * FROM `tb_product` WHERE id = ?");
                $select_products->execute([$pid]);
                if ($select_products->rowCount() > 0) {
                    while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                        $z = $z + 1;
                ?>
                        <form action="Checkout.php" method="post" class="box">
                            <input type="hidden" name="user_id" value="1">
                            <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                            <input type="hidden" name="name" value="<?= $fetch_product['product_name']; ?>">
                            <input type="hidden" name="price" value="<?= $fetch_product['Price']; ?>">
                            <input type="hidden" name="image01" value="<?= $fetch_product['image_01']; ?>">
                            <div class="product-view">
                                <div class="image-container">
                                    <div class="main-image">
                                        <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                                        <button class="slide-btn prev-btn" onclick="prevMainImage()">&#10094;</button>
                                        <button class="slide-btn next-btn" onclick="nextMainImage()">&#10095;</button>
                                    </div>

                                    <div class="sub-image">
                                        <div class="sub-image-item">
                                            <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" onclick="currentSlide(1)">
                                        </div>
                                        <div class="sub-image-item">
                                            <img src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="" onclick="currentSlide(2)">
                                        </div>
                                        <div class="sub-image-item">
                                            <img src="uploaded_img/<?= $fetch_product['image_03']; ?>" alt="" onclick="currentSlide(3)">
                                        </div>
                                    </div>
                                </div>

                                <div id="myModal01" class="modal">
                                    <span class="close closeimg01" data-modal="myModal01">&times;</span>
                                    <img class="modal-content" id="img01">
                                    <button class="close-modal-btn" onclick="closeModal('myModal01')">&times;</button>
                                </div>

                                <div id="myModal02" class="modal">
                                    <span class="close closeimg02" data-modal="myModal02">&times;</span>
                                    <img class="modal-content" id="img02">
                                    <button class="close-modal-btn" onclick="closeModal('myModal02')">&times;</button>
                                </div>

                                <div id="myModal03" class="modal">
                                    <span class="close closeimg03" data-modal="myModal03">&times;</span>
                                    <img class="modal-content" id="img03">
                                    <button class="close-modal-btn" onclick="closeModal('myModal03')">&times;</button>
                                </div>

                                <!-- Main image modal -->
                                <div id="myModalMain" class="modal">
                                    <span class="close closeimgMain" data-modal="myModalMain">&times;</span>
                                    <img class="modal-content" id="imgMain">
                                    <button class="close-modal-btn" onclick="closeModal('myModalMain')">&times;</button>
                                    <button class="slide-btn prev-btn" data-modal="myModalMain" onclick="plusSlides(-1, 'myModalMain')">&#10094;</button>
                                    <button class="slide-btn next-btn" data-modal="myModalMain" onclick="plusSlides(1, 'myModalMain')">&#10095;</button>

                                    <div class="zoom-btn-container">
                                        <button class="zoom-btn zoom-in-btn" onclick="zoomImage(1)">+</button>
                                        <button class="zoom-btn zoom-out-btn" onclick="zoomImage(-1)">-</button>
                                    </div>


                                    <div class="sub-images-container" style ="border: red 1px solid;">
                                        <!-- Update data-modal attributes to match the main modal's ID -->
                                        <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" data-modal="myModalMain">
                                        <img src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="" data-modal="myModalMain">
                                        <img src="uploaded_img/<?= $fetch_product['image_03']; ?>" alt="" data-modal="myModalMain">
                                        
                                    </div>
                                </div>


                                <div class="description-container">
                                    <div class="productdescription-box">
                                        <div class="product-rating">
                                            <span class="star">&#9733;</span>
                                            <span class="star">&#9733;</span>
                                            <span class="star">&#9733;</span>
                                            <span class="star">&#9733;</span>
                                            <span class="star">&#9734;</span>
                                            <span class="rating-count">(245)</span>
                                        </div>
                                        <div class="viewers-count">
                                            <p><i class="fas fa-eye"></i> <span id="viewers"></span> Customers are viewing this product </p>
                                        </div>
                                        <h2><?= $fetch_product['product_name']; ?></h2>

                                        <div class="available-delivery-contaner">

                                            <?php
                                            include "dbconn.php";

                                            $select_stocks = $conn->prepare("SELECT Branch, Stock FROM `tb_product` WHERE id = ?");
                                            $select_stocks->execute([$pid]);

                                            if ($select_stocks->rowCount() > 0) {
                                                while ($fetch_stocks = $select_stocks->fetch(PDO::FETCH_ASSOC)) {

                                                    $branchName = $fetch_stocks['Branch'];
                                                    $stock = $fetch_stocks['Stock'];

                                                    // Determine stock status based on some threshold (e.g., 5 units)
                                                    $stockStatus = ($stock >= 5) ? "High Stock" : "Low Stock";

                                                    // Determine text color based on stock status
                                                    $textColor = ($stockStatus === "High Stock") ? "green" : "red";

                                                    // Check if the product is out of stock
                                                    if ($stock === 0) {
                                                        $isOutOfStock = true; // Set $isOutOfStock to true if the product is out of stock
                                                    }

                                                    // Output branch information with styling
                                                    echo '<div style="color: ' . $textColor . ';">• KDQG ' . $branchName . ': ' . $stockStatus . ' (' . $stock . ')</div>';
                                                }
                                            } else {
                                                // If no rows were found, assume the product is out of stock
                                                $isOutOfStock = true; // Set $isOutOfStock to true if no stock information is available
                                            }
                                            ?>

                                        </div>

                                        <p class="product-path"> Home / Product Category / Product View</p>

                                        <div class="product-reviewmini">

                                            <div class="product-review-box">
                                                <p class="stock-status <?= $fetch_product['Stock'] > 0 ? 'stock-in' : 'stock-out'; ?>">
                                                    <?= $fetch_product['Stock'] > 0 ? 'In Stock' : 'Out of Stock'; ?>
                                                <h3 class="selling-price">₱<?= number_format($fetch_product['Price'], 2); ?></h3>
                                                <p class="product_stock">Stock: <?= $fetch_product['Stock']; ?></p>
                                                </p>

                                                <div class="product-variant">
                                                    <?php
                                                    $serializedColor = $fetch_product['color'];
                                                    $serializedMemory = $fetch_product['memory'];

                                                if ($serializedColor != "" && $serializedMemory != "") {

                                                    $unserializedColor = unserialize($serializedColor);
                                                    $unserializedMemory = unserialize($serializedMemory);


                                                    if (is_array($unserializedColor) && is_array($unserializedMemory)) {
                                                        $count = count($unserializedColor);

                                                    ?>
                                                        <select name="color_and_memory" class="dropdown">
                                                            <option value="">Available Variants</option>
                                                            <?php
                                                            for ($i = 0; $i < $count; $i++) {
                                                                $color = $unserializedColor[$i];
                                                                $memory = $unserializedMemory[$i];
                                                            ?>
                                                                <option value="<?php echo $color . ' ' . $memory; ?>"><?php echo $color . ' ' . $memory; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    <?php
                                                    } else {

                                                        echo "No color and memory data found.";
                                                    }
                                                } else {
                                                    echo "No variants available.";
                                                }
                                                    ?>

                                                </div>


                                                <div class="quantity-container">
                                                    <div class="quantity-input">
                                                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?= $fetch_product['Stock']; ?>">
                                                    </div>

                                                    <div class="quantity-btns">
                                                        <button class="quantity-btn" type="button" onclick="decreaseQuantity()">-</button>
                                                        <button class="quantity-btn" type="button" onclick="increaseQuantity()">+</button>


                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="product-reviewbtn">
                                            <?php if (!$isOutOfStock) : ?>
                                                <button type="submit" name="add_to_cart" class="add-to-cart-btn" onclick="return showLoginPrompt();">
                                                    Add to cart <i class="fas fa-shopping-cart"></i>
                                                </button>
                                                <button type="submit" name="add_to_wishlist" class="add-to-wishlist-btn" onclick="return showLoginPrompt();">
                                                    Add to wishlist <i class="fas fa-heart"></i>
                                                </button>
                                                <button type="submit" name="proceed_to_checkout" class="proceed-to-checkout-btn" onclick="return showLoginPrompt();">
                                                    Proceed to Checkout <i class="fas fa-arrow-circle-right"></i>
                                                </button>
                                            <?php else : ?>
                                                <p class="out-of-stock-message">Out of Stock</p>
                                            <?php endif; ?>
                                        </div>

                                    </div>
            </section>
            <br /><br /><br />
            <h1>Related Products</h1>
            <div class="container-spec">

                <div class="review_slider-container">
                    <div class="review_slider-brand">
                        <div class="review_slide-track">
                            <?php
                            $slider = mysqli_query($db, "SELECT * FROM tb_product ORDER BY RAND() LIMIT 15");
                            if (mysqli_num_rows($slider) > 0) {
                                $i = 0;
                                while ($prds = mysqli_fetch_array($slider)) {
                            ?>
                                    <div class="review_slide-brand">
                                        <a href="product_view.php?pid=<?php echo $prds['id']; ?>">
                                            <?php echo "<img src='./uploaded_img/" . $prds['image_01'] . "' width='100%'/>"; ?></a>
                                    </div>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo "No product yet";
                            }
                            ?>
                        </div>

                    </div>
                </div>

            </div>
            


            <div class="container">
                <h1 class="mt-5 mb-5">SPECIFICATION</h1>
            </div>
            <div class="card">
                <table>
                    <tr>
                        <td class="td_leftspacing">Product Name</td>
                        <td class="td_rightspacing">
                            <pre><?php echo $row['product_name']; ?>
</pre>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_leftspacing">Thickness</td>
                        <td class="td_rightspacing">
                            <pre>234g, 8.9mm</pre>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_leftspacing">Speed</td>
                        <td class="td_rightspacing">
                            <pre>SM / CDMA / HSPA / EVDO / LTE / 5G</pre>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_leftspacing">Dimensions</td>
                        <td class="td_rightspacing">
                            <pre>163.4 x 78.1 x 8.9 mm (6.43 x 3.07 x 0.35 in)</pre>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_leftspacing">SIM</td>
                        <td class="td_rightspacing">
                            <pre>
Nano-SIM and eSIM or Dual SIM (2 Nano-SIMs and eSIM, dual stand-by)	
IP68 dust/water resistant (up to 1.5m for 30 min)
Armor aluminum frame with tougher drop and scratch resistance (advertised)
Stylus (Bluetooth integration, accelerometer, gyro)
</pre>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_leftspacing">Type</td>
                        <td class="td_rightspacing">
                            <pre>Dynamic AMOLED 2X, 120Hz, HDR10+, 1200 nits (HBM), 1750 nits (peak)</pre>
                        </td>
                    </tr>
                </table>
            </div>





    <?php
                    }
                } else {
                    echo '<p class="empty">no products added yet!</p>';
                }
    ?>
    
                <div class="container">
                <h1 class="mt-5 mb-5">PRODUCT RATINGS</h1>
                <div class="card">
                    <div class="card-header">Reviews</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <h1 class="text-warning mt-4 mb-4">
                                    <?php

                                    $pid = $row['id'];
                                    $revsql = "SELECT SUM(rating) AS total FROM tb_feedback WHERE pid=$pid";
                                    $allrev = $db->query($revsql);

                                    $totalreview = "SELECT count(*) FROM tb_feedback WHERE pid=$pid";
                                    $resultreview = $db->query($totalreview);
                                    while ($rev = mysqli_fetch_array($resultreview)) {
                                        if ($allrev->num_rows > 0) {
                                            $tarev = $allrev->fetch_assoc();


                                    ?>
                                            <b><span id="average_rating">
                                                    <?php
                                                    $calt = $rev['count(*)'];
                                                    $recalt = $tarev['total'];
                                                    $newcal = $recalt / $calt;
                                                    $newcall = number_format($newcal, 1);
                                                    echo $newcall;  ?></span> / 5</b>
                                </h1>
                                <div class="mb-3">
                                    <?php
                                            if ($newcal == 5) { ?>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <?php
                                            } else if ($newcal >= 4) {
                                    ?>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <?php

                                            } else if ($newcal >= 3) {
                                    ?>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <?php

                                            } else if ($newcal >= 2) {
                                    ?>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <?php

                                            } else if ($newcal >= 3) {
                                    ?>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <?php

                                            } else if ($newcal >= 1) {
                                    ?>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <?php

                                            } else if ($newcal <= 1) {
                                    ?>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <?php

                                            } else {
                                                echo "No Rating";
                                            }
                                    ?>

                                </div>
                                <h3><span id="total_review"><?php echo $rev['count(*)']; ?></span> Review</h3>
                        <?php
                                        } else {
                                            echo "No Review";
                                        }
                                    }
                        ?>
                            </div>
                            <div class="col-sm-4">
                                <p>
                                <div class="progress-label-left"><b>5</b>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                </div>

                                <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                </div>
                                </p>

                                <p>
                                <div class="progress-label-left"><b>4</b>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                </div>

                                <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>3</b>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                </div>

                                <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>2</b>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                </div>

                                <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>1</b>
                                    <i class="fas fa-star text-warning"></i>
                                </div>

                                <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5" id="review_content"></div>
            </div>

        </div><!--endcontainer-->
    </div><!--end edit-->


    <?php include 'deals.php'; ?>
    <?php include 'slide.php'; ?>
    <?php include 'footer.php'; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
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


<script>
    var currentMainSlideIndex = 1; // Initialize the slide index for the main image

    // Attach click event handlers to the sub-images in the sub-image container
    var subImageContainerSubImages = document.querySelectorAll(".sub-image-item img");
    subImageContainerSubImages.forEach(function(subImg) {
        subImg.addEventListener("click", function() {
            showSubImageInMainImage(subImg.src);
        });
    });

    // Function to show the clicked sub-image in the main image of the image container
    function showSubImageInMainImage(imgSrc) {
        var mainImage = document.querySelector(".image-container .main-image img");
        mainImage.src = imgSrc;
    }

    // Function to update the main image in the main modal with the clicked sub-image
    function updateMainImageInMainModal(imgSrc) {
        var modal = document.getElementById("myModalMain");
        var mainImage = modal.querySelector(".modal-content");
        mainImage.src = imgSrc;
    }

    // Attach click event handlers to the sub-images in the main modal
    var mainModalSubImages = document.querySelectorAll("#myModalMain .sub-images-container img");
    mainModalSubImages.forEach(function(subImg, index) {
        subImg.addEventListener("click", function() {
            updateMainImageInMainModal(subImg.src);
            updateMainModalSubImages(subImg.src); // Update the sub-images
            showSlides(index + 1, "myModalMain"); // Update the slide index and show the corresponding slide
        });
    });

    // Function to update the sub-images in the main modal based on the clicked sub-image
    function updateMainModalSubImages(selectedImgSrc) {
        var mainModalSubImages = document.querySelectorAll("#myModalMain .sub-images-container img");
        mainModalSubImages.forEach(function(subImg) {
            subImg.classList.remove("active");
            if (subImg.src === selectedImgSrc) {
                subImg.classList.add("active");
            }
        });
    }

    // Function to open a modal and show the specified image
    function openModal(modalId, imgSrc) {
        var modal = document.getElementById(modalId);
        var modalImg = modal.querySelector(".modal-content");
        modalImg.src = imgSrc;
        modal.style.display = "block";
    }

    // Function to close a modal
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    // Function to update sub-images and main image in the main modal
    function updateMainModalImages(modalId, slideIndex) {
        var modal = document.getElementById(modalId);
        var modalImages = modal.querySelectorAll(".sub-images-container img");
        var mainImage = modal.querySelector(".modal-content");

        if (slideIndex > modalImages.length) {
            slideIndex = 1;
        } else if (slideIndex < 1) {
            slideIndex = modalImages.length;
        }

        mainImage.src = modalImages[slideIndex - 1].src;
    }

    // Attach click event handlers to the sub-images in the main modal
    var mainModalSubImages = document.querySelectorAll("#myModalMain .sub-images-container img");
    mainModalSubImages.forEach(function(subImg, index) {
        subImg.addEventListener("click", function() {
            openModal("myModalMain", subImg.src);
            updateMainModalImages("myModalMain", index + 1);
        });
    });

    // Attach click event handlers to the slide buttons within the main modal
    var mainModalSlideButtons = document.querySelectorAll("#myModalMain .slide-btn");
    mainModalSlideButtons.forEach(function(slideBtn) {
        slideBtn.addEventListener("click", function() {
            var modalId = slideBtn.getAttribute("data-modal");
            var slideDirection = slideBtn.classList.contains("prev-btn") ? -1 : 1;
            var currentSlideIndex = slideIndexes[modalId] || 1;
            var newSlideIndex = currentSlideIndex + slideDirection;
            updateMainModalImages(modalId, newSlideIndex);
            slideIndexes[modalId] = newSlideIndex;
        });
    });

    // Attach click event handlers to the main image
    var mainImage = document.querySelector(".main-image img");
    mainImage.addEventListener("click", function() {
        openModal("myModalMain", this.src);
        updateMainModalImages("myModalMain", 1);
    });

    // Initialize slide indexes for various modals
    var slideIndexes = {};

    // Function to show the specified slide in a modal
    function showSlide(slideIndex, modalId) {
        var slides = document.querySelectorAll("." + modalId + " .slide");
        if (slideIndex > slides.length) {
            slideIndex = 1;
        } else if (slideIndex < 1) {
            slideIndex = slides.length;
        }
        for (var i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[slideIndex - 1].style.display = "block";
        slideIndexes[modalId] = slideIndex;
    }


    // Attach click event handler to the main image
    var mainImage = document.querySelector(".main-image img");
    mainImage.addEventListener("click", function() {
        openModalMain(this.src);
        showSlides(1, "myModalMain");
    });

    // Attach click event handlers to the sub-images
    var subImages = document.querySelectorAll(".sub-image-item img");
    subImages.forEach(function(subImg, index) {
        subImg.dataset.modal = "myModal" + (index + 1);
        subImg.addEventListener("click", function() {
            openModal(subImg.dataset.modal, subImg.src);
            showSlides(1, subImg.dataset.modal);
        });
    });


    // Function to open the modal and set the initial slide index
    function openModal(modalId, imgSrc) {
        var modal = document.getElementById(modalId);
        var modalImg = modal.querySelector(".modal-content");
        modalImg.src = imgSrc;
        slideIndexes[modalId] = 1;
        modal.style.display = "block";
    }

    // Function to close the modal
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    // Function to update the main image and sub-images based on the current slide index
    function updateImages(modalId, slideIndex) {
        var modal = document.getElementById(modalId);
        var modalImg = modal.querySelector(".modal-content");
        var subImages = modal.querySelectorAll(".sub-images-container img");

        // Handle circular looping of slide indexes
        if (slideIndex > subImages.length) {
            slideIndex = 1;
        } else if (slideIndex < 1) {
            slideIndex = subImages.length;
        }

        modalImg.src = subImages[slideIndex - 1].src;

        // Update main image in the main modal
        updateMainImage(modalId, slideIndex);
    }

    // Attach click event handlers to the sub-images in the image container
    var imageContainerSubImages = document.querySelectorAll(".image-container .sub-image-item img");
    imageContainerSubImages.forEach(function(subImg, index) {
        subImg.dataset.modal = "imageContainerModal" + (index + 1);
        subImg.addEventListener("click", function() {
            openModal(subImg.dataset.modal, subImg.src);
            updateImages(subImg.dataset.modal, 1);
        });
    });

    // Attach click event handlers to the slide buttons within the sub-image modals
    var imageContainerSlideButtons = document.querySelectorAll(".image-container .slide-btn");
    imageContainerSlideButtons.forEach(function(slideBtn) {
        var modalId = slideBtn.getAttribute("data-modal");
        slideBtn.addEventListener("click", function() {
            var slideDirection = slideBtn.classList.contains("prev-btn") ? -1 : 1;
            var slideIndex = slideIndexes[modalId] || 1;
            slideIndex += slideDirection;
            updateImages(modalId, slideIndex); // Update main image in sub-image modal
        });
    });

    // Function to update the main image based on the current sub-image
    function updateMainImage(modalId, slideIndex) {
        var mainImage = document.querySelector(".main-image img");
        var subImage = document.querySelector("." + modalId + " img");
        if (mainImage && subImage) {
            mainImage.src = subImage.src;
        }

        showSlides(slideIndex, modalId); // Show the corresponding review slide
    }

    // Function to show the current slide and activate corresponding modal in the main image
    function showSlides(slideIndex, modalId) {
        var reviewSlides = document.querySelectorAll(".main-image");
        var subImageModals = document.querySelectorAll(".sub-image");

        if (slideIndex > reviewSlides.length) {
            slideIndex = 1;
        }
        if (slideIndex < 1) {
            slideIndex = reviewSlides.length;
        }
        for (var i = 0; i < reviewSlides.length; i++) {
            reviewSlides[i].style.display = "none";
        }
        for (var i = 0; i < subImageModals.length; i++) {
            subImageModals[i].classList.remove("active");
        }
        reviewSlides[slideIndex - 1].style.display = "block";
        subImageModals[slideIndex - 1].classList.add("active");
    }

    // Initialize slide index for the main image in the image container
    var imageContainerMainSlideIndex = 1;

    // Function to change the main image in the image container to the previous image
    function prevImageContainerMainImage() {
        showImageContainerMainImage(imageContainerMainSlideIndex -= 1);
    }

    // Function to change the main image in the image container to the next image
    function nextImageContainerMainImage() {
        showImageContainerMainImage(imageContainerMainSlideIndex += 1);
    }

    // Attach click event handlers to the slide buttons for the main image in the image container
    var imageContainerMainPrevBtn = document.querySelector(".image-container .prev-btn");
    var imageContainerMainNextBtn = document.querySelector(".image-container .next-btn");

    imageContainerMainPrevBtn.addEventListener("click", prevImageContainerMainImage);
    imageContainerMainNextBtn.addEventListener("click", nextImageContainerMainImage);

    // Function to show a specific image in the main image in the image container
    function showImageContainerMainImage(n) {
        var images = document.querySelectorAll(".image-container .sub-image-item img");
        var mainImage = document.querySelector(".image-container .main-image img");

        if (n < 1) {
            imageContainerMainSlideIndex = images.length;
        } else if (n > images.length) {
            imageContainerMainSlideIndex = 1;
        }

        mainImage.src = images[imageContainerMainSlideIndex - 1].src;
    }

    // Function to zoom in or zoom out the main modal image
    function zoomImage(direction) {
        var modal = document.getElementById("myModalMain");
        var modalContent = modal.querySelector(".modal-content");
        var currentZoom = parseFloat(modalContent.style.transform.replace("scale(", "").replace(")", "")) || 1;
        var newZoom = currentZoom + direction * 0.1;

        // Limit zoom level to a reasonable range
        if (newZoom > 0.1 && newZoom < 3) {
            modalContent.style.transform = "scale(" + newZoom + ")";
        }
    }

    // Attach click event handlers to the zoom buttons
    var zoomInBtn = document.querySelector(".zoom-in-btn");
    var zoomOutBtn = document.querySelector(".zoom-out-btn");

    zoomInBtn.addEventListener("click", function() {
        zoomImage(1);
    });

    zoomOutBtn.addEventListener("click", function() {
        zoomImage(-1);
    });

    // Function to show the slide buttons
    function showSlideButtons() {
        var slideButtons = document.querySelectorAll(".main-image .slide-btn");
        slideButtons.forEach(function(btn) {
            btn.style.opacity = 1;
        });
    }

    // Function to hide the slide buttons
    function hideSlideButtons() {
        var slideButtons = document.querySelectorAll(".main-image .slide-btn");
        slideButtons.forEach(function(btn) {
            btn.style.opacity = 0;
        });
    }

    // Attach mouseover and mouseout event handlers to the main image
    var mainImageContainer = document.querySelector(".main-image");
    mainImageContainer.addEventListener("mouseover", showSlideButtons);
    mainImageContainer.addEventListener("mouseout", hideSlideButtons);


    function decreaseQuantity() {
        var quantityInput = document.getElementById('quantity');
        var currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    }

    function increaseQuantity() {
        var quantityInput = document.getElementById('quantity');
        var currentValue = parseInt(quantityInput.value);
        var maxStock = parseInt(quantityInput.max);
        if (currentValue < maxStock && currentValue < 10) {
            quantityInput.value = currentValue + 1;
        } else if (currentValue >= 10) {
            alert('Maximum quantity limit reached (10 items)');
        } else if (currentValue >= maxStock) {
            alert('Maximum stock limit reached');
        }
    }

    function updateViewersCount() {
        var viewersElement = document.getElementById('viewers');

        // Debug: Log the request being sent
        console.log('Sending AJAX request to get_viewers_count.php');

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_viewers_count.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                // Debug: Log the response received
                console.log('Received AJAX response:', xhr.responseText);

                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    viewersElement.textContent = response.viewersCount;
                } else {
                    // Debug: Log any errors
                    console.error('Error while fetching viewers count:', xhr.status, xhr.statusText);
                }
            }
        };
        xhr.send();
    }

    // Debug: Log the initial call
    console.log('Setting interval for updating viewers count');

    // Update the viewers count every 5 seconds
    setInterval(updateViewersCount, 5000);

    function showLoginPromptLogin() {
        var loggedIn = "<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>";
        var message = "This feature requires you to be logged in. Please log in to access this page.";

        if (loggedIn === 'false') {
            var loginPrompt = document.createElement("div");
            loginPrompt.className = "login-prompt";
            loginPrompt.innerHTML = `
                <div class="login-prompt-content">
                    <h2>Please Log In</h2>
                    <p>${message}</p>
                    <a href="login.com.php">Log In</a>
                </div>
            `;
            document.body.appendChild(loginPrompt);
            return false; // Prevent the link from navigating
        }
        return true; // Allow the link to navigate
    }

    function showLoginPrompt(forCart) {
        var loggedIn = "<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>";
        var message = forCart ? "This feature requires you to be logged in. Please log in to access your cart." :
            "This feature requires you to be logged in. Please log in to access your wishlist.";

        if (loggedIn === 'false') {
            var loginPrompt = document.createElement("div");
            loginPrompt.className = "login-prompt";
            loginPrompt.innerHTML = `
                <div class="login-prompt-content">
                    <h2>Please Log In</h2>
                    <p>${message}</p>
                    <a href="login.com.php">Log In</a>
                </div>
            `;
            document.body.appendChild(loginPrompt);
            return false; // Prevent the link from navigating
        }
        return true; // Allow the link to navigate
    }

    function showLoginPrompt() {
        var loggedIn = "<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>";
        if (loggedIn === 'false') {
            var loginPrompt = document.createElement("div");
            loginPrompt.className = "login-prompt";
            loginPrompt.innerHTML = `
                <div class="login-prompt-content">
                    <h2>Please Log In</h2>
                    <p>This feature requires you to be logged in. Please log in to continue.</p>
                    <a href="login.com.php">Log In</a>
                </div>
            `;
            document.body.appendChild(loginPrompt);
            return false; // Prevent the link from navigating
        }
        return true; // Allow the link to navigate
    }
</script>


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
    let slideIndex = 0;
    showSlides();

    function showSlides() { //slideshow
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        setTimeout(showSlides, 2000); // Change image every 2 seconds
    }

    document.addEventListener("DOMContentLoaded", function() {
        const colorSelect = document.getElementById("color");
        const memorySelect = document.getElementById("memory");
        const mainImage = document.querySelector(".main-image img");

        colorSelect.addEventListener("change", updateProductImage);
        memorySelect.addEventListener("change", updateProductImage);

        function updateProductImage() {
            const selectedColor = colorSelect.value;
            const selectedMemory = memorySelect.value;

            // Construct the URL for the product image based on color and memory
            const imageURL = `uploaded_img/${selectedColor}_${selectedMemory}.png`;

            // Update the main product image
            mainImage.src = imageURL;
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Select elements
        const colorSelect = document.getElementById("color");
        const memorySelect = document.getElementById("memory");

        fetch('variants.php')
            .then(response => response.json())
            .then(options => {
                // Populate Color select element
                options.color.forEach(color => {
                    const option = document.createElement("option");
                    option.value = color;
                    option.textContent = color;
                    colorSelect.appendChild(option);
                });

                // Populate Memory select element
                options.memory.forEach(memory => {
                    const option = document.createElement("option");
                    option.value = memory;
                    option.textContent = memory;
                    memorySelect.appendChild(option);
                });
            })
            .catch(error => console.error("Error fetching options: ", error));
    });
</script>


</html>