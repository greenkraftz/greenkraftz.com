<?php 

  defined ("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

  defined ("APPKEY") ? null : define("APPKEY", "201876658831");

  defined ("ADMINKEY") ? null : define("ADMINKEY", "917665882018");


 
 


  //sendsms

  /**
 * MSG91 configuration
 */
define('MSG91_AUTH_KEY', "168851A3Pi9FIngZ59beac08");
// sender id should 6 character long
define('MSG91_SENDER_ID_OTP', 'kSENDr');

define('MSG91_SENDER_ID_ORDER', 'kSENDr');

 
 
 //database
 
defined("DB_HOST") ? null : define("DB_HOST", "localhost");

defined("DB_USER") ? null : define("DB_USER","ksend_admin");

defined("DB_PASS") ? null : define("DB_PASS", "send#200");

defined("DB_NAME") ? null : define("DB_NAME", "ksend21_db");



$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
 
 
 require_once("newfunctions.php");
 
 
 ?>