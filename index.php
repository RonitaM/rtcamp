<?php
session_start();
//include 'PHPbackgroundProcesser.php';
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
$conn = new mysqli('sql6.freemysqlhosting.net', 'sql6425202', 'eq8bBwgTvD', 'sql6425202');
//$conn = new mysqli('remotemysql.com', 'qFyAF6z2HL', 'ZhD8X1loVr', 'qFyAF6z2HL');
//$conn = new mysqli('localhost', 'root', '', 'rtcamp');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql="select email from users where verified=1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	exec("php mail.php");

}
?>

<script>
setTimeout(function () { window.location.reload(); }, 5*1000*60);
// just show current time stamp to see time of last refresh.
//document.write(new Date());
</script>	
