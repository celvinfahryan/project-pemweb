<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

include 'config.php';

$username = $_SESSION['username'];

$sql = "SELECT email, password FROM AKUN WHERE username=?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
// $stmt->bind_result($password);
$stmt->bind_result($email, $password);
$stmt->fetch();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../user/style.css">
</head>
<body>
<header>
    <div class="top-navbar-container">
        <nav class="topnav">
            <a href="../user/dashboard.php" class="logo-dashboard">
                <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Arimo&display=swap" rel="stylesheet">
                Web Museum
            </a>
            <div class="nav-menu">
                <ul>
                    <li><a href="../user/about.php">About Us</a></li>
                    <li><a href="../user/logout.php"><img src="https://www.svgrepo.com/show/506720/logout.svg" class="iconb"> Logout</a></li>
                    <li><a href="profile.php"><img src="https://www.svgrepo.com/show/23012/profile-user.svg" class="iconb"> Profile</a></li>
                    <li>Selamat datang, <?php echo htmlspecialchars($username) ?></li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<br>
<main class="profile-main">
    <div class="profile-container">
        <div class="profile-header">
            <h2>Edit Profile</h2>
        </div>
        <div class="profile-content">
            <div class="profile-picture">
                <img src="44603.jpg" alt="Profile Picture">
                <br>
                <h5><a href="#">Pilih Foto</a></h5>
            </div>
            <form class="profile-form" action="update_profile.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="save-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</main>
</body>
</html>
