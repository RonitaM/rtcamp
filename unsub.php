<?php

//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname="rtcamp";
//$conn = new mysqli('remotemysql.com', 'qFyAF6z2HL', 'ZhD8X1loVr', 'qFyAF6z2HL');

$conn = new mysqli('sql6.freemysqlhosting.net', 'sql6425202', 'eq8bBwgTvD', 'sql6425202');

//$conn = new mysqli('localhost', 'root', '', 'rtcamp');

$email=$_SERVER['QUERY_STRING'];
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql="delete from users where email='$email'";
//echo $sql;
if($conn->query($sql)===TRUE)
{
	echo "Unsubscribed Successfully.";
	echo "<a href='https://rtcamp99.herokuapp.com/'>Click here to go back</a>";
}
else
	echo "Error";


?>

