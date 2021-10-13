<?php

require_once("../resources/config.php") ;

$appkey = $_POST['appkey']; 
if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
    $response = array();
 $response['update']= 0;
 $response['message']= "Details Unavailable";
 $response['success']= 0;
 $response['error']= 1;

     $query1 = query("SELECT * FROM contact_us WHERE tag = '".TAG."' ");
    confirm($query1);
    

    if (mysqli_num_rows($query1) == 1) {
    
       $row = fetch_array($query1);
           $response["title"] = $row["title"];
           $response["mobile"] = $row["mobile"];
           $response["email"] = $row["email"];
           $response["website"] = $row["website"];
           $response["comment"] = $row["comment"];
           
       // success
       $response["success"] = 1;
       $response["error"] = 0;
       $response['message']= "Details Available";
    
    } 


 } else{
    $response["success"] = 0;
    $response["message"] = "Kindly Update Your App To latest Version To Continue ";
    $response['error']= 0;
    $response['update']= 1;       }

    
echo json_encode($response);
}


 
    

?>