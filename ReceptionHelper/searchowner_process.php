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
echo "Vehicle Tag: " . $tag . "<br>";

////find the vehicle
$employee=0;
$ownerquery = "SELECT EMPLOYEE FROM VEHICLES WHERE TAG = '" . $tag . "'";
$ownerresult = $db->query($ownerquery);
if($ownerresult->num_rows == 0){
   echo "Vehicle not found in database.";
}else {
   $row = mysqli_fetch_array($ownerresult);
   $employee=$row['EMPLOYEE'];
    
   //Find the owner
   $email="";
   $emailquery = "SELECT FIRST,LAST,EMAIL,EXT FROM EMPLOYEES WHERE ID=" . $employee ;
   $emailresult = $db->query($emailquery);

   if($emailresult->num_rows == 0){
     echo "Vehicle is assigned to employee id: " . $employee . "<br>"; 
     echo "Employee id not found in database.";
   }else {
     $row = mysqli_fetch_array($emailresult);
     $email = $row['EMAIL'];
     echo "Owner : " . $row['FIRST'] . " " . $row['LAST'] . " <br>  email: " . $email . "<br>  extension: ". $row['EXT'];
     
     //Create form to send email
     echo "<form action=\"sendemail.php?tag=" . $tag . "&email=". $email . "\" method=\"post\">";
     echo "<br>";
     echo "Send email message: <br> <input type=\"text\" name=\"message\" size=70 >";
     echo "<br>";
     echo "<input type=\"submit\" value=\"Send\" >";
     echo "</form>";

   }
   $emailresult->close();

}
$ownerresult->close();

?> 


<?php
}else{
 direct_to_login(1,"You are not logged in.");
}
?>
