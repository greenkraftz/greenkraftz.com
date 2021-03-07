<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 
$response = array();
$json =$_POST['plist'];
$plist=json_decode($json);


if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
    $response['update']= 0;
    


    
    
 $mnumber = $_POST['mnumber']; 
 $userid = $_POST['userid'];
 

if(isset($mnumber , $userid )) {


    $mnumber = escape_string($_POST['mnumber']);
    $userid = escape_string($_POST['userid']);
    


    $query = query("SELECT * FROM users WHERE mnumber = '{$mnumber}' AND userid = '{$userid }' ");
    confirm($query);
    
    if(mysqli_num_rows($query) == 1) {

         $row = fetch_array($query);

         $userid= $row['userid'] ;
         $mnumber=$row['mnumber'];
         $username=$row['username'];
         $address=$row['address'];
         $areacode=$row['areacode'];

         $queryorder= query("INSERT INTO milk_cart_order (userid, mnumber) VALUES ('{$userid}', '{$mnumber}')");
         confirm($queryorder);
         $lastid=last_id();

         $item="\n";
         $carttotal=0;


         foreach( $plist as $item){

            foreach ( $item as $key => $value){
                if ($key == 'pid'){
                $pid=$value;
                }

                if ($key == 'quantity'){
                    $quantity=$value;
                    }
                
                }





         $query2 = query("SELECT * FROM milk_products WHERE pid = '{$pid}'  ");
         confirm($query2);

         if(mysqli_num_rows($query2) == 1) {

            $row2 = fetch_array($query2);

            $pid= $row2['pid'] ;  
            $name=$row2['name']  ;
            $price=$row2['price'] ;
            $ptotal=$price *$quantity;  
            $carttotal=$carttotal+$ptotal;     
         
        $query1 = query("INSERT INTO milk_cart_order_list (milk_cart_order_id ,userid , mnumber , username , address , areacode , pid , name , price , pquantity , ptotal ) 
        VALUES ('{$lastid}', '{$userid}' ,'{$mnumber}' , '{$username}' , '{$address}' , '{$areacode}', '{$pid}' , '{$name}' ,'{$price}', '{$quantity}' , '{$ptotal}' )");
        confirm($query1);

        $itemlist = $itemlist . $pid . ") - " . $name . " -- " .$price ." * " .$quantity ." = " .$ptotal . "\n";

         }
        }

    $data= "Milk2Home Confirmation: Order is Successfully Placed.";
    //sendOrder($mnumber,$data);

   $msg= " Name :".$username  ."\n Mobile :" . $mnumber ."\n Address : " . $address ."\n Pincode :" .$areacode ."\n\n ".$itemlist 
   . "\n TOTAL = " .$carttotal;
  
  $msg = wordwrap($msg,70);
    mail("water2home.chennai@gmail.com","Milk Cart Order ". $lastid,$msg);
    mail("greenkraftz@gmail.com","Milk Cart Order " .$lastid,$msg);


      $response['message']= "Order Placed Successfully";
      $response["success"] = 1;
      $response["error"] = 0;


      }
    }
      else{

        $response['message']= "Unable to place the order ";
        $response['success']= 0;
        $response['error']= 1;
       
             }



   
  }
  else{
    $response['message']= "Kindly Update Your App To latest Version To Continue  ";
    $response['success']= 0;
    $response['error']= 0;
    $response['update']= 1;
    }

 } 







print_r(json_encode($response));
    

?>