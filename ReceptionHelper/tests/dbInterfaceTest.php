<?php

//include 'dbInterface.php';
include 'globals.php';
 

class dbInterfaceTest extends PHPUnit_Framework_TestCase
{
    

     public function test_register_loggin()
     {
 	global $db;
         $db->register_loggin("u",1);
 
         $this->assertEquals(1, $db->check_loggin("u",10));
     }

    public function test_logout_user()
    {
        global $db;
        $db->register_loggin("u",1);
        $db->logout_user("u");
        $this->assertEquals(0, $db->check_loggin("u",10));
    }
 
}


?>