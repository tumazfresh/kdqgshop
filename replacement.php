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
    <meta charset="UTF-8">
    <title>Replacement Policy | KDQG</title>
    <link rel="stylesheet" href="css/replacement_design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/header_design.css">
    <script src="script.js"></script>
</head>

<body>
    <div class="replacement-header-content">
        <h2>King Deo and Queen Grace 
        <br>Replacement Policy</h2>
    </div>
    <div class="replacement-container">
                <div class="replacement-policy">
                <div class="product-category">
                    <h3>MI Xiaomi</h3>
                    <p>At King Deo and Queen Grace Online Retail Shop, we offer a replacement policy for all products in MI Xiaomi. This policy is applicable under certain conditions and guidelines as outlined below:</p>
        
                    <h4>Terms and Conditions</h4>
                    <ul>
                        <li>Products must be purchased directly from King Deo and Queen Grace.</li>
                        <li>Products must be in their original condition with all accessories and packaging.</li>
                        <li>Proof of purchase (receipt or order confirmation) is required for replacement.</li>
                        <li>Replacement requests must be made within 30 days of the original purchase date.</li>
                    </ul>
        
                    <h4>Replacement Process</h4>
                    <ol>
                        <li>Contact our customer support team to initiate the replacement request.</li>
                        <li>Provide the necessary details, including the product information, order number, and reason for replacement.</li>
                        <li>Our customer support team will guide you through the next steps and provide further instructions.</li>
                        <li>Once the replacement request is approved, you will be provided with a return shipping label (if applicable).</li>
                        <li>Return the product in its original packaging, including all accessories.</li>
                        <li>Upon receiving the returned product, our team will inspect it for eligibility.</li>
                        <li>If the product meets the replacement criteria, a new product will be shipped to you.</li>
                    </ol>
        
                    <h4 class="areas-of-replacement">Areas of Replacement</h4>
                    <p>We currently offer replacement services for MI Xiaomi products in the following areas:</p>
                    <ul>
                        <li>Quezon City</li>
                        <li>Pasig City</li>
                        <li>Mandaluyong City</li>
                        <li>Taguig City</li>
                    </ul>
                </div>
        
                <div class="product-category">
                    <h3>OPPO</h3>
                    <p>For OPPO products, our replacement policy follows similar guidelines and conditions as the other categories. Please refer to the details below:</p>
        
                    <h4>Terms and Conditions</h4>
                    <ul>
                        <li>Products must be purchased directly from King Deo and Queen Grace.</li>
                        <li>Products must be in their original condition with all accessories and packaging.</li>
                        <li>Proof of purchase (receipt or order confirmation) is required for replacement.</li>
                        <li>Replacement requests must be made within 30 days of the original purchase date.</li>
                    </ul>
        
                    <h4>Replacement Process</h4>
                    <ol>
                        <li>Contact our customer support team to initiate the replacement request.</li>
                        <li>Provide the necessary details, including the product information, order number, and reason for replacement.</li>
                        <li>Our customer support team will guide you through the next steps and provide further instructions.</li>
                        <li>Once the replacement request is approved, you will be provided with a return shipping label (if applicable).</li>
                        <li>Return the product in its original packaging, including all accessories.</li>
                        <li>Upon receiving the returned product, our team will inspect it for eligibility.</li>
                        <li>If the product meets the replacement criteria, a new product will be shipped to you.</li>
                    </ol>
        
                    <h4 class="areas-of-replacement">Areas of Replacement</h4>
                    <p>We currently offer replacement services for OPPO products in the following areas:</p>
                    <ul>
                        <li>Manila</li>
                        <li>Paranaque City</li>
                        <li>Mandaluyong City</li>
                        <li>Quezon City</li>
                    </ul>
                </div>
        
                <div class="product-category">
                    <h3>Realme</h3>
                    <p>For Realme products, our replacement policy follows similar guidelines and conditions as other categories. Please refer to the details below:</p>
        
                <h4>Terms and Conditions</h4>
                    <ul>
                        <li>Products must be purchased directly from King Deo and Queen Grace.</li>
                        <li>Products must be in their original condition with all accessories and packaging.</li>
                        <li>Proof of purchase (receipt or order confirmation) is required for replacement.</li>
                        <li>Replacement requests must be made within 30 days of the original purchase date.</li>
                    </ul>
        
                    <h4>Replacement Process</h4>
                    <ol>
                        <li>Contact our customer support team to initiate the replacement request.</li>
                        <li>Provide the necessary details, including the product information, order number, and reason for replacement.</li>
                        <li>Our customer support team will guide you through the next steps and provide further instructions.</li>
                        <li>Once the replacement request is approved, you will be provided with a return shipping label (if applicable).</li>
                        <li>Return the product in its original packaging, including all accessories.</li>
                        <li>Upon receiving the returned product, our team will inspect it for eligibility.</li>
                        <li>If the product meets the replacement criteria, a new product will be shipped to you.</li>
                    </ol>
        
                    <h4 class="areas-of-replacement">Areas of Replacement</h4>
                    <p>We currently offer replacement services for Realme products in the following areas:</p>
                    <ul>
                        <li>Quezon City</li>
                        <li>Pasig City</li>
                        <li>Makati City</li>
                    </ul>
                </div>
        
                <div class="product-category">
                    <h3>VIVO</h3>
                    <p>For VIVO products, our replacement policy follows similar guidelines and conditions as other categories. Please refer to the details below:</p>
        
                <h4>Terms and Conditions</h4>
                    <ul>
                        <li>Products must be purchased directly from King Deo and Queen Grace.</li>
                        <li>Products must be in their original condition with all accessories and packaging.</li>
                        <li>Proof of purchase (receipt or order confirmation) is required for replacement.</li>
                        <li>Replacement requests must be made within 30 days of the original purchase date.</li>
                    </ul>
        
                    <h4>Replacement Process</h4>
                    <ol>
                        <li>Contact our customer support team to initiate the replacement request.</li>
                        <li>Provide the necessary details, including the product information, order number, and reason for replacement.</li>
                        <li>Our customer support team will guide you through the next steps and provide further instructions.</li>
                        <li>Once the replacement request is approved, you will be provided with a return shipping label (if applicable).</li>
                        <li>Return the product in its original packaging, including all accessories.</li>
                        <li>Upon receiving the returned product, our team will inspect it for eligibility.</li>
                        <li>If the product meets the replacement criteria, a new product will be shipped to you.</li>
                    </ol>
        
                    <h4 class="areas-of-replacement">Areas of Replacement</h4>
                    <p>We currently offer replacement services for VIVO products in the following areas:</p>
                    <ul>
                        <li>Manila</li>
                        <li>Muntinlupa City</li>
                        <li>Mandaluyong City</li>
                    </ul>
                </div>
        
                <div class="product-category">
                    <h3>HP</h3>
                    <p>For HP products, our replacement policy follows similar guidelines and conditions as other categories. Please refer to the details below:</p>
        
                <h4>Terms and Conditions</h4>
                    <ul>
                        <li>Products must be purchased directly from King Deo and Queen Grace.</li>
                        <li>Products must be in their original condition with all accessories and packaging.</li>
                        <li>Proof of purchase (receipt or order confirmation) is required for replacement.</li>
                        <li>Replacement requests must be made within 30 days of the original purchase date.</li>
                    </ul>
        
                    <h4>Replacement Process</h4>
                    <ol>
                        <li>Contact our customer support team to initiate the replacement request.</li>
                        <li>Provide the necessary details, including the product information, order number, and reason for replacement.</li>
                        <li>Our customer support team will guide you through the next steps and provide further instructions.</li>
                        <li>Once the replacement request is approved, you will be provided with a return shipping label (if applicable).</li>
                        <li>Return the product in its original packaging, including all accessories.</li>
                        <li>Upon receiving the returned product, our team will inspect it for eligibility.</li>
                        <li>If the product meets the replacement criteria, a new product will be shipped to you.</li>
                    </ol>
        
                    <h4 class="areas-of-replacement">Areas of Replacement</h4>
                    <p>We currently offer replacement services for HP products in the following areas:</p>
                    <ul>
                        <li>Makati City</li>
                        <li>Mandaluyong City</li>
                    </ul>
                </div>
        
                <div class="product-category">
                    <h3>Samsung</h3>
                    <p>For Samsung products, our replacement policy follows similar guidelines and conditions as other categories. Please refer to the details below:</p>
        
                <h4>Terms and Conditions</h4>
                    <ul>
                        <li>Products must be purchased directly from King Deo and Queen Grace.</li>
                        <li>Products must be in their original condition with all accessories and packaging.</li>
                        <li>Proof of purchase (receipt or order confirmation) is required for replacement.</li>
                        <li>Replacement requests must be made within 30 days of the original purchase date.</li>
                    </ul>
        
                    <h4>Replacement Process</h4>
                    <ol>
                        <li>Contact our customer support team to initiate the replacement request.</li>
                        <li>Provide the necessary details, including the product information, order number, and reason for replacement.</li>
                        <li>Our customer support team will guide you through the next steps and provide further instructions.</li>
                        <li>Once the replacement request is approved, you will be provided with a return shipping label (if applicable).</li>
                        <li>Return the product in its original packaging, including all accessories.</li>
                        <li>Upon receiving the returned product, our team will inspect it for eligibility.</li>
                        <li>If the product meets the replacement criteria, a new product will be shipped to you.</li>
                    </ol>
        
                    <h4 class="areas-of-replacement">Areas of Replacement</h4>
                    <p>We currently offer replacement services for Samsung products in the following areas:</p>
                    <ul>
                        <li>Quezon City</li>
                        <li>Manila</li>
                        <li>Mandaluyong City</li>
                        <li>Makati City</li>
                    </ul>
                </div>
        
                <div class="product-category">
                    <h3>Huawei</h3>
                    <p>For Huawei products, our replacement policy follows similar guidelines and conditions as other categories. Please refer to the details below:</p>
        
                <h4>Terms and Conditions</h4>
                    <ul>
                        <li>Products must be purchased directly from King Deo and Queen Grace.</li>
                        <li>Products must be in their original condition with all accessories and packaging.</li>
                        <li>Proof of purchase (receipt or order confirmation) is required for replacement.</li>
                        <li>Replacement requests must be made within 30 days of the original purchase date.</li>
                    </ul>
        
                    <h4>Replacement Process</h4>
                    <ol>
                        <li>Contact our customer support team to initiate the replacement request.</li>
                        <li>Provide the necessary details, including the product information, order number, and reason for replacement.</li>
                        <li>Our customer support team will guide you through the next steps and provide further instructions.</li>
                        <li>Once the replacement request is approved, you will be provided with a return shipping label (if applicable).</li>
                        <li>Return the product in its original packaging, including all accessories.</li>
                        <li>Upon receiving the returned product, our team will inspect it for eligibility.</li>
                        <li>If the product meets the replacement criteria, a new product will be shipped to you.</li>
                    </ol>
        
                    <h4 class="areas-of-replacement">Areas of Replacement</h4>
                    <p>We currently offer replacement services for Huawei products in the following areas:</p>
                    <ul>
                        <li>Quezon City</li>
                        <li>Manila</li>
                        <li>Mandaluyong City</li>
                        <li>Taguig City</li>
                        <li>Makati City</li>
                    </ul>
                </div>
        
                <div class="product-category">
                    <h3>Infinix</h3>
                    <p>For Infinix products, our replacement policy follows similar guidelines and conditions as other categories. Please refer to the details below:</p>
        
                <h4>Terms and Conditions</h4>
                    <ul>
                        <li>Products must be purchased directly from King Deo and Queen Grace.</li>
                        <li>Products must be in their original condition with all accessories and packaging.</li>
                        <li>Proof of purchase (receipt or order confirmation) is required for replacement.</li>
                        <li>Replacement requests must be made within 30 days of the original purchase date.</li>
                    </ul>
        
                    <h4>Replacement Process</h4>
                    <ol>
                        <li>Contact our customer support team to initiate the replacement request.</li>
                        <li>Provide the necessary details, including the product information, order number, and reason for replacement.</li>
                        <li>Our customer support team will guide you through the next steps and provide further instructions.</li>
                        <li>Once the replacement request is approved, you will be provided with a return shipping label (if applicable).</li>
                        <li>Return the product in its original packaging, including all accessories.</li>
                        <li>Upon receiving the returned product, our team will inspect it for eligibility.</li>
                        <li>If the product meets the replacement criteria, a new product will be shipped to you.</li>
                    </ol>
        
                    <h4 class="areas-of-replacement">Areas of Replacement</h4>
                    <p>We currently offer replacement services for Infinix products in the following areas:</p>
                    <ul>
                        <li>Manila</li>
                        <li>Marikina City</li>
                    </ul>
                </div>
        
                <div class="product-category">
                    <h3>TECNO Mobile</h3>
                    <p>For TECNO Mobile products, our replacement policy follows similar guidelines and conditions as other categories. Please refer to the details below:</p>
        
                <h4>Terms and Conditions</h4>
                    <ul>
                        <li>Products must be purchased directly from King Deo and Queen Grace.</li>
                        <li>Products must be in their original condition with all accessories and packaging.</li>
                        <li>Proof of purchase (receipt or order confirmation) is required for replacement.</li>
                        <li>Replacement requests must be made within 30 days of the original purchase date.</li>
                    </ul>
        
                    <h4>Replacement Process</h4>
                    <ol>
                        <li>Contact our customer support team to initiate the replacement request.</li>
                        <li>Provide the necessary details, including the product information, order number, and reason for replacement.</li>
                        <li>Our customer support team will guide you through the next steps and provide further instructions.</li>
                        <li>Once the replacement request is approved, you will be provided with a return shipping label (if applicable).</li>
                        <li>Return the product in its original packaging, including all accessories.</li>
                        <li>Upon receiving the returned product, our team will inspect it for eligibility.</li>
                        <li>If the product meets the replacement criteria, a new product will be shipped to you.</li>
                    </ol>
        
                    <h4 class="areas-of-replacement">Areas of Replacement</h4>
                    <p>We currently offer replacement services for TECNO Mobile products in the following areas:</p>
                    <ul>
                        <li>Quezon City</li>
                        <li>Marikina City</li>
                        <li>Manila</li>
                    </ul>
                </div>
            </div>
            
            
        <!--    <div class= "d-none d-sm-block "><!--edit
                <div class="container" style =" margin: 0 30px; border-size:1px; box-shadow: 1px 2px 3px 4px rgba(20,20,20,0.4);">
                            <br>
                            <div class="sidebar" style ="margin: auto">
                                <div class="sidebar-announcement-container">
                                <p class="sidebar-announcement-text">🎉 Exciting News: Join our community for exclusive updates and events!</p>
                                <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image" id = "">
                                <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                                <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                                </div>
                            </div>
                            <br>
                            <div class="sidebar" style ="margin: auto">
                                <div class="sidebar-announcement-container">
                                <p class="sidebar-announcement-text">🎉 Ads: Join our community for exclusive updates and events!</p></p>
                                <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image" id = "">
                                <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                                <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                                </div>
                            </div>
                            <br>
                            <div class="sidebar" style ="margin: auto">
                                <div class="sidebar-announcement-container">
                                <p class="sidebar-announcement-text">🎉 Exciting News: Join our community for exclusive updates and events!</p>
                                <img src="img/banner3.jpg" alt="Upcoming Event" class="sidebar-announcement-image">
                                <p class="sidebar-announcement-text">Get ready for an amazing experience with us!</p>
                                <p class="sidebar-announcement-text">Stay connected and be part of our vibrant community.</p>
                                </div>
                            </div>
                            <br>
                </div>
            </div>-->
    
    </div>
    
    <?php include('slide.php');?>   
    <?php include 'footer.php'; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>