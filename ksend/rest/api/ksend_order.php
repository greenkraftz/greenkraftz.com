<?php

require_once("../resources/config.php") ;


$appkey = $_POST['appkey']; 
$response = array();


if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
    $response['update']= 0;

    $response['message']= "Unable to place the order ";
    $response['success']= 0;
    $response['error']= 1;
    
  
    $mobile_num = escape_string($_POST['mobile_num']);
    $user_id = escape_string($_POST['user_id']);
 
 

if(isset($mobile_num , $user_id )) {



    $query = query("SELECT * FROM users_ks WHERE mobile_num = '{$mobile_num}' AND user_id = '{$user_id }' ");
    confirm($query);
    
    if(mysqli_num_rows($query) == 1) {

        $address_num = escape_string($_POST['address_num']);
        $to_address= escape_string($_POST['to_address']); 
        $to_pincode= escape_string($_POST['to_pincode']); 
        $to_area= escape_string($_POST['to_area']); 
        $to_mobile_num= escape_string($_POST['to_mobile_num']); 
        $pickup_type= escape_string($_POST['pickup_type']); 
        $delivery_speed= escape_string($_POST['delivery_speed']); 
        $bill_amount=  escape_string($_POST['bill_amount']);  
        $delivery_charge=  escape_string($_POST['delivery_charge']);          
        
        
         $row = fetch_array($query);

         $user_id= $row['user_id'] ;
         $mobile_num=$row['mobile_num'];
         $user_name=$row['user_name'];

         if($address_num == 1){
         $from_address=$row['address_1'];
         $from_pincode=$row['pincode_1'];
         $from_area=$row['area_1'];}
         else{
            $from_address=$row['address_2'];
            $from_pincode=$row['pincode_2'];
            $from_area=$row['area_2']; }

         
     
         
        $query1 = query("INSERT INTO ks_orders (user_id , mobile_num , user_name , from_address , from_pincode , from_area
         , to_address , to_pincode , to_area , to_mobile_num , pickup_type , delivery_speed , bill_amount ,delivery_charge ) 
        VALUES ('{$user_id}' ,'{$mobile_num}' , '{$user_name}' , '{$from_address}' , '{$from_pincode}', '{$from_area}' 
        , '{$to_address}' ,'{$to_pincode}', '{$to_area}' , '{$to_mobile_num}', '{$pickup_type}', '{$delivery_speed}', 
        '{$bill_amount}', '{$delivery_charge}')");

    confirm($query1);

    $data= "kSend Confirmation: Pickup Request Placed Successfully.";
    sendOrder($mobile_num,$data);

   $msg= " Name :".$user_name  ."\n Mobile :" . $mobile_num ."\n Address : " . $from_address ."\n Pincode :" .$from_pincode . 
   "\n Area :" .$from_area ."\n To :" ."\n Address :" . $to_address ."\n Pincode :" . $to_pincode . "\n Area :" .$to_area 
   ."\n To Mobile :" . $to_mobile_num ."\n Pickup Type :" . $pickup_type ."\n Delivery Speed :" . $delivery_speed 
   ."\n Bill Amount :" . $bill_amount ."\n delivery_charge :" . $delivery_charge;
  
  $msg = wordwrap($msg,70);
    mail("water2home.chennai@gmail.com","kSEND Pickup ". last_id(),$msg);
    mail("greenkraftz@gmail.com","kSEND Pickup " .last_id(),$msg);


      $response['message']= "Pickup Requested Successfully";
      $response["success"] = 1;
      $response["error"] = 0;


      
    }//user does not exist
   
  }//invalid user

 } else{
    $response['message']= "Kindly Update Your App To latest Version To Continue  ";
    $response['success']= 0;
    $response['error']= 1;
    $response['update']= 1;
    }




}


print_r(json_encode($response));
    

?>