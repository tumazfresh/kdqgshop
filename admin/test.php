<?php
include ('../dbconn.php');
$userchat = $_SESSION['guestchat'];

 $result = mysqli_query($db,"SELECT * FROM tb_chat WHERE `message_from` = '$userchat' OR `message_to` = '$userchat' ORDER BY id ASC ");
 if (mysqli_num_rows($result) > 0) {
 $i=0;
 while($row = mysqli_fetch_array($result)) {
     $messagefrom = $row["message_from"];
 if($userchat == $messagefrom)
 {
 ?>

        <div class="chat darker" >
              <img src="img/login.png" class="right">
              <p><?php echo $row["message"]; ?></p>
              <span class="time-left"><?php echo $row["created"]; ?></span>
         </div>   
    <?php
 }
    else
    {
        ?>
 
        <div class="chat" >
              <img src="img/logo.jpg">
              <p><?php echo $row["message"]; ?></p>
              <span class="time-right"><?php echo $row["created"]; ?></span>
        </div>
       
  
<?php
}
$i++;
}
?>
<?php
}
else{
echo "No Chat Yet! <br/> Start chat by introducing yourself";
 }


?>