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
        // Simulate user authentication
        // ... (your authentication code)

        // Set the login time and insert into the database
        $loginTime = date('Y-m-d H:i:s');
        // ... (your insert query)

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
    $updateStatement = $con->prepare($updateQuery);
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

    <title>Store Manager Orders</title>
    <link rel="stylesheet" href="store_manager_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/alertify.min.js"></script>

</head>

<body>
<div class="add-products-menubar">
    <h1><img src="img/logo.png" alt="Logo" class="logo-img"> KING DEO AND QUEEN GRACE STORE MANAGER ORDERS - <?php echo strtoupper($branch); ?> BRANCH</h1>
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



    <!-- Add Orders -->
<div class="modal fade" id="orderAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD ORDERS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="alertMessage" class="alert d-none"></div>

            <form id="saveOrder" action="#" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="errorMessage" class="alert alert-warning d-none">All fields are mandatory.</div>

                    <div class="mb-3">
                        <label for="">UserID</label>
                        <input type="text" name="user_id" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" />
                    </div>
                        <div class="mb-3">
                        <label for="">Phone Number</label>
                        <input type="tel"  name="number" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="text"  name="email" class="form-control" />
                    </div>
                    <div class="mb-3">
                    <label for="">House No.</label>
                    <input type="text"  name="houseno" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Street</label>
                        <input type="text"  name="street" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Barangay</label>
                        <input type="text"  name="barangay" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">City</label>
                        <input type="text"  name="city" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Zip Code</label>
                        <input type="text"  name="zipcode" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Total Products</label>
                        <input type="text"  name="total-products" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Total Price</label>
                        <input type="text"  name="total-price" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Placed On</label>
                        <input type="text"  name="placed-on" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Delivery Date</label>
                        <input type="text"  name="delivery-date" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Payment Method</label>
                        <input type="text"  name="payment-method" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Uploaded ID Picture</label>
                        <input type="file" name="image01" class="form-control" accept="image/*" required onchange="previewImage(event, 'image01_preview')">
                        <img id="image01_preview" class="img-preview form-control" src="" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="">Payment Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="Pending">Pending</option>
                            <option value="Confirmed">Confirmed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Delivery Method</label>
                        <input type="text" name="delivery_method" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                    <button type="submit" class="btn btn-primary" onclick="return validateForm()">SAVE ORDERS</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var name = document.getElementsByName("name")[0].value;
        var number = document.getElementsByName("number")[0].value;
        var email = document.getElementsByName("email")[0].value;
        var address = document.getElementsByName("address")[0].value;
        var totalProducts = document.getElementsByName("total-products")[0].value;
        var totalPrice = document.getElementsByName("total-price")[0].value;
        var placedOn = document.getElementsByName("placed-on")[0].value;
        var deliveryDate = document.getElementsByName("delivery-date")[0].value;
        var paymentMethod = document.getElementsByName("payment-method")[0].value;
        var uploadedPicture = document.getElementsByName("image01")[0].files[0];
        var paymentStatus = document.getElementsByName("status")[0].value;
        var deliveryMethod = document.getElementsByName("delivery_method")[0].value;
    
        if (
            name === "" ||
            number === "" ||
            email === "" ||
            address === "" ||
            totalProducts === "" ||
            totalPrice === "" ||
            placedOn === "" ||
            deliveryDate === "" ||
            paymentMethod === "" ||
            !uploadedPicture || 
            paymentStatus === "" ||
            deliveryMethod === ""
        ) {
            // Display the alert message for all mandatory fields
            document.getElementById("errorMessage").innerText = "All fields are mandatory.";
            document.getElementById("errorMessage").classList.remove("d-none");
            return false;
        }
    
        // Image size validation
        var maxSizeInBytes = 1 * 1024 * 1024; // 1MB
        if (uploadedPicture.size > maxSizeInBytes) {
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
            previewElement.src = e.target.result; 
        };

        reader.readAsDataURL(input.files[0]);
    }
}

</script>



    <!-- Edit Order Modal -->
<div class="modal fade" id="orderEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">UPDATE ORDER</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editOrderBtn">
                <div class="modal-body">
                    
                    <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>
                    
                    <input type="hidden" id="user_id" name="user_id">
                    
                    <div class="mb-3">
                        <label for="order_id">Order ID</label>
                        <input type="text" id="order_id" name="order_id" class="form-control" />
                    </div>
                    
                    <div class="mb-3">
                        <label for="payment_status">Payment Status</label>
                        <select id="edit_payment" name="payment" class="form-control">
                            <option value="Pending">Pending</option>
                            <option value="Confirmed">Confirmed</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="order_status">Order Status</label>
                        <select id="edit_order" name="order" class="form-control">
                            <option value="Order Placed">Order Placed</option>
                            <option value="Preparing to ship">Preparing to ship</option>
                            <option value="In transit">In transit</option>
                            <option value="Out for delivery">Out for delivery</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                    <button type="submit" class="btn btn-primary" id="editOrderBtn">UPDATE ORDER</button>
                </div>
            </form>
        </div>
    </div>
