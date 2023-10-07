<?php
include('../dbconn.php');
include('../codes/adminlogin.php');
include('../codes/adminheader.php');
include('../codes/adminnavbar.php');
include('../codes/adminsidebar.php');
?>

<style>
.message_row {
  content: "";
  display: table;
  clear: both;

}
.users_column {
  float: left;
  width: 30%;
  border: #f0f0f0 1px solid;
}

.mul-user{
  padding-left: 65px;
}

.status{
  padding-left: 30px;
  width: 100%;
}

.status-green li{
  content: "\2022";
  color: green;
  font-weight: bold;
  padding: 0px 10px;
  float: left;
}
.status-gray li{ /* inactive */
  content: "\2022";
  color: gray;
  font-weight: bold;
  padding: 0px 10px;
  float: left;
}

.message_column {
  float: left;
  width: 70%;
  height: 100%;
  border-radius:5px;
}


.header-message{
  padding:10px;
  border: gray 1px solid;
  border-top-left-radius:5px;
  border-top-right-radius:5px;
  height: 70px;
  background-color:#368BC1;

}
.username{
  padding: 0px 10px;
  padding-top: 15px;
  padding-left: 30px;
  float: left;
  width: 100%;
  font-weight: bold;
  color: white; /* #fff */
}
.username-message{
  color: black;
  font-weight: bold;
}

.body-message{
  border: gray 1px solid;
  padding: 25px;
}

.messages {
   margin-left: 20px;
   margin-right: 20px;
   height: 500px
}

.bottom-message{
  padding: 10px;
  border: gray 1px solid;
  border-bottom-left-radius:5px;
  border-bottom-right-radius:5px;
  background-color:#368BC1;
}

.chat-input{
    width: 75%;
    height: 40px;
    text-transform: capitalize;
    font-size: 16px;
    padding: 5px 10px;
    margin-left: 40px;
    border-radius: 10px;

}

.chat-button{
    margin-left: 50px;
    cursor: pointer;
    background: none;
    color: white; /* fff */
    font-size: 23px;
    border: none;

}

.chat {
    border: 2px solid #dedede;
    background-color: #f0f0f0;
    border-radius: 5px;
    margin-top: 30px;
    padding-top: 10px;
    padding-left: 10px;
    padding-right: 10px;

}

.darker {
    border-color: #368BC1;
    background-color: lightblue;
    margin-left: 150px;


}

.darker::after {
    content: "";
    clear: both;
    display: table;

}

  
.chat img {
    float: left;
    max-width: 50px;
    width: 80%;
    margin-right: 20px;
    border-radius: 50%;
}

.chat img.right {
    float: right;
    margin-left: 20px;
    margin-right:0;
}


.time-right {
    float: right;
    color: #aaa;
    
}

.time-left {
    float: left;
    color: #999;
}


.tab {
  float: left;
}

.tab img{
  float: left;
  width: 25%;
  height: 25%;
}

.tab button {
  display: block;
  background-color: inherit;
  color: black;
  outline: none;
  text-align: left;
  cursor: pointer;
  font-size: 17px;
  border: 1px solid #ccc;
  width: 100%;
  padding: 20px 30px;
}

.tab button:hover {
  background-color: #ddd;

}

.tab button.active {
  background-color: #ccc;
}

.tabcontent {
  float: left;
  border: 1px solid #ccc;
  width: 100%;
  border-left: none;
  height: auto;
  display: none;
  border-radius:5px;

}

.clearfix::after {
  content: "";
  clear: both;
  display: table;
}


