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
    <title>Welcome Page | KDQG</title>
    <!-- All CSS -->
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="css/index_design.css"> 
</head>

<body>        
    <div class="slide">
        <img class="mySlides" src="img/slide.png" width="100%" height="100%" onclick="currentSlide(1)">
        <img class="mySlides" src="img/slide4.png" width="100%" height="100%">
        <img class="mySlides" src="img/slide5.png" width="100%" height="100%">
        <img class="mySlides" src="img/slide6.png" width="100%" height="100%">
            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
                <span class="dot" onclick="currentSlide(4)"></span>
            </div>
    </div>
    
<?php include('slide.php')?>  

<section class="home-sub-header">
    <div class="sub-header" >
        <div class="PCC"> 
            <h2>Products | KDQG </h2>
            <p>A Shop You Can Trust 100% Legit Smart Phones,Tablets & Accessories Establish year 2018</p>
            <br><br>
            <div class="deals-container"><?php include 'deals.php'; ?></div> 
            
            <div style ="display: flex;">
                <div class="col-lg-8 col-sm-12 col-md-8"> 
                    <div class="container-catalog"><!--container-catalog-->
                        <div class="bottom-adjuster"><!--bottom-->
                            <div class="panel-product"><!--product-->
                            <?php
                                $select_products = $conn->prepare("SELECT p.*, p.price AS wishlist_price FROM `tb_product` p LEFT JOIN `tb_wishlist` w ON p.id = w.pid ORDER BY RAND() LIMIT 20;");
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
                                                <input type="submit" class="add-to-cart" data-id="<?= $fetch_product['id']; ?>" value="Add to Cart" >
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
                                <div class="see-more"><a href="ProductCatalog.php" class="readmore"><button>View More Products</button></a></div>
                        </div><!--endbottom-->
                    </div><!--endcatalog-->
                </div> 
                            
                            
                <div class="col-lg-4 col-sm-12 col-md-4"> 
                <!-- Announcement -->
                    <div class= "d-none d-sm-block " style ="margin: auto; border-size:1px; box-shadow: 1px 2px 3px 4px rgba(20,20,20,0.4);"><!--edit-->
                        <br>
                            <div class="sidebar" style ="margin: auto">
                                <div class="sidebar-announcement-container">
                                    <p class="sidebar-announcement-text">ðŸŽ‰ Exciting News: Join our community for exclusive updates and events!</p>
                                    <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image" id = "">
                                    <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                                    <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                                </div>
                            </div>
                        <br>
                            <div class="sidebar" style ="margin: auto">
                                <div class="sidebar-announcement-container">
                                    <p class="sidebar-announcement-text">ðŸŽ‰ Ads: Join our community for exclusive updates and events!</p></p>
                                    <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image" id = "">
                                    <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                                    <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                                </div>
                            </div>
                        <br>
                            <div class="sidebar" style ="margin: auto">
                                <div class="sidebar-announcement-container">
                                    <p class="sidebar-announcement-text">ðŸŽ‰ Exciting News: Join our community for exclusive updates and events!</p>
                                    <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image">
                                    <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                                    <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                                </div>
                            </div>
                                    
                        <section class="home-sub-header">
                            <div class="sub-header">
                            </br></br>
                            <h2>Branches | KDQG</h2>
                            <p>Visit us in our Main Branch and Flagship Stores. For more details click "Read More" below.</p>
                            <br>
                            <br>           
                                <div class="container">
                                    <div class="branches">
                                        <div class="branch-card">
                                            <div class="branch-image">
                                                <img src="img/main-branch.jpg" alt="Branch Image">
                                            </div>
                                            <div class="branch-info">
                                                <h3>Main Branch Roosevelt Munoz</h3>
                                                <p>Location: Road 8, corner Rd 13, Project 6, Quezon City, 1105</p>
                                                <p>Opening Hours: Mon - Sat, 8:00 am - 9:30 pm</p>
                                                <p class="contact">Contact: (+63)915-112-3222</p>
                                            </div>
                                        </div>
                                        <div class="branch-card">
                                            <div class="branch-image">
                                                <img src="img/city-light-fishermall.jpg" alt="Branch Image">
                                            </div>
                                            <div class="branch-info">
                                                <h3>Fisher Mall Quezon City</h3>
                                                <p>Location: 4th Floor, L2 FisherMall #42 Gen. Lim Street Quezon Ave.</p>
                                                <p>Opening Hours: Mon - Sat, 8:00 am - 9:30 pm</p>
                                                <p class="contact">Contact: (+63)915-112-3222</p>
                                            </div>
                                        </div>
                                        <div class="branch-card">
                                            <div class="branch-image">
                                                <img src="img/megamall.jpg" alt="Branch Image">
                                            </div>
                                            <div class="branch-info">
                                                <h3>SM Megamall</h3>
                                                <p>Location: SM Mega Mall, Julia Vargas Avenue Mandaluyong City</p>
                                                <p>Opening Hours: Mon - Sat, 8:00 am - 9:30 pm</p>
                                                <p class="contact">Contact: (+63)915-112-3222</p>
                                            </div>
                                        </div>
                                        <div class="branch-card">
                                            <div class="branch-image">
                                                <img src="img/sm-north-annex.jpg" alt="Branch Image">
                                            </div>
                                            <div class="branch-info">
                                                <h3>SM North Annex</h3>
                                                <p>Location: 5th Floor, SM North EDSA Annex, Bagong Bantay North Ave.</p>
                                                <p>Opening Hours: Mon - Sat, 8:00 am - 9:30 pm</p>
                                                <p class="contact">Contact: (+63)915-112-3222</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </br></br>
                                <div class="see-more"><a href="branches.php" class="readmore"><button>Read More</button></a></div>
                            </div>
                        </section>
                                    
                        <section class="home-header">
                            <div class="sub-header">
                            <h2>FAQ | KDQG </h2>
                            <p>"Frequently Asked Questions" is a key part of a knowledge base; it addresses the most common questions customers have.</p>
                                <div class="faq-container">
                                    <h2>Frequently Asked Questions (FAQs)</h2>
                                    <div class="faq-item">
                                        <div class="faq-question">
                                            <h3 class="question">
                                            <span class="toggle-sign"></span>How do I create an account?</h3>
                                        </div>
                                    </div>
                                    <div class="faq-item">
                                        <div class="faq-question">
                                            <h3 class="question">
                                            <span class="toggle-sign"></span>How to Order?</h3>
                                        </div>
                                    </div>
                                    <div class="faq-item">
                                        <div class="faq-question">
                                            <h3 class="question">
                                            <span class="toggle-sign"></span>How do I pay for my orders?</h3>
                                        </div>
                                    </div>
                                    <div class="faq-item">
                                        <div class="faq-question">
                                        <h3 class="question">
                                        <span class="toggle-sign" ></span>I need support for my purchased product/s</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="see-more"><a href="faq.php" class="readmore"><button>Read More</button></a></div>
                        </section>
                                    
                        <section class="home-sub-header">
                            <div class="sub-header">
                                <h2>Contact us | KDQG</h2>
                                <p>Visit us in our Main Branch and Flagship Stores. For more details click "Read More" below.</p>
                                <br><br>           
                            <div class="container">
                                <div class="branches">
                                    <div class="contact">
                                        <div class="contact-card">
                                            <div class="contact-image">
                                                <div class="icon1"><i class="bi bi-geo-alt-fill"></i></div>
                                            </div>
                                            <div class="contact-info">
                                                <div class="text">
                                                    <h3 id="address">Address</h3>
                                                    <p id="add">327 Roosevelt Ave, Quezon City, Metro Manila, Philippines</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="contact-card">
                                            <div class="contact-image">
                                                <div class="icon1"><i class="bi bi-telephone-fill"></i></div>
                                            </div>
                                            <div class="contact-info">
                                                <h3 id="phone">Phone Number</h3>
                                                <p id="phone-num">0915 112 3222</p>
                                            </div>
                                        </div>
                                        <div class="contact-card">
                                            <div class="contact-image">
                                                <div class="icon1"><i class="bi bi-envelope-fill"></i></div>
                                            </div>
                                            <div class="contact-info">
                                                <h3 id="email">Email</h3>
                                                <p id="email-add">deograciaslasacajr@gmail.com</p>
                                            </div>
                                        </div>
                                        <div class="contact-card">
                                            <div class="contact-image">
                                                <div class="icon1"><i class="bi bi-clock-fill"></i></div>
                                            </div>
                                            <div class="contact-info">
                                                <h3 id="time">Time</h3>
                                                <p id="day-time">Mon - Fri 8:00 am to 9:30 pm</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </br></br>
                                    <div class="see-more"><a href="contact_us.php" class="readmore"><button>Read More</button></a></div>
                            </div>
                        </section>
                    </div> 
                </div> 
                   
            </div>  
        </div>
    </div>
