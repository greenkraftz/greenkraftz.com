<?php 

  defined ("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

  defined ("APPKEY") ? null : define("APPKEY", "break76658831");

  defined ("ADMINKEY") ? null : define("ADMINKEY", "917665882018");


 

  //sendsms

  /**
 * MSG91 configuration
 */
define('MSG91_AUTH_KEY', "168851A3Pi9FIngZ59beac08");
// sender id should 6 character long
define('MSG91_SENDER_ID_OTP', 'BreakF');

define('MSG91_SENDER_ID_ORDER', 'BreakF');

define('APPNAME', 'BreakFast2Home');
define('TAG', 'breakfirst');
define('PRODUCT_TABLE', 'breakfirst_products');
define('ORDER_TABLE', 'breakfirst_orders');
define('ORDER_LIST_TABLE', 'breakfirst_order_list');



 
 //database
 
 defined("DB_HOST") ? null : define("DB_HOST", "localhost");

 defined("DB_USER") ? null : define("DB_USER","kishore1412");
 
 defined("DB_PASS") ? null : define("DB_PASS", "40water40");
 
 defined("DB_NAME") ? null : define("DB_NAME", "mywater1");



$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
 
 
 require_once("newfunctions.php");
 
 
 ?>