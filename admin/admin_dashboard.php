<?php
include("../dbconn.php"); 

// Check if the user is not logged in and redirect to login page
$level="Admin";

if (!isset($_SESSION['id']) || ($_SESSION['userL']!=$level)) {
    $_SESSION['errorMsg']="Sorry, You're not an Admin";
    unset($_SESSION['id']);
    header('Location: admin_login.php');
}

$userId=$_SESSION['id'];
$getdata=mysqli_query($db,"SELECT * FROM `tb_customer` WHERE `custid`='$userId' ");
$rrw=mysqli_fetch_assoc($getdata);

// Define an array of categories to count low stocks of products
$categories = ['Smartphone', 'Laptop', 'Accessory'];

// Initialize an associative array to store low stock counts for each category
$lowStockCounts = [];

// Define a function to fetch and return low stock counts for a specific category
function getLowStockCount($conn, $category) {
    try {
        // Modify this SQL query to fetch low stock counts for the specified category
        $sql = "SELECT COUNT(*) AS low_stock_count FROM tb_product WHERE category = :category AND Stock < :threshold";
        
        // Replace 'your_table_name' with your actual table name and ':threshold' with your low stock threshold
        
        //$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':threshold', $low_stock_threshold);
        $low_stock_threshold = 10; // Set your low stock threshold here
        
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['low_stock_count'];
    } catch(PDOException $e) {
        return 0; // Handle any database errors here
    }
}

// Iterate over the categories and fetch low stock counts for each
foreach ($categories as $category) {
    $lowStockCounts[$category] = getLowStockCount($conn, $category);
}

if (isset($_POST['submit'])) {
    $inputEmail = strtolower(trim($_POST['email']));
    $inputPassword = trim($_POST['password']);

    if (isset($adminCredentials[$inputEmail]) && $inputPassword === $adminCredentials[$inputEmail]) {
        // Simulate user authentication
        // ... (your authentication code)

        // Set the login time and insert into the database
        $loginTime = date('Y-m-d H:i:s');
        // ... (your insert query)

        header("location: admin_dashboard.php");
        exit();
    } else {
        $message['password'] = 'Invalid email or password. Please try again.';
    }
}

