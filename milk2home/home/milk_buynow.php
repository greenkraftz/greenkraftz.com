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
 $quantity=$_POST['quantity'] ;
 

if(isset($mnumber , $userid , $pid ,  $quantity)) {


    $mnumber = escape_string($_POST['mnumber']);
    $userid = escape_string($_POST['userid']);
    $pid = escape_string($_POST['pid']);
    $quantity = escape_string($_POST['quantity']);


    $query = query("SELECT * FROM users WHERE mnumber = '{$mnumber}' AND userid = '{$userid }' ");
    confirm($query);
    
    if(mysqli_num_rows($query) == 1) {

         $row = fetch_array($query);

         $userid= $row['userid'] ;
         $mnumber=$row['mnumber'];
         $username=$row['username'];
         $address=$row['address'];
         $areacode=$row['areacode'];


         $query2 = query("SELECT * FROM milk_products WHERE pid = '{$pid}'  ");
         confirm($query2);

         if(mysqli_num_rows($query2) == 1) {

            $row2 = fetch_array($query2);

            $pid= $row2['pid'] ;  
            $name=$row2['name']  ;
            $price=$row2['price'] ;
            $ptotal=$price *$quantity;       
         
        $query1 = query("INSERT INTO milk_orders (userid , mnumber , username , address , areacode , pid , name , price , pquantity , ptotal ) 
        VALUES ('{$userid}' ,'{$mnumber}' , '{$username}' , '{$address}' , '{$areacode}', '{$pid}' , '{$name}' ,'{$price}', '{$quantity}' , '{$ptotal}' )");

    confirm($query1);

    $data= "Milk2Home Confirmation: Order is Successfully Placed.";
    //sendOrder($mnumber,$data);

   $msg= " Name :".$username  ."\n Mobile :" . $mnumber ."\n Address : " . $address ."\n Pincode :" .$areacode . "\n Product ID :"
   .$pid ."\n Product Name :" . $name ."\n Price :" . $price . "\n Quantity :" .$quantity ."\n Total :" . $ptotal;
  
  $msg = wordwrap($msg,70);
    mail("water2home.chennai@gmail.com","Milk Buy Now ". last_id(),$msg);
    mail("greenkraftz@gmail.com","Milk Buy Now " .last_id(),$msg);


      $response['message']= "Order Placed Successfully";
      $response["success"] = 1;
      $response["error"] = 0;


      }
    }
      else{

        $response['message']= "Unable to place the order ";
        $response['success']= 0;
        $response['error']= 1;
        $response['mnumber']= $mnumber;
        $response['userid']= $userid;
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