
<!DOCTYPE html>
<html lang="en">
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
    

<!--Desktop View Starts-->
<div class="d-none d-lg-block">
    <style>
        .mlink{
            text-decoration:none;
            color:#fff;
            font-weight:700px;

        }
        .mlink:hover
        {
            color:#e00476;
        }
        .nlink
        {
            font: weight 800px;
        } 
        .circle {
            color: #e00476; 
        }  
        .linkq
        {
            font-weight:800;
            font-size:22px;
            margin-top:20px;
            text-decoration:none;
            color:#000000;
        }
                </style>
<div class="container-fluid text-center" style="background-color:#368BC1;padding-top:20px;padding-bottom:20px;">
  <div class="row">
    <div class="col-1"> <a><img src="img/logo.png" class="logo" alt=""></a></div>
    <div class="col-6"><form action="search.php" method="post">
                <div class="search">
                    <label for="searchInput" class="search-label"></label>
                    <input type="text" id="searchInput" name="search-box" class="search-box" placeholder="Search Brands, Products" maxlength="100" required>
                    <button id="searchButton" class="search-btn"><i class="bi bi-search"></i></button>
                </div>
            </form></div>
    <div class="col-1 text-end"><a href="#" class="mlink"><i class="bi bi-person-fill" ></i>Profile</a></div>
    <div class="col-1 text-end"><a href="#" class="mlink"><i class="bi bi-heart-fill"></i>Wishlist</a></div>
    <div class="col-1 text-end"><a href="#" class="mlink"><i class="bi bi-cart-fill"></i>Cart
    <span id="cartItemCount" class="circle"></span></a></div>
    <div class="col-2 text-start"><a href="#" class="mlink"><i class="bi bi-bell-fill" ></i>Notification</a></div>
  </div>
</div>


<div class="container-fluid text-center">
    
  <div class="row" style="margin-top: 20px">
      
            <div class="col-1"><a href="index.php" class="link">Home</a></div>
            <div class="col-3"><a href="ProductCatalog.php" class="link">Product Catalog</a></div>
            <div class="col-2"><div class="dropdown">
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

            <div class="col-2"><a href="about_us.php" class="link">About Us</a></div>
            <div class="col-2"><a href="contact_us.php" class="link">Contact Us</a></div>
            <div class="col-2"><a href="faq.php" class="link">FAQs</a></div>

  </div>
</div>

</div>
<!--Desktop View ends-->

<!--Mobile Menu Starts-->

<div class="container-fluid text-center d-lg-none" style="background-color: #368BC1;padding-top:10px;padding-bottom:10px;">
      <div class="row">
            <div class="col-2 text-start"> <a href="./"><img src="img/logo.png" style="width:35px; height:35px;" alt=""></a></div>
            <div class="col-8" style="color:#fff; font-size:25px;font-weight:800;">KDQG Shop</div>
            <div class="col-2"><img src="./img/menua.png" class="" style="width:35px;height:35px;" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" /></div> 
      </div>
</div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">
        <a href="./"><img src="img/logo.png" style="width:35px; height:35px;" alt=""></a></h5>
    
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
    <div class="offcanvas-body">
    <div class="container text-start">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
        <div class="col">
        <form action="search.php" method="post">
                        <div class="search" style="width:100%; margin: auto;">
                            <label for="searchInput" class="search-label"></label>
                            <input type="text" id="searchInput" name="search-box" class="search-box" placeholder="Search Brands, Products" maxlength="100" style = "border: 1px solid black; border-radius-top-left: 5px; border-radius-down-left: 5px;" required>
                            <button id="searchButton" class="search-btn"><i class="bi bi-search"></i></button>
                        </div>
                </form>
    </div>
        
        <div class="col"><br/><a href="index.php" class="linkq">Home</a></div> 
    <div class="col"><a href="#" class="linkq"><i class="bi bi-person-fill" ></i>Profile</a></div>
    <div class="col"><a href="#" class="linkq"><i class="bi bi-heart-fill"></i>Wishlist</a></div>
    <div class="col"><a href="#" class="linkq"><i class="bi bi-cart-fill"></i>Cart
    <span id="cartItemCount" class="circle"></span></a></div>
    <div class="col"><a href="#" class="linkq"><i class="bi bi-bell-fill" ></i>Notification</a></div>
    <div class="col"><a href="ProductCatalog.php" class="linkq">Product Catalog</a></div>
    <div class="col">
        <div class="dropdown">
                            <button class="dropbtn">
            
                                    <a href="#" class="linkq">Shop Brands<i class="fa fa-caret-down"></i>
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
            <div class="col"><a href="about_us.php" class="linkq">About Us</a></div>
            <div class="col"><a href="contact_us.php" class="linkq">Contact Us</a></div>
            <div class="col"><a href="faq.php" class="linkq">FAQs</a></div>
           
            </div>
        </div>
       
    
    
        </div>
    </div>
    </div>
</div>
  
  


        </div>
            
             <!-- Mobile Menu ends -->

             
</body>
</html>