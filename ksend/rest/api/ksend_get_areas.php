<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 
// array for JSON response
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
 $response['update']= 0;
 $pincode1 = escape_string($_POST['pincode']);
 

     
         

 $response["area"]=array();
 
       $query4 = query("SELECT * FROM ks_areas WHERE pincode = '{$pincode1}' ");
       confirm($query4);
       if (mysqli_num_rows($query4) > 0) {

        while ($row = fetch_array($query4)) {
            $area = array();
            $area["area"] = $row["area_name"];
            array_push($response["area"], $area);

        } 



       // success
       $response["success"] = 1;
       $response["error"] = 0;

       }


    
      
      else {

    $response['message']= "Delivery Not Available in this Pincode";
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