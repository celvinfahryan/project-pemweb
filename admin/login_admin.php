<?php
session_start();
if (isset($_SESSION['username'])) {
    echo '<script>window.location.href = "dashboard_admin.php";</script>';
    exit();
}
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="style_admin.css">

</head>
<body>
    <div class="body-form">
	<div class="container-login">
	<h2>Login As Admin</h2>

	<?php
    if (isset($_SESSION['message'])) {
        echo '<div class="message_admin">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    } elseif (isset($_SESSION['success'])) {
        echo '<div class="success_admin">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    ?>
	
	<form id="login-form" method ="post" action="process_login.php">

		<br>
		<div class="form-group">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username" required placeholder="Enter Username Here">
		</div>

		<div class="form-group">
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" required placeholder="Enter Password Here">
		</div>
		<br>
	  
        <div class= "login-button">
        <button type="submit" name = "login">Login</button>
		</div>

        <br>
		<div class ="link">
		<label for = "admin-link">
		<a href = "../user/login.php">Login as User</a>
		</div>
		
    </form>
	</div>
    </div>
	<!-- <script src="script.js"></script> -->
	
</body>
</html>