</section> 

<div class= "d-flex d-md-none"><!--MOBILE VIEW--> 
    <section class="home-sub-header">
        <div class="sub-header">
            </br></br>
            <h2>Branches | KDQG</h2>
            <p>Visit us in our Main Branch and Flagship Stores. For more details click "Read More" below.</p>
            <br><br>           
            <div class="container">
                <div class="branches">
                    <div class="branch-card">
                        <div class="branch-image">
                            <img src="img/main-branch.jpg" alt="Branch Image">
                        </div>
                        <div class="branch-info">
                            <h3>Main Branch Roosevelt Munoz</h3>
                            <p>Location: Road 8, corner Rd 13, Project 6, Quezon City, 1105</p>
                            <p>Opening Hours: Mon - Sat, 8:00 am - 9:30 pm</p>
                            <p class="contact">Contact: (+63)915-112-3222</p>
                        </div>
                    </div>
                    <div class="branch-card">
                        <div class="branch-image">
                            <img src="img/city-light-fishermall.jpg" alt="Branch Image">
                        </div>
                        <div class="branch-info">
                            <h3>Fisher Mall Quezon City</h3>
                            <p>Location: 4th Floor, L2 FisherMall #42 Gen. Lim Street Quezon Ave.</p>
                            <p>Opening Hours: Mon - Sat, 8:00 am - 9:30 pm</p>
                            <p class="contact">Contact: (+63)915-112-3222</p>
                        </div>
                    </div>
                    <div class="branch-card">
                        <div class="branch-image">
                            <img src="img/megamall.jpg" alt="Branch Image">
                        </div>
                        <div class="branch-info">
                            <h3>SM Megamall</h3>
                            <p>Location: SM Mega Mall, Julia Vargas Avenue Mandaluyong City</p>
                            <p>Opening Hours: Mon - Sat, 8:00 am - 9:30 pm</p>
                            <p class="contact">Contact: (+63)915-112-3222</p>
                        </div>
                    </div>
                    <div class="branch-card">
                        <div class="branch-image">
                            <img src="img/sm-north-annex.jpg" alt="Branch Image">
                        </div>
                        <div class="branch-info">
                            <h3>SM North Annex</h3>
                            <p>Location: 5th Floor, SM North EDSA Annex, Bagong Bantay North Ave.</p>
                            <p>Opening Hours: Mon - Sat, 8:00 am - 9:30 pm</p>
                            <p class="contact">Contact: (+63)915-112-3222</p>
                        </div>
                    </div>
                </div>
            </div>
        </br></br>
            <div class="see-more"><a href="branches.php" class="readmore"><button>Read More</button></a></div>
        </div>
    </section>
