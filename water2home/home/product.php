<?php

require_once("../resources/config.php") ;



$appkey = $_POST['appkey']; 

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
$_POST['update']= 0;



 $_POST['productprice']= "Unavailable";
    $_POST['productname']= "Unavailable";

    $query1 = query("SELECT * FROM products ");
    confirm($query1);
    

   
    if(mysqli_num_rows($query1) > 0) {

        

            $row = fetch_array($query1);


    

    $_POST['message']= "Product Details Updated";
    $_POST['productprice']= $row['productprice'];
    $_POST['productname']= $row['productname'];
    $_POST['productdesc']= $row['productdesc'];

    $_POST['success']= 1;
    $_POST['error']= 0;

    

    }

       
    
else {

    $_POST['message']= "Product Details Unavailable";
    $_POST['success']= 0;
    $_POST['error']= 1;

}


 } else{
        $_POST['message']= "Kindly Update Your App To latest Version To Continue  ";
         $_POST['success']= 0;
        $_POST['error']= 1;
        $_POST['update']= 1;
    }




}


print_r(json_encode($_POST));
    

?>