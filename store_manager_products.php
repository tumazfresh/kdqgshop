<?php
include("dbconn.php");

// Check if the user is not logged in and redirect to login page
if (!isset($_SESSION['id'])) {
    header('Location: store_manager_login.php');
    exit();
}

if (isset($_SESSION['id'])) {
    $branch = $_SESSION['branch'];
    //echo $branch;
} else {
    header('store_manager_login.php');
}
$message = [];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$managerCredentials = array(
    'manager1@gmail.com' => array('password' => 'managerbranch1', 'branch' => 'Munoz'),
    'manager2@gmail.com' => array('password' => 'managerbranch2', 'branch' => 'Cubao'),
    'manager3@gmail.com' => array('password' => 'managerbranch3', 'branch' => 'QuezonCity'),
    'manager4@gmail.com' => array('password' => 'managerbranch4', 'branch' => 'Glorietta'),
    'manager5@gmail.com' => array('password' => 'managerbranch5', 'branch' => 'SMMegamall'),
    'manager6@gmail.com' => array('password' => 'managerbranch6', 'branch' => 'SMNorthAnnex'),
);

if (isset($_POST['submit'])) {
    $inputEmail = strtolower(trim($_POST['email']));
    $inputPassword = trim($_POST['password']);

    if (isset($managerCredentials[$inputEmail]) && $inputPassword === $managerCredentials[$inputEmail]) {

        // Set the login time and insert into the database
        $loginTime = date('Y-m-d H:i:s');
       

        header("location: store_manager_dashboard.php");
        exit();
    } else {
        $message['password'] = 'Invalid email or password. Please try again.';
    }
}

