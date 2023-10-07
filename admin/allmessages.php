<?php
include ('../dbconn.php'); 

 $sqlw = "SELECT message_from, message_to, MAX(id) AS latest FROM tb_chat GROUP BY message_from, message_to";
 $resultw = $dba->query($sqlw);
 if ($resultw->num_rows > 0) { 
 while($roww =$resultw->fetch_assoc()) {
     
 echo $roww['latest']. "<br/>";
     
 } 
} 
else{
echo "No Chat Yet! <br/> Start chat by introducing yourself";
 }


?>