if (isset($_GET['logout']) && isset($_SESSION['id'])) {
    // Get the current time for logout
    $logoutTime = date('Y-m-d H:i:s');

    // Update the database with logout time and status
    $updateQuery = "UPDATE tb_admin SET logout_time = :logout_time, status = 'inactive' WHERE id = :id";
    $updateStatement = $conn->prepare($updateQuery);
    $updateStatement->bindValue(':logout_time', $logoutTime, PDO::PARAM_STR);
    $updateStatement->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
    $updateSuccess = $updateStatement->execute();

    if ($updateSuccess) {
        // Destroy the session
        session_destroy();

        // Redirect to login page
        header("location: admin_login.php");
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
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="admin_style.css">-->
    <link rel="stylesheet" href="store_manager_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style type="text/css">.chartBox {
        width:100%;
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
    <h1><img src="admin-img/logo.png" alt="Logo" class="logo-img"> KING DEO AND QUEEN GRACE ADMIN DASHBOARD</h1>
    <div class="login-logout">
        <?php
        if (isset($_SESSION['id'])) {?>
        <a href="admin_dashboard.php"><i class="fas fa-user"></i> <?php echo $rrw['username']; ?></a>
        <?php
            echo '<a href="?logout=1"><i class="fas fa-sign-out-alt"></i> Logout</a>';
        } else {
            echo '<a href="admin_login.php"><i class="fas fa-user"></i> Admin</a>';
            echo '<a href=""><i class="fas fa-sign-out-alt"></i> Logout</a>';
        }
        ?>
    </div>
</div>
<!-- Dashboard  -->
<div class="add-products-container">
    <div class="add-products-sidebar">
        <ul>
            <li><a href="admin_dashboard.php" class="active"><i class="fas fa-home"></i><span class="label">Dashboard</span></a></li>
            <li><a href="admin_users.php"><i class="fas fa-users"></i><span class="label">Users</span></a></li>
            <li><a href="admin_products.php" class="active"><i class="fas fa-cube"></i><span class="label">Products</span></a></li>
            <li><a href="admin_inventory.php" class="active"><i class="fas fa-archive"></i><span class="label">Inventory</span></a></li>
            <li><a href="admin_analytics.php"><i class="fas fa-chart-bar"></i><span class="label">Analytics</span></a></li>
            <li><a href="admin_feedback.php"><i class="fas fa-star"></i><span class="label">Rating and Review</span></a></li>
            <li><a href="admin_messages.php"><i class="fas fa-envelope"></i><span class="label">Messages</span></a></li>
            <li><a href="admin_orders.php"><i class="fas fa-shopping-cart"></i><span class="label">Orders</span></a></li>
            <li><a href="admin_reports.php"><i class="fas fa-file-alt"></i><span class="label">Sales Reports</span></a></li>
            <li><a href="admin_announcements.php"><i class="fas fa-bullhorn"></i><span class="label">Announcements</span></a></li>
            <li><a href="admin_chatbox.php"><i class="fas fa-comments"></i><span class="label">Chatbox</span></a></li>
            <li><a href="admin_settings.php"><i class="fas fa-cogs"></i><span class="label">Settings</span></a></li>
        </ul>
    </div>
        <div class="dashboard-container" style="margin: 20px; padding: 20px;">
                <div class="dashboard-content" style="margin-top: 5px;">
                    <h2>DASHBOARD OVERVIEW</h2>
                    <!--
                    <a href="store_manager_dashboard.php" class="store-manager-button">
                        <i class="fas fa-store"></i> Store Manager
                    </a>
                    -->
                  <div class="dashboard-cards" style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; padding: 10px;">
                      
                    <!-- SmartPhone Stocks card -->
                  <div id="phoneCategory" class="dashboard-card" style="margin: 10px; padding: 10px;">
                    <div class="card-icon">
                        <i class="fas fa-mobile"></i>
                    </div>
                    <div class="card-content" style="margin: 5px; padding: 5px;">
                        <h3 id="phoneCategoryCount" style="margin: 5px; padding: 5px;">0</h3>
                        <span class="label-name" >SmartPhone Stocks</span>
                         <?php if ($lowStockCounts['Smartphone'] > 0): ?>
                            <!-- <div class="alert" id="alertPhone" style="display: none;"> </div> -->
                            <!-- Your alert message content goes here -->
                            <p class="low-stock-message">
                                <i class="fas fa-exclamation-triangle exclamation-icon"></i>
                                <?php echo $lowStockCounts['Smartphone']; ?> products are low stock.
                            </p>
                            
                         <?php endif; ?>
                    </div>
                </div>

                    <!-- Laptop Stocks card -->
                  <div id="laptopCategory" class="dashboard-card" style="margin: 10px; padding: 10px;">
                    <div class="card-icon">
                      <i class="fas fa-laptop"></i>
                    </div>
                    <div class="card-content" style="margin: 5px; padding: 5px;">
                      <h3 id="laptopCategoryCount" style="margin: 5px; padding: 5px;">0</h3>
                      <span class="label-name">Laptop Stocks</span>
                      <?php if ($lowStockCounts['Laptop'] > 0): ?>
                        <!-- <div class="alert" id="alertLaptop" style="display: none;"></div> -->
                            <!-- Your alert message content goes here -->
                            <p class="low-stock-message">
                                <i class="fas fa-exclamation-triangle exclamation-icon"></i>
                                <?php echo $lowStockCounts['Laptop']; ?> products are low stock.
                            </p>
                       
                       <?php endif; ?>
                    </div>
                  </div>
                  
                    <!-- Accessories Stocks card -->
                  <div id="accesoriesCategory" class="dashboard-card" style="margin: 10px; padding: 10px;">
                    <div class="card-icon">
                      <i class="fas fa-headphones"></i>
                    </div>
                    <div class="card-content" style="margin: 5px; padding: 5px;">
                      <h3 id="accessoryCategoryCount" style="margin: 5px; padding: 5px;">0</h3>
                      <span class="label-name">Accessories Stocks</span>
                      <?php if ($lowStockCounts['Accessory'] > 0): ?>
                        <!-- <div class="alert" id="alertAccessory" style="display: none;"> </div> -->
                            <!-- Your alert message content goes here -->
                            <p class="low-stock-message">
                                <i class="fas fa-exclamation-triangle exclamation-icon"></i>
                                <?php echo $lowStockCounts['Accessory']; ?> products are low stock.
                            </p>
                        
                        <?php endif; ?>
                    </div>
                  </div>
                  
                    <!-- Purchase Orders card -->
                  <div id="ordersCategory" class="dashboard-card" style="margin: 10px; padding: 10px;">
                    <div class="card-icon" >
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-content" style="margin: 5px; padding: 5px;">
                      <h3 id="purchaseOrdersCount" style="margin: 5px; padding: 5px;">0</h3>
                      <span class="label-name">Purchase Orders</span>
                    </div>
                  </div>
                  
                    <!-- Rating and Review card -->
                  <div id="ratingCategory" class="dashboard-card" style="margin: 10px; padding: 10px;">
                    <div class="card-icon">
                      <i class="fas fa-star"></i>
                    </div>
                    <div class="card-content" style="margin: 5px; padding: 5px;">
                      <h3 id="messagesCount" style="margin: 5px; padding: 5px;">0</h3>
                      <span class="label-name">Rating and Review</span>
                    </div>
                  </div>
                  
                    <!-- Inventory alert card -->
                  <div id="inventoryAlertsCategory" class="dashboard-card" style="margin: 10px; padding: 10px;">
                    <div class="card-icon">
                      <i class="fas fa-boxes"></i>
                    </div>
                    <div class="card-content" style="margin: 5px; padding: 5px;">
                      <h3 id="inventoryAlertsCount" style="margin: 5px; padding: 5px;">0</h3>
                      <span class="label-name">Inventory Alerts</span>
                    </div>
                  </div>
            </div>  <!-- dashboard cards endiv-->
            
            <div class="charts">
                <div class="top-products-chart">
                    <h2>Top 5 Products Ordered</h2>
                    <div class="chart">
                         <!--first CHART id?-->
                            <canvas id="myChart"></canvas>
                    </div>
                </div>    
                        <!--first CHART script-->
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
                        </button>-->
                    
                <div class="purchase-sales-chart">
                    <h2>Purchase and Sales Orders</h2>
                    
                    <div class="chart-container">
                         Sample content for purchase and sales chart 
                        <img src="img/sample_chart1.jpg" alt="Top Products Chart">
                        <button class="analytics-button" title="Analytics">
                            <i class="fas fa-chart-bar"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div> <!--dahboard content end div -->
    </div> <!--dahboard container end div -->
        
<script src="admin_script.js"></script>

<script>
//get count to display on the cards
    // Define an array with URLs to fetch data
    const urlConfigs = [
        { id: 'purchaseOrdersCount', url: 'admin_orders.php' },
        { id: 'messagesCount', url: 'admin_messages.php' },
        { id: 'inventoryAlertsCount', url: 'admin_low_stocks.php' },
        { id: 'phoneCategoryCount', url: 'admin_phone_category.php' },
        { id: 'laptopCategoryCount', url: 'admin_laptop_category.php' },
        { id: 'accessoryCategoryCount', url: 'admin_accessory_category.php' },
    ];

    // Function to update count and element
    function updateCount(elementId, url) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                $('#' + elementId).text(data);
            },
            error: function () {
                // Handle any errors here
                console.error('Error fetching count for ' + elementId);
            }
        });
    }

    // Iterate over the urlConfigs array and set intervals for updates
    $(document).ready(function () {
        for (const config of urlConfigs) {
            updateCount(config.id, config.url);
            setInterval(() => updateCount(config.id, config.url), 60000);
        }
    });
</script>
        
<script>
//to go to pages once clicked
        $(document).ready(function () {
            // Attach a click event handler to the card by its id
            $('#phoneCategory').click(function () {
                // Redirect to a different form or page
                window.location.href = 'admin_products.php'; // Replace with the actual URL
            });
        
            $('#laptopCategory').click(function () {
                window.location.href = 'admin_products.php'; // Replace with the actual URL
            });
            
            $('#accesoriesCategory').click(function () {
                window.location.href = 'admin_products.php'; // Replace with the actual URL
            });
            
            $('#ordersCategory').click(function () {
                window.location.href = 'admin_order_page.php'; // Replace with the actual URL
            });
            
            $('#ratingCategory').click(function () {
                window.location.href = 'admin_order_page.php'; // Replace with the actual URL
            }); 
            
            $('#inventoryAlertsCategory').click(function () {
                window.location.href = 'admin_order_page.php'; // Replace with the actual URL
            });
        });
        
        /* Commenting, might need again
        if (false) {
            // Show the alert message
            document.getElementById('alertAccessory').style.display = 'block';
            document.getElementById('alertLaptop').style.display = 'block';
            document.getElementById('alertPhone').style.display = 'block';
        }*/
</script>
</body>
</html>
