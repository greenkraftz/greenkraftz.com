<?php

require_once("../resources/config.php") ;

$appkey = $_POST['appkey']; 

if(isset($appkey)) {
    $response = array();
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){

$response['update']= 0;
$response['message']= "Invalid Number OTP Request Failed ";
$response['success']= 0;
$response['error']= 1;

$mobile_num = escape_string($_POST['mobile_num']);

if(isset($mobile_num)) {
       
    $query = query("SELECT * FROM donor_list WHERE donor_mobile_num = '{$mobile_num}'  ");
    confirm($query);
    
    if(mysqli_num_rows($query) == 0) {

    $query1 = query("INSERT INTO donor_list (donor_mobile_num) VALUES ('{$mobile_num}')");
    confirm($query1);

    }

       
        $otp = rand(1000, 9999);

        $query2 = query("INSERT INTO blood_otp_table (mobile_num, otp) VALUES ('{$mobile_num}', '{$otp}')");
    confirm($query2);

    
    
  //  sendOTP($mobile_num,$otp);

   $response['mobile_num']= $mobile_num;   
    $response['otp_id']= last_id();
    $response['message']= "OTP generated successfully";
    $response['success']= 1;
    $response['error']= 0;

        $msg= APPNAME." OTP Request " . $mobile_num . " : " . $otp ;
         mail("water2home.chennai@gmail.com",APPNAME." OTP Request ". last_id() . " : " .$mobile_num ,$msg );
                mail("greenkraftz@gmail.com",APPNAME." OTP Request ". last_id() . " : " .$mobile_num ,$msg );


    }


 } else{
        $response['message']= "Kindly Update Your App To latest Version To Continue  ";
        $response['success']= 0;
        $response['error']= 0;
        $response['update']= 1;
    }



    print_r(json_encode($response));
    
}

    

?>