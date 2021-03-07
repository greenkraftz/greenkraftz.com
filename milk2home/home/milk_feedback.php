<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 
$response = array();


if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
    $response['update']= 0;
    
    $mnumber = escape_string($_POST['mnumber']);
    $userid = escape_string($_POST['userid']);
    $username = escape_string($_POST['username']);    
    $useremail = escape_string($_POST['useremail']);
    $feedback = escape_string($_POST['feedback']);
    $rating = escape_string($_POST['rating']);
    

if(isset($mnumber , $userid )) {


    $query = query("SELECT * FROM users WHERE mnumber = '{$mnumber}' AND userid = '{$userid }' ");
    confirm($query);
    
    if(mysqli_num_rows($query) == 1) {

                  
        $query1 = query("INSERT INTO milk_feedback (userid , mnumber , username , useremail , feedback , rating ) 
        VALUES ('{$userid}' ,'{$mnumber}' , '{$username}' , '{$useremail}' , '{$feedback}', '{$rating}'  )");

    confirm($query1);

    $data= "Milk2Home Confirmation: Feedback Recieved.";
    //sendOrder($mnumber,$data);

   $msg= " Name : ".$username  ."\n Mobile : " . $mnumber ."\n username : " . $username ."\n usermail : " .$usermail . "\n Feedback :"
   .$feedback ."\n Rating : " . $rating ;
  
  $msg = wordwrap($msg,70);
    mail("water2home.chennai@gmail.com","Milk Feedback ". last_id(),$msg);
    mail("greenkraftz@gmail.com","Milk Feedback " .last_id(),$msg);


      $response['message']= "Feedback Submitted Successfully";
      $response["success"] = 1;
      $response["error"] = 0;


      
    }
      else{

        $response['message']= "Unable to Submit Feedback ";
        $response['success']= 0;
        $response['error']= 1;
       
             }



   
  }else{
    
            $response['message']= "Unable to Submit Feedback ";
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