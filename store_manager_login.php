<?php
include("dbconn.php");

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


if (isset($_GET['logout'])) {
    session_destroy();

    if (isset($_SESSION['id'])) {
        $inactiveQuery = "UPDATE tb_manager SET status = 'inactive' WHERE id = :id";
        $inactiveStatement = $con->prepare($inactiveQuery);
        $inactiveStatement->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
        $inactiveStatement->execute();
    }

    header("location: store_manager_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Store Manager Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="store_manager_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="add-products-menubar">
    <h1><img src="img/logo.png" alt="Logo" class="logo-img"> KING DEO AND QUEEN GRACE STORE MANAGER LOGIN</h1>
    
</div>
<div class="login-card">
    <div class="header-container">
        <h2><i class="fas fa-user-lock"></i> STORE MANAGER LOGIN PANEL</h2>
    </div>
    <div class="login-container">
    <form action="" method="POST">
        <div class="form-group">
            <div class="input-container">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Email Address" autofocus="" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input class="form-control <?php echo isset($message['password']) ? 'is-invalid' : '' ?>" type="password" id="password" name="password" placeholder="Password" required>
                <div class="invalid-feedback">
                    <?php echo $message['password'] ?? '' ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Login">
        </div>
    </form>
</div>
<script src="admin_script.js"></script>
</body>
</html>