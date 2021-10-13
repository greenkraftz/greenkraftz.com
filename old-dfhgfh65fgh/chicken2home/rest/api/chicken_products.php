<?php

require_once("../resources/config.php") ;

$appkey = $_POST['appkey']; 
// array for JSON response
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
 $response['update']= 0;
 $response['message']= "Product Details Unavailable";
    $response['success']= 0;
    $response['error']= 1;



    $query= query("SELECT * FROM delivery_charge WHERE tag = 'chicken2home' ");
    confirm($query);
    $row = fetch_array($query);
    $response["delivery_charge"] = $row["delivery_charge"];


     $query1 = query("SELECT * FROM chicken_products");
    confirm($query1);
    

    if (mysqli_num_rows($query1) > 0) {
    $response["products"] = array();
    
       while ($row = fetch_array($query1)) {
           // temp user array
           $product = array();
           $product["pid"] = $row["pid"];
           $product["name"] = $row["name"];
           $product["price"] = $row["price"];
           $product["description"] = $row["description"];
           $product["pincode"] = $row["pincode"];
           $product["available"] = $row["available"];
           $product["image"]=$row["image"];
           $product["delivery"]=$row["delivery"];
           $product["type"]=$row["type"];

           
    
           // push single product into final response array
           array_push($response["products"], $product);
       } 
       // success
       $response["success"] = 1;
       $response["error"] = 0;
       $response['message']= "Product Details ";
    
    
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