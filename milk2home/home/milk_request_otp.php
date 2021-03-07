<?php

require_once("../resources/config.php") ;

$appkey = $_POST['appkey']; 
// array for JSON response
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
$response['update']= 0;



$mnumber = $_POST['mnumber']; 


if(isset($mnumber)) {
    
    $mnumber = escape_string($_POST['mnumber']);
    
    
    $query = query("SELECT * FROM users WHERE mnumber = '{$mnumber}'  ");
    confirm($query);
    
    if(mysqli_num_rows($query) == 0) {

    $query1 = query("INSERT INTO users (mnumber) VALUES ('{$mnumber}')");
    confirm($query1);

    }

       
        $otp = rand(1000, 9999);

        $query2 = query("INSERT INTO otp_table (mnumber, otp) VALUES ('{$mnumber}', '{$otp}')");
    confirm($query2);

    
    
   // sendOTP($mnumber,$otp);

   $response['mnumber']= $mnumber;   
    $response['otpid']= last_id();
    $response['message']= "OTP generated successfully";
    $response['success']= 1;
    $response['error']= 0;

        $msg= "OTP Request " . $mnumber . " : " . $otp ;
         mail("water2home.chennai@gmail.com","Milk OTP Request ". last_id() . " : " .$mnumber ,$msg );
                mail("greenkraftz@gmail.com","Milk OTP Request ". last_id() . " : " .$mnumber ,$msg );


    

 


}
else {

    $response['message']= "OTP Request Failed ";
     $response['success']= 0;
    $response['error']= 1;
    

     }

 } else{
         $response['message']= "Kindly Update Your App To latest Version To Continue  ";
         $response['success']= 0;
        $response['error']= 1;
        $response['update']= 1;
    }



    print_r(json_encode($response));
    
}

    

?>