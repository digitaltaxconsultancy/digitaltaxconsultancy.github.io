<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // SMTP settings for Brevo
    $mail->isSMTP();
    $mail->Host = 'smtp-relay.sendinblue.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your-brevo-email@example.com'; // your Brevo login email
    $mail->Password = 'your-smtp-key-here'; // your SMTP key from Brevo
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Email content from form
    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addAddress('yourdestination@email.com', 'Your Name'); // Where to send the mail

    $mail->Subject = 'New message from website';
    $mail->Body    = "Name: {$_POST['name']}\nEmail: {$_POST['email']}\nPhone: {$_POST['phone']}\n\nMessage:\n{$_POST['message']}";
    
    $mail->send();
    echo 'Message has been sent successfully';
} catch (Exception $e) {
    echo "Message could not be sent. Error: {$mail->ErrorInfo}";
}
