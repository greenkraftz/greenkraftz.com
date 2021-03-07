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


    $query = query("SELECT * FROM users WHERE mnumber = '{$mnumber}' AND userid = '{$userid }' ");
    confirm($query);
    
    if(mysqli_num_rows($query) == 1) {

         $row = fetch_array($query);

         


         $query2 = query("SELECT * FROM milk_products WHERE pid = '{$pid}'  ");
         confirm($query2);

         if(mysqli_num_rows($query2) == 1) {


             $query3 = query("SELECT * FROM milk_sche_list WHERE pid = '{$pid}' AND userid = '{$userid }' ");
         confirm($query3);  
         $row = fetch_array($query3);
         $response['quantity']= $row['quantity'] ? $row['quantity'] : 1  ;
         $response['paymentmode'] = $row['payment_mode'];
         $response['timeslot'] = $row['timeslot'];         
         $response['mon'] = $row['mon'] ? true : false;
         $response['tue'] = $row['tue'] ? true : false;
         $response['wed'] = $row['wed']? true : false;
         $response['thur'] = $row['thur']? true : false;
         $response['fri'] = $row['fri']? true : false;
         $response['sat'] = $row['sat']? true : false;
         $response['sun'] = $row['sun']? true : false;

         $response['true']=false;
         if(mysqli_num_rows($query3)==1){$response['true']=true;}
         

      //   $msg= "User ID : " . $userid . " Number : " . $mnumber . " Product : " . $pid ;
      //   mail("water2home.chennai@gmail.com","New Milk Schedule  ". last_id() . " : " .$mnumber ,$msg );
       //         mail("greenkraftz@gmail.com","New Milk Schedule  ". last_id() . " : " .$mnumber ,$msg );
         
    //$data= "Milk2Home Confirmation: Order is Successfully Placed.";
    //sendOrder($mnumber,$data);


      $response['message']= "Schedule Fetch Successful";
      $response["success"] = 1;
      $response["error"] = 0;


      }else{$response['message']= "Product Does not Exist ";
            $response['success']= 0;
            $response['error']= 1;   }
    }
      else{

        $response['message']= "Unable to place the order ";
        $response['success']= 0;
        $response['error']= 1;
       
             }



   
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