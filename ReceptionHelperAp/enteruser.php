<?php
include 'globals.php';
if($_SESSION['username'] == $dbuser  && $db->check_loggin($_SESSION['username'],$loggintimeout)){
 ?>

<a href="home.php"> Home </a> 
&nbsp; &nbsp; &nbsp; 
<a href="Logout.php"> Logout </a> 
<br> <br>

New user registration: <br>

<form action="enteruser_process.php" method="post">
Employee Id: <input type="number" name="employeeid" size=3 maxlength=3>  
<br>
User Name: <input type="text" name="username" size=20 maxlength=20> 
<br>
Password: <input type="password" name="password" size=20 maxlength=20> 
<br>
<input type="submit" value="Enter" >
</form>


 
 <?php

}else{
 direct_to_login(1,"You are not logged in.");
}

?>
