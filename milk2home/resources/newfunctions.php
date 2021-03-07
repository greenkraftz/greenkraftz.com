<?php 

$upload_directory = "uploads";


// helper functions


function last_id(){

global $connection;

return mysqli_insert_id($connection); //The mysqli_insert_id() function returns the ID generated by a query on a table with a column having the AUTO_INCREMENT attribute.

}





function set_message($msg){

if(!empty($msg)) {

$_SESSION['message'] = $msg;

} else {

$msg = "";
    }
}






function display_message() {

    if(isset($_SESSION['message'])) {

        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}









function redirect($location){

return header("Location: $location ");

}





function query($sql) {

global $connection;

return mysqli_query($connection, $sql);


}










function confirm($result){

global $connection;

if(!$result) {

die("QUERY FAILED " . mysqli_error($connection));
	}
}











function escape_string($string){

global $connection;

return mysqli_real_escape_string($connection, $string);
}





function fetch_array($result){

return mysqli_fetch_array($result);


}


function is_connected_db(){
    global $connection;
    if ($connection->connect_error) {
        echo "Not Connected successfully";
    }else{
    echo "Connected successfully";}
}







function sendOTP($mobile, $otp ) {
     
    $otp_prefix = ':';
 
    //Your message to send, Add URL encoding here.
    $message = urlencode("Your OPT is $otp_prefix $otp Welcome to Milk2Home. ");
 
    $response_type = 'json';
 
    //Define route 
    $route = "4";
     
    //Prepare you post parameters
    $postData = array(
        'authkey' => MSG91_AUTH_KEY,
        'mobiles' => $mobile,
        'message' => $message,
        'sender' => MSG91_SENDER_ID_OTP,
        'route' => $route,
        'response' => $response_type
    );
 
//API URL
    $url = "https://control.msg91.com/api/sendhttp.php";
 
// init the resource
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
    ));
 
 
    //Ignore SSL certificate verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 
 
    //get response
    $output = curl_exec($ch);
 
    //Print error if any
    if (curl_errno($ch)) {
       // echo 'error:' . curl_error($ch);
    }
 
    curl_close($ch);
}





function sendOrder($mobile, $data ) {
     
    //$otp_prefix = ':';
 
    //Your message to send, Add URL encoding here.
    $message = urlencode($data);
 
    $response_type = 'json';
 
    //Define route 
    $route = "4";
     
    //Prepare you post parameters
    $postData = array(
        'authkey' => MSG91_AUTH_KEY,
        'mobiles' => $mobile,
        'message' => $message,
        'sender' => MSG91_SENDER_ID_ORDER,
        'route' => $route,
        'response' => $response_type
    );
 
//API URL
    $url = "https://control.msg91.com/api/sendhttp.php";
 
// init the resource
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
    ));
 
 
    //Ignore SSL certificate verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 
 
    //get response
    $output = curl_exec($ch);
 
    //Print error if any
    if (curl_errno($ch)) {
       // echo 'error:' . curl_error($ch);
    }
 
    curl_close($ch);
}






function my_toint($data){
if($data == 'true'){return 1;}

else {
    return 0;
}

}











/****************************FRONT END FUNCTIONS************************/

?>
