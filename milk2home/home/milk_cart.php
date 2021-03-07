<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 
// array for JSON response
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
 $response['update']= 0;


 //$items=array();
 $items = $_POST['cartitems'];
 $items= json_decode($items);

 $response["products"] = array();



 foreach($items as $item) {
    
       

       $query= query("SELECT * FROM milk_products WHERE pid = '{$item}' ");
       confirm($query);


     

       if (mysqli_num_rows($query) > 0) {
        
        
               $row = fetch_array($query);
               // temp user array
               $product = array();
               $product["pid"] = $row["pid"];
               $product["name"] = $row["name"];
               $product["price"] = $row["price"];
               $product["description"] = $row["description"];
               $product["areacode"] = $row["areacode"];
               $product["available"] = $row["available"];
               $product["image"]=$row["image"];
               $product["delivery"]=$row["delivery"];
               
               
        
               // push single product into final response array
               array_push($response["products"], $product);


               // success
       $response["success"] = 1;
       $response["error"] = 0;
           
           
        
          
    
           
        
        } 

    
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