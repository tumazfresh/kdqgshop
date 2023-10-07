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

    if (isset($managerCredentials[$inputEmail]) && $inputPassword === $managerCredentials[$inputEmail]['password']) {
        // Simulate user authentication
        $query = "SELECT MAX(id) as max_id FROM tb_manager";
        $statement = $conn->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $nextUserId = $result['max_id'] + 1;

        $_SESSION['id'] = $nextUserId;
        $_SESSION['branch'] = $managerCredentials[$inputEmail]['branch'];

        $loginTime = gmdate('Y-m-d H:i:s', time() + (8 * 3600)); 
        $insertQuery = "INSERT INTO tb_manager (id, email, password, login_time, status) VALUES (:id, :email, :password, :login_time, 'active')";
        $insertStatement = $conn->prepare($insertQuery);
        $insertStatement->bindValue(':id', $nextUserId, PDO::PARAM_INT);
        $insertStatement->bindValue(':email', $inputEmail, PDO::PARAM_STR);
        $insertStatement->bindValue(':password', $inputPassword, PDO::PARAM_STR);
        $insertStatement->bindValue(':login_time', $loginTime, PDO::PARAM_STR);
        $insertStatement->execute();

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
        session_unset();
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
<!DOCTYPE html>
<html>
<head>
    <title>Store Manager Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="store_manager_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style type="text/css">.chartBox {
        width:400px;
    }</style>
</head>
<body>
    
<?php 
// Attempt select quer for chart
try{
  $sql = "SELECT product_name, SUM(quantity) AS quantity FROM tb_order GROUP BY product_name ORDER BY quantity DESC LIMIT 5;";   
  $result = $conn->query($sql);
  if($result->rowCount() > 0) {
      $quantity = array();
      $productName = array();
    while($row = $result->fetch()) {
        $quantity[]= $row["quantity"];
        $productName[]= $row["product_name"];
    }
  unset($result);
  } else {
    echo "No records matching your query were found.";
  }
} catch(PDOException $e){
  die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close connection
unset($conn);
?>

<div class="add-products-menubar">
    <h1><img src="img/logo.png" alt="Logo" class="logo-img"> KING DEO AND QUEEN GRACE STORE MANAGER DASHBOARD - <?php echo strtoupper($branch); ?> BRANCH</h1>
    <div class="login-logout">
        <?php
        if (isset($_SESSION['id'])) {
            echo '<a href="store_manager_dashboard.php"><i class="fas fa-user"></i> Store Manager</a>';
            echo '<a href="?logout=1"><i class="fas fa-sign-out-alt"></i> Logout</a>';
        } else {
            echo '<a href="store_manager_login.php"><i class="fas fa-user"></i> Store Manager</a>';
            echo '<a href=""><i class="fas fa-sign-out-alt"></i> Logout</a>';
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
    <div class="add-products-content">
        <h2>DASHBOARD</h2>
        <div class="add-products-content">
            <div class="dashboard-container">
                
                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-mobile"></i>
                    </div>
                    <div class="card-content">
                        <h3 id="phoneCategoryCount"></h3>
                        <span class="label-name">Smartphone Stocks</span>
                    </div>
                </div>
                
                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <div class="card-content">
                        <h3 id="laptopCategoryCount"></h3>
                        <span class="label-name">Laptop Stocks</span>
                    </div>
                </div>
                
                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-headphones"></i>
                    </div>
                    <div class="card-content">
                        <h3 id="accessoryCategoryCount"></h3>
                        <span class="label-name">Accessories Stocks</span>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-content">
                        <h3 id="purchaseOrdersCount"></h3>
                        <span class="label-name">Purchase Orders</span>
                    </div>
                </div>
                
                <div class="dashboard-card">
                    <div class="card-icon">
                          <i class="fas fa-star"></i>
                    </div>
                    <div class="card-content">
                        <h3 id="messagesCount"></h3>
                        <span class="label-name">Rating and Review</span>
                    </div>
                </div>
                
                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="card-content">
                        <h3 id="inventoryAlertsCount"></h3>
                        <span class="label-name">Inventory Alerts</span>
                    </div>
                </div>
                
            </div class="chartBox">
            <div class="charts">
                <div class="top-products-chart">
                    <h2>Top 5 Products Ordered</h2>
                    <div class="chart">
                         <!--first CHART-->
                        <div>
                          <canvas id="myChart"></canvas>
                        </div>
                        
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        
                        <script>
                        
                        // setup
                            const quantity = <?php echo json_encode($quantity); ?>;
                            const productName = <?php echo json_encode($productName); ?>;
                            const data = {
                                labels: productName,
                                datasets: [{
                                    //label: '# of Orders', NOTE: Might include again, depends
                                    label: 'Quantity Ordered',
                                    data: quantity,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(153, 102, 255, 0.6)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)'
                                    ],
                                    borderWidth: 1,
                                }]
                            };
                        
                            // Config
                            const config = {
                                type: 'bar',
                                data,
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            grid: {
                                                display: true,
                                                color: 'rgba(0, 0, 0, 0.1)', 
                                            },
                                            title: {
                                                display: true,
                                                text: 'Quantity Ordered', // y-axis label
                                            },
                                        },
                                        x: {
                                            grid: {
                                                display: false,
                                            },
                                            title: {
                                                display: true,
                                                text: 'Products Purchased', // x-axis label
                                            },
                                        },
                                    },
                                    plugins: {
                                        legend: {
                                            display: false,
                                        },
                                    },
                                    responsive: true,
                                    maintainAspectRatio: false, // disable aspect ratio for more control
                                    animation: {
                                        duration: 2000, // animation duration 
                                        easing: 'easeOutBounce', // animation function
                                    },
                                },
                            };
                            
                        //chart render
                            const ctx = document.getElementById('myChart').getContext('2d');
                            const myChart = new Chart(ctx, config);
                         // new Chart(ctx, {
                          //});
                        </script>
                        <!--<img src="img/sample_chart1.jpg" alt="Top Products Chart">-->
                        <!--<button class="analytics-button" title="Analytics">
                            <i class="fas fa-chart-bar"></i>
                        </button>
                    </div>
                </div>
                <div class="purchase-sales-chart">
                    <!--<h2>Purchase and Sales Orders</h2>-->
                    <div class="chart-container">
                        <!-- Sample content for purchase and sales chart -->
                        <!--<img src="img/sample_chart1.jpg" alt="Top Products Chart">-->
                        <button class="analytics-button" title="Analytics">
                            <i class="fas fa-chart-bar"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <script src="admin_script.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        function updatePurchaseOrdersCount() {
            $.ajax({
                url: 'get_orders.php', 
                type: 'GET',
                success: function (data) {
                    $('#purchaseOrdersCount').text(data);
                },
                error: function () {
                    // Handle any errors here
                    console.error('Error fetching purchase orders count.');
                }
            });
        }

        updatePurchaseOrdersCount();
        
        setInterval(updatePurchaseOrdersCount, 60000); 
