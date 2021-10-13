<?php 

if(isset($_POST['email']) || isset($_POST['first_name'])) {


$name = $_POST['first_name'];
$email = $_POST['email'];
$message = $_POST['message'];
$formcontent="From: $name \nEmail $email \nMessage: $message";
$recipient = "greenkraftz@gmail.com";
$subject = "App Development Contact";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
/* Redirect visitor to the thank you page */
header('Location: thanks.html');
exit();

}

header('Location: thanks.html');
exit();


?>