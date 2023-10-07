<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_POST['user_id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  try {
    // Update the user profile data in the database
    $update_query = $conn->prepare("UPDATE `tb_customer` SET name = ?, email = ?, phone = ?, address = ? WHERE custid = ?");
    $update_query->execute([$name, $email, $phone, $address, $user_id]);

    // Redirect back to the profile page after updating
    header('Location: account_profile.com.php');
    exit();
  } catch (PDOException $e) {
    // Handle any errors that occurred during the update process
    echo "Error: " . $e->getMessage();
  }
}
?>
