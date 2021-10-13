<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 
// array for JSON response
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
 $response['update']= 0;

 $userid = escape_string($_POST['userid']);
 $mnumber = escape_string($_POST['mnumber']);
 
 if(isset($mnumber , $userid )) {
    

     $query1 = query("SELECT * FROM milk_sche_list WHERE userid = '{$userid}'");
    confirm($query1);
    

    if (mysqli_num_rows($query1) > 0) {
    $response["products"] = array();
    
       while ($row = fetch_array($query1)) {
           // temp user array
           $product = array();
           $product["pid"] = $row["pid"];
           $product['quantity']= $row['quantity']  ;
           $product['paymentmode'] = $row['payment_mode'];
           $product['timeslot'] = $row['timeslot'];
           $product['name'] = $row['name'];         
           
           $product['mon'] = $row['mon'] ? true : false;
           $product['tue'] = $row['tue'] ? true : false;
           $product['wed'] = $row['wed']? true : false;
           $product['thur'] = $row['thur']? true : false;
           $product['fri'] = $row['fri']? true : false;
           $product['sat'] = $row['sat']? true : false;
           $product['sun'] = $row['sun']? true : false;
    
           // push single product into final response array
           array_push($response["products"], $product);
       } 
       // success
       $response["success"] = 1;
       $response["error"] = 0;
       $response['message']= "Scheduled List Retrived Successfully";
       
    
      

       
    
    } else {

    $response['message']= "No Items Scheduled";
    $response['success']= 0;
    $response['error']= 1;

}

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