<?php

require_once("../resources/config.php") ;





$appkey = $_POST['appkey']; 

if(isset($appkey)) {
    $appkey = escape_string($_POST['appkey']);
if ($appkey == APPKEY){
$_POST['update']= 0;



$mnumber = $_POST['mnumber']; 
$name = $_POST['username']; 
$address = $_POST['address']; 
$userid = $_POST['userid']; 
$pincode= $_POST['areacode']; 




if(isset($mnumber , $name , $address , $userid , $pincode)) {
    
    $mnumber = escape_string($_POST['mnumber']);
    $name = escape_string($_POST['username']);
    $address = escape_string($_POST['address']);
    $userid = escape_string($_POST['userid']);
    $pincode = escape_string($_POST['areacode']);



    $query1 = query("SELECT * FROM pincodes WHERE pincode = '{$pincode}' ");
    confirm($query1);
    if(mysqli_num_rows($query1) ==1) {


    
    
    $query = query("SELECT * FROM users WHERE mnumber = '{$mnumber}' AND userid = '{$userid }' ");
    confirm($query);
    
    if(mysqli_num_rows($query) == 1) {

        

        $query2 = query("UPDATE users SET username='{$name}' , address = '{$address}' ,areacode = '{$pincode}' WHERE mnumber='{$mnumber}'");
        confirm($query2);

    

    $_POST['message']= "Information Updated";
   
    $_POST['success']= 1;
    $_POST['error']= 0;

    

    }

       
    
else {

    $_POST['message']= "Updated Failed";
    $_POST['success']= 0;
    $_POST['error']= 1;

}


}else{
    $_POST['message']= "Delivery Not available at this pincode yet";
    $_POST['success']= 0;
    $_POST['error']= 1;


}


}else{
    $_POST['message']= "Provide Valid Information !!";
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