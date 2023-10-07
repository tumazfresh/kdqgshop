<?php
include('../dbconn.php');
include('../codes/adminlogin.php');
include('../codes/adminheader.php');
include('../codes/adminnavbar.php');
include('../codes/adminsidebar.php');
?>
<link rel="stylesheet" href="../css/chatbox_design.css">

    
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
               url: "allmessages.php",
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