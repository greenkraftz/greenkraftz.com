<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
$response['update']= 0;



$mnumber = $_POST['mnumber']; 
$otp = $_POST['otp']; 
$otpid = $_POST['otpid']; 



if(isset($mnumber , $otp , $otpid)) {
    
    $mnumber = escape_string($_POST['mnumber']);
    $otp = escape_string($_POST['otp']);
    $otpid = escape_string($_POST['otpid']);
    
    
    $query = query("SELECT * FROM otp_table WHERE mnumber = '{$mnumber}' AND otp = '{$otp }' AND otpid = '{$otpid }' ");
    confirm($query);
    
    if(mysqli_num_rows($query) == 1) {

        $authkey = md5(uniqid(rand(), true));

        $query2 = query("UPDATE users SET authkey='{$authkey}' WHERE mnumber='{$mnumber}'");
        confirm($query2);

    $query1 = query("SELECT * FROM users WHERE mnumber = '{$mnumber}'  ");
    confirm($query1);
    $row = fetch_array($query1);


    $response['userid']= $row['userid'];
    $response['authkey']= $row['authkey'];
    $response['mnumber']= $row['mnumber'];
    

    $response['success']= 1;
    $response['error']= 0;

    $response['message']= "OTP Verification Successful.";

       $msg= "Userid : " . $row['userid'] . " User Name : " . $row['username'] ;
     mail("water2home.chennai@gmail.com","Milk User Login ". $row['userid'],$msg );
            mail("greenkraftz@gmail.com","Milk User Login ". $row['userid'], $msg);



    }

       
    
else {

    $response['message']= "Incorrect OTP !!";
    $response['success']= 0;
    $response['error']= 1;

     }

}


} else{
         $response['message']= "Kindly Update Your App To latest Version To Continue !! ";
         $response['success']= 0;
        $response['error']= 1;
        $response['update']= 1;
    }



    print_r(json_encode($response));
    
}


    

?>