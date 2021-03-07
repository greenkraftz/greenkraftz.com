<?php

require_once("../resources/config.php") ;

$appkey = $_POST['appkey']; 
// array for JSON response
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
 $response['update']= 0;
 $response['message']= "Recipients Details Unavailable";
    $response['success']= 0;
    $response['error']= 1;


     $query1 = query("SELECT * FROM ".RECIPIENT_TABLE." ORDER BY  `recipient_id` DESC");
    confirm($query1);
    

    if (mysqli_num_rows($query1) > 0) {
    $response["recipients"] = array();
    
       while ($row = fetch_array($query1)) {
           // temp user array
           $recipient = array();
           $recipient["recipient_name"] = $row["recipient_name"];
           $recipient["recipient_image"] = $row["recipient_image"];
           $recipient["recipient_group"] = $row["recipient_group"];
           $recipient["recipient_number"] = $row["recipient_number"];
           $recipient["recipient_location"] = $row["recipient_location"];
           $recipient["recipient_age"] = $row["recipient_age"];
           $recipient["recipient_deadline"] = $row["recipient_deadline"];

           // push single product into final response array
           array_push($response["recipients"], $recipient);
       } 
       // success
       $response["success"] = 1;
       $response["error"] = 0;
       $response['message']= "Recipients Details ";
    
    
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