</div>




    <!-- View Order Modal -->
    <div class="modal fade" id="orderViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">VIEW ORDER</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>User ID: </strong><span id="view_user_id"></span></p>
                 <p><strong>Product ID: </strong><span id="view_product_id"></span></p>
                <p><strong>Name: </strong><span id="view_name"></span></p>
                <p><strong>Phone Number: </strong><span id="view_number"></span></p>
                <p><strong>Email: </strong><span id="view_email"></span></p>
                <p><strong>House No.: </strong><span id="view_houseno"></span></p>
                <p><strong>Street: </strong><span id="view_street"></span></p>
                <p><strong>Barangay: </strong><span id="view_barangay"></span></p>
                <p><strong>City: </strong><span id="view_city"></span></p>
                <p><strong>Zip Code: </strong><span id="view_zipcode"></span></p>
                <p><strong>Product name: </strong><span id="view_product_name"></span></p>
                <p><strong>Quantity: </strong><span id="view_product_quantity"></span></p>
                <p><strong>Price: </strong><span id="view_product_price"></span></p>
                <p><strong>Total Price: </strong><span id="view_total_price"></span></p>
                <p><strong>Placed On: </strong><span id="view_placed_on"></span></p>
                <p><strong>Payment Method: </strong><span id="view_payment_method"></span></p>
                <p><strong>Payment Status: </strong><span id="view_payment_status"></span></p>
                <p><strong>Uploaded ID Picture: </strong><img id="view_picture" class="img-thumbnail" src="" alt=""></p>
                <p><strong>Proof Of Payment Address: </strong><span id="view_proof_address"></span></p>
                <p><strong>Delivery Date: </strong><span id="view_delivery_date"></span></p>
                <p><strong>Delivery Method: </strong><span id="view_delivery_method"></span></p>
                 <p><strong>Order Status: </strong><span id="view_order_status"></span></p>
                
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
            <h4>ORDER LIST
            <button type="button" class="btn btn-custom float-end" data-bs-toggle="modal" data-bs-target="#orderAddModal">
                <i class="fas fa-plus"></i> ADD ORDER
              </button>
            </h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="myTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 5%;">Order ID</th>
                    <th style="width: 5%;">User ID</th>
                    <th style="width: 5%;">Product ID</th>
                    <th style="width: 10%;">Name</th>
                    <th style="width: 10%;">Color</th>
                    <th style="width: 10%;">Variant</th>
                    <th style="width: 10%;">Phone Number</th>
                    <th style="width: 15%;">Email</th>
                    <th style="width: 8%;">House number</th>
                    <th style="width: 8%;">Street</th>
                    <th style="width: 8%;">Barangay</th>
                    <th style="width: 8%;">City</th>
                    <th style="width: 8%;">Zipcode</th>
                    <th style="width: 8%;">Product Name</th>
                    <th style="width: 8%;">Quantity</th>
                    <th style="width: 8%;">Price</th>
                    <th style="width: 8%;">Total Price</th>
                    <th style="width: 5%;">Placed On</th>
                    <th style="width: 5%;">Payment Method</th>
                    <th style="width: 5%;">Payment Status</th>
                    <th style="width: 5%;">Uploaded Valid ID</th>
                    <th style="width: 5%;">Delivery Date</th>
                    <th style="width: 5%;">Delivery Method</th>
                    <th style="width: 5%;">Order Status</th>
                    <th style="width: 16%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                                require 'dbcon.php';

                                    $query = "SELECT * FROM tb_order";
                                    $query_run = mysqli_query($con, $query);
                                    
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $order) {
                                            // Fetch user data based on user_id from the current order
                                            $user_query = "SELECT * FROM tb_order WHERE user_id = {$order['user_id']}";
                                            $user_result = mysqli_query($con, $user_query);
                                            $user = mysqli_fetch_assoc($user_result);
                                    
                                            // Check if the user data was found
                                            if ($user) {
                                                ?>
                                                <tr>
                                                    <td><?= $user['order_id'] ?></td>
                                                    <td><?= $order['user_id'] ?></td>
                                                    <td><?= $user['pid'] ?></td>
                                                    <td><?= $user['name'] ?></td>
                                                    <td><?= $user['color'] ?></td>
                                                    <td><?= $user['variant'] ?></td>
                                                    <td><?= $user['number'] ?></td>
                                                    <td><?= $user['email'] ?></td>
                                                    <td><?= $user['houseno'] ?></td>
                                                    <td><?= $user['street'] ?></td>
                                                    <td><?= $user['barangay'] ?></td>
                                                    <td><?= $user['city'] ?></td>
                                                    <td><?= $user['zipcode'] ?></td>
                                                    <td><?= $user['product_name'] ?></td>
                                                    <td><?= $user['quantity'] ?></td>
                                                    <td><?= $user['price'] ?></td>
                                                    <td><?= $user['total_price'] ?></td>
                                                    <td><?= $user['placed_on'] ?></td>
                                                    <td><?= $user['payment_method'] ?></td>
                                                    <td><?= $user['payment_status'] ?></td>
                                                    <td><img src="uploaded_img/<?= $user['picture_image'] ?>" class="img-thumbnail" style="max-height: 50px;"></td>
                                                    <td><?= $user['delivery_date'] ?></td>
                                                    <td><?= $user['delivery_method'] ?></td>
                                                    <td><?= $user['order_status'] ?></td>
                                                    <td>
                                                        <button type="button" value="<?= $user['order_id']; ?>" class="viewOrderModalBtn btn btn-info btn-sm"><i class="fas fa-eye"></i> VIEW</button>
                                                        <button type="button" value="<?= $user['order_id']; ?>" class="editOrder btn btn-success btn-sm"><i class="fas fa-edit"></i> UPDATE</button>
                                                        <button type="button" class="deleteOrder btn btn-danger btn-sm" data-order-id="<?= $user['order_id']; ?>"><i class="fas fa-trash-alt"></i> DELETE</button>


                                                    </td>
                                                </tr>
                                                <?php
                                            }
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

$(document).on('click', '.viewOrderModalBtn', function () {
        var order_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "manager_orders_codee.php?view_order=" + order_id, 
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200) {
                    // Updated the IDs for view modal
                    $('#view_user_id').text(res.data.user_id);
                    $('#view_product_id').text(res.data.pid);
                    $('#view_name').text(res.data.name);
                    $('#view_number').text(res.data.number); 
                    $('#view_email').text(res.data.email);
                    $('#houseno').val(res.data.house_number);
                    $('#street').val(res.data.street);
                    $('#barangay').val(res.data.barangay);
                    $('#city').val(res.data.city);
                    $('#zipcode').val(res.data.zip_code);
                    $('#view_product_name').text(res.data['product_name']);
                    $('#view_product_quantity').text(res.data['quantity']);
                    $('#view_product_price').text(res.data['price']);
                    $('#view_placed_on').text(res.data['placed_on']);
                    $('#view_payment_method').text(res.data['payment_method']);
                    $('#view_payment_status').text(res.data['payment_status']);
                    $('#view_picture').attr('src', 'uploaded_img/' + res.data.uploadedID); 
                    $('#view_proof_address').text(res.data['proof_of_payment_address']); 
                    $('#view_delivery_date').text(res.data['delivery_date']);
                    $('#view_delivery_method').text(res.data['delivery_method']);
                    $('#view_order_status').text(res.data['order_status']);
                    $('#orderViewModal').modal('show');
                }
            }
        });
    });


