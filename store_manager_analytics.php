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
    <title>Store Manager Analytics</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="store_manager_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

        body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.header {
    background-color: #3498db;
    color: #fff;
    padding: 20px;
    text-align: center;
}

.header h1 {
    font-size: 28px;
    margin: 0;
}

.nav {
    background-color: #333;
    color: #fff;
    padding: 10px 0;
}

.nav ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
    text-align: center;
}

.nav li {
    display: inline;
    margin-right: 20px;
}

.nav a {
    text-decoration: none;
    color: #fff;
}

.chart-container {
    max-width: 1400px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    padding: 30px;
    margin-bottom: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center; 
}

.chart-title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
    display: inline-block; 
    align-items: center; 
}



.chart-box {
    width: 100%;
    max-width: 100%;
    margin: 0 auto;
    background-color: #ffffff;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.2);
    overflow: hidden;
}

.chart {
    width: 500%;
    height: 500px;
}

@media (max-width: 768px) {
    .chart-container {
        padding: 20px; /
    }
    .chart-title {
        font-size: 24px; 
    }
    .chart {
        height: 400px; 
    }
}




    </style>
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
    <h1><img src="img/logo.png" alt="Logo" class="logo-img"> KING DEO AND QUEEN GRACE STORE MANAGER ANALYTICS - <?php echo strtoupper($branch); ?> BRANCH</h1>
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
    
    <!-- Main Content -->
    <div class="container">
        <!-- bar graph-->
        <div class="chart-container">
            <h2 class="chart-title">Top 5 Products Purchased</h2>
            <canvas id="myChart1" class="chart-box"></canvas>
        </div>

        <!-- line chart -->
        <div class="chart-container">
            <h2 class="chart-title">Number of Products by Categories</h2>
            <canvas id="myChart2" class="chart-box"></canvas>
        </div>
    </div>
    
        <!-- pie chart -->
    <div class="chart-container">
        <h2 class="chart-title">Sales by Category</h2>
        <canvas id="myChart3" class="chart-box"></canvas>
    </div>
    
        <!-- horizontalchart -->
    <div class="chart-container">
        <h2 class="chart-title">Categories Distribution by Branches</h2>
        <canvas id="myChart4" class="chart-box"></canvas>
    </div>



    <script>
        //barchart
        const quantity = <?php echo json_encode($quantity); ?>;
        const productName = <?php echo json_encode($productName); ?>;
        const data1 = {
            labels: productName,
            datasets: [{
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

        const ctx1 = document.getElementById('myChart1').getContext('2d');
        const myChart1 = new Chart(ctx1, {
            type: 'bar',
            data: data1,
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
                            text: 'Quantity Ordered',
                        },
                    },
                    x: {
                        grid: {
                            display: false,
                        },
                        title: {
                            display: true,
                            text: 'Products Purchased',
                        },
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                },
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 2000,
                    easing: 'easeOutBounce',
                },
            },
        });

        // linechart (SAMPLE ONLY)
        const smartphonesData = [10, 15, 20, 25, 30];
        const laptopsData = [5, 8, 12, 15, 20];
        const accessoriesData = [15, 18, 22, 28, 35];

        const data2 = {
            labels: productName,
            datasets: [
                {
                    label: 'Smartphones',
                    data: smartphonesData,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 173, 173, 0.6)',
                },
                {
                    label: 'Laptops',
                    data: laptopsData,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(173, 216, 230, 0.6)', 
                },
                {
                    label: 'Accessories',
                    data: accessoriesData,
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(240, 230, 140, 0.6)', 
                },
            ],
        };


        const ctx2 = document.getElementById('myChart2').getContext('2d');
        const myChart2 = new Chart(ctx2, {
            type: 'line',
            data: data2,
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
                            text: 'Number of Products',
                        },
                    },
                    x: {
                        grid: {
                            display: false,
                        },
                        title: {
                            display: true,
                            text: 'Category',
                        },
                    },
                },
                plugins: {
                    legend: {
                        display: true,
                    },
                },
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 2000,
                    easing: 'easeOutBounce',
                },
            },
        });
        
            //piechart (SAMPLE ONLY)
            const salesData = [3000, 5000, 2000];
            const categoryLabels = ['Smartphones', 'Laptops', 'Accesorries'];
            
            const data3 = {
                labels: categoryLabels,
                datasets: [{
                    data: salesData,
                    backgroundColor: [
                        'rgba(240, 230, 140, 0.6)', 
                        'rgba(152, 251, 152, 0.6)', 
                        'rgba(255, 192, 203, 0.6)', 
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(50, 205, 50, 1)',
                        'rgba(255, 105, 180, 1)',
                    ],
                    borderWidth: 1,
                }]
            };

            
            const ctx3 = document.getElementById('myChart3').getContext('2d');
            const myChart3 = new Chart(ctx3, {
                type: 'pie',
                data: data3,
                options: {
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right', 
                        },
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 2000,
                        easing: 'easeOutBounce',
                    },
                },
            });
            
            
            
            

    </script>
</body>
</html>