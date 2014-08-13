<?php
include 'globals.php';

$username = $_POST['username'];
$password = $_POST['password'];

//echo "login: $username $password<br>";
 
//query the db to match the username
$passwquery = "SELECT ID,PASSWORD FROM USERS WHERE USERNAME = '" . $username . "'";
$passwresult = $db->query($passwquery);

//check if user was found
if($passwresult->num_rows == 0){
 //register incident
 $db->register_loggin($username,0);

 //return to index.html
 direct_to_login(2," '" . $username .  "' user not found in database.");	
	
}else {

 //check if user has tried too many times 
 global $loginattemptsperiodshort, $loginattemptsshort, $loginattemptsperiodlong, $loginattemptslong;
 if($db->get_login_failures($username,$loginattemptsperiodshort) > $loginattemptsshort 
    || $db->get_login_failures($username,$loginattemptsperiodlong) > $loginattemptslong ) {
 
  //register incident
  $db->register_loggin($username,0);
 
  //return to login page
  direct_to_login(2,"Account loocked due to too many attempts. Try later.");

 }else {

   // check password 
   $row = mysqli_fetch_array($passwresult);
   if($password == $row['PASSWORD']){ 
     //direct to home page
     header('refresh:1 ;  url=home.php');
   
     //register user loggin in db
     if(!$db->register_loggin($username,1))
       direct_to_login(2,"Failed to register loggin in db. Loggin failed.");	
       
     //register user in the session 
     //session_register('username'); //deprecated in php5
     $_SESSION['username'] = $username;

     echo "Successful login.";	
   }else {
    //password does not match
    //register incident
    $db->register_loggin($username,0);
   
    //return to login page
    direct_to_login(2,"Invalid Password");
   }	

 }

}

$passwresult->close();






