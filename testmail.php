<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '/opt/bitnami/apache2/htdocs/onlineadm/classes/Exception.php';
require '/opt/bitnami/apache2/htdocs/onlineadm/classes/PHPMailer.php';
require '/opt/bitnami/apache2/htdocs/onlineadm/classes/SMTP.php';

$mail = new PHPMailer;

		$mail->IsSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
		$mail->Port = 465;                                    // Set the SMTP port
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'mailmeanupammaiti@gmail.com';                // SMTP username
		$mail->Password = 'India@1234India!!';                 // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
		$mail->From = 'kandrarkk@online-admission.co.in';
		$mail->FromName = 'Kandra Radhakanta Kundu Mahavidyalaya';
		$mail->AddAddress('mailmeanupammaiti@rediffmail.com');               // Name is optional
		$mail->IsHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Test subject';
		$mail->Body    = '<h1>Test Body</h1>';

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';