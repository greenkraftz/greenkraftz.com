<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 
// array for JSON response
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
 $response['update']= 0;

     $query1 = query("SELECT * FROM milk_contactus");
    confirm($query1);
    

    if (mysqli_num_rows($query1) > 0) {
    
       $row = fetch_array($query1);
           $response["title"] = $row["title"];
           $response["mobile"] = $row["mobile"];
           $response["email"] = $row["email"];
           $response["website"] = $row["website"];
           $response["comment"] = $row["comment"];
           
       // success
       $response["success"] = 1;
       $response["error"] = 0;
    
    } else {
    $response['message']= "Product Details Unavailable";
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