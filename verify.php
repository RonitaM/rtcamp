<?php
session_start();

$conn = new mysqli('remotemysql.com', 'qFyAF6z2HL', 'ZhD8X1loVr', 'qFyAF6z2HL');
//$conn = new mysqli('localhost', 'root', '', 'rtcamp');
$token=$_SERVER['QUERY_STRING'];
if (isset($token)) {
    //$token = $_GET['token'];
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $query = "UPDATE users SET verified=1 WHERE token='$token'";

        if (mysqli_query($conn, $query)) {
           // $_SESSION['id'] = $user['id'];
            //$_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = true;
            echo "<script>alert('Your email address has been verified successfully')</script>";
			echo "<a href='https://rtcamp99.herokuapp.com/'>Click here to go to Index Page</a>";
           //header('location: mail.php');
            //exit(0);
        }
    } else {
        echo "User not found!";
    }
} else {
    echo "No token provided!";
}