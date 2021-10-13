<?php

require_once("../resources/config.php") ;

$appkey = $_POST['appkey']; 
// array for JSON response
$response = array();

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
 $response['update']= 0;
 $response["success"] = 0;
$response["error"] = 1;
$response["message"] = "Order Failed.";

$query= query("SELECT * FROM delivery_charge WHERE tag = '".TAG."' ");
confirm($query);
$row = fetch_array($query);
$delivery_charge = $row["delivery_charge"];

$mobile_num = escape_string($_POST['mobile_num']);

if(isset($mobile_num)) {

     
    $queryUser = query("SELECT * FROM users WHERE mnumber = '{$mobile_num}'  ");
    confirm($queryUser);
    
    if(mysqli_num_rows($queryUser) == 1) {

        $row = fetch_array($queryUser);

        $userid= $row['userid'] ;
        $mnumber=$row['mnumber'];
        $username=$row['username'];
        $address=$row['address'];
        $areacode=$row['areacode'];

        $queryorder= query("INSERT INTO ".ORDER_TABLE." (user_id, mobile_num, user_name, delivery_address, pincode) 
        VALUES ('{$userid}', '{$mnumber}', '{$username}', '{$address}', '{$areacode}' )");
        confirm($queryorder);
        $lastid=last_id();




 //$items=array();
 if(isset($_POST['cartitems'])) {
 $items = $_POST['cartitems'];
 $itemsArray= json_decode($items, true);

 $carttotal=0;
 $itemlist = "";

 //$response["products"] = array();


 foreach ($itemsArray as $key => $value) {

    $itemid = $value["pid"];
    $cartId = $value["id"];
    $cartQuantity =  $value["quantity"];
    
      $queryItem= query("SELECT * FROM ".PRODUCT_TABLE." WHERE pid = '{$itemid}' ");
       confirm($queryItem);

       if (mysqli_num_rows($queryItem) == 1) {

        $rowItem = fetch_array($queryItem);

        $pid= $rowItem['pid'] ;  
        $pname=$rowItem['name']  ;
        $price=$rowItem['price'] ;
        $ptotal=$price *$cartQuantity;  
        $carttotal=$carttotal+$ptotal;     
     
    $query1 = query("INSERT INTO ".ORDER_LIST_TABLE." (order_id , mobile_num , p_id , p_name , p_price , p_quantity ,
     p_total ) 
    VALUES ('{$lastid}' ,'{$mnumber}' , '{$pid}' , '{$pname}' , '{$price}', '{$cartQuantity}' , '{$ptotal}' )");
    confirm($query1);

    $itemlist = $itemlist . $pid . ") - " . $pname . " -- " .$price ." * " .$cartQuantity ." = " .$ptotal . "\n";

           
         
        } 

    
   }

   $data= APPNAME."Services Temporarily Unavailable.";
   //$data= APPNAME." Orders only available from 6.30AM to 10.00AM.";
   //$data= APPNAME." Products Out of Stock.Please Try Again Tomorrow.";



   sendOrder($mnumber,$data);

   $total= $carttotal+$delivery_charge;

  $msg= " Name :".$username  ."\n Mobile :" . $mnumber ."\n Address : " . $address ."\n Pincode :" .$areacode ."\n\n ".$itemlist 
  . "\n Sub total = " .$carttotal . "\n Delivery Charge = " .$delivery_charge . "\n TOTAL = " .$total ;

  $sub = APPNAME." Order ";
 
 $msg = wordwrap($msg,70);
   mail("water2home.chennai@gmail.com",$sub . $lastid,$msg);
   mail("greenkraftz@gmail.com",$sub .$lastid,$msg);


     $response['message']= "Order Placed Successfully";
     $response["success"] = 1;
     $response["error"] = 0;

}  // fail

} // end of user



 } // end of mob num

 
 
}else{
    $response["success"] = 0;
    $response["message"] = "Kindly Update Your App To latest Version To Continue ";
    $response['error']= 0;
    $response['update']= 1;

        
        
    }



}


 // echoing JSON response
 echo json_encode($response);
    

?>