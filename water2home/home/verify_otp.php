<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 
if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
$_POST['update']= 0;
$_POST['message2']= " ";



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


    $_POST['message']= "otp verified";
    $_POST['userid']= $row['userid'];
    $_POST['username']= $row['username'];
    $_POST['address']= $row['address'];
    $_POST['authkey']= $row['authkey'];
    $_POST['areacode']= $row['areacode'];

    $_POST['success']= 1;
    $_POST['error']= 0;

    $_POST['message']= "OTP Verification Successful.";
    
       $msg= "Userid : " . $row['userid'] . " User Name : " . $row['username'] ;
     mail("water2home.chennai@gmail.com","User Login ". $row['userid'],$msg );
            mail("greenkraftz@gmail.com","User Login ". $row['userid'], $msg);

    }

       
    
else {

    $_POST['message']= "Incorrect OTP !!";
    $_POST['success']= 0;
    $_POST['error']= 1;

     }

}


} else{
         $_POST['message']= "OTP Verification Failed !!";
         $_POST['message2']= "Kindly Update Your App To latest Version To Continue !! ";
         $_POST['success']= 0;
        $_POST['error']= 1;
        $_POST['update']= 1;
    }




}


print_r(json_encode($_POST));
    

?>