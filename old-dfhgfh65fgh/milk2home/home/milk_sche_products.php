<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 
// array for JSON response
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
 $response['update']= 0;



 

     $query1 = query("SELECT * FROM milk_products");
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
           $product["areacode"] = $row["areacode"];
           $product["available"] = $row["available"];
           $product["image"]=$row["image"];
    
           // push single product into final response array
           array_push($response["products"], $product);
       } 


       $query2 = query("SELECT * FROM milk_paymentmodes");
       confirm($query2);
       if (mysqli_num_rows($query2) > 0) {
        $response["payments"]=array();

        while ($row = fetch_array($query2)) {
            // temp user array
            $payment = array();
            $payment["payid"] = $row["paymentmode_id"];
            $payment["payname"] = $row["paymentmode_name"];
            
     
            // push single product into final response array
            array_push($response["payments"], $payment);
        } 


       }





       $query3 = query("SELECT * FROM milk_sche_timeslot");
       confirm($query3);
       if (mysqli_num_rows($query3) > 0) {
        $response["timeslot"]=array();

        while ($row = fetch_array($query3)) {
            // temp user array
            $timeslot = array();
            $timeslot["timeslot_id"] = $row["timeslot_id"];
            $timeslot["timeslot"] = $row["timeslot"];
            
     
            // push single product into final response array
            array_push($response["timeslot"], $timeslot);
        } 


       }







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




}


 // echoing JSON response
 echo json_encode($response);
    

?>