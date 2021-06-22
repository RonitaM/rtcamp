<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname="rtcamp";
$conn = mysqli_connect($servername, $username, $password, $dbname);

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

