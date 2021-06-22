<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
session_start();


//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname="rtcamp";
$conn = new mysqli('remotemysql.com', 'qFyAF6z2HL', 'ZhD8X1loVr', 'qFyAF6z2HL');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 1;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "rtcamp.test99@gmail.com";
$mail->Password   = "Test@1999";
$mail->IsHTML(true);
$email=$_SESSION['email'];
$token=$_SESSION['token'];
//$reciever=$_SESSION['reciever'];
$subject="Verification Link";
$message="<p>Thank you for subscribing up on our site. Please click on the link below to verify your account:.</p>
        <a href="https://rtcamp14.herokuapp.com/verify.php?$token'> Verify Email!";
$mail->AddAddress("$email");
$mail->SetFrom("rtcamp.test123@gmail.com", "Testing");
$mail->AddReplyTo("rtcamp.test123@gmail.com", "Testing");
//$mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
$mail->Subject = $subject;
$content = $message;

$mail->MsgHTML($content); 
if(!$mail->Send()) {
  echo "Error while sending Email.";
  var_dump($mail);
} else {
echo "<script>alert('Email Sent Successfully to $email. Please click on the link for verification. ');window.history.go(-1);</script>";
	

}

?>
