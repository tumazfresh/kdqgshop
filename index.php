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
<div style="background-color:#e4f2fb;padding-top:30px;">
<div class="container text-center">
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
    <div class="col"><h2>Products | KDQG </h2></div>
    <div class="col"><p>A Shop You Can Trust 100% Legit Smart Phones,Tablets & Accessories Establish year 2018</p>
            </div>
    <div class="col"><?php include 'deals.php'; ?></div>
    <div class="col" style="padding-top:40px;padding-bottom:40px;"><h1>Latest Products</h1></div>
            
  </div>
</div>


<div class="container text-center">
  <div class="row">
    <div class="col-lg-8 col-sm-12 col-md-8"><?php include('indext.php'); ?></div>
    <div class="col-lg-4 col-sm-12 col-md-4"><?php include('sidebar.php'); ?></div>
    
  </div>
</div>

</div>

    <div class="container text-center" style="padding-top:30px;padding-bottom:40px;margin-top:40px;">
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
    <div class="col"><h2>KDQG About Us</h2></div>
    <div class="col"><p>This contains information about the timelines of King Deo Queen Grace Shop, a renowned online retailer.</p></div>
     
  </div>
</div>

<div class="container text-center" style="padding-top:40px;padding-bottom:40px;">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
    <div class="col">  
                                <img src="img/company-image.jpg" alt="" style="width:100%;border-radius:0px 50px 50px 0px;"> </div>
    <div class="col" style="padding-top:50px;">
     <h2>Our History</h2>
                                        <p>The King Deo and Queen Grace Online Retail Shop started in 2018, prior to the global pandemic that swept across the globe.....</p>
                                    
                                        <h2>Our Goal</h2>
                                        <p>Our aim has consistently been to offer technology that is affordable, dependable, and of high quality to all individuals. Our unwavering.....</p>
                                  
                                  <a href="about_us.php" style="text-decoration:none;"><button class="btn btn-primary" style="border-radius:20px;width:40%;margin-left:auto;margin-right:auto;background-color:#0d6efd;">Read More</button></a>
                                  </div>
                                   
  </div>
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
        
    function updateCartItemCount() {
        $.ajax({
            type: 'GET',
            url: 'cartcount.php',
            success: function(data) {
                $('#cartItemCount').text(data);
            }
        });
    }

    // Call the function on page load
    updateCartItemCount();

        $('.add-to-car').click(function()
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
                
        updateCartItemCount();
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


