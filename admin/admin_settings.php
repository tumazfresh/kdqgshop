<?php
include('../dbconn.php');
include('../codes/adminlogin.php');
include('../codes/adminheader.php');
include('../codes/adminnavbar.php');
include('../codes/adminsidebar.php');
?>


<html>
<style> 
/*-------------------------------------------------------------------- account-profile-------------------------------------------------------------------- */
.profile-container {
  max-width: 1500px;
  margin: 0 auto;
  padding: 40px; 
  background-color: #fff;
  border-radius: 5px;
  display: flex;
  justify-content: center;
}


.account-container {
  display: flex;
  max-width: 2000px; 
  margin: 20px auto; 
  padding: 40px; 
  background-color: rgba(120, 120, 120, 0.2);
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  position: relative;
}


.sidebar {
  width: 200px;
  background-color: #f9f9f9;
  border-radius: 3px;
  padding: 20px;
  font-size: 14px;
  margin-right: 20px;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    margin-bottom: 10px;
    width: 600px;
}

.sidebar ul li a {
    display: inline-block;
    padding: 2px 8px;
    background-color: #3394d5;
    color: #fff;
    text-decoration: none;
    border-radius: 3px;
}

.sidebar ul li a:hover {
    background-color: #999;
}

.sidebar ul li a .icon {
    margin-right: 10px;
}

.content {
    display: block;
    padding: 20px;
    width: 100%;
    padding-left: 20px;
    flex-direction: column;
    background-color: #ffffff;
}

.content h2 {
    text-align: left;
    margin-top: 1px;
    font-size: 24px;
    color: #000;
}

.flex{
    border: 1px solid red;
    text-align: right;
}
.flex h2{
    text-align: right;
    font-size: 30px;
}
.heading{
    font-weight: Bold;
}

.account-details {
    margin-bottom: 20px;
    display: flex;
    position: relative;
    grid-template-columns: 1fr 1fr;
    grid-gap: 20px;
}

.account-details h3 {

    margin: 10px;
    font-size: 18px;

}

.account-details p {
    font-size: 14px;
    color: #666666;
    margin: 20px;
}

.underline {
    border-bottom: 1px solid #ccc;
    margin-bottom: 10px;
}

.profile-picture-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.profile-picture-header img{
    display: flex;
    align-items: center;
    margin: auto;
    width: 150px;
    height: 150px;
}

/* 
#profileImage {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    margin-right: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease-in-out;
}


#profileImage:hover {
    transform: scale(1.1); 
    transition: transform 0.3s ease-in-out;
}
*/

.header-text {
    font-size: 18px;
    font-weight: bold;
    color: #333; 
}

#profileImage {
    border: 2px solid #fff;
}

.profile-picture-container {
    background-color: #fff;
    padding: 10px;
    border-radius: 50%;
    display: flex;
    align-items: center;
}

.profile-picture-container .header-text {
    display: flex;
    align-items: center;
}

.profile-picture-header {
    transition: background-color 0.3s ease-in-out;
}


.edit-profile-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 10px;
}

.profile-details {
  background-color: #f8f8f8;
  border-radius: 5px;
  padding: 20px;
  margin: 20px 0;
}

.edit-profile-button {
    position: absolute; 
    bottom: -25px; 
    right: 0; 
    background-color: #5AA2D3;
    color: #fff;
    border: none;
    border-radius: 3px;
    padding: 8px 16px;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    transition: background-color 0.3s, transform 0.3s;
}

.edit-profile-button i {
    margin-right: 8px;
}

.edit-profile-button:hover {
    background-color:#B0B0B0;
    transform: scale(1.05);
}


.custom-close-button {
    background-color: #dc3545; 
    color: #fff; 
    border: none; 
    font-weight: bold;
    font-size: 14px;
    padding: 11px 18px; 
    border-radius: 4px; 
    transition: background-color 0.3s ease, color 0.3s ease;
}

.custom-close-button:hover {
    background-color: #aaa; 
    color: #fff;
}

.modal-footer{
    justify-content: space-between;
}



.sidebar ul li a.disabled {
  font-size: 14px;
  color: #000;
  pointer-events: none;
  opacity: 0.6; 
  background-color: transparent; 
}

.sidebar ul li a.disabled:hover {
  background-color: transparent;
}

.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 9999; 
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}


