<?php
include 'globals.php';
if($db->check_loggin($_SESSION['username'],$loggintimeout)){
?>

<a href="home.php"> Home </a> 
<br> <br>

Search for owner of vehicle <br>

<form action="searchowner_process.php" method="post">
Enter Vehicle Tag: <input type="text" name="tag" size=6 maxlength=6>
<input type="submit" value="Search Owner" >
</form>


<?php
}else{
 direct_to_login(1,"You are not logged in.");
}

