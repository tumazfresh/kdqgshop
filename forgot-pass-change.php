<?php
include('dbconn.php');
session_start();

echo "Your email is". $_SESSION['forgotpass-email'] ." NOTE: test only to check if emails is passed to this page";
$message = [];

if (isset($_POST['submit'])) {
   $email = $_SESSION['forgotpass-email'];
   $password = $_POST['password'];
   $confirmPassword = $_POST['confirmPassword'];
   
   if (!$password){
       $message['password'] = 'Please enter your password';
   } else if (strlen($password) < 8 || !preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*])/', $password)) {
       $message['password'] = 'Password must contain at least 8 characters, including alphanumeric, numbers, and special characters.';
   }
   
   
   if (!$confirmPassword){
       $message['confirm-password'] = 'Please confirm your password';
   } else if ($password != $confirmPassword){
       $message['confirm-password'] = 'Password does not match.';
   }
   
   if (count($message) === 0){
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      
      $update_password = $conn->prepare("UPDATE `tb_customer` SET password=? WHERE email=?");
      $update_password->execute([$hashedPassword, $email]);
      
      header('location: login.php');
      exit();
     }
}
?>

<!-- NOTE: DELETE COMMENT IF WORKING PROPERLY....Display the error message if email duplication, birthdate limitation, or password duplication occurs -->

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <style>
    .forgot-pass-form {
            max-width: 400px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .forgot-pass-form h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
        }
        
        .submit-btn-container {
            display: flex;
            justify-content: flex-end;
        }

        .submit-btn {
            padding: 10px 20px;
            background-color: #8CB2E8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #A4C2F4;
        }
    
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav">
            <img src="img/logo.png" class="logo" alt="">
            
        </div>
    </nav>
    <div class="nav-items">
        <ul class="links-container">
            <li class="link-item"><a href="index.php" class="link">Home</a></li>
            <li class="link-item"><a href="product_catalog.php" class="link">Product Catalog</a></li>
            <li class="link-item"><a href="contact_us.php" class="link">Contact Us</a></li>
            <li class="link-item"><a href="faq.php" class="link">FAQs</a></li>
            <li class="link-item"><a href="warranty.php" class="link">Warranty Policy</a></li>
            <li class="link-item"><a href="replacement.php" class="link">Replacement Policy</a></li>
        </ul>
    </div>
    </nav>
    <div class="forgot-pass-form">
    <h2>Change Passwrod</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="form-group">
            <label for="name">Enter Password</label>
            <input class="form-control <?php echo isset($message['password']) ? 'is-invalid' : '' ?>" type="password" id="password" name="password" placeholder="Enter your Email" value="<?php echo isset($_POST["password"]) ? htmlspecialchars($_POST["password"]) : ''; ?>" required>
            <div class="invalid-feedback">
                <?php echo $message['password'] ?? '' ?>
            </div>
        </div>
        <div class="form-group">
            <label for="name">Confirm Password </label>
            <input class="form-control <?php echo isset($message['confirm-password']) ? 'is-invalid' : '' ?>" type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter Your password" >
            <div class="invalid-feedback">
                <?php echo $message['confirm-password'] ?? '' ?>
            </div>
        </div>
        <div class="submit-btn-container">
            <button type="submit" name="submit" class="submit-btn">Confirm Password
            </button>
        </div>
    </form>
</div>
    <?php include 'footer.php'; ?>
</body>
</html>