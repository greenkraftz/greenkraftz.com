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


    $query1 = query("SELECT * FROM users WHERE mnumber = '{$mnumber}' AND userid = '{$userid }'");
    confirm($query1);
    

    if (mysqli_num_rows($query1) == 1) {
    
           $row = fetch_array($query1); 
          
           $response["username"] = $row["username"];
           $response["address"] = $row["address"];
           $response["areacode"] = $row["areacode"];
           $response["area"] = $row["areaname"];
         
       // success
       $response["success"] = 1;
       $response["error"] = 0;


       $query3 = query("SELECT * FROM pincodes");
       confirm($query3);
       if (mysqli_num_rows($query3) > 0) {
        $response["pincode"]=array();

        while ($row = fetch_array($query3)) {
            // temp user array
            $pincode = array();
            //$timeslot["timeslot_id"] = $row["timeslot_id"];
            $pincode["pincode"] = $row["pincode"];
            
     
            // push single product into final response array
            array_push($response["pincode"], $pincode);
        } 


       }


    
      } 
      else {

    $response['message']= "User Details Unavailable";
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