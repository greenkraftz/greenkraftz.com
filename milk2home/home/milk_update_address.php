<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 
// array for JSON response
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
 $response['update']= 0;

 $mnumber = escape_string($_POST['mnumber']);
 $userid = escape_string($_POST['userid']);
 $name = escape_string($_POST['username']);
 $address = escape_string($_POST['address']);
 $pincode = escape_string($_POST['areacode']);
 $areaname = escape_string($_POST['area']);
 

 $query3 = query("SELECT * FROM pincodes WHERE pincode = '{$pincode}' ");
 confirm($query3);
 if(mysqli_num_rows($query3) == 1) {
 


    $query1 = query("SELECT * FROM users WHERE mnumber = '{$mnumber}' AND userid = '{$userid }'");
    confirm($query1);
    

    if (mysqli_num_rows($query1) == 1) {


        $query2 = query("UPDATE users SET username='{$name}' , address = '{$address}' ,areacode = '{$pincode}' ,areaname = '{$areaname}'
        WHERE mnumber = '{$mnumber}' AND userid = '{$userid }' ");
        confirm($query2);
      
         // success
       $response["success"] = 1;
       $response["error"] = 0;
       $response['message']= "Address Updated Successfully";
       
    
      } 
      else {

    $response['message']= "Address Update Failed";
    $response['success']= 0;
    $response['error']= 1;

      }


    } else {
        
            $response['message']= "Delivery Not Available At Pincode";
            $response['success']= 0;
            $response['error']= 1;
        
              }


 } else{
    $response["success"] = 0;
    $response["message"] = "Kindly Update Your App To latest Version To Continue ";
    $response['error']= 0;
    $response['update']= 1;

        
        
    }




}


 // echoing JSON response
 echo json_encode($response);
    

?>