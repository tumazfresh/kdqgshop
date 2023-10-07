<?php
include('dbconn.php');


if (isset($_SESSION['id'])) {
   $id = $_SESSION['id'];
} else {
   $id = '';
}

$message = [];


if(isset($_POST['terms-checkbox'])) {
    $_SESSION['terms-checkbox'] = true;
} else {
    $_SESSION['terms-checkbox'] = false;
}
    
if (isset($_POST['submit'])) {
   //store user input
   $name = trim($_POST['name']);
   $email = trim($_POST['email']);
   $pass = $_POST['password'];
   $cpass = $_POST['confirm-password'];
   $birthdate = $_POST['birthdate'];
   $gender = $_POST['gender'];
   $houseno = trim($_POST['houseno']);
   $street = trim($_POST['street']);
   $barangay = trim($_POST['barangay']);
   $city = trim($_POST['city']);
   $zipcode = trim($_POST['zipcode']);
   $phoneNumber = trim($_POST['phone-number']);
   $checkVerification = $_POST['verification-code'];
   $storedVerificationCode = $_SESSION['verification_code'] ?? '';
   //$terms = $_POST['terms-checkbox'];
    
   //Name validation
   if (!$name){
       $message['name'] = 'This is a required field';
   }
   if (!preg_match("/^[a-zA-Z ]*$/",$name)){
      $message['name'] = 'Number and special characters are not allowed in this field.';
   }
   
   //Email validation
   if (!$email) {
    $message['email'] = 'Email is a required field';
    } elseif (!preg_match('/^[A-Za-z0-9._%+-]+@(gmail\.com|my\.jru\.edu)$/', $email)) {
        $message['email'] = 'Invalid email format. Allowed domains are gmail.com and my.jru.edu';
    }

   // Password validation
   if (!$pass){
       $message['password'] = 'This is a required field';
   }
   if (strlen($pass) < 8 || !preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*])/', $pass)) {
      $message['password'] = 'Password must contain at least 8 characters, including alphanumeric, numbers, and special characters.';
   }

   // Phone number validation
   if (!$phoneNumber){
       $message['phone-number'] = 'This is a required field';
   }
   if (!preg_match('/^(09|\+639)\d{9}$/', $phoneNumber)) {
      $message['phone-number'] = 'Invalid contact number. Please enter a valid phone number starting with "09" or "+639".';
   }

   //check if pass and confirm pass matches
   if (!$cpass){
       $message['confirm-password'] = 'This is a required field';
   } else if ($pass != $cpass) {
      $message['confirm-password'] = 'The password you enter does not match!';
   }

   // Birthdate limitation - age should not be a minor (below 16 years old)
   if (!$birthdate){
       $message['birthdate'] = 'This is a required field';
   }
   
   $birthdateObj = DateTime::createFromFormat('Y-m-d', $birthdate);
   $today = new DateTime();
   $age = $today->diff($birthdateObj)->y;

   if ($age < 16) {
      $message['birthdate'] = 'You must be at least 16 years old to register.';
   }
   
    // address Validation
   if (!$houseno){
       $message['houseno'] = 'This is a required field';
   }
   
   if (!$street){
       $message['street'] = 'This is a required field';
   }
   
   if (!$barangay){
       $message['barangay'] = 'This is a required field';
   }
   
   if (!$city){
       $message['city'] = 'This is a required field';
   }
   
   if (!$zipcode){
       $message['zipcode'] = 'This is a required field';
   }
   
   $select_user = $conn->prepare("SELECT * FROM `tb_customer` WHERE email = ?");
   $select_user->execute([$email]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
   //email validation
   if ($select_user->rowCount() > 0) {
      $message['email'] = 'Email already exists! Try another one.';
   } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $message['email'] = 'Please enter a valid email.';
   } 
   
   //verifcation code validation
    if (!$checkVerification){
       $message['verification-code'] = 'This is a required field';
   }else if ($checkVerification !=  $storedVerificationCode){
       $message['verification-code'] = 'Verification code does not match';
   }
    
    
   if (count($message) === 0){
      // Encrypt the password using bcrypt

      $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
      $insert_user = $conn->prepare("INSERT INTO `tb_customer` (name, email, password, birthdate, gender, house_number, street, barangay, city, zip_code, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $insert_user->execute([$name, $email, $hashedPassword, $birthdate, $gender, $houseno, $street, $barangay, $city, $zipcode, $phoneNumber]);
      header('location: login.php');
      exit();
     }
}

