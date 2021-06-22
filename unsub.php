<?php

//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname="rtcamp";
$conn = new mysqli('remotemysql.com', 'qFyAF6z2HL', 'ZhD8X1loVr', 'qFyAF6z2HL');

$email=$_SERVER['QUERY_STRING'];
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql="delete from users where email=$email";
if($conn->query($sql)===TRUE)
	echo "Unsubscribed Successfully.";
else
	echo "Error";


?>

