<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 
// array for JSON response
$response = array();
$mnumber = escape_string($_POST['mnumber']);
$userid = escape_string($_POST['userid']);
$pid = escape_string($_POST['pid']);

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
 $response['update']= 0;



 if(isset($mnumber , $userid , $pid )) {
    

    $query1 = query("SELECT * FROM milk_sche_list WHERE pid = '{$pid}' AND userid = '{$userid }' ");
    confirm($query1);  
    

    if (mysqli_num_rows($query1) == 1) {

        $query2 = query("DELETE FROM milk_sche_list WHERE pid = '{$pid}' AND userid = '{$userid }' ");
        confirm($query2); 

        // success
        $response['message']= "Schedule Deleted Successfully";        
       $response["success"] = 1;
       $response["error"] = 0;

       } else{
       $response['message']= "Schedule Delete Failed";
       $response['success']= 0;
       $response['error']= 1;}
       
    
      

       
    
    } else {

    $response['message']= "Schedule  Unavailable";
    $response['success']= 0;
    $response['error']= 1;}

 }

  else{
    $response["success"] = 0;
    $response["message"] = "Kindly Update Your App To latest Version To Continue ";
    $response['error']= 0;
    $response['update']= 1;}

 // echoing JSON response
 echo json_encode($response);
}
    

?>