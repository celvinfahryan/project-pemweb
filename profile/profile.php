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
    <title>Profile</title>
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
            <h2>Profile <a href="edit_profile.php"><img src="https://cdns.iconmonstr.com/wp-content/releases/preview/2012/240/iconmonstr-pencil-14.png" alt="Edit Profile" class="iconb"></a></h2>
        </div>
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
        <div class="profile-content">
            <div class="profile-picture">
                <img src="44603.jpg" alt="Profile Picture">
            </div>
            <form class="profile-form">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username) ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email) ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" disabled>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
</main>
</body>
</html>
