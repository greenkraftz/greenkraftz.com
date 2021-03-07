<?php

require_once("../resources/config.php") ;

$appkey = $_POST['appkey']; 
// array for JSON response
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
 $response['update']= 0;
 $response["success"] = 0;
$response["error"] = 1;
$response["message"] = "Cart is Empty ";

$query= query("SELECT * FROM delivery_charge WHERE tag = '".TAG."' ");
confirm($query);
$row = fetch_array($query);
$response["delivery_charge"] = $row["delivery_charge"];



 //$items=array();
 if(isset($_POST['cartitems'])) {
 $items = $_POST['cartitems'];
 $itemsArray= json_decode($items, true);

 $response["products"] = array();


 foreach ($itemsArray as $key => $value) {

    $itemid = $value["pid"];
    $cartId = $value["id"];
    $cartQuantity =  $value["quantity"];
    
      $query= query("SELECT * FROM ".PRODUCT_TABLE." WHERE pid = '{$itemid}' ");

       confirm($query);

       if (mysqli_num_rows($query) > 0) {
        
        
               $row = fetch_array($query);
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
               $product["id"]=$cartId;
               $product["quantity"]=$cartQuantity;
               $product["total"]= $row["price"] * $cartQuantity ;

               
               
        
               // push single product into final response array
               array_push($response["products"], $product);


            
           
         
        } 

    
   }

}

   // success
   $response["success"] = 1;
   $response["error"] = 0;



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