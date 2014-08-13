<?php
include 'globals.php';
if($db->check_loggin($_SESSION['username'],$loggintimeout)){
?>
 
<a href="home.php">Home</a> 
&nbsp; &nbsp; &nbsp; 
<a href="Logout.php"> Logout </a>
<br> <br>

<?php

$employeeid = $_POST["employeeid"] ;
$firstname = $_POST["firstname"] ;
$lastname = $_POST["lastname"] ;
$email = $_POST["email"] ;
$extension = $_POST["extension"] ;

//check if vehicle already registered
$checkquery = "SELECT ID,FIRST,LAST FROM EMPLOYEES WHERE ID=" . $employeeid ;
$checkresult = $db->query($checkquery);
if($checkresult->num_rows == 0){
   $info =  $employeeid . ",'" . $firstname . "','" . $lastname . "','". $email . "'," . $extension;
   $query = "INSERT INTO EMPLOYEES (ID,FIRST,LAST,EMAIL,EXT) VALUES (" . $info . ")"; 
   $result = $db->query($query);
   if($result == true){
     echo "Successfully registered: " . $info;
   }else{
     echo "Failed to register employee. ";
   }

}else{
  $row = mysqli_fetch_array($checkresult);
  echo "Employee id is already registered : " . $row['ID'] . " " . $row['FIRST'] . " " . $row['LAST'];
}

$checkresult->close();
?> 


 <?php
}else{
 direct_to_login(1,"You are not logged in.");
}
?>




