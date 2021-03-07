<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 
$response = array();


if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
    $response['update']= 0;
  
 $mnumber = $_POST['mnumber']; 
 $userid = $_POST['userid'];
 $pid=$_POST['pid'] ;
 
 
if(isset($mnumber , $userid , $pid )) {

    $mnumber = escape_string($_POST['mnumber']);
    $userid = escape_string($_POST['userid']);
    $pid = escape_string($_POST['pid']);
    $quantity=escape_string($_POST['quantity']);
    $payment_mode=escape_string($_POST['payment_mode']);
    $timeslot=escape_string($_POST['timeslot']);
    $name=escape_string($_POST['name']);
    
    $mon=my_toint(escape_string($_POST['mon']));
    $tue=my_toint(escape_string($_POST['tue']));
    $wed=my_toint(escape_string($_POST['wed']));
    $thur=my_toint(escape_string($_POST['thur']));
    $fri=my_toint(escape_string($_POST['fri']));
    $sat=my_toint(escape_string($_POST['sat']));
    $sun=my_toint(escape_string($_POST['sun']));
    


    $query = query("SELECT * FROM milk_sche_list WHERE pid = '{$pid}' AND userid = '{$userid }' ");
    confirm($query);
    
    if(mysqli_num_rows($query) == 0) {

        $query2 = query("INSERT INTO milk_sche_list (userid, pid) VALUES ('{$userid}', '{$pid}') ");
    confirm($query2);
        }


        $query3 = query("UPDATE milk_sche_list SET userid='{$userid}' , mnumber = '{$mnumber}' ,pid = '{$pid}'
        ,quantity = '{$quantity}' ,payment_mode = '{$payment_mode}' ,timeslot = '{$timeslot}' ,mon = '{$mon}'
        ,tue = '{$tue}' ,wed = '{$wed}' ,thur = '{$thur}' ,fri = '{$fri}' ,sat = '{$sat}' ,sun = '{$sun}' ,name = '{$name}'
        WHERE pid = '{$pid}' AND userid = '{$userid }' ");
        confirm($query3);



        $response['message']= "Schedule Updated Successfully";
        $response['success']= 1;
        $response['error']= 0;


}else{

        $response['message']= "Update Failed";
        $response['success']= 0;
        $response['error']= 1;
       
             }



   
  

 } else{
    $response['message']= "Kindly Update Your App To latest Version To Continue  ";
    $response['success']= 0;
    $response['error']= 1;
    $response['update']= 1;
    }




}


print_r(json_encode($response));
    

?>