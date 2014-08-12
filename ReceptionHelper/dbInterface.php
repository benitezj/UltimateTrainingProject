<?php

class dbInterface{
      
   private $con;
   public $connected = false;
   

   function __construct($host="",$user="",$passwd="",$DB=""){
    $this->con = mysqli_connect($host,$user,$passwd,$DB);
    if (mysqli_connect_errno()) $this->connected = false; 
    else $this->connected = true;
   }      

   function __destruct(){
     if($this->connected) mysqli_close($this->con);
   }

   function query($query){
     return mysqli_query($this->con,$query);
   }

   //log user into database
   function register_loggin($username,$success){
      $query = "INSERT INTO LOGGINS (USERNAME,TIME,SUCCESS) VALUES ('" . $username . "'," . time() . "," . $success . ")"; 
      if(!mysqli_query($this->con,$query)) return false;
      return true;
   }  

   //log out user 
   function logout_user($username){	 
      $query = "INSERT INTO LOGGINS (USERNAME,TIME,SUCCESS) VALUES ('" . $username . "'," . time() . ",0)"; 
      if(!mysqli_query($this->con,$query)) return false;
       return true;	 
   }

   //check if user is logged in
   function check_loggin($username,$timeout){
      $query = "SELECT * FROM LOGGINS WHERE USERNAME='" . $username . "' && TIME>" . (time()-$timeout) ;
      $result = mysqli_query($this->con, $query);
   
      //find the latest entry, could have been a login (1) or a logout (0) 
      $time = 0;
      $success = 0;
      while($row = mysqli_fetch_array($result)) {
         if($row['TIME'] > $time){	
           $time = $row['TIME'];     
           $success = $row['SUCCESS'];
         } 
       }
   
      $result->close();	
      return $success;
   }

   //count number of login attempts	
   function get_login_failures($username,$period){
      $query = "SELECT * FROM LOGGINS WHERE USERNAME='" . $username . "' && TIME>" . (time()-$period) . " && SUCCESS=0"; 
      $result = mysqli_query($this->con, $query);
      $number = $result->num_rows;   
      $result->close();	

      return $number;
   } 

   //record incident in history table
   function record_incident($tag,$email,$message){
      $query = "INSERT INTO HISTORY (TIME,TAG,EMAIL,MESSAGE) VALUES (" . time()  . ",'" . $tag . "','" . $email . "','" . $message . "')" ; 
      if(!mysqli_query($this->con,$query)) return false;
      return true;	 
   }


   //display all incidents
   function print_incidents(){
      $result = mysqli_query($this->con,"SELECT * FROM HISTORY");
      
      while($row = mysqli_fetch_array($result)) {
        $date = date("Y-m-d H:i:s", $row['TIME']);
        echo $date . " " . $row['TAG'] . " " . $row['EMAIL'] . " " . $row['MESSAGE'];
        echo "<br>";
      }
   
      $result->close();	
      return true;
   }
  
   //display all loggins
   function print_loggins(){
      $result = mysqli_query($this->con,"SELECT * FROM LOGGINS");
   
      while($row = mysqli_fetch_array($result)) {
        echo $row['USERNAME'] . " " . $row['TIME'] . " " . $row['SUCCESS'];
        echo "<br>";
      }
   
      $result->close();	
      return true;
   }
   
   
   //function to display the Vehicles in the database
   function print_Vehicles(){
      $result = mysqli_query($this->con,"SELECT * FROM VEHICLES");
      while($row = mysqli_fetch_array($result)) {
        echo $row['TAG'] . " " . $row['MODEL'] . " " . $row['EMPLOYEE'];
        echo "<br>";
      }
   
      $result->close();
   }
   
   //function to display the Employees in the database
   function print_Employees(){
      $result = mysqli_query($this->con,"SELECT * FROM EMPLOYEES");
      while($row = mysqli_fetch_array($result)) {
         echo $row['ID'] . " " . $row['FIRST'] . " " . $row['LAST'];
         echo "<br>";
      }
   
      $result->close();
   }


}



?>