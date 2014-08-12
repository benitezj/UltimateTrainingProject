<?php

$dbuser = "ultimate";
$dbuserpasswd = "software";
$localhost = "127.0.0.1";
$database = "ReceptionDB";
$timezone = "EST";
$localdomain = "fiu.edu";

$loggintimeout = 10*60; 
$loginattemptsperiodshort =  60 ;
$loginattemptsshort =  5 ;
$loginattemptsperiodlong =  24*60*60 ;
$loginattemptslong =  15 ;


//start the session for every page to access stored variables
session_start();

//set the time zone
date_default_timezone_set($timezone);

//
include 'dbInterface.php';
$db = new dbInterface($localhost,$dbuser,$dbuserpasswd,$database);


//Library:

function direct_to_login($refreshtime,$message){
  header("refresh:". $refreshtime . "; url=index.html");  
  echo $message;
}



?>