<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'rtcamp');
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
           header('location: mail.php');
            //exit(0);
        }
    } else {
        echo "User not found!";
    }
} else {
    echo "No token provided!";
}