</style>
<html>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-9" style="margin: auto;">
                    <div class="card-header">
                        <h4>CHAT MESSAGE INTERFACE</h4>
                    </div>
                <div class="card">
                    <div class="message_row">
                        
                        <div class="users_column card">
                            <div class ="tab">
                                <button class="tablinks" onclick="myfunction(event, 'sample')">
                                  <img src="admin-img/login.png">
                                  <div class ="mul-user">Jem Paola Gacumo</div>
                                  <div class ="status-green"><li>Active Now</li></div>
                                </button>
                            </div>
                            <div class ="tab"> 
                                <button class="tablinks" onclick="myfunction(event, 'sample1')">
                                  <img src="admin-img/login.png">
                                  <div class ="mul-user">Sample 1</div>
                                  <div class ="status-gray"><li>Inactive Now</li></div>
                                </button>
                            </div>
                            <div class ="tab">
                                <button class="tablinks" onclick="myfunction(event, 'sample2')">
                                  <img src="admin-img/login.png">
                                  <div class ="mul-user">Sample 2</div>
                                  <div class ="status-green"><li>Active Now</li></div>
                                </button>
                            </div>
                            <div class ="tab">
                                <button class="tablinks" onclick="myfunction(event, 'sample3')"> 
                                  <img src="admin-img/login.png">
                                  <div class ="mul-user">Sample 3</div>
                                  <div class ="status-gray"><li>Inactive Now</li></div>
                                </button>
                            </div>
                        </div>
                      
                        <div class="message_column card">
                            <div id="sample" class="tabcontent">
                                <div class ="header-message"> 
                                   <div class ="username">Jem Paola Gacumo</div>
                                </div>
                            <div class ="body-message"> 
                                <div class ="messages">
                                    <div class="chat" style="margin-right: 100px;">
                                        <img src="admin-img/login.png" class="left">
					                    <p class ="username-message">Jem Paola Gacumo</p>
                                        <p>BTS? or Black Pink?</p>
                                        <span class="time-right">2023-10-01 16:57:00</span>
                                    </div>
                                    <div class="chat darker" >
                                        <img src="admin-img/logo.png" class="right">
                                        <p>ASTRO</p>
                                        <span class="time-left">2023-10-01 16:57:00</span>
                                    </div>
                                    <div class="chat" style="margin-right: 100px;">
                                        <img src="admin-img/login.png" class="left">
					                    <p class ="username-message">Jem Paola Gacumo</p>
                                        <p>Same! Cha Eun Woo?</p>
                                        <span class="time-right">2023-10-01 16:57:00</span>
                                    </div>
                                    <div class="chat darker" >
                                        <img src="admin-img/logo.png" class="right">
                                        <p>YES</p>
                                        <span class="time-left">2023-10-01 16:57:00</span>
                                    </div>
                                </div>
                            </div>
                                  <div class ="bottom-message"> 
                                    <input class ="chat-input"></input>
                                    <button class ="chat-button" type ="submit" value=""><i class='fas fa-paper-plane' ></i></button>
                                  </div>
                                  <div class="clearfix"></div>
                            </div>
                        
                            <div id="sample1" class="tabcontent">
                                <div class ="header-message"> 
                                      <div class ="username">Sample1</div>
                                </div>
                            <div class ="body-message"> 
                                <div class ="messages">
                                    <div class="chat" style="margin-right: 100px;">
                                        <img src="admin-img/login.png" class="left">
                                        <p class ="username-message">Sample1</p>
                                        <p>hello madlang people</p>
                                        <span class="time-right">2023-10-01 16:57:00</span>
                                    </div>
                                    <div class="chat darker" >
                                        <img src="admin-img/logo.png" class="right">
                                        <p>Mabuhay! mili miss u.</p>
                                        <span class="time-left">2023-10-01 16:57:00</span>
                                    </div>
                                    <div class="chat darker" >
                                        <img src="admin-img/logo.png" class="right">
                                        <p>Wazzap?</p>
                                        <span class="time-left">2023-10-01 16:57:00</span>
                                    </div>
                                    <div class="chat" style="margin-right: 100px;">
                                        <img src="admin-img/login.png" class="left">
                                        <p class ="username-message">Sample1</p>
                                        <p>madlang people</p>
                                        <span class="time-right">2023-10-01 16:57:00</span>
                                    </div>
                                </div>
                            </div>
                                  <div class ="bottom-message"> 
                                    <input class ="chat-input"></input>
                                    <button class ="chat-button" type ="submit" value=""><i class='fas fa-paper-plane' ></i></button>
                                  </div>
                                  <div class="clearfix"></div>
                            </div>
                            
                            <div id="sample2" class="tabcontent">
                                <div class ="header-message"> 
                                    <div class ="username">Sample2</div>
                                </div>
                            <div class ="body-message"> 
                                <div class ="messages">
                                    <div class="chat" style="margin-right: 100px;">
                                        <img src="admin-img/login.png" class="left">
                                        <p class ="username-message">Sample2</p>
                                        <p>EAT?</p>
                                        <span class="time-right">2023-10-01 16:57:00</span>
                                    </div>
                                    <div class="chat darker" >
                                        <img src="admin-img/logo.png" class="right">
                                        <p>Dabarkads</p>
                                        <span class="time-left">2023-10-01 16:57:00</span>
                                    </div>
                                    <div class="chat" style="margin-right: 100px;">
                                        <img src="admin-img/login.png" class="left">
                                        <p class ="username-message">Sample2</p>
                                        <p>Eat bulaga?</p>
                                        <span class="time-right">2023-10-01 16:57:00</span>
                                    </div>
                                    <div class="chat" style="margin-right: 100px;">
                                        <img src="admin-img/login.png" class="left">
                                        <p class ="username-message">Sample2</p>
                                        <p>TV 5 or Channel 7?</p>
                                        <span class="time-right">2023-10-01 16:57:00</span>
                                    </div>
                                </div>
                            </div>
                                  <div class ="bottom-message"> 
                                    <input class ="chat-input"></input>
                                    <button class ="chat-button" type ="submit" value=""><i class='fas fa-paper-plane' ></i></button>
                                  </div>
                                  <div class="clearfix"></div>
                            </div>
                            
                            <div id="sample3" class="tabcontent">
                                <div class ="header-message"> 
                                    <div class ="username">Sample3</div>
                                </div>
                            <div class ="body-message"> 
                                <div class ="messages">
                                    <div class="chat" style="margin-right: 100px;">
                                        <img src="admin-img/login.png" class="left">
					                    <p class ="username-message">Sample3</p>
                                        <p>JRU? Jose Rizal University?</p>
                                        <span class="time-right">2023-10-01 16:57:00</span>
                                    </div>
                                    <div class="chat" style="margin-right: 100px;">
                                        <img src="admin-img/login.png" class="left">
					                    <p class ="username-message">Sample3</p>
                                        <p>JRU? Jack Roberto University?</p>
                                        <span class="time-right">2023-10-01 16:57:00</span>
                                    </div>
                                    <div class="chat darker" >
                                        <img src="admin-img/logo.png" class="right">
                                        <p>Jack Roberto University po</p>
                                        <span class="time-left">2023-10-01 16:57:00</span>
                                    </div>
                                    <div class="chat" style="margin-right: 100px;">
                                        <img src="admin-img/login.png" class="left">
					                    <p class ="username-message">Sample3</p>
                                        <p>Wtf? Seriously?</p>
                                        <span class="time-right">2023-10-01 16:57:00</span>
                                    </div>
                                </div>
                            </div>
                                  <div class ="bottom-message"> 
                                    <input class ="chat-input"></input>
                                    <button class ="chat-button" type ="submit" value=""><i class='fas fa-paper-plane' ></i></button>
                                  </div>
                                  <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<script>
function myfunction(Event, message) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(message).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
</html>

