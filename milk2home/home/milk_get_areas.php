<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 
// array for JSON response
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
 $response['update']= 0;
 $areacode = escape_string($_POST['areacode']);
 

     
         
       // success
       $response["success"] = 1;
       $response["error"] = 0;


       $query3 = query("SELECT * FROM areas WHERE areacode = '{$areacode}' ");
       confirm($query3);
       if (mysqli_num_rows($query3) > 0) {
        $response["area"]=array();

        while ($row = fetch_array($query3)) {
            // temp user array
            $area = array();
            //$timeslot["timeslot_id"] = $row["timeslot_id"];
            $area["area"] = $row["areaname"];
            
     
            // push single product into final response array
            array_push($response["area"], $area);
        } 


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