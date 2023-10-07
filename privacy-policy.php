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
    <title>Privacy Policy | KDQG</title>
    <!-- All CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="css/privacy_design.css">
</head>

<body>

    <div class="PP-content">
        <h2>King Deo and Queen Grace Privacy Policy</h2>
        <p>Please read the following private policy carefully before using our services.</p>
    </div>

    <main class="privacy-policy">
        <h2>KDQG Online Shop Privacy Policy</h2>
        <hr><p></p>
        <p>This Privacy Policy describes how your personal information is collected, used, and shared when you visit or make a purchase from <a href="1index.php">KDQGonlineshop</a> (the “Site”).</p>
 
        <div class="PP-container">
        <h2>Information We Collect</h2>
        <p>We collect the following types of information when you use our website:</p>
        <ul>
            <li>Personal information such as your name, email address, and contact details.</li>
            <li>Demographic information such as your age, gender, and location.</li>
            <li>Payment information to process transactions.</li>
            <li>Website usage information through cookies and similar technologies.</li>
        </ul>
        </div>
         
        <div class="PP-container">       
        <h2>How We Use Your Information</h2>
        <p>We use the collected information for the following purposes:</p>
        <ul>
            <li>To provide and personalize our services to you.</li>
            <li>To process and fulfill your orders.</li>
            <li>To communicate with you regarding your account and transactions.</li>
            <li>To improve our website and user experience.</li>
            <li>To send you promotional emails and updates (you can opt-out anytime).</li>
        </ul>
        </div>
        
        <div class="PP-container">         
        <h2>How We Protect Your Information</h2>
        <p>We take the security of your information seriously and implement various security measures to protect it:</p>
        <ul>
            <li>Regular monitoring and security patches to prevent unauthorized access.</li>
            <li>Strict access controls to limit access to personal information.</li>
            <li>Securely destroying your personal information when it is no longer needed for any legal or business purpose.</li>
        </ul>
        </div>
 
        <div class="PP-container">       
        <h2>Third-Party Disclosure</h2>
        <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent,
            except as necessary for providing our services or as required by law.</p>
        </div>
        
        <div class="PP-container">
        <h2>Cookie Policy</h2>
        <p>Our website uses cookies to enhance your browsing experience. You can manage your cookie preferences through
            your browser settings.</p>
        </div>
        
        <div class="PP-container">
        <h2>Updates to the Privacy Policy</h2>
        <p>We may update this privacy policy from time to time. We will notify you of any changes by posting the new
            policy on this page.</p>
        </div>
        <p>If you have any questions or concerns about our privacy policy, please <a href="contact_us.php">Contact Us</a>.</p>
    </main>
    
    <?php include 'deals.php'; ?>    
    <?php include 'slide.php'; ?>
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
