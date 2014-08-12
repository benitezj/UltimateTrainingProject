<?php
include 'globals.php';
if($db->check_loggin($_SESSION['username'],$loggintimeout)){
?>

<a href="home.php"> Home </a> 
&nbsp; &nbsp; &nbsp; 
<a href="listvehicles.php"> List all vehicles </a> 
&nbsp; &nbsp; &nbsp; 
<a href="Logout.php"> Logout </a> 
<br> <br>

New vehicle registration: <br>

<form action="entervehicle_process.php" method="post">
Vehicle Tag: <input type="text" name="tag" size=6 maxlength=6> 
&nbsp; &nbsp;
Vehicle Model: <input type="text" name="type" size=20 maxlength=20> 
&nbsp; &nbsp;
Owner Employee Id: <input type="number" name="ownerid" size=3 maxlength=3>  
&nbsp;
<input type="submit" value="Enter" >
</form>


 
 <?php

}else{
 direct_to_login(1,"You are not logged in.");
}

?>
