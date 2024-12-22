<?php
include 'config.php';

session_start();

$akun = null; // Inisialisasi variabel $akun

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('SELECT * FROM akun WHERE id = ?');
    $stmt->execute([$id]);
    $akun = $stmt->fetch();
    
    if (!$akun) {
        $_SESSION['message'] = 'Akun tidak ditemukan!';
        header('Location: dashboard_admin.php');
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match("/^[a-zA-Z0-9._%+-]+@gmail\.com$/", $email)) {
        $_SESSION['message'] = 'Email harus valid dan menggunakan domain @gmail.com!';
        header('Location: update.php?id=' . $id);
        exit();
    }

    $invalid_characters = "/['\"!?=]/";
    if (preg_match($invalid_characters, $username)) {
        $_SESSION['message'] = 'Username tidak boleh mengandung karakter \' " ! ? =';
        header('Location: update.php?id=' . $id);
        exit();
    }

    // Periksa apakah email atau username sudah ada, kecuali untuk akun yang sedang di-update
    $check_stmt = $pdo->prepare("SELECT * FROM akun WHERE (email = ? OR username = ?) AND id != ?");
    $check_stmt->execute([$email, $username, $id]);
    if ($check_stmt->rowCount() > 0) {
        $_SESSION['message'] = 'Email atau Username sudah digunakan!';
        header('Location: update.php?id=' . $id);
        exit();
    }

    // Cek apakah password kosong atau tidak
    if (!empty($_POST['password'])) {
        $password = $_POST['password']; // Hashing password seharusnya ditambahkan di sini
        if (preg_match($invalid_characters, $password)) {
            $_SESSION['message'] = 'Password tidak boleh mengandung karakter \' " ! ? =';
            header('Location: update.php?id=' . $id);
            exit();
        }
        $sql = "UPDATE akun SET email = ?, username = ?, password = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $username, $password, $id]);
    } else {
        // Jika password kosong, hanya update email dan username
        $sql = "UPDATE akun SET email = ?, username = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $username, $id]);
    }

    $_SESSION['success'] = 'Akun berhasil diupdate!';
    header('Location: dashboard_admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun</title>
    <link rel="stylesheet" href="style_admin.css">
</head>
<body>
    <div class="body-form">
        <div class="container-login">
            <h2>Edit Akun</h2>
            <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="message_admin">' . $_SESSION['message'] . '</div>';
                unset($_SESSION['message']);
            }
            if (isset($_SESSION['success'])) {
                echo '<div class="success_admin">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            ?>
            <br>

            <form action="update.php" method="post">
                <div class="form-group">
                    <?php if ($akun): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($akun['id']) ?>">
                    
                    <label>Email:</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($akun['email']) ?>" required><br>
                    
                    <label>Username:</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($akun['username']) ?>" required><br>

                    <label>Password (kosongkan jika tidak ingin mengganti)</label>
                    <input type="password" name="password"><br>
                    <?php else: ?>
                    <p>Akun tidak ditemukan atau terjadi kesalahan.</p>
                    <?php endif; ?>
                </div>

                <input type="submit" value="Update"><br><br>

                <div class="link">
                    <a href="dashboard_admin.php">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
