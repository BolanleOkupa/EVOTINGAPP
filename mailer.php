<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ ."/vendor/autoload.php";

$mail = new PHPMailer(true);
// $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
$mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = "ssl";
// $mail->SMTPSecure = PHPMailer:: ENCRYPTION_STARTTLS;
$mail->Port = 465;
$mail->Username = 'bollyonigbinde@gmail.com';
$mail->setFrom('bollyonigbinde@gmail.com', 'Voter app');
$mail->Password = 'bgmu dnpl xqug royr';

$mail->isHTML(true);

return $mail;