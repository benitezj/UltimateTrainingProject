<?php
include 'globals.php';
if($db->check_loggin($_SESSION['username'],$loggintimeout)){
 ?>
 

<a href="home.php">Home</a> 
&nbsp; &nbsp; &nbsp; 
<a href="Logout.php"> Logout </a>
<br> <br>


<b> List of vehicles in database: </b>
<br>

<?php
$db->print_Vehicles();
?>


<?php
}else{
 direct_to_login(1,"You are not logged in.");
}
?>




