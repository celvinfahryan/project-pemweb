<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email']; // Pastikan ada input email di form

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match("/^[a-zA-Z0-9._%+-]+@gmail\.com$/", $email)) {
        $_SESSION['message'] = 'Email harus valid dan menggunakan domain @gmail.com!';
        header('Location: create.php');
        exit();
    }

    $invalid_characters = "/['\"!?=]/";
    if (preg_match($invalid_characters, $username) || preg_match($invalid_characters, $password)) {
        $_SESSION['message'] = 'Username atau Password tidak boleh mengandung karakter \' " ! ? =';
        header('Location: create.php');
        exit();
    }

    // Periksa apakah username atau email sudah ada
    $check_stmt = $pdo->prepare("SELECT * FROM akun WHERE username = ? OR email = ?");
    $check_stmt->execute([$username, $email]);
    if ($check_stmt->rowCount() > 0) {
        $_SESSION['message'] = 'Username atau email sudah digunakan!';
        header('Location: create.php');
        exit();
    }
    
    // Masukkan data baru ke dalam database
    $sql = "INSERT INTO akun (username, password, email) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $password, $email]);

    $_SESSION['success'] = 'Data berhasil ditambahkan.';
    header('Location: dashboard_admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun</title>
    <link rel="stylesheet" href="style_admin.css">
</head>
<body>
    <div class="body-form">
        <div class="container-login">
            <h2>Tambah Akun</h2>
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
            <div class="form-group">
                <form action="create.php" method="post">
                    <label>Email:</label>
                    <input type="email" name="email" required><br>

                    <label>Username:</label>
                    <input type="text" name="username" required><br>

                    <label>Password:</label>
                    <input type="password" name="password" required><br>
                    
                    <input type="submit" value="Tambah">
                    <br><br>
                </form>
                <div class="link">
                    <a href="dashboard_admin.php">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>