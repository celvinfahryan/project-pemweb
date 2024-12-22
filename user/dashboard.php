<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
$username = $_SESSION['username'];
$isAdmin = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']; // Pastikan pemeriksaan isAdmin benar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
    <div class="top-navbar-container">
    <nav class="topnav">
        <a href="dashboard.php" class="logo-dashboard">
        <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Arimo&display=swap" rel="stylesheet">
        Web Museum
        </a>
    <div class="nav-menu">
      <ul>
        <?php if ($isAdmin) { ?>
            <li> <a href="../admin/dashboard_admin.php">Kembali ke Menu</a></li>
        <?php } ?>
        <li><a href="about.php">About Us</a></li>
        <?php if (!$isAdmin) { ?>
            <li><a href="logout.php"><img src="https://www.svgrepo.com/show/506720/logout.svg" class="iconb"> Logout</a></li>
            <li><a href="../profile/profile.php"><img src="https://www.svgrepo.com/show/23012/profile-user.svg" class="iconb"> Profile</a></li>
        <?php  } ?>
        <li>Selamat datang, <?php echo htmlspecialchars($username) ?></li>
      </ul>
    </div>
    </nav>
    </div>
</header>
    <br>
    <div class="top-text">
    <h2>Daftar Museum</h2>
    </div>

    <div class="card-container">
    <div class="card">
        <a href="content.php?id=1">
        <img src="https://tse4.mm.bing.net/th?id=OIP.R9Rl_uO71elLpHSq5M60SwHaEx&pid=Api&P=0&h=220" alt="" width="600">
        <div class="card-body">
            <span class="tag tag-blue">Museum Fatahillah</span>
            <h4>Museum Sejarah</h4>
            <p>Salah satu museum bersejarah di Indonesia</p>
        </div>
        </a>
        <?php if ($isAdmin) { ?>
            <a href="../admin/edit_content.php" class="btn btn-primary">Edit</a>
        <?php } ?>
    </div>
    </div>
</body>
</html>
