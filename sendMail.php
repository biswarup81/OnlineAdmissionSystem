<?php
//$result = false;
//$send = new sendMail();
//$send->MailMe("krishdu.p@gmail.com","test mail","testing from server");

class sendMail{

function MailMe($toMail, $subject, $body){
    $result = false;
 //   require './phpmailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;

    try {
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Enable verbose debug output
      $mail->isSMTP();                           // Send using SMTP
      $mail->Host       = 'email-smtp.us-east-2.amazonaws.com';      // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                  // Enable SMTP authentication
      $mail->Username   = 'AKIAU5QQEM2FNLD2L67S';  // SMTP username
      $mail->Password   = 'BEOrUaVdUEj5QfO3CTkVyvg4/EVPZDkTQ7wKYIKVfAUN';               // SMTP password
      $mail->SMTPSecure ='tls';    // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
      $mail->Port       = 587;                  // TCP port to connect to

      $mail->setFrom("admission@kandrarkkmahavidyalaya.org", "Online Admission System"); //Sender E-mail
      $mail->addAddress($toMail);     // Add a recipient
      // $mail->addReplyTo('info@example.com', 'Information');
      // $mail->addCC('cc@example.com');
      // $mail->addBCC('bcc@example.com');

      // Content
      $mail->isHTML(true);   //For sending HTML content

      $mail->Subject = $subject;   //E-Mail Subject
      $mail->Body    = $body;   //E-Mail body

      if($mail->send()){
		  $result =  true;
	     }else{
		   $result = false;
	    }
      } 
      catch (Exception $e) {
        $result =  false;
      }
	return $result;  
  }
}
?>
