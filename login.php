<?php
include('dbconn.php');
include('header.php');
if(isset($_SESSION['id']))
{
    header('location:./');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<head>
    <title>Login Form | KDQG</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="css/login_design.css">
</head>

<body>
    <div class="login-form">
        <h2>Login to My Account</h2>
        <p class="welcome-text">Welcome back! </p>
        <p class="login-text">Please enter your email and password:</p>
        <?php
                if(isset($_SESSION['errorMsg']))
                { ?>
                <div class="alert-danger" role="alert"><?php echo $_SESSION['errorMsg']; ?>
</div>
                    <?php
                    unset($_SESSION['errorMsg']);
                }
                ?>
    <form action="./loginserver.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" type="text" name="email" placeholder="Username/Email Address" required>
                
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter password here" required>
                
                    <p><a href="forgot-pass.php" id="forgotPasswordLink" class="disabled">Forgot password?</a></p>
            </div>
            <div class="form-group">
                <input class="form-control login-btn" type="submit" name="login" value="Login">
                <p>Don't have an account yet? <a href="registration.php">Signup now</a></p>
            </div>
        </form>
    </div>
    
    <?php include 'deals.php'; ?>
    <?php include 'slide.php'; ?>
    <?php include 'footer.php'; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

</body>
</html>