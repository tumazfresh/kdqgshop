<?php
include 'dbconn.php';

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}

// Display the success message if it's set
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}



// Fetch user profile data
$select_products = $conn->prepare("SELECT * FROM `tb_customer` WHERE custid = :user_id");
$select_products->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$select_products->execute();
$fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);

$profile_data_js = json_encode([
  'name' => $fetch_product['name'],
  'email' => $fetch_product['email'],
  'phone' => $fetch_product['phone'],
  'houseno' => $fetch_product['house_number'],
  'street' => $fetch_product['street'],
  'barangay' => $fetch_product['barangay'],
  'city' => $fetch_product['city'],
  'zipcode' => $fetch_product['zip_code']
]);

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $houseno = $_POST['houseno'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];

$servername = "srv1041.hstgr.io";
$username = "u629283545_kdqg_ecommerce";
$password = "iTech1234_kdqg";
$dbname = "u629283545_ecommerce_db";

    // Create a PDO connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Prepare and execute the SQL query using placeholders
    $query = "UPDATE tb_customer SET name=:name, email=:email, phone=:phone, house_number=:houseno, street=:street, barangay=:barangay,city=:city, zip_code=:zipcode WHERE custid=:user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':houseno', $houseno, PDO::PARAM_STR);
    $stmt->bindParam(':street', $street, PDO::PARAM_STR);
    $stmt->bindParam(':barangay', $barangay, PDO::PARAM_STR);
    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
    $stmt->bindParam(':zipcode', $zipcode, PDO::PARAM_STR);

    if ($stmt->execute()) {
    header('Location: account_profile.php');
    exit(); 
    } else {
        $res = [
            'status' => 500,
            'message' => 'Profile Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}

$searchResults = array(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_btn'])) {
    $search_box = '%' . $_POST['search_box'] . '%';
    $stmt = $con->prepare("SELECT p.*, w.price AS wishlist_price FROM `tb_product` p LEFT JOIN `tb_wishlist` w ON p.id = w.pid WHERE p.product_name LIKE :search_box AND p.Stock >= '1' AND p.Status = 'Active'");
    $stmt->bindParam(':search_box', $search_box, PDO::PARAM_STR);
    $stmt->execute();
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
}



// Prompt to login for adding to wishlist
function showWishlistPrompt() {
    echo '<div id="wishlistPrompt" class="modal">';
    echo '<div class="modal-content">';
    echo '<span class="close" id="closeWishlistPrompt">&times;</span>';
    echo '<p>Please log in to add this item to your wishlist.</p>';
    echo '</div>';
    echo '</div>';
}

// Prompt to login for adding to cart
function showCartPrompt() {
    echo '<div id="cartPrompt" class="modal">';
    echo '<div class="modal-content">';
    echo '<span class="close" id="closeCartPrompt">&times;</span>';
    echo '<p>Please log in to add this item to your cart.</p>';
    echo '</div>';
    echo '</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head><?php include('header3.php')?>
</head>
<head>
  <meta charset="UTF-8">
  <title>My Account Profile | KDQG</title>
  <link rel="stylesheet" href="account_profile.css">
  <link rel="stylesheet" href="css/header_design.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>

  <div class="profile-container">
    <div class="account-container">
      <div class="sidebar">
        <ul>
          <li><a href="#" class="disabled"><span class="icon">&#128100;</span>My Personal Details</a></li>
          <li><a href="orders.php"><span class="icon">&#128722;</span>My Orders</a></li>
          <li><a href="wishlist.php"><span class="icon"><i class="fas fa-heart"></i></span>Wishlist</a></li>
          <li><a href="order-history.php"><span class="icon">&#128197;</span>Order History</a></li>
          <div class="underline"></div>
          <li><a href="user_logout.php" class="icon logout-link" onclick="return confirm('Logout from the website?');"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </li>
        </ul>
      </div>
      <div class="content">
        <?php
        $select_products = $conn->prepare("SELECT * FROM `tb_customer` WHERE custid = '$user_id'");
        $select_products->execute();
        if ($select_products->rowCount() > 0) {
          while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <form id="updateProfile" action="" method="post">
              <div class="flex">
                <div class="profile-picture-header">
                    <img id="profileImage" src="<?= $fetch_product['profile_picture']; ?>" alt="">
                </div>

                <h2 class="heading">Customer Profile</h2>
                <div class="underline"></div>
            </div>

                
              <div class="account-details">
                <div>
                  <h3>Name:</h3>
                  <p id="profileName"><?= $fetch_product['name']; ?></p>
                  
                  <h3>Email:</h3>
                  <p id="profileEmail"><?= $fetch_product['email']; ?></p>
                </div>
                
                <div class="account-details">
                  <div>
                    <h3>Phone Number:</h3>
                    <p id="profilePhone"><?= $fetch_product['phone']; ?></p>
                    
                    <h3>House:</h3>
                    <p id="profileHouseno"><?= $fetch_product['house_number']; ?></p>
                  </div>
                  
                  <div>
                    <h3>Street:</h3>
                    <p id="profileStreet"><?= $fetch_product['street']; ?></p>
                    
                    <h3>Barangay:</h3>
                    <p id="profileBarangay"><?= $fetch_product['barangay']; ?></p>
                  </div>

                 <div>
                    <h3>City:</h3>
                    <p id="profileCity"><?= $fetch_product['city']; ?></p>
                    
                    <h3>Zip code:</h3>
                    <p id="profileZipcode"><?= $fetch_product['zip_code']; ?></p>
                  </div>
             </div>
             
                  <div class="edit-profile-container">
                    <button id="editProfileButton" type="button" class="edit-profile-button"><i class="fas fa-edit"></i> Edit Profile</button>
                  </div>
                </div>
              </div>


          <?php
          }
        } else {
          echo '<p class="empty">No details found!</p>';
        }
          ?>

      </div>
    </div>

    <!-- Edit Profile Modal -->
<div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="updateProfileForm">
        <div class="modal-body" style="max-height: calc(100% - 135px); overflow-y: auto;">
          <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>
          <input type="hidden" id="user_id" name="user_id" value="<?= $user_id ?>">
          
          <div class="mb-3">
            <label for="profilePicture" class="form-label">Customer Profile Picture</label>
            <input type="file" id="profilePicture" name="profilePicture" accept="image/*">
            <div id="profilePictureError" class="text-danger"></div>
          </div>

          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="<?= $fetch_product['name']; ?>" minlength="10" maxlength="50" required>
            <div id="nameError" class="text-danger"></div>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= $fetch_product['email']; ?>" minlength="10" maxlength="50" required>
            <div id="emailError" class="text-danger"></div>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" id="phone" name="phone" class="form-control" value="<?= $fetch_product['phone']; ?>" minlength="11" maxlength="11" required>
            <div id="phoneError" class="text-danger"></div>
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">House Number</label>
            <input type="text" id="houseno" name="houseno" class="form-control" value="<?= $fetch_product['house_number']; ?>" minlength="5" maxlength="50" required>
            <div id="housenoError" class="text-danger"></div>
          </div>
          
          <div class="mb-3">
            <label for="address" class="form-label">Street</label>
            <input type="text" id="street" name="street" class="form-control" value="<?= $fetch_product['street']; ?>" minlength="5" maxlength="50" required>
            <div id="streetError" class="text-danger"></div>
          </div>
          
          <div class="mb-3">
            <label for="address" class="form-label">Barangay</label>
            <input type="text" id="barangay" name="barangay" class="form-control" value="<?= $fetch_product['barangay']; ?>" minlength="4" maxlength="50" required>
            <div id="barangayError" class="text-danger"></div>
          </div>
          
          
          <div class="mb-3">
            <label for="address" class="form-label">City</label>
            <input type="text" id="city" name="city" class="form-control" value="<?= $fetch_product['city']; ?>" minlength="5" maxlength="50" required>
            <div id="cityError" class="text-danger"></div>
        </div>

          
          <div class="mb-3">
            <label for="address" class="form-label">Zip code</label>
            <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?= $fetch_product['zip_code']; ?>" minlength="4" maxlength="10" required>
            <div id="zipcodeError" class="text-danger"></div>
          </div>
          
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <button type="submit" class="btn btn-primary modal-btn-save" id="saveChangesButton">SAVE CHANGES</button>
          <button type="button" class="btn btn-secondary custom-close-button" id="closeModal" data-bs-dismiss="modal">CLOSE</button>
        </div>
      </form>
    </div>
  </div>
</div>









  <?php include 'footer.php'; ?>

  <script>
    $(document).ready(function() {
        const editProfileButton = document.getElementById('editProfileButton');
        const editProfileModal = document.getElementById('userEditModal');
        const closeModal = document.getElementById('closeModal');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('phone');
        const housenoInput = document.getElementById('houseno');
        const streetInput = document.getElementById('street');
        const barangayInput = document.getElementById('barangay');
        const cityInput = document.getElementById('city');
        const zipcodeInput = document.getElementById('zipcode');

        const profileData = <?= $profile_data_js ?>;

        const notification = document.getElementById('notification');
        const closeButton = notification.querySelector('.notification-close');

        editProfileButton.addEventListener('click', () => {
            nameInput.value = profileData.name;
            emailInput.value = profileData.email;
            phoneInput.value = profileData.phone;
            housenoInput.value = profileData.houseno;
            streetInput.value = profileData.street;
            barangayInput.value = profileData.barangay;
            cityInput.value = profileData.city;
            zipcodeInput.value = profileData.zipcode;

            // Show the modal 
            $('#userEditModal').modal('show');
        });

        closeModal.addEventListener('click', () => {
            // Close the modal 
            $('#userEditModal').modal('hide');
        });

        closeButton.addEventListener('click', function() {
            notification.style.display = 'none';
        });

        // Handle "Save Changes" button click
        $(document).on('submit', '#updateProfileForm', function(e) {
            e.preventDefault(); // Prevent the default form submission behavior
            // Perform client-side validation here

            var formData = new FormData(this);
            formData.append("update_profile", true);

            $.ajax({
                type: 'POST',
                url: 'account_profile.php',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 200) {
                        // Update the UI with the new profile data
                        $('#profileName').text(nameInput.value);
                        $('#profileEmail').text(emailInput.value);
                        $('#profilePhone').text(phoneInput.value);
                        $('#profileHouseno').text(housenoInput.value);
                        $('#profileStreet').text(streetInput.value);
                        $('#profileBarangay').text(barangayInput.value);
                        $('#profileCity').text(cityInput.value);
                        $('#profileZipcode').text(zipcodeInput.value);

                        // Close the modal using 
                        $('#userEditModal').modal('hide');
                        
                        // Show a success message 
                        $('#updateProfileSuccess').removeClass('d-none');
                        $('#updateProfileSuccess').text(response.message);

                        // Delay the redirection to allow the user to see the success message
                        setTimeout(function() {
                            window.location.href = 'account_profile.php';
                        }, 1000);
                    } else {
                        // Handle validation errors or other errors here
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                },
            });
        });
    });
</script>
  
  <script>
    document.getElementById('name').addEventListener('input', function () {
        var name = this.value;
        var nameError = document.getElementById('nameError');

        // Check if the name contains only letters and spaces
        if (!/^[a-zA-Z\s]+$/.test(name)) {
            nameError.textContent = 'Name should only contain letters and spaces.';
            this.setCustomValidity('Name should only contain letters and spaces.');
        } else {
            nameError.textContent = '';
            this.setCustomValidity('');
        }
    });
</script>

<script>
    document.getElementById('email').addEventListener('input', function () {
        var email = this.value;
        var emailError = document.getElementById('emailError');

        // Check if it is a valid email format
        var emailFormat = /^[A-Za-z0-9._%+-]+@(gmail\.com|my\.jru\.edu)$/; // Allow either gmail.com or my.jru.edu
        if (!emailFormat.test(email)) {
            emailError.textContent = 'Please enter a valid email address (e.g., juandc@gmail.com).';
            this.setCustomValidity('Please enter a valid email address (e.g., juandc@gmail.com).');
        } else {
            emailError.textContent = '';
            this.setCustomValidity('');
        }
    });
</script>
  
<script>
    document.getElementById('phone').addEventListener('input', function () {
        var phoneNumber = this.value;
        var phoneError = document.getElementById('phoneError');

        // Check if it contains non-numeric characters
        if (!/^[0-9]+$/.test(phoneNumber)) {
            phoneError.textContent = 'Phone number must contain only numeric characters.';
            this.setCustomValidity('Phone number must contain only numeric characters.');
        } else if (phoneNumber.length >= 2 && phoneNumber.substring(0, 2) !== '09') {
            phoneError.textContent = 'Phone number must start with "09".';
            this.setCustomValidity('Phone number must start with "09".');
        } else {
            phoneError.textContent = '';
            this.setCustomValidity('');
        }
    });
</script>

<script>
    document.getElementById('houseno').addEventListener('click', function () {
        var houseno = document.getElementById('houseno').value;
        var housenoError = document.getElementById('housenoError');

        // Split the address into three components such as (street name, street number, and city) using a comma as a separator
        var housenoComponents = houseno.split(',');

        // Check if there are exactly three components (street name, street number, and city)
        if (housenoComponents.length !== 3) {
            housenoError.textContent = 'Please enter a complete house number.';
        } else {
            housenoError.textContent = '';
            // If the address is valid, you can proceed with form submission
        }
    });
    
    document.getElementById('street').addEventListener('click', function () {
        var street = document.getElementById('street').value;
        var streetError = document.getElementById('streetError');

        // Split the address into three components such as (street name, street number, and city) using a comma as a separator
        var streetComponents = street.split(',');

        // Check if there are exactly three components (street name, street number, and city)
        if (streetComponents.length !== 3) {
            streetError.textContent = 'Please enter a complete street address.';
        } else {
            streetError.textContent = '';
            // If the address is valid, you can proceed with form submission
        }
    });
    
    document.getElementById('barangay').addEventListener('click', function () {
        var barangay = document.getElementById('barangay').value;
        var barangayError = document.getElementById('barangayError');

        // Split the address into three components such as (street name, street number, and city) using a comma as a separator
        var barangayComponents = barangay.split(',');

        // Check if there are exactly three components (street name, street number, and city)
        if (barangayComponents.length !== 3) {
            barangayError.textContent = 'Please enter a complete barangay address.';
        } else {
            barangayError.textContent = '';
            // If the address is valid, you can proceed with form submission
        }
    });
    
    
    document.getElementById('city').addEventListener('blur', function () {
        var city = document.getElementById('city').value;
        var cityError = document.getElementById('cityError');
    
        // Split the city into components using a comma as a separator (if needed)
        var cityComponents = city.split(',');
    
        // Check if there are exactly three components (street name, street number, and city)
        if (cityComponents.length !== 3) {
            cityError.textContent = 'Please enter a complete city address.';
        } else {
            cityError.textContent = '';
            // If the address is valid, you can proceed with form submission
        }
    });

    
    
    document.getElementById('zipcode').addEventListener('click', function () {
        var zipcode = document.getElementById('zipcode').value;
        var zipcodeError = document.getElementById('zipcodeError');

        // Split the address into three components such as (street name, street number, and city) using a comma as a separator
        var zipcodeComponents = zipcode.split(',');

        // Check if there are exactly three components (street name, street number, and city)
        if (zipcodeComponents.length !== 3) {
            zipcodeError.textContent = 'Please enter a complete zip code address.';
        } else {
            zipcodeError.textContent = '';
            // If the address is valid, you can proceed with form submission
        }
    });
</script>

<script>
    function showLoginPrompt(type) {
    if (!<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>) {
        const alertMessage = type ? `Please log in to access ${type}` : 'Please log in to access this feature.';
        const alertDiv = document.createElement('div');
        alertDiv.classList.add('alert');
        alertDiv.textContent = alertMessage;
        document.body.appendChild(alertDiv);
        setTimeout(() => {
            alertDiv.remove();
        }, 3000); 
        return false;
    }
}
</script>

<script>
$(document).ready(function () {
    $("#profilePicture").change(function () {
        // Get the selected file
        var selectedFile = $(this)[0].files[0];
        
        if (selectedFile) {
            // FileReader to read the selected image
            var reader = new FileReader();
            
            reader.onload = function (e) {
                // Set the source of the profile picture image element
                $("#profileImage").attr("src", e.target.result);
            };
            
            // Read the selected file as a Data URL
            reader.readAsDataURL(selectedFile);
        }
    });
});
</script>


</body>

</html>