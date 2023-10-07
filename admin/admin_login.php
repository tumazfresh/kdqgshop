<?php
include("../dbconn.php");
if(isset($_SESSION['id']))
{
    header('location:./');
    exit;
}

?>




<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../store_manager_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="add-products-menubar">
    <h1><img src="../img/logo.png" alt="Logo" class="logo-img"> KING DEO AND QUEEN GRACE ADMIN LOGIN</h1>
    
</div>
<div class="login-card">
    <div class="header-container">
        <h2><i class="fas fa-user-lock"></i> ADMIN LOGIN PANEL</h2>
    </div>
    <div class="login-container">
    <form action="../adminserver/loginserver.php" method="POST">
        <div class="form-group">
            <div class="input-container">
                <?php
                if(isset($_SESSION['errorMsg']))
                { ?>
                <div class="alert alert-danger" role="alert"><?php echo $_SESSION['errorMsg']; ?>
</div>
                    <?php
                    unset($_SESSION['errorMsg']);
                }
                ?>
            </div>
            <div class="input-container">
                <i class="fas fa-envelope"></i>
                <input type="text" id="email" name="email" placeholder="Username/Email Address" autofocus="" value="" required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input class="form-control" type="password" id="password" name="password" placeholder="Password" required>
             
            </div>
        </div>
        <div class="form-group">
            <input type="submit" name="login" value="Login">
        </div>
    </form>
</div>

</body>
</html>