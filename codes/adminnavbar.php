
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
    <h1><img src="../img/logo.png" alt="Logo" class="logo-img"> KING DEO AND QUEEN GRACE ADMIN DASHBOARD</h1>
    <div class="login-logout">
        <?php
        if (isset($_SESSION['id'])) {?>
        <a href="./"><i class="fas fa-user"></i> <?php echo $rrw['username']; ?></a>
        <?php
            echo '<a href="?logout=1"><i class="fas fa-sign-out-alt"></i> Logout</a>';
        } else {
            echo '<a href="admin_login.php"><i class="fas fa-user"></i> Admin</a>';
            echo '<a href=""><i class="fas fa-sign-out-alt"></i> Logout</a>';
        }
        ?>
    </div>
</div>