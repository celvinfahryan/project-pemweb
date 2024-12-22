<?php
session_start();
if (isset($_SESSION['username'])) {
    echo '<script>window.location.href = "dashboard.php";</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="body-form">
	<div class="container-login">
	<h2>Login</h2>
	<?php
    if (isset($_SESSION['message'])) {
        echo '<div class="message">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['success'])) {
        echo '<div class="success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    ?>
	<form id="login-form" method ="post" action="process_login.php">

		<br>
		<div class="form-group">
        <label for="username">Email atau Username: </label><br>
        <input type="text" id="username" name="username" required placeholder="Enter Email or Username Here">
		</div>

		<div class="form-group">
        <label for="password">Password: </label><br>
        <input type="password" id="password" name="password" required placeholder="Enter Password Here">
		</div>
		<br>
	  
        <div class= "login-button">
        <button type="submit" name = "login">Login</button>
		</div>

		<div class ="register-link">
		<label for = "register-link">
		<a href = "register.php"><br>Dont Have Account? Register
		</div>

		<div class ="admin-link">
		<label for = "admin-link">
		<a href = "../admin/login_admin.php"><br>Login as admin 
		</div>
		
    </form>
	</div>
    </div>
	<!-- <script src="script.js"></script> -->
	
</body>
</html>