</div>        

<div class= "d-flex d-md-none"><!--MOBILE VIEW-->   
    <div class="home-sub-container">
        <section class="home-header">
            <div class="sub-header">
            <h2>FAQ | KDQG </h2>
            <p>"Frequently Asked Questions" is a key part of a knowledge base; it addresses the most common questions customers have.</p>
                <div class="faq-container">
                <h2>Frequently Asked Questions (FAQs)</h2>
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3 class="question">
                            <span class="toggle-sign"></span>How do I create an account?</h3>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3 class="question">
                            <span class="toggle-sign"></span>How to Order?</h3>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3 class="question">
                            <span class="toggle-sign"></span>How do I pay for my orders?</h3>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3 class="question">
                            <span class="toggle-sign" ></span>I need support for my purchased product/s</h3>
                        </div>
                    </div>
                </div>
            </div>
                <div class="see-more"><a href="faq.php" class="readmore"><button>Read More</button></a></div>
        </section>
    </div>
</div><!--end edit-->  

<div class= "d-flex d-md-none"><!--MOBILE VIEW-->    
    <div class="PCC">
        <section class="home-sub-header">
        <div class="sub-header">
        <h2>Contact us | KDQG</h2>
        <p>Visit us in our Main Branch and Flagship Stores. For more details click "Read More" below.</p>
        <br><br>           
            <div class="container">
                <div class="branches">
                    <div class="contact">
                        <div class="contact-card">
                            <div class="contact-image">
                                <div class="icon1"><i class="bi bi-geo-alt-fill"></i></div>
                            </div>
                            <div class="contact-info">
                                <div class="text">
                                    <h3 id="address">Address</h3>
                                    <p id="add">327 Roosevelt Ave, Quezon City, Metro Manila, Philippines</p>
                                </div>
                            </div>
                        </div>
                        <div class="contact-card">
                            <div class="contact-image">
                                <div class="icon1"><i class="bi bi-telephone-fill"></i></div>
                            </div>
                            <div class="contact-info">
                                <h3 id="phone">Phone Number</h3>
                                <p id="phone-num">0915 112 3222</p>
                            </div>
                        </div>
                        <div class="contact-card">
                            <div class="contact-image">
                                <div class="icon1"><i class="bi bi-envelope-fill"></i></div>
                            </div>
                            <div class="contact-info">
                                <h3 id="email">Email</h3>
                                <p id="email-add">deograciaslasacajr@gmail.com</p>
                            </div>
                        </div>
                        <div class="contact-card">
                            <div class="contact-image">
                                <div class="icon1"><i class="bi bi-clock-fill"></i></div>
                            </div>
                            <div class="contact-info">
                                <h3 id="time">Time</h3>
                                <p id="day-time">Mon - Fri 8:00 am to 9:30 pm</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </br></br>
            <div class="see-more"><a href="contact_us.php" class="readmore"><button>Read More</button></a></div>
        </div>
        </section>
    </div>
