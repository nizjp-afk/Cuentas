<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require '../class.phpmailer.php';

try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	$body             = file_get_contents('contents.html');
	$body             = preg_replace('/\\\\/','', $body); //Strip backslashes

	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = 587;                    // set the SMTP server port
	$mail->Host       = "smtp.gmail.com"; // SMTP server
	$mail->Username   = "fernandomadoz@gmail.com";     // SMTP server username
	$mail->Password   = "valentin";            // SMTP server password
	$mail->SMTPSecure = "tls";                 // Establece el tipo de seguridad SMTP

	//$mail->IsSendmail();  // tell the class to use Sendmail

	$mail->AddReplyTo("fernandomadoz@gmail.com","Fer Madoz");

	$mail->From       = "fernandomadoz@gmail.com";
	$mail->FromName   = "Fer Madoz";

	$to = "fernandomadoz@hotmail.com";

	$mail->AddAddress($to);

	$mail->Subject  = "Desde Casa via Gmail 01";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
	echo 'Message has been sent. a'.$to;
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>