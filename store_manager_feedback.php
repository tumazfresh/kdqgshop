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

    <title>Store Manager Feedback</title>
    <link rel="stylesheet" href="store_manager_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/alertify.min.js"></script>

</head>

<body>
<div class="add-products-menubar">
    <h1><img src="img/logo.png" alt="Logo" class="logo-img"> KING DEO AND QUEEN GRACE STORE MANAGER FEEDBACK - <?php echo strtoupper($branch); ?> BRANCH</h1>
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

<!-- View Feedback Modal -->
<div class="modal fade" id="messageViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">VIEW FEEDBACK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>User ID: </strong><span id="view_id"></span></p>
                <p><strong>Order ID: </strong><span id="view_order_id"></span></p>
                <p><strong>Name: </strong><span id="view_name"></span></p>
                <p><strong>Rating: </strong><span id="view_rating"></span></p>
                <p><strong>Review: </strong><span id="view_review"></span></p>
                <p><strong>Date: </strong><span id="view_date"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Feedback Modal -->
<div class="modal fade" id="messageDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DELETE FEEDBACK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this feedback?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="confirmDelete">DELETE</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
            </div>
        </div>
    </div>
</div>

<!-- Table for Feedback -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>RATING AND REVIEW</h4>
                </div>
                <div class="card-body">
                    <table id="messageTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>UserID</th>
                                <th>OrderID</th>
                                <th>Name</th>
                                <th>Rating</th>
                                <th>Review</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
require 'dbcon.php';

$query = "SELECT * FROM tb_feedback"; // Updated table name
$query_run = mysqli_query($con, $query);

if(mysqli_num_rows($query_run) > 0)
{
    foreach($query_run as $message)
    {
        ?>
        <tr>
            <td><?= $message['id'] ?></td>
            <td><?= $message['order_id'] ?></td>
            <td><?= $message['name'] ?></td>
            <td><?= $message['rating'] ?></td>
            <td><?= $message['review'] ?></td>
            <td><?= $message['date'] ?></td>
            <td class="text-center">
         <div class="btn-group" role="group">
        <button type="button" class="viewMessageBtn btn btn-info btn-sm" data-id="<?= $message['id']; ?>"><i class="fas fa-eye"></i> VIEW</button>
        <button type="button" value="<?= $message['id']; ?>" class="deleteMessageBtn btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> DELETE</button>
    </div>
</td>

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
$(document).on('click', '.viewMessageBtn', function () {
    var id = $(this).data('id');
    console.log("View button clicked. ID: " + id);

    $.ajax({
        type: "GET",
        url: "manager_feedback_code.php?id=" + id,
        success: function (response) {
            try {
                var res = jQuery.parseJSON(response);
                console.log("Parsed response object:", res); 
                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $('#view_id').text(res.data.id); 
                    $('#view_order_id').text(res.data.order_id);
                    $('#view_name').text(res.data.name);
                    $('#view_rating').text(res.data.rating);
                    $('#view_review').text(res.data.review);
                    $('#view_date').text(res.data.date);
                    $('#messageViewModal').modal('show'); // Show the modal
                }
            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
});




$(document).on('click', '.deleteMessageBtn', function (e) {
    e.preventDefault();
    var deleteBtn = $(this); 

    if (confirm('Are you sure you want to delete this data?')) {
        var id = deleteBtn.val();
        $.ajax({
            type: "POST",
            url: "manager_feedback_code.php",
            data: {
                'delete_message': true,
                'id': id
            },
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 500) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(res.message);
                } else {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);
                    // Disable the delete button temporarily to prevent multiple clicks
                    deleteBtn.prop('disabled', true);
                    
                    // Autoload function
                    $('#messageTable').load(location.href + " #messageTable", function () {
                        // Re-enable the delete button after the content is reloaded
                        deleteBtn.prop('disabled', false);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                alertify.set('notifier', 'position', 'top-right');
                alertify.error('An error occurred while deleting the message.');
            }
        });
    }
});




</script>

</body>
</html>


