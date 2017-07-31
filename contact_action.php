<?php
include_once 'vendor/autoload.php';
include_once 'vendor/phpmailer/phpmailer/class.phpmailer.php';
include_once 'vendor/phpmailer/phpmailer/class.smtp.php';
if(!isset($_SESSION)){
    session_start();
}
//echo '<pre>';
//print_r($_POST);
//exit();

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];


$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "rasel.hossen7576@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "01927659096123";
//Set who the message is to be sent from
$mail->setFrom('rasel.hossen7576@gmail.com', 'First Last');
//Set an alternative reply-to address
//$mail->addReplyTo('prodip3080@gmail.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('prodip5080@gmail.com', 'John Doe');
//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';
$mail->Body    = 'Hello'.$name.','.'<br>'. 'A Email Sent Successfully!';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'hello';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
    $_SESSION['email_sent_mgs'] = 'Email Sent Successfully!';
    header('location:contact_us.php');
}