.modal-content {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
    max-width: 500px;
    width: 100%;
    animation: slideIn 0.3s ease-in-out;

}

@keyframes slideIn {
    0% {
        transform: translateY(-20px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

.modal-header {
    background-color: #a8cbe8;
    color: #fff;
    padding: 15px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.modal-title {
    margin: 0;
    font-size: 24px;
    margin-bottom: 10px; 
}

.modal-body {
    padding: 20px 0;
}

.modal-body .mb-3 {
    margin-bottom: 20px;
}

.form-label {
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: border-color 0.3s;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
}

.alert {
    margin-bottom: 20px;
}

.modal-footer {
    border-top: 1px solid #ddd;
    padding: 15px 0;
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.modal-btn-close,
.modal-btn-save {
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
}

.modal-btn-close {
    background-color: #d9534f;
    border-color: #d9534f;
    color: #fff;
    margin-left: 10px;
}

.modal-btn-save {
    background-color: #5cb85c;
    border-color: #5cb85c;
    color: #fff;
}

.modal-btn-close:hover,
.modal-btn-save:hover {
    background-color: #545b62;
    border-color: #545b62;
}

.modal-btn-close:focus,
.modal-btn-save:focus {
    outline: none;
}

.nav-icon img {
    width: 32px; 
    height: 32px;
    transition: transform 0.3s ease-in-out;
}

.nav-icon:hover img {
    transform: scale(1.1);
}

/* Notification Animation */
.notification {
    position: absolute;
    top: -20px;
    left: 50%;
    transform: translateX(-50%);
    display: none;
    background-color: #fff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
}

.nav-icon:hover .notification {
    display: block;
    animation: fadeInUp 0.3s ease-in-out;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}



/* Adjust for small screens */
@media (max-width: 768px) {
    .modal-footer {
        flex-direction: column;
        align-items: flex-end;
    }

    .modal-btn-close,
    .modal-btn-save {
        margin-top: 5px;
    }
}

@media (max-width: 768px) {
    .modal-content {
        max-width: 100%;
    }
}
</style>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12" style="margin: auto;">
            <div class="card-header">
                <h4>ADMIN PROFILE INTERFACE</h4>
            </div>
            <div class="card">
                <body>
                    <div class="profile-container">
                        <div class="account-container">
                            <div class="sidebar">
                                <ul>
                                    <p style="margin: auto;" id="time"></p>
                                    <div class="profile-picture-header">
                                        <img  src="admin-img/logo.png" alt="">
                                    </div>
                                    <li><a href="#" class="disabled"><span class="icon">&#128100;</span>My Personal Details</a></li>
                                    <li><a href="#" ><i class="bi bi-gear"></i> Edit Profile</a></li>
                                    <div class="underline"></div>
                                    <li><a href="user_logout.php" class="icon logout-link" onclick="return confirm('Logout from the website?');"><i class="fas fa-sign-out-alt"></i> Logout</a></li>

                                </ul>
                            </div>
                            <div class="content">
                                <div class="flex">
                                    <h2 class="heading">Admin Profile</h2> 

                                    <div class="underline"></div>
                                </div>
                                
                                <div class="account-details">
                                    <div>
                                        <h3>Name:</h3>
                                        <p>Joneeeell</p>
                                
                                        <h3>Email:</h3>
                                        <p>Joneeeell@gmail.com</p>
                                    </div>
                                    
                                    <div class="account-details">
                                        <div>
                                            <h3>Phone Number:</h3>
                                            <p>09090909090</p>
                                            
                                            <h3>House:</h3>
                                            <p>123</p>
                                        </div>
                                    
                                        <div>
                                            <h3>Street:</h3>
                                            <p>ok</p>
                                            <h3>Barangay:</h3>
                                            <p>brgy.ok</p>
                                        </div>
                                    
                                    <div>
                                    <h3>City:</h3>
                                    <p>Quezon City</p>
                                    
                                    <h3>Zip code:</h3>
                                    <p>12345</p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
            </div>
        </div>
    </div>
</div>
<script> 
var timeDisplay = document.getElementById("time");


function refreshTime() {
  var dateString = new Date().toLocaleString("en-US", {timeZone: "America/Sao_Paulo"});
  var formattedString = dateString.replace(", ", " - ");
  timeDisplay.innerHTML = formattedString;
}

setInterval(refreshTime, 1000)
</script> 
</html>

