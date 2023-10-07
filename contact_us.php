<?php
include 'dbconn.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

$id = 0;

if (isset($_POST['send'])) {
    $name = isset($_POST['name']) ? filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
    $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) : '';
    $phoneNumber = isset($_POST['phone_number']) ? filter_var($_POST['phone_number'], FILTER_SANITIZE_NUMBER_INT) : '';
    $message = isset($_POST['message']) ? filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';

    // Validate Email
    if (!$email || (strpos($email, '@gmail.com') === false && strpos($email, '@my.jru.edu') === false)) {
    $errors[] = "Invalid email format or not a Gmail or @my.jru.edu address";
    }

    // Validate Phone Number (Phone Number)
    if (!preg_match('/^(09|\+639)\d{9}$/', $phoneNumber)) {
        $errors[] = "Invalid phone number";
    }

    // Validate Message
    if (empty($message)) {
        $errors[] = "Message field is required";
    }

    if (empty($errors)) {
        $select_message = $conn->prepare("SELECT COUNT(*) FROM `tb_messages` WHERE name = ? AND email = ? AND phone_number = ? AND message = ?");
        $select_message->bindValue(1, $name);
        $select_message->bindValue(2, $email);
        $select_message->bindValue(3, $phoneNumber);
        $select_message->bindValue(4, $message);
        $select_message->execute();
        $rowCount = $select_message->fetchColumn();
        $select_message->closeCursor();

        if ($rowCount == 0) {
            $insert_message = $conn->prepare("INSERT INTO `tb_messages` (id, name, email, phone_number, message) VALUES (?, ?, ?, ?, ?)");
            $insert_message->bindValue(1, $id);
            $insert_message->bindValue(2, $name);
            $insert_message->bindValue(3, $email);
            $insert_message->bindValue(4, $phoneNumber);
            $insert_message->bindValue(5, $message);
            $insert_message->execute();
            $insert_message->closeCursor(); 
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <div id = "ready">
        <div class = "try">
              <span class="closebtn" onclick="this.parentElement.style.display='none';" style ="background-color: #368BC1;">&times;</span> 
              <strong>Success!</strong> Your message has been sent. Thank you for reaching out.
        </div>
    </div>
   <?php include('header.php')?></head>
<head>
    <title>KDQG | Contact Us</title>
    <!-- All CSS -->
    <link rel="stylesheet" href="css/header_design.css">
    <link rel="stylesheet" href="css/contact_design.css">
</head>
<head>
   <style>
      #ready {
         display: none;
         background-color: #368BC1;
         position: fixed;
         width: 100%; 
         padding: 20px; 
         text-align: center;
         color: white;
         z-index: 1;
      }


.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
   </style>
</head>
<body> 
<div class= "d-flex d-md-none">    <!-- MOBILE VIEW-->
    <section class="contact">
        <div class="contact-content">
            <h2>Contact Us</h2>
            <p id="cont">Feel free to reach out to us with any questions, concerns, or feedback you may have.</p>
        </div>
        <div class="contact-container">
            <div class="contact-form">
                <form action="#" method="post">
                    <h2>Get In Touch</h2>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" required maxlength="200" class="box">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" id="number" name="phone_number" min="0" max="9999999999" placeholder="Enter your number" required onkeypress="if(this.value.length == 11) return false;" class="box">
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" class="box" name="message" placeholder="Enter your message" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <input  class ="submit" type = "submit" name="send" value = "Click Me" onclick = "myfunction();"/>
                    </div>
                </form>
            </div>
        </div>

            <div class="contact">
                            <div class="contact-card">
                                <div class="contact-image">
                                    <div class="icon1" style="margin: auto;"><i class="bi bi-geo-alt-fill"></i></div>
                                </div>
                                <div class="contact-info">
                                    <div class="text">
                                        <h3 id="address">Address</h3>
                                        <p id="add">327 Roosevelt Ave, Quezon City, Metro Manila, Philippines</p>
                                    </div>
                                </div>
                            </div>
                            <div class="contact-card">
                                <div class="contact-image">
                                    <div class="icon1" style="margin: auto;"><i class="bi bi-telephone-fill"></i></div>
                                </div>
                                <div class="contact-info">
                                        <h3 id="phone">Phone Number</h3>
                                        <p id="phone-num">0915 112 3222</p>
                                </div>
                            </div>
                            <div class="contact-card">
                                <div class="contact-image">
                                    <div class="icon1" style="margin: auto;"><i class="bi bi-envelope-fill"></i></div>
                                </div>
                                <div class="contact-info">
                                        <h3 id="email">Email</h3>
                                        <p id="email-add">deograciaslasacajr@gmail.com</p>
                                </div>
                            </div>
                            <div class="contact-card">
                                <div class="contact-image">
                                    <div class="icon1" style="margin: auto;"><i class="bi bi-clock-fill"></i></div>
                                </div>
                                <div class="contact-info">
                                        <h3 id="time">Time</h3>
                                        <p id="day-time">Mon - Fri 8:00 am to 9:30 pm</p>
                                </div>
                            </div>

            </div>
</section>
</div><!--end edit-->





  
 <div class= "d-none d-sm-block "> <!-- BROWSER VIEW-->
    <section class="contact">
        <div class="contact-content">
            <h2>Contact Us</h2>
            <p id="cont">Feel free to reach out to us with any questions, concerns, or feedback you may have.</p>
        </div>
        <div class="contact-container">
            <div class="contact-info">
                <div class="box">
                    <div class="icon1"><i class='fas fa-map-marker-alt' aria-hidden="true"></i></div>
                    <div class="text">
                        <h3 id="address">Address</h3>
                        <p id="add">327 Roosevelt Ave, Quezon City, Metro Manila, Philippines</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon1"><i class='fas fa-phone' aria-hidden="true"></i></div>
                    <div class="text">
                        <h3 id="phone">Phone Number</h3>
                        <p id="phone-num">0915 112 3222</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon1"><i class='fas fa-envelope' aria-hidden="true"></i></div>
                    <div class="text">
                        <h3 id="email">Email</h3>
                        <p id="email-add">deograciaslasacajr@gmail.com</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon1"><i class='fas fa-clock' aria-hidden="true"></i></div>
                    <div class="text">
                        <h3 id="time">Time</h3>
                        <p id="day-time">Mon - Fri 8:00 am to 9:30 pm</p>
                    </div>
                </div>
            </div>
            <div class="contact-form">
                <form action="#" method="post">
                    <h2>Get In Touch</h2>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" required maxlength="200" class="box">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" id="number" name="phone_number" min="0" max="9999999999" placeholder="Enter your number" required onkeypress="if(this.value.length == 11) return false;" class="box">
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" class="box" name="message" placeholder="Enter your message" cols="30" rows="10"></textarea>
                    </div>
                        <div class="form-group">
                            <input type="submit" class="submit" name="send" onclick="myfunction()" style="align:right;"></input>
                    </div>
                </form>
            </div>
            
    </div>
    </section>    
</div> <!-- end edit-->     
    
    <?php include 'slide.php'; ?>
    <?php include 'footer.php'; ?>
    <div id="response" class="success-message"></div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
    <script>
       function myfunction(note, done) { 
          var box = $("#ready"); 
          box.find(".try").text(note);
          box.find(".sendmessage").unbind().click(function() { 
             box.hide();
          });
          box.find(".sendmessage").click(done); box.show();
       }

    </script>
</body>
</html>  