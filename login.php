<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="login1.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	
	<div class="navbar">
        <img src="Assets/logowomen.png" alt="" class="logo">
            <ul>
                <li><a href="home.html">HOME</a></li>
                <li><a href="login.php">LOGIN</a></li>
				<li><a href="">REVIEW</a></li>
                <li><a href="">ABOUT</a></li>
                <li><a href="contactus.html">CONTACT</a></li>
            
			</ul>
     </div>
	<div class="container">
        
		<div class="img">
			<img src="Assets/loginbg.svg">
		</div>
		<div class="login-content">
			<form action="" method="post">
				<img src="Assets/profile.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" name="userid" required>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name="password" required>
            	   </div>
            	</div>
            	<a href="reg.php">Register?</a>
            	<input type="submit" class="btn" name="submit"  value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="login.js"></script>
</body>
</html>
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "complainreg";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed");
}

if (isset($_POST['submit'])) {
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    $loginSql = "SELECT * FROM `login` WHERE `email`='$userid' AND `password`='$password'";
    $loginResult = mysqli_query($conn, $loginSql);

    if (mysqli_num_rows($loginResult) > 0) {
        $loginValue = mysqli_fetch_assoc($loginResult);

        if ($loginValue['usertype'] == 0) { // User login
            $_SESSION["userauth"] = true;
            $userSql = "SELECT * FROM `users` WHERE `email`='$userid'";
            $userResult = mysqli_query($conn, $userSql);
            $_SESSION['userType'] = 'user';

            if (mysqli_num_rows($userResult) > 0) {
                $userValue = mysqli_fetch_assoc($userResult);
                $_SESSION['userid'] = $userValue['usid'];
                $_SESSION['useremail'] = $userValue['email'];
                $_SESSION['name'] = $userValue['name'];
                $_SESSION['usertype'] = $loginValue['usertype'];

                // Check if user account is inactive
                if ($loginValue['status'] === 'inactive') {
                    echo "<script>alert('Account is inactive. Please Contact Admin for Activation')</script>";
                } else {
                    header('Location: userdashboard.php');
                    exit();
                }
            }
        } else if ($loginValue['usertype'] == 1) { // Officer login
            $_SESSION["staffauth"] = true;
            $officerSql = "SELECT * FROM `officer` WHERE `email`='$userid'";
            $officerResult = mysqli_query($conn, $officerSql);

            if (mysqli_num_rows($officerResult) > 0) {
                $officerValue = mysqli_fetch_assoc($officerResult);
                $_SESSION['officerid'] = $officerValue['officerid'];
                $_SESSION['officeremail'] = $officerValue['email'];
                $_SESSION['userType'] = 'officer';

                // Check if officer account is inactive
                if ($officerValue['status'] === 'inactive') {
                    echo "<script>alert('Account is inactive. Please Contact Admin for Activation'); window.location.href = 'login.php';</script>";
                } else {
                    header('Location: officerdashboard.php');
                    exit();
                }
            }
        } else { // Admin login
            $_SESSION["adminauth"] = true;
            header('Location: admindashboard.php');
            exit();
        }
    } else {
        echo "<script>alert('Invalid User ID or User is not Active');</script>";
    }
}

$conn->close();
?>
