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
$mail->Username   = "rtcamp.test123@gmail.com";
$mail->Password   = "Test@1999";
$mail->IsHTML(true);

$sql="select email from users where verified=1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
		$email=$row["email"];
  

$subject="A funny Comic.";

$message="Click here to have a funny day ahead: <a href='https://c.xkcd.com/random/comic/'> Click Me </a>

<p><br><br>
For the attachment, you can run the attached html script- funny.html in browser. 

<br><br><br> Click here to <a href='https://rtcamp99.herokuapp.com/unsub.php?$email'> Unsubscribe </a>";

$url = 'https://c.xkcd.com/random/comic/';
$binary_content = file_get_contents($url);

// You should perform a check to see if the content
// was actually fetched. Use the === (strict) operator to
// check $binary_content for false.
if ($binary_content === false) {
   throw new Exception("Could not fetch remote content from: '$url'");
}

// $mail must have been created
$mail->AddStringAttachment($binary_content, "Funny.pdf", $encoding = 'base64', $type = 'application/pdf');
$url='https://c.xkcd.com/random/comic/';
$mail->addStringAttachment(file_get_contents($url), 'Funny.html');

$mail->AddAddress("$email");
$mail->SetFrom("rtcamp.test99@gmail.com", "Testing");
$mail->AddReplyTo("rtcamp.test99@gmail.com", "Testing");
//$mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");

$mail->Subject = $subject;

$content = $message;

$mail->AddAttachment( 'https://c.xkcd.com/random/comic/' , 'NameOfFile.pdf' );

$mail->MsgHTML($content); 

if(!$mail->Send()) {
  echo "Error while sending Email.";
  var_dump($mail);
} else {
echo "<script>alert('Email Sent Successfully to $email. ')</script>";
}	

}
}
?>

<script>
setTimeout(function () { window.location.reload(); }, 5*60*1000);
// just show current time stamp to see time of last refresh.
document.write(new Date());
</script>	
