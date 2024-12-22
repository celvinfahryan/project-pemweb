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
    <title>About Us</title>
    <link rel="stylesheet" href="style.css">
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
    <div class="container">
        <div class="content">
            <div class="text">
                <h1>About Us</h1>
                <p>Selamat datang di Web Museum, platform terdepan yang memberikan informasi terkini tentang museum-museum terbaik di Indonesia. 
                    Kami berkomitmen untuk memudahkan Anda dalam menemukan dan mengeksplorasi berbagai museum yang kaya akan sejarah, seni, dan budaya.</p>
                <h2>Visi</h2>
                <p>Visi kami adalah menjadi sumber utama informasi yang terpercaya dan komprehensif mengenai museum-museum di Indonesia, 
                    serta mendorong masyarakat untuk lebih mengenal dan mengapresiasi warisan budaya dan sejarah bangsa.</p>
                <h2>Misi</h2>
                <ol>
                    <li>Memudahkan Akses Informasi</li>
                    <li>Meningkatkan Kesadaran Budaya</li>
                    <li>Mendukung Kegiatan Edukatif</li>
                    <li>Menghubungkan Pengunjung dengan Museum</li>
                </ol>
                <p>Kami percaya bahwa museum adalah jendela ke masa lalu yang memberikan wawasan berharga tentang sejarah dan budaya kita. 
                    Dengan Web Museum, kami bertujuan untuk membuat pengalaman kunjungan museum lebih mudah diakses dan lebih bermakna bagi semua orang.
                    
                    Bergabunglah dengan komunitas kami dan mulailah petualangan budaya Anda bersama Web Museum. Mari kita jelajahi dan pelajari bersama!</p>
            </div>
            <div class="img-container">
                <img src="https://i.pinimg.com/564x/af/05/20/af052054fdd702fe03dc263160ca02af.jpg" alt="Image description">
            </div>
        </div>
    </div>
</body>
</html>
