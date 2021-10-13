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

       
        
         $row = fetch_array($query);

   

         $response['user_name']=$row['user_name'];         
         $response['address_1']=$row['address_1'];
         $response['pincode_1']=$row['pincode_1'];
         $response['area_1']=$row['area_1'];
         
         $response['address_2']=$row['address_2'];
         $response['pincode_2']=$row['pincode_2'];
         $response['area_2']=$row['area_2'];

         $pincode1=$row['pincode_1'];


         $query3 = query("SELECT * FROM ks_pincodes");
         confirm($query3);
         if (mysqli_num_rows($query3) > 0) {
          $response["pincode"]=array();
  
          while ($row = fetch_array($query3)) {
              $pincode = array();
              $pincode["pincode"] = $row["pincode"];
              
       
              // push single product into final response array
              array_push($response["pincode"], $pincode);
          } 
  
  
         }


         $query4 = query("SELECT * FROM ks_areas WHERE pincode = '{$pincode1}' ");
         confirm($query4);
         if (mysqli_num_rows($query4) > 0) {
          $response["area"]=array();
  
          while ($row = fetch_array($query4)) {
              $area = array();
              $area["area"] = $row["area_name"];
              array_push($response["area"], $area);

          } 
  
  
         }


      $response['message']= "Order Placed Successfully";
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