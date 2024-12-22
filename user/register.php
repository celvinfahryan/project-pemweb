<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <script>
    function validateForm() {
        var username = document.forms["loginForm"]["username"].value;
        if (username == "") {
            alert("Username harus diisi");
            return false;
        }
    }
    </script>
</head>
<body>
    <div class="body-form">
    <div class="container-register">
    <h2>Register</h2>
    <?php
    session_start();
    if (isset($_SESSION['message'])) {
        echo '<div class="message">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    } elseif (isset($_SESSION['success'])) {
        echo '<div class="success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    ?>
    <br>
    <form method="post" action="process_register.php">
        
        <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required placeholder="Enter Email Here" pattern="[a-zA-Z0-9._%+-]+@gmail\.com" >
        </div>  

        <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required placeholder="Enter Username Here">
        </div>

        <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required placeholder="Enter Password Here">
        </div>
        <br>
        
        <div class= "register-button">
        <button type="submit" name = "register">Register</button>
        <div class ="login-link">
		<label for = "login-link">
		<a href = "login.php"><br>Already have an Account? Login
		</div>
    </form>
    </div>
</body>
</html>