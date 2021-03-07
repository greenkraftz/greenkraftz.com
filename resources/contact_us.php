<?php 

if(isset($_POST['email']) || isset($_POST['name'])) {


$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$phone = $_POST['phone'];
$formcontent="From: $name \nEmail: $email \nMessage: $message \nPhone: $phone" ;
$recipient = "greenkraftz@gmail.com";
$subject = "GreenKRAFTZ Contact us";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
/* Redirect visitor to the thank you page */
header('Location: thanks.html');
exit();

}

header('Location: thanks.html');
exit();


?>