</script>

    <script>
        function updateMessagesCount() {
        $.ajax({
            url: 'get_messages.php', 
            type: 'GET',
            success: function (data) {
                $('#messagesCount').text(data);
            },
            error: function () {
                // Handle any errors here
                console.error('Error fetching messages count.');
            }
        });
    }

    updateMessagesCount();
    setInterval(updatePurchaseOrdersCount, 60000);
</script>

    <script>
    function updateProductsCount() {
        $.ajax({
            url: 'get_products.php',
            type: 'GET',
            success: function (data) {
                $('#productCount').text(data);
            },
            error: function () {
                // Handle any errors here
                console.error('Error fetching products count.');
            }
        });
    }
    
    updateProductsCount();
    setInterval(updateProductsCount, 60000); 
</script>

    <script>
    function updateInventoryAlertsCount() {
        $.ajax({
            url: 'get_low_stocks.php',
            type: 'GET',
            success: function (data) {

                $('#inventoryAlertsCount').text(data);
            },
            error: function () {
                // Handle any errors here
                console.error('Error fetching inventory alerts count.');
            }
        });
    }

    updateInventoryAlertsCount();
    setInterval(updateInventoryAlertsCount, 60000); 

</script>

<script>
    function updatePhoneCategoryCount() {
        $.ajax({
            url: 'phone_category.php',
            type: 'GET',
            success: function (data) {
                $('#phoneCategoryCount').text(data);
            },
            error: function () {
                // Handle any errors here
                console.error('Error fetching phone category count.');
            }
        });
    }

    updatePhoneCategoryCount();
    setInterval(updatePhoneCategoryCount, 60000);
</script>

<script>
    function updateLaptopCategoryCount() {
        $.ajax({
            url: 'laptop_category.php',
            type: 'GET',
            success: function (data) {
                $('#laptopCategoryCount').text(data);
            },
            error: function () {
                // Handle any errors here
                console.error('Error fetching laptop category count.');
            }
        });
    }

    updateLaptopCategoryCount();
    setInterval(updateLaptopCategoryCount, 60000);
</script>

<script>
    function updateAccessoryCategoryCount() {
        $.ajax({
            url: 'accessory_category.php',
            type: 'GET',
            success: function (data) {
                $('#accessoryCategoryCount').text(data);
            },
            error: function () {
                // Handle any errors here
                console.error('Error fetching accessory category count.');
            }
        });
    }

    updateAccessoryCategoryCount();
    setInterval(updateAccessoryCategoryCount, 60000);
</script>
</body>
</html>