if (isset($_GET['logout']) && isset($_SESSION['id'])) {
    // Get the current time for logout
    $logoutTime = date('Y-m-d H:i:s');

    // Update the database with logout time and status
    $updateQuery = "UPDATE tb_manager SET logout_time = :logout_time, status = 'inactive' WHERE id = :id";
    $updateStatement = $conn->prepare($updateQuery);
    $updateStatement->bindValue(':logout_time', $logoutTime, PDO::PARAM_STR);
    $updateStatement->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
    $updateSuccess = $updateStatement->execute();

    if ($updateSuccess) {
        // Destroy the session
        session_destroy();

        // Redirect to login page
        header("location: store_manager_login.php");
        exit();
    } else {
        // Handle database update error
        // You might want to display an error message here
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Store Manager Products</title>
    <link rel="stylesheet" href="store_manager_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/alertify.min.js"></script>

</head>

<body>
<div class="add-products-menubar">
        <h1><img src="img/logo.png" alt="Logo" class="logo-img"> KING DEO AND QUEEN GRACE STORE MANAGER INVENTORY - <?php echo strtoupper($branch); ?> BRANCH</h1>
    <div class="login-logout">
        <?php

        
        if (isset($_SESSION['id'])) {
            echo '<a href="store_manager_dashboard.php"><i class="fas fa-user"></i> Store Manager</a>';
            echo '<a href="?logout=1"><i class="fas fa-sign-out-alt"></i> Logout</a>';
        } else {
            echo '<a href="store_manager_login.php"><i class="fas fa-user"></i> Store Manager</a>';
            echo '<a href=""><i class="fas fa-sign-out-alt"></i> Logout</a>';
        }
        
        if (isset($_GET['logout'])) {
            session_destroy();
            header("location: store_manager_login.php");
            exit();
        }
        ?>
    </div>
</div>
<div class="add-products-container">
    <div class="add-products-sidebar">
        <ul>
            <li><a href="store_manager_dashboard.php" class="active"><i class="fas fa-home"></i><span class="label">Dashboard</span></a></li>
            <li><a href="store_manager_users.php"><i class="fas fa-users"></i><span class="label">Users</span></a></li>
            <li><a href="store_manager_productstest.php" class="active"><i class="fas fa-cube"></i><span class="label">Products</span></a></li>
            <li><a href="store_manager_inventory.php" class="active"><i class="fas fa-archive"></i><span class="label">Inventory</span></a></li>
            <li><a href="store_manager_analytics.php"><i class="fas fa-chart-bar"></i><span class="label">Analytics</span></a></li>
            <li><a href="store_manager_feedback.php"><i class="fas fa-star"></i><span class="label">Rating and Review</span></a></li>
            <li><a href="store_manager_messages.php"><i class="fas fa-envelope"></i><span class="label">Messages</span></a></li>
            <li><a href="store_manager_orders.php"><i class="fas fa-shopping-cart"></i><span class="label">Orders</span></a></li>
            <li><a href="store_manager_reports.php"><i class="fas fa-file-alt"></i><span class="label">Sales Reports</span></a></li>
            <li><a href="store_manager_announcements.php"><i class="fas fa-bullhorn"></i><span class="label">Announcements</span></a></li>
            <li><a href="store_manager_chatbox.php"><i class="fas fa-comments"></i><span class="label">Chatbox</span></a></li>
            <li><a href="store_manager_settings.php"><i class="fas fa-cogs"></i><span class="label">Settings</span></a></li>
        </ul>
    </div>



    <!-- Add Product -->
    <div class="modal fade" id="productAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD PRODUCT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="alertMessage" class="alert d-none"></div>

            <form id="saveProduct" action="#" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="errorMessage" class="alert alert-warning d-none">All fields are mandatory.</div>
                    <div class="mb-3">
                        <label for="">Brand</label>
                        <select name="brand" class="form-control" required>
                        <option value="">Select Brand</option>
                        <option value="Apple">Apple</option>
                        <option value="Xiaomi">Xiaomi</option>
                        <option value="OPPO">OPPO</option>
                        <option value="RealMe">RealMe</option>
                        <option value="Vivo">Vivo</option>
                        <option value="Itel">Itel</option>
                        <option value="HP">HP</option>
                        <option value="Samsung">Samsung</option>
                        <option value="Huawei">Huawei</option>
                        <option value="TECNO Mobile">TECNO Mobile</option>
                        <option value="ACER">ACER</option>
                        <option value="Lenovo">Lenovo</option>
                        <option value="DELL">DELL</option>
                        <option value="MSI">MSI</option>
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Category</label>
                        <select name="category" class="form-control" required>
                        <option value="">Select Category</option>
                        <option value="Smartphone">Smartphone</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Accessories">Accessories</option>
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="">SubCategory (Accessories)</label>
                        <select name="subcategory_accessories" class="form-control">
                            <option value="">Select SubCategory</option>
                            <option value="powerbank">Powerbank</option>
                            <option value="earphones">Earphones</option>
                            <option value="headphones">Headphones</option>
                            <option value="mouse">Mouse</option>
                            <option value="charger_cable">Charger Cable</option>
                            <option value="screen_protector">Screen Protector</option>
                            <option value="phone_case">Phone Case</option>
                            <option value="laptop_case">Laptop Case</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Product Name</label>
                        <input type="text" name="productname" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Product Description</label>
                        <input type="text" name="productdesc" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Color</label>
                        <select name="color" class="form-control">
                            <option value="">Select Color</option>
                            <option value="Silver">Silver</option>
                            <option value="Gold">Gold</option>
                            <option value="Rose Gold">Rose Gold</option>
                            <option value="Black">Black</option>
                            <option value="White">White</option>
                            <option value="Midnight Green">Midnight Green</option>
                            <option value="Purple">Purple</option>
                            <option value="Red">Red</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Memory</label>
                        <select name="memory" class="form-control">
                            <option value="">Select Memory</option>
                            <option value="sixteen">16 GB</option>
                            <option value="thirtytwo">32 GB</option>
                            <option value="sixtyfour">64 GB</option>
                            <option value="onetwentyeight">128 GB</option>
                            <option value="twofiftysix">256 GB</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Image 1</label>
                        <input type="file" name="image01" class="form-control" accept="image/*" required onchange="previewImage(event, 'image01_preview')">
                        <img id="image01_preview" class="img-preview form-control" src="" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="">Image 2</label>
                        <input type="file" name="image02" class="form-control" accept="image/*" required onchange="previewImage(event, 'image02_preview')">
                        <img id="image02_preview" class="img-preview form-control" src="" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="">Image 3</label>
                        <input type="file" name="image03" class="form-control" accept="image/*" required onchange="previewImage(event, 'image03_preview')">
                        <img id="image03_preview" class="img-preview form-control" src="" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="">Stock</label>
                        <input type="number" name="Stock" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Price</label>
                        <input type="number" name="Price" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                    <button type="submit" class="btn btn-primary" onclick="return validateForm()">SAVE PRODUCTS</button>

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var brand = document.getElementsByName("brand")[0].value;
        var category = document.getElementsByName("category")[0].value;
        var subCategory = document.getElementsByName("subcategory")[0].value;
        var productName = document.getElementsByName("productname")[0].value;
        var productDesc = document.getElementsByName("productdesc")[0].value;
        var color = document.getElementsByName("color")[0].value;
        var memory = document.getElementsByName("memory")[0].value;
        var image01 = document.getElementsByName("image01")[0].files[0];
        var image02 = document.getElementsByName("image02")[0].files[0];
        var image03 = document.getElementsByName("image03")[0].files[0];
        var stock = document.getElementsByName("Stock")[0].value;
        var price = document.getElementsByName("Price")[0].value;

        if (brand === "" || category === "" || subCategory === "" || productName === "" || productDesc === "" || color === "" || memory === "" || stock === "" || price === "" || !image01 || !image02 || !image03) {
            // Display the alert message for all mandatory fields
            document.getElementById("errorMessage").innerText = "All fields are mandatory.";
            document.getElementById("errorMessage").classList.remove("d-none");
            return false;
        }

        // Image size validation
        var maxSizeInBytes = 1 * 1024 * 1024; 
        if (image01.size > maxSizeInBytes || image02.size > maxSizeInBytes || image03.size > maxSizeInBytes) {
            document.getElementById("errorMessage").innerText = "Image size should be less than 1MB.";
            document.getElementById("errorMessage").classList.remove("d-none");
            return false;
        }

        // If all fields are filled and image size is valid, hide the alert and allow the form submission
        document.getElementById("errorMessage").classList.add("d-none");
        return true;
    }

    function previewImage(event, previewId) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var previewElement = document.getElementById(previewId);
                previewElement.setAttribute('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>



    <!-- Edit Product Modal -->
    <div class="modal fade" id="productEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">UPDATE PRODUCT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateProduct">
                    <div class="modal-body">

                        <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                        <input type="hidden" id="product_id" name="product_id"> 

                        <div class="mb-3">
                            <label for="">Brand</label>
                            <select id="edit_brand" name="brand" class="form-control" required>
                                <option value="">Select Brand</option>
                                <option value="Apple">Apple</option>
                                <option value="Xiaomi">Xiaomi</option>
                                <option value="OPPO">OPPO</option>
                                <option value="RealMe">RealMe</option>
                                <option value="Vivo">Vivo</option>
                                <option value="Itel">Itel</option>
                                <option value="HP">HP</option>
                                <option value="Samsung">Samsung</option>
                                <option value="Huawei">Huawei</option>
                                <option value="TECNO Mobile">TECNO Mobile</option>
                                <option value="ACER">ACER</option>
                                <option value="Lenovo">Lenovo</option>
                                <option value="DELL">DELL</option>
                                <option value="MSI">MSI</option>
                    </select>
                    </div>
                        <div class="mb-3">
                            <label for="">Category</label>
                            <select id="edit_category" name="category"class="form-control" required>
                                <option value="">Select Category</option>
                                <option value="Smartphone">Smartphone</option>
                                <option value="Laptop">Laptop</option>
                                <option value="Accessories">Accessories</option>
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="">SubCategory (Accessories)</label>
                        <select id="edit_subcategory" name="editsubcategory" class="form-control">
                            <option value="">Select SubCategory</option>
                            <option value="powerbank">Powerbank</option>
                            <option value="earphones">Earphones</option>
                            <option value="headphones">Headphones</option>
                            <option value="mouse">Mouse</option>
                            <option value="charger_cable">Charger Cable</option>
                            <option value="screen_protector">Screen Protector</option>
                            <option value="phone_case">Phone Case</option>
                            <option value="laptop_case">Laptop Case</option>
                        </select>
                    </div>
                        <div class="mb-3">
                            <label for="">Product Name</label>
                            <input type="text" id="productname" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Product Description</label>
                            <input type="text" id="productdesc" class="form-control" />
                        </div>
                        <div class="mb-3">
                        <label for="">Color</label>
                        <select name="color" class="form-control">
                            <option value="">Select Color</option>
                            <option value="Silver">Silver</option>
                            <option value="Gold">Gold</option>
                            <option value="Rose Gold">Rose Gold</option>
                            <option value="Black">Black</option>
                            <option value="White">White</option>
                            <option value="Midnight Green">Midnight Green</option>
                            <option value="Purple">Purple</option>
                            <option value="Red">Red</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Memory</label>
                        <select name="memory" class="form-control">
                            <option value="">Select Memory</option>
                            <option value="sixteen">16 GB</option>
                            <option value="thirtytwo">32 GB</option>
                            <option value="sixtyfour">64 GB</option>
                            <option value="onetwentyeight">128 GB</option>
                            <option value="twofiftysix">256 GB</option>
                        </select>
                    </div>

                        <div class="mb-3">
                            <label for="">Image 1</label>
                            <img id="image01_edit_preview" class="img-thumbnail form-control" src="" alt="">
                            <input type="file" id="image01" class="form-control" onchange="previewImage(event, 'image01_edit_preview'); setFilePath(this, 'uploaded_img/<?= $product['image_01'] ?>');">
                        </div>
                        <div class="mb-3">
                            <label for="">Image 2</label>
                            <img id="image02_edit_preview" class="img-thumbnail form-control" src="" alt="">
                            <input type="file" id="image02" class="form-control" onchange="previewImage(event, 'image02_edit_preview'); setFilePath(this, 'uploaded_img/<?= $product['image_02'] ?>');">
                        </div>
                        <div class="mb-3">
                            <label for="">Image 3</label>
                            <img id="image03_edit_preview" class="img-thumbnail form-control" src="" alt="">
                            <input type="file" id="image03" class="form-control" onchange="previewImage(event, 'image03_edit_preview'); setFilePath(this, 'uploaded_img/<?= $product['image_03'] ?>');">
                        </div>
                        <div class="mb-3">
                            <label for="">Stock</label>
                            <input type="number" id="stock" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Price</label>
                            <input type="number" id="price"class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Status</label>
                            <select id="edit_status" class="form-control">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                        <button type="submit" class="btn btn-primary" onclick="return validateForm()">UPDATE PRODUCT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Product Modal -->
    <div class="modal fade" id="productViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">VIEW PRODUCT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Product ID: </strong><span id="view_product_id"></span></p>
                <p><strong>Brand: </strong><span id="view_brand"></span></p>
                <p><strong>Category: </strong><span id="view_category"></span></p>
                <p><strong>SubCategory: </strong><span id="view_subcategory"></span></p>
                <p><strong>Product Name: </strong><span id="view_productname"></span></p>
                <p><strong>Product Description: </strong><span id="view_productdesc"></span></p>
                <p><strong>Color: </strong><span id="view_color"></span></p>
                <p><strong>Memory: </strong><span id="view_memory"></span></p>
                <p><strong>Image 1: </strong><img id="view_image01" class="img-thumbnail" src="" alt=""></p>
                <p><strong>Image 2: </strong><img id="view_image02" class="img-thumbnail" src="" alt=""></p>
                <p><strong>Image 3: </strong><img id="view_image03" class="img-thumbnail" src="" alt=""></p>
                <p><strong>Stock: </strong><span id="view_stock"></span></p>
                <p><strong>Price: </strong><span id="view_price"></span></p>
                <p><strong>Status: </strong><span id="view_status"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>


<div class="container mt-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>INVENTORY LIST
            <button type="button" class="btn btn-custom float-end" data-bs-toggle="modal" data-bs-target="#productAddModal">
                <i class="fas fa-plus"></i> ADD PRODUCT
              </button>
            </h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="myTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 5%;">Product ID</th>
                    <th style="width: 10%;">Brand</th>
                    <th style="width: 10%;">Category</th>
                    <th style="width: 10%;">SubCategory</th>
                    <th style="width: 10%;">Product Name</th>
                    <th style="width: 15%;">Product Description</th>
                    <th style="width: 10%;">Color</th>
                    <th style="width: 10%;">Memory</th>
                    <th style="width: 8%;">Image 1</th>
                    <th style="width: 8%;">Image 2</th>
                    <th style="width: 8%;">Image 3</th>
                    <th style="width: 5%;">Stock</th>
                    <th style="width: 5%;">Price</th>
                    <th style="width: 5%;">Status</th>
                    <th style="width: 16%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                                require 'dbcon.php';

                                $query = "SELECT * FROM tb_product WHERE Branch = '$branch'";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $product) {
                                ?>
                                        <tr>
                                            <td><?= $product['id'] ?></td>
                                            <td><?= $product['brand'] ?></td>
                                            <td><?= $product['category'] ?></td>
                                            <td><?= $product['subcategory'] ?></td>
                                            <td><?= $product['product_name'] ?></td>
                                            <td><?= $product['product_desc'] ?></td>
                                            <td><?= $product['color'] ?></td>
                                            <td><?= $product['memory'] ?></td>
                                            <td><img src="uploaded_img/<?= $product['image_01'] ?>" class="img-thumbnail" style="max-height: 50px;"></td>
                                            <td><img src="uploaded_img/<?= $product['image_02'] ?>" class="img-thumbnail" style="max-height: 50px;"></td>
                                            <td><img src="uploaded_img/<?= $product['image_03'] ?>" class="img-thumbnail" style="max-height: 50px;"></td>
                                            <td><?= $product['Stock'] ?></td> 
                                            <td><?= $product['Price'] ?></td>
                                            <td><?= $product['Status'] ?></td>
                                        <td>
                                            <button type="button" value="<?= $product['id']; ?>" class="viewProductModalBtn btn btn-info btn-sm"><i class="fas fa-eye"></i> VIEW</button>
                                            <button type="button" value="<?= $product['id']; ?>" class="editProductBtn btn btn-success btn-sm"><i class="fas fa-edit"></i> UPDATE</button>
                                            <button type="button" value="<?= $product['id']; ?>" class="deleteProductBtn btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> DELETE</button>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>

$(document).on('click', '.viewProductModalBtn', function() {
    var product_id = $(this).val();
    $.ajax({
        type: "GET",
        url: "product_codes.php?product_id=" + product_id,
        success: function(response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 404) {
                alert(res.message);
            } else if (res.status == 200) {
                $('#view_product_id').text(res.data.id);
                $('#view_brand').text(res.data.brand);
                $('#view_category').text(res.data.category);
                $('#view_subcategory').text(res.data.subcategory);
                $('#view_productname').text(res.data.product_name);
                $('#view_productdesc').text(res.data.product_desc);
                $('#view_color').text(res.data.color);
                $('#view_memory').text(res.data.memory);
                $('#view_image01').attr('src', 'uploaded_img/' + res.data.image_01);
                $('#view_image02').attr('src', 'uploaded_img/' + res.data.image_02);
                $('#view_image03').attr('src', 'uploaded_img/' + res.data.image_03);
                $('#view_stock').text(res.data.Stock);
                $('#view_price').text(res.data.Price);
                $('#view_status').text(res.data.Status);
                $('#productViewModal').modal('show');
            }
        }
    });
});

    
function updateImagePreviews(imageData) {
    document.getElementById("image01_preview").src = "uploaded_img/" + imageData.image01.name;
    document.getElementById("image02_preview").src = "uploaded_img/" + imageData.image02.name;
    document.getElementById("image03_preview").src = "uploaded_img/" + imageData.image03.name;
}



    function saveProduct(formData) {
    $.ajax({
        type: "POST",
        url: "product_codes.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 422) {
                $('#errorMessage').removeClass('d-none');
                $('#errorMessage').text(res.message);
            } else if (res.status == 200) {
                $('#errorMessage').addClass('d-none');
                alertify.set('notifier', 'position', 'top-right');
                alertify.success(res.message);

                // Close the add product modal
                $('#productAddModal').modal('hide');
                $('#saveProduct')[0].reset();

                // Reload the product list table
                $('#myTable').load(location.href + " #myTable");

                // Reset image previews
                document.getElementById("image01_preview").src = "";
                document.getElementById("image02_preview").src = "";
                document.getElementById("image03_preview").src = "";
            } else if (res.status == 500) {
                alert(res.message);
            }
        },
        error: function (xhr, textStatus, error) {
            console.log(xhr.responseText);
            alert("Error saving the product data. Please try again later.");
        }
    });
}



    $(document).on('submit', '#saveProduct', function (e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        formData.append("save_product", true);
        formData.append("image01", $('#image01')[0].files[0]);
        formData.append("image02", $('#image02')[0].files[0]);
        formData.append("image03", $('#image03')[0].files[0]);

        
        saveProduct(formData);
    });


