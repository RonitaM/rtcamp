<?php
session_start();
?>

<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title> Registration </title>
	</head>
	
	<body>
		<form autocomplete="off" method="POST" action="second.php">
			Enter your email address: <input type="email" name="email" required>
			<input type="Submit" value="Subscribe" name="submit">
		</form>
	</body>
</html>


<?php

$conn = new mysqli('remotemysql.com', 'qFyAF6z2HL', 'ZhD8X1loVr', 'qFyAF6z2HL');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql="CREATE TABLE users ( id int(11) NOT NULL AUTO_INCREMENT, email varchar(100) NOT NULL, verified tinyint(1) NOT NULL DEFAULT '0', token varchar(255) DEFAULT NULL, PRIMARY KEY (id) )";

if ($conn->query($sql) === TRUE) {
  echo "Table created successfully";
} else {
  //echo "Error creating table: " . $conn->error;
}
$conn->close();
?>


