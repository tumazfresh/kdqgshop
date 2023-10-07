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
<head><?php include('header.php')?>
</head>
<head>
    <title>About Us | KDQG</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="css/about_design.css">
</head>

<body>
<div class= "d-block d-md-none">    <!-- MOBILE VIEW-->
<div class="about-header-content">
            <h2>About King Deo and Queen Grace</h2>
            <p>King Deo and Queen Grace is a renowned online retailer shop that offers a wide range of products to customers.</p>
        </div>

    <div class="about-section" style="border-bottom: none;">
        <div class="about-content">
            
        <div class="about-image" style="margin-bottom: 50px">
            <img src="img/company-image-1.png" alt="">
            <img src="img/company-image.jpg" alt="">
            <img src="img/company-image-1.png" alt="">
        </div>
        
            <h2>Our History</h2>
            <p  style="text-align:justify;">The King Deo and Queen Grace Online Retail Shop started in 2018, prior to the global pandemic that swept across the globe. Our business started with a focus on accessories, specifically catering to the burgeoning demand for tempered glass and protective cases. During that period, the business operations were located solely in SM North. At that stage, the expansion of our brand had yet to materialize, with no other branches yet.</p>

            <h2>Our Goal</h2>
            <p style="text-align:justify;">Our aim has consistently been to offer technology that is affordable, dependable, and of high quality to all individuals. Our unwavering focus and determination continue to grow, as we remain steadfast in our commitment to becoming the premier technology provider for every Filipino family. Our dedication to this mission has only strengthened over time, as evidenced by our expansion and success in the retail industry. We strive to be the preferred technology partner for every individual in the Philippines, ensuring that our products meet the needs and expectations of our customers while remaining accessible and reliable.</p>
        </div>
    </div>

</div><!--end edit-->






<div class= "d-none d-sm-block "> <!-- BROWSER VIEW-->
<div class="about-header-content">
            <h2>About King Deo and Queen Grace</h2>
            <p>King Deo and Queen Grace is a renowned online retailer shop that offers a wide range of products to customers.</p>
        </div>
<div class="container">
    <div class="about-section">
        <div class="about-content">
            <h2>Our History</h2>
            <p>The King Deo and Queen Grace Online Retail Shop started in 2018, prior to the global pandemic that swept across the globe. Our business started with a focus on accessories, specifically catering to the burgeoning demand for tempered glass and protective cases. During that period, the business operations were located solely in SM North. At that stage, the expansion of our brand had yet to materialize, with no other branches yet.</p>
        </div>
        <div class="about-image">
            <img src="img/company-image.jpg" alt="">
        </div>
    </div>
    <div class="about-section">
        <div class="about-image">
            <img src="img/company-image-1.png" alt="">
        </div>
        <div class="about-content">
            <h2>Our Goal</h2>
            <p>Our aim has consistently been to offer technology that is affordable, dependable, and of high quality to all individuals. Our unwavering focus and determination continue to grow, as we remain steadfast in our commitment to becoming the premier technology provider for every Filipino family. Our dedication to this mission has only strengthened over time, as evidenced by our expansion and success in the retail industry. We strive to be the preferred technology partner for every individual in the Philippines, ensuring that our products meet the needs and expectations of our customers while remaining accessible and reliable.</p>
        </div>
    </div>
</div>
</div><!--end edit-->

    <?php include 'deals.php'; ?>
    <?php include 'slide.php'; ?>
    <?php include 'footer.php'; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    
</body>
</html>
