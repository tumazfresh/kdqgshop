<div class="add-products-menubar">
        <h1><img src="img/logo.png" alt="Logo" class="logo-img"> KING DEO AND QUEEN GRACE STORE MANAGER PRODUCTS - <?php echo strtoupper($branch); ?> BRANCH</h1>
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