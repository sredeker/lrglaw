<?php
/**
 * This example shows sending a message using PHP's mail() function.
 */

require 'phpmailer/PHPMailerAutoload.php';

$name = $_POST['txtName'] ? $_POST['txtName'] : "";
$email = $_POST['txtEmail'] ? $_POST['txtEmail'] : "";
$company = $_POST['txtCompany'] ? $_POST['txtCompany'] : "";
$phoneNumber = $_POST['txtPhone'] ? $_POST['txtPhone'] : "";
$message = $_POST['txtMessage'] ? $_POST['txtMessage'] : "";
$mailTo = $_POST['emailTo'] ? $_POST['emailTo'] : "";




//Create a new PHPMailer instance
$mail = new PHPMailer;


//Set who the message is to be sent from
$mail->setFrom($mailTo);


//Set who the message is to be sent to
$mail->addAddress($mailTo);


//Set the subject line
$mail->Subject = 'LRGR.com - New Contact Request';


//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML("
  A contact has been requested from the website.<br /><br />
  name: " . $name . "<br />
  email: " . $email . "<br />
  company: " . $company . "<br />
  phone: " . $phoneNumber . "<br /><br />
  message:<br />" . $name . "
");


//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}


?>