</div><!--end edit-->

<div class="home-container">
    <section class="home-header">
        <div class="sub-header">
        <h2>KDQG About Us</h2>
        <p>This contains information about the timelines of King Deo Queen Grace Shop, a renowned online retailer.</p>
        <br>
            <div class="container-about-us">
                <div class="about-sections">
                    <div class="contact">
                        <div class="contact-card">
                            <div class="contact-image" style="margin: auto;">
                                <img src="img/company-image-1.png" alt="">
                                <img src="img/company-image.jpg" alt="">
                                <img src="img/company-image-1.png" alt="">
                            </div>
                        </div>
                        <div class="contact-card">
                            <div class="contact-image">
                                <div class="about-sections">
                                    <div class="about-content">
                                        <h2>Our History</h2>
                                        <p>The King Deo and Queen Grace Online Retail Shop started in 2018, prior to the global pandemic that swept across the globe.....</p>
                                    </div>
                                    <div class="about-content">
                                        <h2>Our Goal</h2>
                                        <p>Our aim has consistently been to offer technology that is affordable, dependable, and of high quality to all individuals. Our unwavering.....</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>
        </br></br>
        <div class="see-more"><a href="about_us.php" class="readmore"><button>Read More</button></a></div>
        </div>
    </section>
</div>   

<button class="open-button" onclick="openForm()"><i class="bi bi-chat-dots-fill fa-2x"></i></button>

<div class="chat-popup" id="chatpop">
    <?php if (isset($_SESSION['user_id'])) { ?>
        <form class="chat-container">
            <button type="button" class="cancel" onclick="closeForm()"><i class="bi bi-x-circle-fill fa-lg" style="color: #828282;"></i></button>
            <h3 class ="header-chatpop" >Chat with KDQG</h3>
            <a href="chatbox.php"><button type="button" class="chatbtn" style="background-color: #006AFF">Chat Us</button></a>
        </form>
    
    <?php } else { ?>
        <form class="chat-container">
            <button type="button" class="cancel" onclick="closeForm()"><i class="bi bi-x-circle-fill fa-lg" style="color: #828282;"></i></button>
            <h3 class ="header-chatpop" >Chat with KDQG</h3>
            <a href="login.php"><button type="button" class="chatbtn" style="background-color: #006AFF">Login to Chat</button></a>
            <a href="https://www.facebook.com/profile.php?id=100063481463428"><button type="button" class="chatbtn" style="background-color: #363636">Visit us in Facebook</button></a>
        </form>
    <?php } ?>
</div>

<?php include('slide.php');?>     
<?php include('footer.php');?>   

<!-- All Js -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
<script>
    $(document).ready(function()
    {
        $('.add-to-cart').click(function()
        {
            var productID = $(this).data('id'); 
            $.ajax(
                {
                    type: "POST",
                    url: "addtocart.php",
                    data: { id: productID },
                    success: function()
                    {
                        alert('Product Added to cart');
                    }
                });
        });
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
</script>

<script>
    document.querySelector('.announcement-dismiss').addEventListener('click', function() {
        const announcementContainer = document.querySelector('.announcement-container');
        announcementContainer.style.display = 'none';
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
function openForm() {
    document.getElementById("chatpop").style.display = "block";
}

function closeForm() {
    document.getElementById("chatpop").style.display = "none";
}
</script>

</body>
</html>
