<?php
include('../dbconn.php');
session_destroy();
header('location:../admin_login.php'); 
?>