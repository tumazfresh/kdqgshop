<?php
if (!isset($_SESSION['id']) || ($_SESSION['userL']!="Admin")) {
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