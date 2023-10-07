<?php
include('dbconn.php');
session_start();

//if (isset($_SESSION['id'])) {
//   $id = $_SESSION['id'];
//} else {
//   $id = '';
//}

$message = [];

if (isset($_POST['submit'])) {
   $email = trim($_POST['email']);
   //$email = filter_var($email, FILTER_SANITIZE_STRING);
   $verificationCode = $_POST['code'];
   
   //email validation
   if (!$email) {
       $message['email'] = 'Please Enter your email';
   } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $message['email'] = 'Please enter a valid email.';
   }
   
   //verifcation code validation
    if (!$verificationCode){
       $message['verification-code'] = 'This is a required field.';
   }else if ($verificationCode !=  $_SESSION['verification_code']){
       $message['verification-code'] = 'Verification code does not match.';
   }
    
   if (count($message) === 0){
      $_SESSION['forgotpass-email'] = $email;
      header('location: forgot-pass-change.php');
      exit();
     }
}

if (isset($_POST['submitOTP'])) {

    $email = $_POST['email'];
    
    $select_user = $conn->prepare("SELECT * FROM `tb_customer` WHERE email = ?");
    $select_user->execute([$email]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
    
    if ($select_user->rowCount() == 0) {
      $message['email'] = 'This email does not exists, please enter a valid email.';
    } 
    
    if (count($message) === 0){
        $verificationCode = substr(number_format(time() * rand(), 0, '',''), 0, 6);
        $from = "@kdqgshop.com";
        $to = $email;
        $subject = "KDQG Email Verfication";
        $message = 'Your verfication code is: '. $verificationCode;
        $_SESSION['verification_code'] = $verificationCode;
        // The content-type header must be set when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers = "From:" . $from;
        
        if(mail($to,$subject,$message, $headers)) {
              echo "Verfication Code Sent.";
        } else {
              echo "Message was not sent.";
        }
    }

}
?>

<!-- NOTE: DELETE COMMENT IF WORKING PROPERLY....Display the error message if email duplication, birthdate limitation, or password duplication occurs -->

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
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
    <h2>Forgot Password</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="form-group">
            <label for="name">Enter Email</label>
            <input class="form-control <?php echo isset($message['name']) ? 'is-invalid' : '' ?>" type="text" id="email" name="email" placeholder="Enter your Email" value="<?php echo isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : ''; ?>" required>
            <div class="invalid-feedback">
                <?php echo $message['email'] ?? '' ?>
            </div>
        </div>
        <div class="form-group">
            <label for="name">Enter Verification Code </label>
            <input class="form-control <?php echo isset($message['name']) ? 'is-invalid' : '' ?>" type="text" id="code" name="code" placeholder="Enter Verification Code Sent" >
            <div class="invalid-feedback">
                <?php echo $message['verification-code'] ?? '' ?>
            </div>
        </div>
        <div class="submit-btn-container">
            <button type="submit" name="submit" class="submit-btn">Change Password
            </button>
        </div>
        <div class="submit-btn-container">
            <button type="submit" name="submitOTP" class="submit-btn">Send Verification 
            </button>
        </div>
    </form>
</div>
    <?php include 'footer.php'; ?>
</body>
</html>