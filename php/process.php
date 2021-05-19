<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer();

try {
    //Server settings
    //$mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  			// Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'phonkdrip@gmail.com';                     // SMTP username
    $mail->Password   = 'ryan2005@';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('phonkdrip@gmail.com');
    $mail->addAddress('phonkdrip@gmail.com');     // Add a recipient
    $mail->addReplyTo($_REQUEST['email'], $_REQUEST['name']);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $_REQUEST['subject'];

    $fields = array();
    $fields{"name"} = "Name";
    $fields{"email"} = "E-mail";
    $fields{"subject"} = "Subject";
    $fields{"message"} = "Message";

    $body = "Here is the message from PhonkDrip:\n\n"; foreach($fields as $a => $b){   $body .= sprintf("%20s: %s\n",$b,$_REQUEST[$a]); }

    $mail->Body    = $body;
    $mail->AltBody = $body;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
