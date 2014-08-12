<?php
include 'globals.php';
if($db->check_loggin($_SESSION['username'],$loggintimeout)){
?>
 

<center>
 
<h1>Ultimate Software Reception Traffic Helper</h1>
 
<?php
  if($_SESSION['username'] == $dbuser ){
?>

<form action="enteruser.php" > 
<input type="submit" value="Register New User" >  
</form>

<form action="enteremployee.php" > 
<input type="submit" value="Register New Employee" >  
</form>

<?php
  }
?>



<form action="entervehicle.php" > 
<input type="submit" value="Register New Vehicle" >
</form>

<form action="searchowner.php" >
<input type="submit" value="Search Vehicle Owner" >
</form>

<form action="eventhistory.php" >
<input type="submit" value="Incidents Log" >
</form>

<form action="Logout.php" >
<input type="submit" value="Logout" >
</form>


</center>

<?php
}else{
 direct_to_login(1,"You are not logged in.");
}
?>
