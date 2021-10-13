<?php

require_once("../resources/config.php") ;

$appkey = $_POST['appkey']; 
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);

if ($appkey == APPKEY){

$response['update']= 0;
$response['message']= "Incorrect OTP !!";
$response['success']= 0;
$response['error']= 1;

$mobile_num = escape_string($_POST['mobile_num']);
$otp = escape_string($_POST['otp']);
$otp_id = escape_string($_POST['otp_id']);

if(isset($mobile_num , $otp , $otp_id)) {
      
    $query = query("SELECT * FROM otp_table WHERE otpid = '{$otp_id }' ");
    confirm($query);
    
    if(mysqli_num_rows($query) == 1) {
        

        $row = fetch_array($query);

        if($otp== $row['otp'] && $mobile_num == $row['mnumber']){
            
        $auth_key = md5(uniqid(rand(), true));

        $query2 = query("UPDATE users SET authkey='{$auth_key}' WHERE mnumber='{$mobile_num}'");
        confirm($query2);

    $query1 = query("SELECT * FROM users WHERE mnumber = '{$mobile_num}'  ");
    confirm($query1);
    $row = fetch_array($query1);


    $response['user_id']= $row['userid'];
    $response['auth_key']= $row['authkey'];
    $response['mobile_num']= $row['mnumber'];
    

    $response['success']= 1;
    $response['error']= 0;

    $response['message']= "OTP Verification Successful.";

       $msg= "user_id : " . $row['userid'] . " User Name : " . $row['username'] ;
     mail("water2home.chennai@gmail.com",APPNAME." User Login ". $row['userid'],$msg );
            mail("greenkraftz@gmail.com",APPNAME." User Login ". $row['userid'], $msg);

    }

    }


}


} else{
        $response['message']= "Kindly Update Your App To latest Version To Continue !! ";
        $response['success']= 0;
        $response['error']= 0;
        $response['update']= 1;
    }



    print_r(json_encode($response));
    
}


    

?>