$(document).on('click', '.editProductBtn', function() {
    var product_id = $(this).val();
    $('#product_id').val(product_id);

    $.ajax({
        type: "GET",
        url: "product_codes.php?product_id=" + product_id,
        success: function(response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 404) {
                alert(res.message);
            } else if (res.status == 200) {
                var brandSelect = document.getElementById("edit_brand");
                var categorySelect = document.getElementById("edit_category");
                var subcategorySelect = document.getElementById("edit_subcategory");
                var statusSelect = document.getElementById("edit_status");

                for (var i = 0; i < brandSelect.options.length; i++) {
                    if (brandSelect.options[i].value === res.data.brand) {
                        brandSelect.options[i].selected = true;
                        break;
                    }
                }

                for (var i = 0; i < categorySelect.options.length; i++) {
                    if (categorySelect.options[i].value === res.data.category) {
                        categorySelect.options[i].selected = true;
                        break;
                    }
                }

                for (var i = 0; i < subcategorySelect.options.length; i++) {
                    if (subcategorySelect.options[i].value === res.data.subcategory) {
                        subcategorySelect.options[i].selected = true;
                        break;
                    }
                }

                for (var i = 0; i < statusSelect.options.length; i++) {
                    if (statusSelect.options[i].value === res.data.Status) {
                        statusSelect.options[i].selected = true;
                        break;
                    }
                }
                
                $('#edit_brand').val(res.data.brand);
                $('#edit_category').val(res.data.category);
                $('#edit_subcategory').val(res.data.subcategory);
                $('#productname').val(res.data.product_name);
                $('#productdesc').val(res.data.product_desc);
                $('#color').val(res.data.color);
                $('#memory').val(res.data.memory);
                $('#image01_edit_preview').attr('src', 'uploaded_img/' + res.data.image_01);
                $('#image02_edit_preview').attr('src', 'uploaded_img/' + res.data.image_02);
                $('#image03_edit_preview').attr('src', 'uploaded_img/' + res.data.image_03);
                $('#stock').val(res.data.Stock);
                $('#price').val(res.data.Price);
                $('#edit_status').val(res.data.Status);
                $('#productEditModal').modal('show');
            }
        }
    });
});


