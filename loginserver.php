<?php
include('dbconn.php');

if(isset($_REQUEST['login']))
{
    $email=mysqli_real_escape_string($db,$_REQUEST['email']);
    $password=mysqli_real_escape_string($db,$_REQUEST['password']);
    $password = md5($password);
    $query=mysqli_query($db,"SELECT * FROM `tb_customer` WHERE `email` = '$email' AND `password`='$password' OR `username`='$email' AND `password`='$password' ");
    $rowCount=mysqli_num_rows($query);
    if($rowCount > 0)
    {
        $rt=mysqli_fetch_assoc($query);
        $userID=$rt['custid'];
        $userLEVEL=$rt['user_level'];
        $_SESSION['id']=$userID;
        $_SESSION['userL']=$userLEVEL;
        header('location:./');
        exit;
    }
    else
    {
        $_SESSION['errorMsg']="Invalid Login Details";
        header('location:./login.php');
        exit;
    }
}
?>