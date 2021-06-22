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