function updateImagePreviews(imageData) {
    }


    function saveOrder(formData) {
    $.ajax({
        type: "POST",
        url: "manager_orders_codee.php",
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

                $('#orderAddModal').modal('hide');
                $('#saveOrder')[0].reset();

                $('#myTable').load(location.href + " #myTable");

                document.getElementById("image01_preview").src = "";
            } else if (res.status == 500) {
                alert(res.message);
            }
        },
        error: function (xhr, textStatus, error) {
            console.log(xhr.responseText);
            alert("Error saving the order data. Please try again later.");
        }
    });
}

$(document).on('submit', '#saveOrder', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("save_order", true);
    formData.append("image01", $('#image01')[0].files[0]);
    saveOrder(formData);
});



function setFilePath(inputElement, imagePath) {
        if (imagePath) {
            inputElement.setAttribute('value', imagePath);
        }
    }
    
    $(document).on('submit', '#editOrderBtn', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("update_order", true);
        formData.append("uploadedID", $('#picture')[0].files[0]);
        
        $.ajax({
            type: "POST",
            url: "manager_orders_codee.php",
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
                    
                    $('#orderEditModal').modal('hide');
                    $('#editOrderBtn')[0].reset();
                    
                    $('#myTable').load(location.href + " #myTable");
                    
                    document.getElementById("image01_edit_preview").src = "";
                } else if (res.status == 500) {
                    alert(res.message);
                }
            },
            error: function (xhr, textStatus, error) {
                console.log(xhr.responseText);
                alert("Error updating the order data. Please try again later.");
            }
        });
    });

    $(document).on('click', '#editOrderBtn', function () {
        // Submit the form with the id "updateOrderForm"
        $('#editOrderBtn').submit();
    });

        $(document).on('click', '.editOrder', function () {
    var order_id = $(this).val();
    $.ajax({
        type: "GET",
        url: "manager_orders_codee.php?view_order=" + order_id,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 404) {
                alert(res.message);
            } else if (res.status == 200) {
                // Update the IDs for edit modal
                
                $('#order_id').val(res.data.order_id); 
                $('#edit_payment').val(res.data.payment_status);
                $('#edit_order').val(res.data.order_status); 
                $('#orderEditModal').modal('show');
            }
        }
    });
});






    $(document).on('click', '.deleteOrder', function () {
    var order_id = $(this).data('order-id'); 

    if (confirm('Are you sure you want to delete this data?')) {
        $.ajax({
            type: "POST",
            url: "manager_orders_codee.php",
            data: {
                'delete_order': true,
                'order_id': order_id // 
            },
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 500) {
                    alert(res.message);
                } else {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    // Reload the table data
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

</body>

</html>