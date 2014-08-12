<?php
include 'globals.php';
if($db->check_loggin($_SESSION['username'],$loggintimeout)){
 ?>

<a href="home.php"> Home </a> 
&nbsp; &nbsp; &nbsp; 
<a href="listemployees.php"> List all employees</a> 
&nbsp; &nbsp; &nbsp; 
<a href="Logout.php"> Logout </a> 
<br> <br>

New employee registration: <br>

<form action="enteremployee_process.php" method="post">
Employee Id: <input type="number" name="employeeid" size=3 maxlength=3>  
<br>
Employee First Name: <input type="text" name="firstname" size=20 maxlength=20> 
<br>
Employee Last Name: <input type="text" name="lastname" size=20 maxlength=20> 
<br>
Employee email: <input type="text" name="email" size=20 maxlength=20> 
<br>
Employee extension: <input type="number" name="extension" size=3 maxlength=3> 
<br>
<input type="submit" value="Enter" >
</form>


 
 <?php

}else{
 direct_to_login(1,"You are not logged in.");
}

?>
