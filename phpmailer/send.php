<?php
$mail_header = '';
$mail_footer = '';
require 'src/PHPMailerAutoload.php';

if($_SERVER['REQUEST_METHOD']=='POST')$_GET=$_POST;
$mail = new PHPMailer;


$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.t3awno.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'mail@t3awno.com';                 // SMTP username
$mail->Password = 'p@ssw0rd';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                    // TCP port to connect to
$mail->CharSet = 'UTF-8';
$mail->From = 'mail@t3awno.com';
$mail->FromName = 'علامات';
$mails = explode(',',$_GET['mails']);

if(isset($mails) && count($mails)>0)
{
	foreach($mails as $email)
	{
		$mail->addAddress($email);
	}
}

$mail->WordWrap = 50;
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = urldecode($_GET['title']);
$mail->Body    = $mail_header.'<br/><p align="center" style="font-size:20px;font-wieght:bold">'.urldecode($_GET['text']).'</p><br/>'.$mail_footer;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}