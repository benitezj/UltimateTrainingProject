<?php
include 'globals.php';
if($db->check_loggin($_SESSION['username'],$loggintimeout)){
 ?>
 

<a href="home.php">Home</a> 
&nbsp; &nbsp; &nbsp; 
<a href="Logout.php"> Logout </a>
<br> <br>


<?php

$tag = $_POST["tag"] ;
$type = $_POST["type"] ;
$ownerid = $_POST["ownerid"] ;


//check if vehicle already registered
$checkquery = "SELECT EMPLOYEE FROM VEHICLES WHERE TAG = '" . $tag . "'";
$checkresult = $db->query($checkquery);
if($checkresult->num_rows == 0){
   $query = "INSERT INTO VEHICLES (TAG,MODEL,EMPLOYEE) VALUES ('" . $tag . "','" . $type . "', " . $ownerid . ")"; 
   $result = $db->query($query);
   if($result == true){
     echo "Successfully registered: <br> Tag: " . $tag . "<br>   Model: " . $type . "<br>   Owner id: " . $ownerid ;
   }else{
     echo "Failed to register vehicle. ";
   }
}else{
  $row = mysqli_fetch_array($checkresult);
  echo "Vehicle is already registered to employee id: " . $row['EMPLOYEE'];
}

$checkresult->close();
?> 



<?php
}else{
 direct_to_login(1,"You are not logged in.");
}
?>




