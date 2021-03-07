<?php

require_once("../resources/config.php") ;

$appkey = $_POST['appkey']; 
if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
    $response = array();
    $response['update']= 0; 
     $response['message']= "Unable to Submit Feedback ";
    $response['success']= 0;
    $response['error']= 1;
    
    $mobile_num = escape_string($_POST['mobile_num']);
    $user_name = escape_string($_POST['user_name']);    
    $user_email = escape_string($_POST['user_email']);
    $feedback = escape_string($_POST['feedback']);
    $rating = escape_string($_POST['rating']);
    $user_id = escape_string($_POST['user_id']);    
    
    $tag = TAG;

if(isset($mobile_num )) {


    $query = query("SELECT * FROM users WHERE mnumber = '{$mobile_num}' ");
    confirm($query);
    
    if(mysqli_num_rows($query) == 1) {

                  
        $query1 = query("INSERT INTO feedback (tag , user_id , mobile_num , user_name , user_email , feedback , rating ) 
        VALUES ( '{$tag}' ,'{$user_id}' ,'{$mobile_num}' , '{$user_name}' , '{$user_email}' , '{$feedback}', '{$rating}'  )");

    confirm($query1);

    //$data= APPNAME." Confirmation: Feedback Recieved.";
    //sendOrder($mnumber,$data);

   $msg= " Name : ".$user_name  ."\n Mobile : " . $mobile_num  ."\n usermail : " .$user_email . "\n Feedback :"
   .$feedback ."\n Rating : " . $rating ;
  
  $msg = wordwrap($msg,70);
    mail("water2home.chennai@gmail.com",APPNAME." Feedback ". last_id(),$msg);
    mail("greenkraftz@gmail.com",APPNAME." Feedback " .last_id(),$msg);


      $response['message']= "Feedback Submitted Successfully";
      $response["success"] = 1;
      $response["error"] = 0;


      
    }
    
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