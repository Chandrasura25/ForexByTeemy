<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;  
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;
class PHPMailerController extends Controller
{
    public function composeEmail(Request $request){
    require 'vendor/autoload.php';
    $mail = new PHPMailer(true); 
    try {                      
          //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
        $mail->setFrom('sender@example.com', 'SenderName');
        $mail->addAddress($request->emailRecipient);
        $mail->addCC($request->emailCc);
        $mail->addBCC($request->emailBcc);

        $mail->addReplyTo('sender@example.com', 'SenderReplyName');
        $mail->isHTML(true);                // Set email content format to HTML

        $mail->Subject = $request->emailSubject;
        $mail->Body    = $request->emailBody;
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
}
