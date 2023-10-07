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
<HTML>
<head><?php include('header.php')?>
</head>
<head>
    <title>Branches | KDQG</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="css/branches_design.css">

</head>
<body>
<div class="branch-header">
    <h2>King Deo and Queen Grace 
    <br>Flagship Stores (NCR)</h2>
</div>

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
                    <img src="img/city-light-cubao.jpg" alt="Branch Image">
                </div>
                <div class="branch-info">
                    <h3>City Light Cubao</h3>
                    <p>Location: LGF 005 SM Cubao Araneta Center Socorro Cubao</p>
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
                    <img src="img/glorietta2.jpg" alt="Branch Image">
                </div>
                <div class="branch-info">
                    <h3>Glorietta 2</h3>
                    <p>Location: 3rd Floor, Cyber Zone , Glorietta 2, Makati City</p>
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
    <?php include 'slide.php'; ?>
    
    <?php include 'footer.php'; ?>
    
    <script>
    function showLoginPrompt(type) {
        if (!<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>) {
            alert('Please log in to access ' + type);
            return false; 
        }
    }
</script>
    
</body>
<script>
    const notification = document.getElementById('notification');
    const closeButton = notification.querySelector('.notification-close');

    // Add a click event listener to the close button
    closeButton.addEventListener('click', function () {
        notification.style.display = 'none';
    });
</script>
</html>