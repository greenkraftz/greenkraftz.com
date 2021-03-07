<?php

require_once("../resources/config.php") ;

$appkey = $_POST['appkey']; 
if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
    $response = array();
 $response['update']= 0;
 $response['message']= "Delivery Not Available in this Pincode";
 $response['success']= 0;
 $response['error']= 1;

 $pincode = escape_string($_POST['pincode']);
 
      $query3 = query("SELECT * FROM areas WHERE areacode = '{$pincode}' ");
       confirm($query3);
       if (mysqli_num_rows($query3) > 0) {
      // success
      $response["success"] = 1;
      $response["error"] = 0;
      $response['message']= "Delivery Available";

        $response["area"]=array();

        while ($row = fetch_array($query3)) {
            $area = array();
            $area["area"] = $row["areaname"];
            array_push($response["area"], $area);
        } 


       }

 } else{
    $response["success"] = 0;
    $response["message"] = "Kindly Update Your App To latest Version To Continue ";
    $response['error']= 0;
    $response['update']= 1; }




}


 // echoing JSON response
 echo json_encode($response);
    

?>