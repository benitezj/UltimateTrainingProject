<?php
include 'globals.php';
if($db->check_loggin($_SESSION['username'],$loggintimeout)){
?>

<a href="home.php">Home</a> 
&nbsp; &nbsp; &nbsp; 
<a href="Logout.php"> Logout </a> 
<br><br>


<?php

$email = $_GET['email'];
$tag = $_GET['tag'];
$message = $_POST["message"];

$domain = split("@",$email);

if($domain[1] != $localdomain ){
   echo "Message sending failed. <br> ";
   echo "Email : " . $email . " is not in the local domain : ". $localdomain . "<br>";

}else{
   
   ///send email
   if(mail($email,"Your vehicle: " . $tag,$message)){
      echo "Message sent. <br>";

     ///Write to log 
     if(! $db->record_incident($tag,$email,$message)	){
        echo "Unable to record incident in database. <br>";
     }

   }else{
    echo "Message sending failed. <br>";
   }
}
?> 


<?php
}else{
 direct_to_login(1,"You are not logged in.");
}
?>
