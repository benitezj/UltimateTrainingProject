<?php

include '../ReceptionHelperAp/dbInterface.php';

class dbInterfaceTest extends PHPUnit_Framework_TestCase
{

     protected $db;

     protected function setUp(){
      $dbuser = "ultimate";	
      $dbuserpasswd = "software";
      $localhost = "127.0.0.1";
      $database = "ReceptionDB";
      $this->db = new dbInterface($localhost,$dbuser,$dbuserpasswd,$database);   
     }	

     public function test_connected()
     {
       $this->assertEquals(true, $this->db->connected());
     }

     public function test_register_loggin()
     {
       $this->db->register_loggin("u",1);
       $this->assertEquals(1, $this->db->check_loggin("u",2));
     }

     public function test_logout_user()
     {
          $this->db->register_loggin("u",1);
 	  sleep(2);//database will not register otherwise due to primary key being time()
          $this->db->logout_user("u");	 
          $this->assertEquals(false, $this->db->check_loggin("u",2));
     }
 
     public function test_get_login_failures()
     {
       $this->db->register_loggin("u",0);
       sleep(1);
       $this->db->register_loggin("u",0);
       sleep(1);
       $this->db->register_loggin("u",0);
       $this->assertEquals(3, $this->db->get_login_failures("u",4));
     }

}


?>