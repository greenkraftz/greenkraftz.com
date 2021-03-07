<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 
// array for JSON response
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
 $response['update']= 0;
 $response['message']= "Address Update Failed";
 $response['success']= 0;
 $response['error']= 1;


 $mobile_num = escape_string($_POST['mobile_num']);
 $user_id = escape_string($_POST['user_id']);
 $user_name = escape_string($_POST['user_name']);
 $address = escape_string($_POST['address']);
 $pincode = escape_string($_POST['pincode']);
 $areaname = escape_string($_POST['area']);
 $addressnum = escape_string($_POST['address_num']);
 
 




    $query1 = query("SELECT * FROM users_ks WHERE mobile_num = '{$mobile_num}' AND user_id = '{$user_id }'");
    confirm($query1);
    

    if (mysqli_num_rows($query1) == 1) {


        if($addressnum==1){


        $query2 = query("UPDATE users_ks SET user_name='{$user_name}' , address_1 = '{$address}' ,pincode_1 = '{$pincode}' ,area_1 = '{$areaname}'
        WHERE mobile_num = '{$mobile_num}' AND user_id = '{$user_id }' ");
        confirm($query2);

        }
        else{
            $query2 = query("UPDATE users_ks SET user_name='{$user_name}' , address_2 = '{$address}' ,pincode_2 = '{$pincode}' ,area_2 = '{$areaname}'
            WHERE mobile_num = '{$mobile_num}' AND user_id = '{$user_id }' ");
            confirm($query2);
       }
      
         // success
       $response["success"] = 1;
       $response["error"] = 0;
       $response['message']= "Address Updated Successfully";
       
    
      } 
   


   


 } else{
    $response["success"] = 0;
    $response["message"] = "Kindly Update Your App To latest Version To Continue ";
    $response['error']= 0;
    $response['update']= 1;

        
        
    }



 // echoing JSON response
 echo json_encode($response);
}



    

?>