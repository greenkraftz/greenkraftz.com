<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 
// array for JSON response
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
 $response['update']= 0;

     $query1 = query("SELECT * FROM milk_aboutus");
    confirm($query1);
    

    if (mysqli_num_rows($query1) > 0) {
    
       $row = fetch_array($query1);
           $response["title"] = $row["title"];
           $response["subtitle"] = $row["subtitle"];
           $response["content"] = $row["content"];
           $response["privacy_title"] = $row["privacy_title"];
           $response["privacy_text"] = $row["privacy_text"];
           $response["terms_title"] = $row["terms_title"];
           $response["terms_text"] = $row["terms_text"];
           
           
       // success
       $response["success"] = 1;
       $response["error"] = 0;
    
    } else {
    $response['message']= "About Us Unavailable";
    $response['success']= 0;
    $response['error']= 1;
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