if (isset($_POST['submitOTP'])) {

    $name = $_POST['name'];
    //$name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    //$email = filter_var($email, FILTER_SANITIZE_STRING);
    
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
        echo '<script language="javascript"> alert("Verification code sent.") </script>';
    } else {
          echo "Message was not sent.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head><?php include('header2.php')?></head>
<head>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="css/stylefront_design(1).css">
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <style>
    </style>
</head>
<body>
<div class= "d-block d-md-none">    <!-- MOBILE VIEW-->
<div class="registration-form-mobile">
        <h2>Register now to King Deo and Queen Grace MOBILE!</h2>
        
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
              <label for="name">Name</label>
              <input class="form-control <?php echo isset($message['name'])  ? 'is-invalid' : '' ?>" type="text" id="name" name="name" placeholder="Enter fullname" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>" required>
              <div class="invalid-feedback"> 
                 <?php echo $message['name'] ?? '' ?>
              </div>
              <small class="form-text text-muted">
                Number and special characters are not allowed in this field.
            </small>
            </div>
          
            <div class="form-group">
              <label for="email">Email Address</label>
              <input class="form-control <?php echo isset($message['email'])  ? 'is-invalid' : '' ?>" type="email" id="email" name="email" placeholder="Enter email address" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>"  required>
              <div class="invalid-feedback"> 
                 <?php echo $message['email'] ?? '' ?>
              </div>
              <small class="form-text text-muted">
                The email format should be valid. Use Gmail domain. (e.g., juandc@gmail.com)
            </small>
            </div>
            
            <div class="form-group">
              <label for="password">Password</label>
              <input class="form-control <?php echo isset($message['password'])  ? 'is-invalid' : '' ?>" type="password" id="password" name="password" placeholder="Enter password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ''; ?>"  required>
              <div class="invalid-feedback"> 
                 <?php echo $message['password'] ?? '' ?>
              </div> 
            <small class="form-text text-muted">
                Password must contain at least 8 characters, including alphanumeric, numbers, and special characters.
            </small>
        </div>
        
            <div class="form-group">
               <label for="confirm-password">Confirm Password</label>
               <input class="form-control <?php echo isset($message['confirm-password'])  ? 'is-invalid' : '' ?>" type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" value="<?php echo isset($_POST["confirm-password"]) ? $_POST["confirm-password"] : ''; ?>" required>
               <div class="invalid-feedback"> 
                  <?php echo $message['confirm-password'] ?? '' ?>
               </div>
               <small class="form-text text-muted">
                The password should be matched.
            </small>
            </div>
            
            <div class="form-group">
               <label for="birthdate">Birthdate</label>
               <input class="form-control <?php echo isset($message['birthdate'])  ? 'is-invalid' : '' ?>" type="date" id="birthdate" name="birthdate" value="<?php echo isset($_POST["birthdate"]) ? $_POST["birthdate"] : ''; ?>"  required>
               <div class="invalid-feedback"> 
                 <?php echo $message['birthdate'] ?? '' ?>
              </div> 
              <small class="form-text text-muted">
                You should at least be above 16 years old to register.
            </small>
            </div>
            
            <div class="form-group">
            <label for="gender">Gender</label>
               <select id="gender" name="gender" required>
                  <option value="" disabled selected>Select Gender</option>
                  <option <?php echo isset($_POST["gender"]) && $_POST["gender"] === "male" ? "selected" : ""; ?> value="male" >Male</option>
                  <option <?php echo isset($_POST["gender"]) && $_POST["gender"] === "female" ? "selected" : ""; ?> value="female" >Female</option>
                  <option <?php echo isset($_POST["gender"]) && $_POST["gender"] === "others" ? "selected" : ""; ?> value="other" >Others</option>
               </select>
            <small class="form-text text-muted">
                Select your preferred gender.
            </small>
            </div>

            <div class="form-group">
              <label for="houseno">House No.</label>
              <input class="form-control <?php echo isset($message['houseno'])  ? 'is-invalid' : '' ?>" type="text" id="houseno" name="houseno" placeholder="Enter house number" value="<?php echo isset($_POST["houseno"]) ? $_POST["houseno"] : ''; ?>" minlength="1" maxlength="8" required>
              <div class="invalid-feedback"> 
                 <?php echo $message['houseno'] ?? '' ?>
              </div> 
              <small class="form-text text-muted">
                The house number should be correct. (e.g., 1805)
            </small>
            </div>
    
            <div class="form-group">
              <label for="street">Street</label>
              <input class="form-control <?php echo isset($message['street'])  ? 'is-invalid' : '' ?>" type="text" id="street" name="street" placeholder="Enter street" value="<?php echo isset($_POST["street"]) ? $_POST["street"] : ''; ?>" minlength="6" maxlength="20" required>
              <div class="invalid-feedback"> 
                 <?php echo $message['street'] ?? '' ?>
              </div> 
              <small class="form-text text-muted">
                The street should be correct. (e.g., Daffodil St.)
            </small>
            </div>
    
            <div class="form-group">
              <label for="barangay">Barangay</label>
              <input class="form-control <?php echo isset($message['barangay'])  ? 'is-invalid' : '' ?>" type="text" id="barangay" name="barangay" placeholder="Enter barangay" value="<?php echo isset($_POST["barangay"]) ? $_POST["barangay"] : ''; ?>" minlength="5" maxlength="20" required>
              <div class="invalid-feedback"> 
                 <?php echo $message['barangay'] ?? '' ?>
              </div> 
              <small class="form-text text-muted">
                The barangay should be correct. (e.g., Hulo)
            </small>
            </div>
    
            <div class="form-group">
              <label for="city">City</label>
              <input class="form-control <?php echo isset($message['city'])  ? 'is-invalid' : '' ?>" type="text" id="city" name="city" placeholder="Enter city" value="<?php echo isset($_POST["city"]) ? $_POST["city"] : ''; ?>" minlength="6" maxlength="30" required>
              <div class="invalid-feedback"> 
                 <?php echo $message['city'] ?? '' ?>
              </div> 
              <small class="form-text text-muted">
                The city should be correct. (e.g., Mandaluyong)
            </small>
            </div>
    
            <div class="form-group">
              <label for="zipcode">Zip Code</label>
              <input class="form-control <?php echo isset($message['zipcode'])  ? 'is-invalid' : '' ?>" type="text" id="zipcode" name="zipcode" placeholder="Enter zip code" value="<?php echo isset($_POST["zipcode"]) ? $_POST["zipcode"] : ''; ?>" minlength="4" maxlength="4" required>
              <div class="invalid-feedback"> 
                 <?php echo $message['zipcode'] ?? '' ?>
              </div> 
              <small class="form-text text-muted">
                The zip code should be correct. (e.g., 1550)
            </small>
            </div>
    
            <div class="form-group">
              <label for="phone-number">Phone Number</label>
              <input class="form-control <?php echo isset($message['phone-number'])  ? 'is-invalid' : '' ?>" type="tel" id="phone-number" name="phone-number" placeholder="Enter Phone Number" value="<?php echo isset($_POST["phone-number"]) ? $_POST["phone-number"] : ''; ?>" minlength="11" maxlength="11" required>
              <div class="invalid-feedback"> 
                 <?php echo $message['phone-number'] ?? '' ?>
              </div>
              <small class="form-text text-muted">
                Please enter a valid phone number starting with "09" or "+639".
            </small>
            </div>

            <div class="form-group checkbox-container">
              <label for="terms-checkbox">
                <input type="checkbox" id="terms-checkbox" name="terms-checkbox" <?php if(isset($_SESSION['terms-checkbox']) && $_SESSION['terms-checkbox']) echo 'checked'; ?> required>
                <span class="checkbox-custom" style ="margin-bottom: 50px; border-width: 10px;"></span>
                <p>I agree to the terms and conditions of the<a href="privacy-policy.php" >Privacy Policy</a></p>
              </label>
            </div>

            <div class="form-group">
                <div class="verification-code-container">
                    <label for="verification-code">Email Verification Code</label>
                    <div class="input-group ">
                        <input class="form-control" <?php echo isset($message['verification-code'])  ? 'is-invalid' : '' ?> type="text" id="verification-code" name="verification-code" placeholder="Verification Code">
                        <button type="submit" name="submitOTP" class="btn btn-primary">OTP</button> 
                    </div>    
                </div>
            </div>
            <div class="invalid-feedback " > 
                <?php echo $message['verification-code'] ?? '' ?>
            </div> 
    

    <div class="form-group button-group">
      <input type="submit" name="submit" value="Create Account" class="submit-btn">
      <input type="button" value="Cancel" class="cancel-btn">
   </div>

    <p>Already have an account?</br><a href="login.php" style="float: right;">Login here</a></p>
  </form>
</div>
        <div class="registration-image">
        <img src="img/registration.png" alt="Registration Image" class="registration-img">
        </div>
</div><!--end edit-->






<div class= "d-none d-sm-block "> <!-- BROWSER VIEW-->
<div class="registration-form">
        <h2>Register now to King Deo and Queen Grace!</h2>
        <div class="registration-image">
        <img src="img/registration.png" alt="Registration Image" class="registration-img animated-image">
        </div>
        
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
              <label for="name">Name</label>
              <input class="form-control <?php echo isset($message['name'])  ? 'is-invalid' : '' ?>" type="text" id="name" name="name" placeholder="Enter fullname" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>" required>
              <div class="invalid-feedback"> 
                 <?php echo $message['name'] ?? '' ?>
              </div>
              <small class="form-text text-muted">
                Number and special characters are not allowed in this field.
            </small>
            </div>
          
            <div class="form-group">
              <label for="email">Email Address</label>
              <input class="form-control <?php echo isset($message['email'])  ? 'is-invalid' : '' ?>" type="email" id="email" name="email" placeholder="Enter email address" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>"  required>
              <div class="invalid-feedback"> 
                 <?php echo $message['email'] ?? '' ?>
              </div>
              <small class="form-text text-muted">
                The email format should be valid. Use Gmail domain. (e.g., juandc@gmail.com)
            </small>
            </div>
            
            <div class="form-group">
              <label for="password">Password</label>
              <input class="form-control <?php echo isset($message['password'])  ? 'is-invalid' : '' ?>" type="password" id="password" name="password" placeholder="Enter password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ''; ?>"  required>
              <div class="invalid-feedback"> 
                 <?php echo $message['password'] ?? '' ?>
              </div> 
            <small class="form-text text-muted">
                Password must contain at least 8 characters, including alphanumeric, numbers, and special characters.
            </small>
        </div>
            <div class="form-group">
               <label for="confirm-password">Confirm Password</label>
               <input class="form-control <?php echo isset($message['confirm-password'])  ? 'is-invalid' : '' ?>" type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" value="<?php echo isset($_POST["confirm-password"]) ? $_POST["confirm-password"] : ''; ?>" required>
               <div class="invalid-feedback"> 
                  <?php echo $message['confirm-password'] ?? '' ?>
               </div>
               <small class="form-text text-muted">
                The password should be matched.
            </small>
            </div>
            
            <div class="form-group">
               <label for="birthdate">Birthdate</label>
               <input class="form-control <?php echo isset($message['birthdate'])  ? 'is-invalid' : '' ?>" type="date" id="birthdate" name="birthdate" value="<?php echo isset($_POST["birthdate"]) ? $_POST["birthdate"] : ''; ?>"  required>
               <div class="invalid-feedback"> 
                 <?php echo $message['birthdate'] ?? '' ?>
              </div> 
              <small class="form-text text-muted">
                You should at least be above 16 years old to register.
            </small>
            </div>
            
            <div class="form-group">
            <label for="gender">Gender</label>
               <select id="gender" name="gender" required>
                  <option value="" disabled selected>Select Gender</option>
                  <option <?php echo isset($_POST["gender"]) && $_POST["gender"] === "male" ? "selected" : ""; ?> value="male" >Male</option>
                  <option <?php echo isset($_POST["gender"]) && $_POST["gender"] === "female" ? "selected" : ""; ?> value="female" >Female</option>
                  <option <?php echo isset($_POST["gender"]) && $_POST["gender"] === "others" ? "selected" : ""; ?> value="other" >Others</option>
               </select>
            <small class="form-text text-muted">
                Select your preferred gender.
            </small>
            </div>
            <div class="form-group">
              <label for="houseno">House No.</label>
              <input class="form-control <?php echo isset($message['houseno'])  ? 'is-invalid' : '' ?>" type="text" id="houseno" name="houseno" placeholder="Enter house number" value="<?php echo isset($_POST["houseno"]) ? $_POST["houseno"] : ''; ?>" minlength="1" maxlength="8" required>
              <div class="invalid-feedback"> 
                 <?php echo $message['houseno'] ?? '' ?>
              </div> 
              <small class="form-text text-muted">
                The house number should be correct. (e.g., 1805)
              </small>
            </div>
    
            <div class="form-group">
              <label for="street">Street</label>
              <input class="form-control <?php echo isset($message['street'])  ? 'is-invalid' : '' ?>" type="text" id="street" name="street" placeholder="Enter street" value="<?php echo isset($_POST["street"]) ? $_POST["street"] : ''; ?>" minlength="6" maxlength="20" required>
              <div class="invalid-feedback"> 
                 <?php echo $message['street'] ?? '' ?>
              </div> 
              <small class="form-text text-muted">
                The street should be correct. (e.g., Daffodil St.)
              </small>
            </div>
    
            <div class="form-group">
              <label for="barangay">Barangay</label>
              <input class="form-control <?php echo isset($message['barangay'])  ? 'is-invalid' : '' ?>" type="text" id="barangay" name="barangay" placeholder="Enter barangay" value="<?php echo isset($_POST["barangay"]) ? $_POST["barangay"] : ''; ?>" minlength="5" maxlength="20" required>
              <div class="invalid-feedback"> 
                 <?php echo $message['barangay'] ?? '' ?>
              </div> 
              <small class="form-text text-muted">
                The barangay should be correct. (e.g., Hulo)
              </small>
            </div>
    
            <div class="form-group">
              <label for="city">City</label>
              <input class="form-control <?php echo isset($message['city'])  ? 'is-invalid' : '' ?>" type="text" id="city" name="city" placeholder="Enter city" value="<?php echo isset($_POST["city"]) ? $_POST["city"] : ''; ?>" minlength="6" maxlength="30" required>
              <div class="invalid-feedback"> 
                 <?php echo $message['city'] ?? '' ?>
              </div> 
              <small class="form-text text-muted">
                The city should be correct. (e.g., Mandaluyong)
              </small>
            </div>
    
            <div class="form-group">
              <label for="zipcode">Zip Code</label>
              <input class="form-control <?php echo isset($message['zipcode'])  ? 'is-invalid' : '' ?>" type="text" id="zipcode" name="zipcode" placeholder="Enter zip code" value="<?php echo isset($_POST["zipcode"]) ? $_POST["zipcode"] : ''; ?>" minlength="4" maxlength="4" required>
              <div class="invalid-feedback"> 
                 <?php echo $message['zipcode'] ?? '' ?>
              </div> 
              <small class="form-text text-muted">
                The zip code should be correct. (e.g., 1550)
              </small>
            </div>
    
            <div class="form-group">
              <label for="phone-number">Phone Number</label>
              <input class="form-control <?php echo isset($message['phone-number'])  ? 'is-invalid' : '' ?>" type="tel" id="phone-number" name="phone-number" placeholder="Enter Phone Number" value="<?php echo isset($_POST["phone-number"]) ? $_POST["phone-number"] : ''; ?>" minlength="11" maxlength="11" required>
              <div class="invalid-feedback"> 
                 <?php echo $message['phone-number'] ?? '' ?>
              </div> 
              <small class="form-text text-muted">
                Please enter a valid phone number starting with "09" or "+639".
            </small>
            </div>

            <div class="form-group"><!-- border: blue 1px solid -->
              <label for="terms-checkbox"><!-- border: blue 1px solid -->
                <input type="checkbox" id="terms-checkbox" name="terms-checkbox" style="border: yellow 1px solid" <?php if(isset($_SESSION['terms-checkbox']) && $_SESSION['terms-checkbox']) echo 'checked'; ?> required>
                <span class="checkbox-custom"></span> <!-- border: blue 1px solid -->
                <p>I agree to the terms and conditions of the<a href="privacy-policy.php" >Privacy Policy</a></p>
              </label>
            </div>



            <div class="form-group">
                <div class="verification-code-container">
                    <label for="verification-code">Email Verification Code</label>
                    <div class="input-group">
                        <input class="form-control" <?php echo isset($message['verification-code'])  ? 'is-invalid' : '' ?> type="text" id="verification-code" name="verification-code" placeholder="Verification Code">
                        <button type="submit" name="submitOTP" class="btn btn-primary">OTP</button> 
                    </div>    
                </div>
            </div>
            <div class="invalid-feedback"> 
                <?php echo $message['verification-code'] ?? '' ?>
            </div> 
    

    <div class="form-group button-group">
      <input type="submit" name="submit" value="Create Account" class="submit-btn">
      <input type="button" value="Cancel" class="cancel-btn">
   </div>

    <p>Already have an account? <a href="login.php">Login here</a></p>
  </form>
</div>
</div><!--end edit-->


    <?php include 'slide.php'; ?>
    <?php include 'footer.php'; ?>
    
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>

</body>
</html>