function setFilePath(inputElement, imagePath) {
        if (imagePath) {
            inputElement.setAttribute('value', imagePath);
        }
    }

    
        $(document).on('submit', '#updateProduct', function (e) {
            e.preventDefault();
        
            var formData = new FormData(this);
            formData.append("update_product", true);
            formData.append("product_id", $('#product_id').val()); 
            formData.append("image01", $('#image01_edit')[0].files[0]); 
            formData.append("image02", $('#image02_edit')[0].files[0]); 
            formData.append("image03", $('#image03_edit')[0].files[0]); 
        
            $.ajax({
            type: "POST",
            url: "product_codes.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    $('#errorMessageUpdate').removeClass('d-none');
                    $('#errorMessageUpdate').text(res.message);
                } else if (res.status == 200) {
                    $('#errorMessageUpdate').addClass('d-none');
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#productEditModal').modal('hide');
                    $('#updateProduct')[0].reset();

                    $('#myTable').load(location.href + " #myTable");

                    document.getElementById("image01_edit_preview").src = "";
                    document.getElementById("image02_edit_preview").src = "";
                    document.getElementById("image03_edit_preview").src = "";
                } else if (res.status == 500) {
                    alert(res.message);
                }
            },
            error: function (xhr, textStatus, error) {
                console.log(xhr.responseText);
                alert("Error updating the product data. Please try again later.");
            }
        });
    });


        $(document).on('click', '.viewProductBtn', function() {
        var product_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "product_codes.php?product_id=" + product_id,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $('#view_product_id').text(res.data.id);
                    $('#view_brand').text(res.data.brand);
                    $('#view_category').text(res.data.category);
                    $('#view_subcategory').text(res.data.subcategory);
                    $('#view_productname').text(res.data.productname);
                    $('#view_productdescription').text(res.data.productdesc);
                    $('#view_color').text(res.data.color);
                    $('#view_memory').text(res.data.memory);
                    $('#view_image01').attr('src', 'uploaded_img/' + res.data.image_01);
                    $('#view_image02').attr('src', 'uploaded_img/' + res.data.image_02);
                    $('#view_image03').attr('src', 'uploaded_img/' + res.data.image_03);
                    $('#view_stock').text(res.data.Stock);
                    $('#view_price').text(res.data.Price);
                    $('#view_status').text(res.data.Status);
                    $('#productViewModal').modal('show');
                }
            }
        });
    });

    $(document).on('click', '.deleteProductBtn', function(e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var product_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "product_codes.php",
                    data: {
                        'delete_product': true,
                        'product_id': product_id
                    },
                    success: function(response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable').load(location.href + " #myTable");
                        }
                    }
                });
            }
        });

        const sidebar = document.querySelector('.add-products-sidebar');

            sidebar.addEventListener('mouseenter', () => {
            sidebar.classList.add('expanded');
        });

            sidebar.addEventListener('mouseleave', () => {
            sidebar.classList.remove('expanded');
        });

    </script>
    
    <script>
    // Function to enable or disable the subcategory dropdown
    function toggleSubcategoryDropdown() {
        var category = document.getElementsByName("category")[0].value;
        var subcategoryDropdown = document.getElementsByName("subcategory_accessories")[0];

        // Check if the selected category is either "Smartphone" or "Laptop"
        if (category === "Smartphone" || category === "Laptop") {
            subcategoryDropdown.disabled = true;
            subcategoryDropdown.value = ""; // Reset the selected value
        } else {
            subcategoryDropdown.disabled = false;
        }
    }

    // Add an event listener to the category dropdown to toggle the subcategory dropdown
    document.getElementsByName("category")[0].addEventListener("change", toggleSubcategoryDropdown);

    // Initialize the state of the subcategory dropdown
    toggleSubcategoryDropdown();
</script>


</body>

</html>