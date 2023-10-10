<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include_once(__DIR__.'/vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($recepient){
    //$mail = new PHPMailer(true);
    $mail = new PHPMailer();

    try {
    //Server settings
    $mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    ));

    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->Username   = '';
    $mail->Password   = '';
    $mail->SetFrom('mailAddress', 'SenderName');

    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAutoTLS = false;
    $mail->Port       = 587;


    //Recipients
    $mail->addAddress($recepient['email'], $recepient['name'] ?? "SenderName");

    // Content
    $mail->isHTML(true);
    $mail->Subject = $recepient['subject'] ?? "Upwork Jobs Alert";
    $mail->Body    = $recepient['mail_body'];
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    return $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}