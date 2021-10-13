<?php

require_once("../resources/config.php") ;

$appkey = $_POST['appkey']; 
// array for JSON response
if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
 $response = array();
 $response['update']= 0;
 $response['message']= "User Details Unavailable";
    $response['success']= 0;
    $response['error']= 1;


    $mobile_num = escape_string($_POST['mobile_num']);
    $query1 = query("SELECT * FROM users WHERE mnumber = '{$mobile_num}'");
    confirm($query1);
    

    if (mysqli_num_rows($query1) == 1) {
    
           $row = fetch_array($query1); 
          
           $response["user_name"] = $row["username"];
           $response["address"] = $row["address"];
           $response["pincode"] = $row["areacode"];
           $response["area"] = $row["areaname"];
         
       // success
       $response["success"] = 1;
       $response["error"] = 0;


       $query3 = query("SELECT * FROM pincodes");
       confirm($query3);
       if (mysqli_num_rows($query3) > 0) {
        $response["pincodes"]=array();

        while ($row = fetch_array($query3)) {
            $pincode = array();
            $pincode["pincodes"] = $row["pincode"];
            array_push($response["pincodes"], $pincode);
                                             } 
                                          }
                                        
                         } 
      


 } else {
    $response["success"] = 0;
    $response["message"] = "Kindly Update Your App To latest Version To Continue ";
    $response['error']= 0;
    $response['update']= 1;   }



    echo json_encode($response);

}
    

?>