<?php 

session_start();

  defined ("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
 
  defined ("FRONT") ? null : define("FRONT", __DIR__ .DS."front" .DS );
  
  defined ("BACK") ? null : define("BACK", __DIR__ .DS."back" .DS );
  
  defined ("IMAGES") ? null : define("IMAGES", "../resources/images/");

  defined ("APPKEY") ? null : define("APPKEY", "1234567890");
  
  defined ("ADMINKEY") ? null : define("ADMINKEY", "1234567890");


 
 //echo __DIR__ ;


  //sendsms

  /**
 * MSG91 configuration
 */
define('MSG91_AUTH_KEY', "168851A3Pi9FIngZ59beac08");
// sender id should 6 character long
define('MSG91_SENDER_ID_OTP', 'watOTP');

define('MSG91_SENDER_ID_ORDER', 'watORD');

 
 
 //database
 
defined("DB_HOST") ? null : define("DB_HOST", "localhost");

defined("DB_USER") ? null : define("DB_USER","kishore1412");

defined("DB_PASS") ? null : define("DB_PASS", "40water40");

defined("DB_NAME") ? null : define("DB_NAME", "mywater1");



$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
 
 
 require_once("newfunctions.php");
 
 
 ?>