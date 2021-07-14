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
//$conn = new mysqli('remotemysql.com', 'qFyAF6z2HL', 'ZhD8X1loVr', 'qFyAF6z2HL');

$conn = new mysqli('sql6.freemysqlhosting.net', 'sql6425202', 'eq8bBwgTvD', 'sql6425202');

//$conn = new mysqli('localhost', 'root', '', 'rtcamp');

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
$mail->Username   = "hope.this.works1499@gmail.com";
$mail->Password   = "Test@1999";
$mail->IsHTML(true);

$sql="select email from users where verified=1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
		$email=$row["email"];
		
		
$ran=rand(1,500);

$url = "http://xkcd.com/$ran/info.0.json";

//call api
$json = file_get_contents($url);
$json = json_decode($json);
//print_r($json);
$img=$json->img;
echo $email;


$subject="A funny Comic.";

$message="

Click me to have a funny day ahead- generate a random comic: <a href='https://c.xkcd.com/random/comic/'> Click Me </a>

<p><br><br>
 <img src='$img'>


<br><br><br> Click here to <a href='https://rtcamp99.herokuapp.com/unsub.php?$email'> Unsubscribe </a>";


//$message=$mess1+$mess2;

$url = 'https://c.xkcd.com/random/comic/';
$binary_content = file_get_contents($url);

// You should perform a check to see if the content
// was actually fetched. Use the === (strict) operator to
// check $binary_content for false.
if ($binary_content === false) {
   throw new Exception("Could not fetch remote content from: '$url'");
}

// $mail must have been created
//$mail->AddStringAttachment($binary_content, "Funny.pdf", $encoding = 'base64', $type = 'application/pdf');

//$mail->addStringAttachment(file_get_contents($url), 'Funny.html');

$mail->AddAddress("$email");
$mail->SetFrom("hope.this.works1499@gmail.com", "Testing");
$mail->AddReplyTo("hope.this.works1499@gmail.com", "Testing");
//$mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");

$mail->Subject = $subject;

$content = $message;

//$mail->AddAttachment( "$img" , 'NameOfFile.png' );
$mail->addStringAttachment(file_get_contents($img), 'funny.png');
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
