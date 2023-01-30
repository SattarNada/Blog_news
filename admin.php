<?php
// gettin password crypte echo password_hash('admin',PASSWORD_BCRYPT);
 session_start();
//Database Configuration File
include('includes/config.php');
if(isset($_SESSION['login']))
{ 
    //header('location:dashboard.php');
}
//error_reporting(0);
if(isset($_POST['login']))
  {
 
    // Getting username/ email and password
    $uname=$_POST['username'];
    $password=$_POST['pass'];
    // Fetch data from database on the basis of username/email and password
$sql =mysqli_query($con,"SELECT UserName,Password FROM admin WHERE (UserName='$uname' )");
 $num=mysqli_fetch_array($sql);
if($num>0)
{
$hashpassword=$num['Password']; // Hashed password fething from database
//verifying Password
if (password_verify($password, $hashpassword)) {
$_SESSION['login']=$_POST['username'];
    echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
  } else {
echo "<script>alert('Wrong Password');</script>";
 
  }
}
//if username or email not found in database
else{
echo "<script>alert('User not registered with us');</script>";
  }
 
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="links/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="links/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="links/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="links/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="links/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="links/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!-- Favicons -->
	<link href="assets/img/intro-carousel/333.png" rel="icon">

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('assets/img/intro-carousel/i1.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					 Login
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5"method="post" >

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn" name="login">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	<!-- END HOME -->

	<script>
            var resizefunc = [];
        </script>
	
<!--===============================================================================================-->
	<script src="links/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="links/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="links/bootstrap/js/popper.js"></script>
	<script src="links/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="links/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="links/daterangepicker/moment.min.js"></script>
	<script src="links/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="links/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>