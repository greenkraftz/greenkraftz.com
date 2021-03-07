<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
$_POST['update']= 0;



 $mnumber = $_POST['mnumber']; 
 $userid = $_POST['userid']; 

if(isset($mnumber , $userid )) {


    $mnumber = escape_string($_POST['mnumber']);
    $userid = escape_string($_POST['userid']);


        $query = query("SELECT * FROM users WHERE mnumber = '{$mnumber}' AND userid = '{$userid }' ");
    confirm($query);
    
    if(mysqli_num_rows($query) == 1) {

         $row = fetch_array($query);

         $userid= $row['userid'] ;
         $mnumber=$row['mnumber'];
         $username=$row['username'];
         $address=$row['address'];
         $areacode=$row['areacode'];





        $query1 = query("INSERT INTO orders (userid ,mnumber , username , address , areacode) VALUES ('{$userid}' ,'{$mnumber}' , '{$username}' , 
                 '{$address}' , '{$areacode}' )");

    confirm($query1);

    $data= "Water2Home Confirmation: Order for 20L Water Can is Successfully Placed.";
    sendOrder($mnumber,$data);

   $msg= " Name :".$username  ."\n Mobile :" . $mnumber ."\n Address : " . $address ."\n Pincode :" .$areacode;
  
  $msg = wordwrap($msg,70);
    mail("water2home.chennai@gmail.com","Order ". last_id(),$msg);
    mail("greenkraftz@gmail.com","Order " .last_id(),$msg);


      $_POST['message']= "Order Placed Successfully ";
         $_POST['success']= 1;
        $_POST['error']= 0;


      }
      else{

        $_POST['message']= "Unable to place the order ";
         $_POST['success']= 0;
        $_POST['error']= 1;
             }



   
  }

 } else{
        $_POST['message']= "Kindly Update Your App To latest Version To Continue  ";
         $_POST['success']= 0;
        $_POST['error']= 1;
        $_POST['update']= 1;
    }




}


print_r(json_encode($_POST));
    

?>