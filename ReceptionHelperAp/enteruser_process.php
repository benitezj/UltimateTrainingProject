<?php
include 'globals.php';
if($_SESSION['username'] == $dbuser  && $db->check_loggin($_SESSION['username'],$loggintimeout)){
?>
 

<a href="home.php">Home</a> 
&nbsp; &nbsp; &nbsp; 
<a href="Logout.php"> Logout </a>
<br> <br>


<?php

$employeeid = $_POST["employeeid"] ;
$username = $_POST["username"] ;
$password = $_POST["password"] ;


//check if vehicle already registered
$checkquery = "SELECT ID,USERNAME,PASSWORD FROM USERS WHERE ID=" . $employeeid ;
$checkresult = $db->query($checkquery);
if($checkresult->num_rows == 0){

   $info =  $employeeid . ",'" . $username . "','" . $password . "'";
   $query = "INSERT INTO USERS (ID,USERNAME,PASSWORD) VALUES (" . $info . ")"; 
   $result = $db->query($query);
   if($result == true){
     echo "Successfully registered: " . $username;
   }else{
     echo "Failed to register user. ";
   }

}else{
  $row = mysqli_fetch_array($checkresult);
  echo "Employee id is already registered as a user." ;
}

$checkresult->close();
?> 



<?php
}else{
 direct_to_login(1,"You are not logged in.");
}
?>




