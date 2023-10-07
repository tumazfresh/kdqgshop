<?php

require 'dbcon.php';

if(isset($_POST['save_user']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $birthdate = mysqli_real_escape_string($con, $_POST['birthdate']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $houseno = mysqli_real_escape_string($con, $_POST['houseno']);
    $street = mysqli_real_escape_string($con, $_POST['street']);
    $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $zipcode = mysqli_real_escape_string($con, $_POST['zipcode']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    

    if($name == NULL || $email == NULL || $password == NULL || $birthdate == NULL || $gender == NULL || $houseno == NULL || $street == NULL || $barangay == NULL || $city == NULL || $zipcode == NULL || $phone == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    // Password validation
    if (strlen($password) < 8 || !preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*])/', $password)) {
        $res = [
            'status' => 422,
            'message' => 'Password must contain at least 8 characters, including alphanumeric, numbers, and special characters.'
        ];
        echo json_encode($res);
        return;
    }

    // Phone number validation
    if (!preg_match('/^(09|\+639)\d{9}$/', $phone)) {
        $res = [
            'status' => 422,
            'message' => 'Invalid contact number. Please enter a valid phone number starting with "09" or "+639".'
        ];
        echo json_encode($res);
        return;
    }

    // Birthdate limitation - age should not be a minor (below 16 years old)
   $birthdateObj = DateTime::createFromFormat('Y-m-d', $birthdate);
   $today = new DateTime();
   $age = $today->diff($birthdateObj)->y;

   if ($age < 16) {
      $res = [
        'status' => 422,
        'message' => 'You must be at least 16 years old to register.'
    ];
    echo json_encode($res);
    return;
   }

    $query = "INSERT INTO tb_customer (name,email,password,birthdate,gender,houseno,street,barangay,city,zipcode,phone) VALUES ('$name','$email','$password','$birthdate','$gender','$houseno','$street','$barangay','$city','$zipcode','$phone')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'User Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'User Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_user']))
{
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $birthdate = mysqli_real_escape_string($con, $_POST['birthdate']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $houseno = mysqli_real_escape_string($con, $_POST['houseno']);
    $street = mysqli_real_escape_string($con, $_POST['street']);
    $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $zipcode = mysqli_real_escape_string($con, $_POST['zipcode']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);

    if($name == NULL || $email == NULL || $birthdate == NULL || $gender == NULL || $houseno == NULL || $street == NULL || $barangay == NULL || $city == NULL || $zipcode == NULL || $phone == NULL )
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    // Phone number validation
    if (!preg_match('/^(09|\+639)\d{9}$/', $phone)) {
        $res = [
            'status' => 422,
            'message' => 'Invalid contact number. Please enter a valid phone number starting with "09" or "+639".'
        ];
        echo json_encode($res);
        return;
    }
    
    // Birthdate limitation - age should not be a minor (below 16 years old)
   $birthdateObj = DateTime::createFromFormat('Y-m-d', $birthdate);
   $today = new DateTime();
   $age = $today->diff($birthdateObj)->y;

   if ($age < 16) {
      $res = [
        'status' => 422,
        'message' => 'You must be at least 16 years old to register.'
    ];
    echo json_encode($res);
    return;
   }

    $query = "UPDATE tb_customer SET name='$name', email='$email', birthdate='$birthdate', gender='$gender', house_number='$houseno', street='$street', barangay='$barangay', city='$city', zip_code='$zipcode', phone='$phone'
                WHERE custid='$user_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'User Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'User Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['user_id']))
{
    $user_id = mysqli_real_escape_string($con, $_GET['user_id']);

    $query = "SELECT * FROM tb_customer WHERE custid='$user_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $user = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'User Fetch Successfully by id',
            'data' => $user
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'User Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_user']))
{
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    $query = "DELETE FROM tb_customer WHERE custid='$user_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'User Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'User Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

?>