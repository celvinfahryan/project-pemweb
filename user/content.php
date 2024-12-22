<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo '<script>window.location.href = "login.php";</script>';
    exit();
}
$username = $_SESSION['username'];
$isAdmin = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
	<link rel="stylesheet" href="style.css" type="text/css">
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
    <!-- <div class="container"> -->

    <div class="container">
    <main class="main-content">
        <section class="welcome-section">
            <div class="edit-btn">
                <h2>Museum Fatahillah </h2>
                <?php if ($isAdmin) { ?>
                <a href="edit_content.php" class = "edit-button" name = "edit">Edit</a>
                <?php } ?>
            </div>
            <h3>Selamat datang di Museum Fatahillah, Jakarta</h3>
            <br>
            <p>Museum Fatahillah memiliki nama resmi Museum Sejarah Jakarta adalah sebuah museum yang terletak di Jalan Taman Fatahillah Nomor 1, Jakarta Barat, Daerah Khusus Ibukota Jakarta, Indonesia dengan luas lebih dari 1.300 meter persegi.</p>
            <div class="img-container">
                <img src="https://ik.imagekit.io/tvlk/blog/2020/11/wisata-Malang-Museum-Angkut-7.jpg?tr=dpr-2,w-675" alt="Artifact Image">
            
            </div>
            <p>Bangunan ini dahulu merupakan Balai Kota Batavia (bahasa Belanda: Stadhuis van Batavia) yang dibangun pada tahun 1707-1710 atas perintah Gubernur Jenderal Joan van Hoorn. 
                Bangunan ini menyerupai Istana Dam di Amsterdam, terdiri atas bangunan utama dengan dua sayap di bagian timur dan barat serta bangunan sanding yang digunakan sebagai kantor, 
                ruang pengadilan, dan ruang-ruang bawah tanah yang dipakai sebagai penjara. Pada tanggal 30 Maret 1974, bangunan ini kemudian diresmikan oleh bapak Ali Sadikin sebagai Museum Sejarah Jakarta.</p>
        </section>
        <aside class="sidebar">
            <h3>Galeri</h3>
            <div class="img-container">
            <img src="https://ik.imagekit.io/tvlk/blog/2020/11/wisata-Malang-Museum-Angkut-7.jpg?tr=dpr-2,w-675" alt="Artifact Thumbnail">
            </div>
            <div class="tabs">
                <button id="jamBukaBtn" onclick="showContent('jam_buka')">Jam Buka</button>
                <button id="fasilitasBtn" onclick="showContent('fasilitas')">Fasilitas</button>
            </div>
            <div id="content_tab">
                <?php
                if (isset($_GET['content_tab']) && $_GET['content_tab'] == 'fasilitas') {
                    include 'fasilitas.php';
                } else {
                    include 'jam_buka.php';
                }
                ?>
            </div>
        </aside>

    </main>
    </div>
    <script>
        function showContent(content_tab) {
            window.location.href = '?content_tab=' + content_tab;
        }
        // Menyoroti tombol yang aktif
        document.addEventListener('DOMContentLoaded', function() {
            var activeTab = '<?php echo isset($_GET['content_tab']) ? $_GET['content_tab'] : 'jam_buka'; ?>';
            if (activeTab === 'fasilitas') {
                document.getElementById('fasilitasBtn').classList.add('active');
            } else {
                document.getElementById('jamBukaBtn').classList.add('active');
            }
        });
        // document.getElementById('<?php echo isset($_GET['content_tab']) && $_GET['content_tab'] == 'fasilitas' ? "fasilitasBtn" : "jamBukaBtn"; ?>').classList.add('active');
    </script>

    </script>
</body>
</html>
