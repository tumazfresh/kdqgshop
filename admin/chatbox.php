<?php
include 'dbconn.php';

   /* if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        $user_id = '';
    }*/
    
   if(isset($_SESSION['guestchat']))
    { 
    }
    else
    {
    $uniquekey = md5(date('ymdhis'));
    $_SESSION['guestchat'] = $uniquekey; 
    }
     echo  $_SESSION['guestchat'];



    $result = array();
    $message = isset($_POST['message']) ? $_POST['message'] : null ;
    $message_from = isset($_POST['message_from']) ? $_POST['message_from'] : null;
    $message_to = isset($_POST['message_to']) ? $_POST['message_to'] : null;
    
    //if(!empty ($message) && !empty ($message_from)){
    //    $sql = "INSERT INTO `tb_chat` (`message`,`message_from`) VALUES ('".$message."','".$message_from."')";
    //    $result ['sent_status'] = $db->query($sql);
   // }else{
    //    $sql = "INSERT INTO `tb_chat` (`message`,`message_from`) VALUES ('".$message."','".$message_from."')";
     //   $result ['sent_status'] = $db->query($sql);
   // }
   
   if(!empty ($message) && !empty ($message_from) && !empty ($message_to)){
      $insert_message = $conn->prepare("INSERT INTO `tb_chat` (message, message_from, message_to) VALUES (?, ?,?)");
      $insert_message->execute([$message, $message_from, $message_to]);
      header('location: chatbox.php');
      exit();
   }

// Display the success message if it's set

if (isset($_GET['message'])) {

    $message = $_GET['message'];
}


?>



<!DOCTYPE html>
<html lang="en">
<head><?php include('header.php')?>
</head>
<head>
    <title> Chatbox | KDQG</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/boxicons/2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <link rel="stylesheet" href="css/chatbox_design.css">

    
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
</head>
<body>
<div class="chat-container">
    <div class ="chatp">
        <h2>Chat Box</h2>
        <p>If you require any further information, please feel free to chat us! </p>
    </div>
    
    <div class="chatbox" id="chatbox">
        
    </div>
    <div class="chat-message">
        
        <form>
        <input type="hidden" id= "message_to" autocomplete = "off" autofocus placeholder = "Type message..." class="chat-input" value="Admin" > 
        <input type="hidden" id= "message_from" autocomplete = "off" autofocus placeholder = "Type message..." class="chat-input" value="<?php echo $_SESSION['guestchat']; ?>" > 
        <input type="text" id= "message" autocomplete = "off" autofocus placeholder = "Type message..." class="chat-input" maxlength="100">
        <button class="chat-button" type ="submit" value=""><i class='fas fa-paper-plane' ></i></button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"> </script>

<script>
   $(document).ready(function(){
       function fetchData()
       {
           $.ajax({
               url: "test.php",
               success: function(data)
               {
                   $("#chatbox").html(data);
               }
           });
       }
       setInterval(fetchData, 1000);
       fetchData();
   }); 
</script>
<script>
   var message_from = null, start = 0, url = '#';
    $(document).ready(function(){
        // message_from = prompt("Please enter your name");
        load();
        
        $('form').submit(function(e){
          $.post(url, {
              message: $('#message').val(),
              message_from:  $('#message_from').val(),
              message_to:  $('#message_to').val(),
          });
          $('#message').val('');
          return false;
        })
    });    
    
    function load(){
        $.get(url + '?start=' + start, function (result){
            if(result.items){
                result.items.forEach(item =>{
                    start = item.id;
                    $('#messages').append(renderMessage(item));
                })
            };
            load();
        });
    }
    
    function renderMessage(item){
        return `<div class = "chat"><p>${item.message_from}</p>${item.message}</div>`;
    }
</script>

<script>
function scrollToBottom() {
    var chatbox = document.getElementById("messages");
    chatbox.scrollTop = chatbox.scrollHeight;
}


</script>

<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
  
    <!-- jQuery code to show 
      the working of this method -->
    <script>
        $(document).ready(function() {
            $("button").click(function() {
                $("html, body").animate({
                    scrollTop: $(
                      'html, body').get(0).scrollHeight
                }, 2000);
            });
        });
    </script>
</body>
</html>