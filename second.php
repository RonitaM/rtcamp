<?php
session_start();
$email = "";
$errors = [];

$conn = new mysqli('localhost', 'root', '', 'rtcamp');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SIGN UP USER
if (isset($_POST['submit'])) {
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email required';
    }
    $email = $_POST['email'];
	
    $token = substr((md5(rand(1,100))),0,5); // generate unique token
	//echo $token;

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $errors['email'] = "Email already exists";
    }

    if (count($errors) === 0) {
        $query = "INSERT INTO users(email,token) values('$email','$token');";
        
		if($conn->query($query)===TRUE)
		{
			//echo "New record created successfully";
		} else {
			//echo "Error: " . $sql . "<br>" . $conn->error;
		}
		

            // TO DO: send verification email to user
            // sendVerificationEmail($email, $token);
	
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;
			$_SESSION['token']=$token;
            $_SESSION['message'] = "You are subscribed. Please click on the verification link sent in $email";
            $_SESSION['type'] = 'alert-success';
			echo "<script type='text/javascript'>alert('".$_SESSION['message']."');</script>";
            header('location: third.php');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
			echo "<script type='text/javascript'>alert('".$_SESSION['error_msg']."');window.history.back();</script>";
        }
}
?>