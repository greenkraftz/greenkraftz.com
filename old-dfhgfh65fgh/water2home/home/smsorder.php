<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == ADMINKEY){
$_POST['update']= 0;



 $mnumber = $_POST['mnumber']; 
 

if(isset($mnumber )) {


    $mnumber = escape_string($_POST['mnumber']);


        $query = query("SELECT * FROM users WHERE mnumber = '{$mnumber}' ");
    confirm($query);
    
     if(mysqli_num_rows($query) == 0) {

    $query1 = query("INSERT INTO users (mnumber) VALUES ('{$mnumber}')");
    confirm($query1);

    }

     $query2 = query("SELECT * FROM users WHERE mnumber = '{$mnumber}' ");
    confirm($query2);

         $row = fetch_array($query2);

         $userid= $row['userid'] ;
         $mnumber=$row['mnumber'];
         $username=$row['username'];
         $address=$row['address'];
         $areacode=$row['areacode'];





        $query3 = query("INSERT INTO smsorders (userid ,mnumber , username , address , areacode) VALUES ('{$userid}' ,'{$mnumber}' , '{$username}' , 
                 '{$address}' , '{$areacode}' )");

    confirm($query3);

    $smsdata= "Water2Home Confirmation: SMS Order for 20L Water Can is Successfully Placed.";
    sendOrder($mnumber,$smsdata);

   $msg= " Name :".$username  ."\n Mobile :" . $mnumber ."\n Address : " . $address ."\n Pincode :" .$areacode;
  
  $msg = wordwrap($msg,70);
    mail("water2home.chennai@gmail.com","Order ". last_id(),$msg);
    mail("greenkraftz@gmail.com","Order " .last_id(),$msg);



        

      $_POST['message']= "Order Placed Successfully ";
         $_POST['success']= 1;
        $_POST['error']= 0;


      
      



   
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