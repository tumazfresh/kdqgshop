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

    <title>Store Manager Registered Users</title>
    <link rel="stylesheet" href="store_manager_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.css"/>

    <style>

    </style>

</head>
<body>
<div class="add-products-menubar">
    <h1><img src="img/logo.png" alt="Logo" class="logo-img"> KING DEO AND QUEEN GRACE STORE MANAGER USERS - <?php echo strtoupper($branch); ?> BRANCH</h1>
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


<!-- Add User -->
<div class="modal fade" id="userAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ADD USER</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="saveUser">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text"  name="name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="text"  name="email" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="text"  name="password" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Birthdate</label>
                    <input type="date" name="birthdate" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Gender</label>
                    <input type="text"  name="gender" class="form-control" />
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
                    <label for="">Phone Number</label>
                    <input type="text"  name="phone" class="form-control" />
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">SAVE USER</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">UPDATE USER</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateUser">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" id="user_id" name="user_id">

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" id="name" name="name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="text" id="email" name="email" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Birthdate</label>
                    <input type="date" id="birthdate" name="birthdate" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Gender</label>
                    <input type="text" id="gender" name="gender" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">House No.</label>
                    <input type="text" id="houseno" name="houseno" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Street</label>
                    <input type="text" id="street" name="street" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Barangay</label>
                    <input type="text" id="barangay" name="barangay" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">City</label>
                    <input type="text" id="city" name="city" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Zip Code</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Phone Number</label>
                    <input type="text" id="phone" name="phone" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">UPDATE USER</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- View User Modal -->
<div class="modal fade" id="userViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">VIEW USER</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
            <p><strong>User ID: </strong><span id="view_id"></span></p>
            <p><strong>Name: </strong><span id="view_name"></span></p>
            <p><strong>Email: </strong><span id="view_email"></span></p>
            <p><strong>Birthdate: </strong><span id="view_birthdate"></span></p>
            <p><strong>Gender: </strong><span id="view_gender"></span></p>
            <p><strong>House No.: </strong><span id="view_houseno"></span></p>
            <p><strong>Street: </strong><span id="view_street"></span></p>
            <p><strong>Barangay: </strong><span id="view_barangay"></span></p>
            <p><strong>City: </strong><span id="view_city"></span></p>
            <p><strong>Zip Code: </strong><span id="view_zipcode"></span></p>
            <p><strong>Phone Number: </strong><span id="view_phone"></span></p>
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
                        <h4>REGISTERED USERS
                            <button type="button" class="btn btn-primary btn-add-user" data-bs-toggle="modal" data-bs-target="#userAddModal">
                                <i class="fas fa-plus"></i> ADD USER
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>UserID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Birthdate</th>
                                <th>Gender</th>
                                <th>House Number</th>
                                <th>Street</th>
                                <th>Barangay</th>
                                <th>City</th>
                                <th>Zip Code</th>
                                <th>Phone Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'dbcon.php';

                            $query = "SELECT * FROM tb_customer";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $user)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $user['custid'] ?></td>
                                        <td><?= $user['name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['birthdate'] ?></td>
                                        <td><?= $user['gender'] ?></td>
                                        <td><?= $user['house_number'] ?></td>
                                        <td><?= $user['street'] ?></td>
                                        <td><?= $user['barangay'] ?></td>
                                        <td><?= $user['city'] ?></td>
                                        <td><?= $user['zip_code'] ?></td>
                                        <td><?= $user['phone'] ?></td>
                                        <td>
                                            <button type="button" value="<?=$user['custid'];?>" class="viewUserBtn btn btn-info btn-sm"><i class="fas fa-eye"></i> VIEW</button>
                                            <button type="button" value="<?=$user['custid'];?>" class="editUserBtn btn btn-success btn-sm"><i class="fas fa-edit"></i> UPDATE</button>
                                            <button type="button" value="<?=$user['custid'];?>" class="deleteUserBtn btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> DELETE</button>
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
        $(document).on('submit', '#saveUser', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_user", true);

            $.ajax({
                type: "POST",
                url: "manager_users_code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#UserAddModal').modal('hide');
                        $('#saveUser')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editUserBtn', function () {

            var user_id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "manager_users_code.php?user_id=" + user_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#user_id').val(res.data.custid);
                        $('#name').val(res.data.name);
                        $('#email').val(res.data.email);
                        $('#birthdate').val(res.data.birthdate);
                        $('#gender').val(res.data.gender);
                        $('#houseno').val(res.data.house_number);
                        $('#street').val(res.data.street);
                        $('#barangay').val(res.data.barangay);
                        $('#city').val(res.data.city);
                        $('#zipcode').val(res.data.zip_code);
                        $('#phone').val(res.data.phone);
                        

                        $('#userEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateUser', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_user", true);

            $.ajax({
                type: "POST",
                url: "manager_users_code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        
                        $('#userEditModal').modal('hide');
                        $('#updateUser')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.viewUserBtn', function () {

            var user_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "manager_users_code.php?user_id=" + user_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#view_id').text(res.data.custid);
                        $('#view_name').text(res.data.name);
                        $('#view_email').text(res.data.email);
                        $('#view_birthdate').text(res.data.birthdate);
                        $('#view_gender').text(res.data.gender);
                        $('#view_houseno').text(res.data.house_number);
                        $('#view_street').text(res.data.street);
                        $('#view_barangay').text(res.data.barangay);
                        $('#view_city').text(res.data.city);
                        $('#view_zipcode').text(res.data.zip_code);
                        $('#view_phone').text(res.data.phone);
                        

                        $('#userViewModal').modal('show');
                    }
                }
            });
        });

        $(document).on('click', '.deleteUserBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
                var user_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "manager_users_code.php",
                    data: {
                        'delete_user': true,
                        'user_id': user_id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if(res.status == 500) {

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
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

</body>
</html>