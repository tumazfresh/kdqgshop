<?php
include 'dbconn.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

?>


<!DOCTYPE html>
<html>
<head><?php include('header.php')?>
</head>
<head>
    <title>FAQs | KDQG</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="css/faq_design.css">
    <link rel="stylesheet" href="css/header_design.css">
</head>
<body>
    
    
<div class= "d-block d-md-none">    <!-- MOBILE VIEW-->
<div class="faq-header">
<h2>King Deo and Queen Grace 
<br>Frequently Asked Questions (FAQs)</h2>
<p>FAQs "Frequently Asked Questions" is a key part of a knowledge base; it addresses the most common questions customers have</p>
<?php include 'deals.php'; ?>
</div>
<div class="faq-container" style =" padding: 30px; margin: 10px">      
        <div class="faq-item">
            <div class="faq-question">
                <h3 class="question">
                    How do I create an account?</h3>
                    <p> 1. Go to <a href="registration.php">registration</a> in our website.<br></p>
                    <p> 2. Enter your personal details and click the create account button to submit the form.</p> 
                
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <h3 class="question">How to Order?</h3>
                   <p> 1. Browse our products.<br></p> 
                   <p> 2. Add desired items to your cart.<br></p> 
                   <p> 3. Proceed to checkout and provide necessary information.<br></p> 
                   <p> 4. Review your order and confirm.<br></p> 
                   <p> 5. Complete the payment.<br></p> 
                   <p> 6. Receive order confirmation and delivery details.</p> 
                
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <h3 class="question">How do I pay for my orders?</h3>
                   <p> 1. We accept various payment methods including credit/debit card, GCash, Maya, bank transfer, and Cash on Delivery (COD).<br></p>
                   <p> 2. During the checkout process, you can choose your preferred payment option and proceed with the payment.<br></p>
                   <p> 3. If you choose Cash on Delivery (COD) as your payment method, you first need to provide your ID Picture and address for verification.</p>
                
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <h3 class="question">I need support for my purchased product/s</h3>
                   <p> 1. If you require support for your purchased product/s, please contact our customer service team via email or phone.<br></p>
                   <p> 2. Provide detailed information about the issue you're facing, and our support team will assist you as soon as possible.</p>
                
            </div>
        </div>


</div>
</div><!--end edit-->






<div class= "d-none d-sm-block "> <!-- BROWSER VIEW-->
<div class="faq-header">
<h2>King Deo and Queen Grace 
<br>Frequently Asked Questions (FAQs)</h2>
<p>FAQs "Frequently Asked Questions" is a key part of a knowledge base; it addresses the most common questions customers have</p>
</div>
<div class="faq-container" style =" padding: 30px;"> 
        <div class="faq-item">
            <div class="faq-question">
                <h3 class="question">
                    <span class="toggle-sign">+</span>How do I create an account?</h3>
                <div class="answer">1. Go to <a href="registration.php"><span><span>registration</span></span></a> in our website.<br>
                    2. Enter your personal details and click the create account button to submit the form.
                </div>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <h3 class="question">
                    <span class="toggle-sign">+</span>How to Order?</h3>
                <div class="answer">1.Browse our products.<br>
                    2. Add desired items to your cart.<br>
                    3. Proceed to checkout and provide necessary information.<br>
                    4. Review your order and confirm.<br>
                    5. Complete the payment.<br>
                    6. Receive order confirmation and delivery details.
                </div>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <h3 class="question">
                    <span class="toggle-sign">+</span>How do I pay for my orders?</h3>
                <div class="answer">1. We accept various payment methods including credit/debit card, GCash, Maya, bank transfer, and Cash on Delivery (COD).<br>
                    2. During the checkout process, you can choose your preferred payment option and proceed with the payment.
                    3. If you choose Cash on Delivery (COD) as your payment method, you first need to provide your ID Picture and address for verification.
                </div>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <h3 class="question">
                    <span class="toggle-sign">+</span>I need support for my purchased product/s</h3>
                <div class="answer">1. If you require support for your purchased product/s, please contact our customer service team via email or phone.<br>
                    2. Provide detailed information about the issue you're facing, and our support team will assist you as soon as possible.
                </div>
            </div>
        </div>
</div>
<?php include 'deals.php'; ?>
</div><!--end edit-->

    <?php include 'slide.php'; ?>

    <?php include 'footer.php'; ?>
    
    <!-- All Js -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Add a click event listener to toggle the answers
        $('.question').click(function() {
            const answer = $(this).siblings('.answer');
            const sign = $(this).find('.toggle-sign');

            // Toggle the answer's visibility
            answer.slideToggle();

            // Toggle the sign (change + to - or vice versa)
            sign.text(sign.text() === '+' ? '-' : '+');
        });
    </script>



</body>
</html>