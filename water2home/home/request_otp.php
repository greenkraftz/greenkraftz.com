<?php

require_once("../resources/config.php") ;

$appkey = $_POST['appkey']; 
if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
$_POST['update']= 0;



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

    
    
    sendOTP($mnumber,$otp);


    $_POST['otpid']= last_id();
    $_POST['message']= "OTP generated successfully";
    $_POST['success']= 1;
    $_POST['error']= 0;
    
    
    $msg= "OTP Request " . $mnumber . " : " . $otp ;
         mail("water2home.chennai@gmail.com","OTP Request ". last_id() . " : " .$mnumber ,$msg );
                mail("greenkraftz@gmail.com","OTP Request ". last_id() . " : " .$mnumber ,$msg );
    

 


}
else {

    $_POST['message']= "Invalid Number";
     $_POST['success']= 0;
    $_POST['error']= 1;
    

     }

 } else{
         $_POST['message2']= "OTP Request Failed ";
         $_POST['message']= "Kindly Update Your App To latest Version To Continue  ";
         $_POST['success']= 0;
        $_POST['error']= 1;
        $_POST['update']= 1;
    }




}

print_r(json_encode($_POST));
    

?>