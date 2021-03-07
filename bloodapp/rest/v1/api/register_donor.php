<?php

require_once("../resources/config.php") ;

$appkey = $_POST['appkey']; 
if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
    $response = array();
if ($appkey == APPKEY){
    $response['update']= 0; 
     $response['message']= "Unable to Register ";
    $response['success']= 0;
    $response['error']= 1;
    
    $mobile_num = escape_string($_POST['mobile_num']);
    $user_name = escape_string($_POST['donor_username']);    
    $blood_group = escape_string($_POST['blood_group']);
    $rh_group = escape_string($_POST['rh_group']);
    $donor_location = escape_string($_POST['donor_location']);

    
    //$tag = TAG;

if(isset($mobile_num )) {


    $query = query("SELECT * FROM donor_list WHERE donor_mobile_num = '{$mobile_num}' ");
    confirm($query);
    
    if(mysqli_num_rows($query) == 0) {

                  
        $query1 = query("INSERT INTO donor_list ( donor_username  , donor_mobile_num , donor_blood_group , donor_rh_group , donor_location) 
        VALUES ( '{$user_name}' , '{$mobile_num}' , '{$blood_group}', '{$rh_group}' , '{$donor_location}' )");}

        else{
        $query2 = query("UPDATE donor_list SET donor_username='{$user_name}' , donor_blood_group = '{$blood_group}' ,donor_rh_group = '{$rh_group}' 
        ,donor_location = '{$donor_location}' WHERE donor_mobile_num = '{$mobile_num}' ");
        confirm($query2);}
  

      $response['message']= "Donor Registration Successfully";
      $response["success"] = 1;
      $response["error"] = 0;


      
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