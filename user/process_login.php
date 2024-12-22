<?php
session_start();
$db = new mysqli('localhost', 'user1', '', 'pemweb', 3306);

if ($db->connect_error) {
    die('Koneksi ke database gagal: ' . $db->connect_error);
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $invalid_characters = "/['\"!?=]/";
    if (preg_match($invalid_characters, $username) || preg_match($invalid_characters, $password)) {
        $_SESSION['message'] = 'Username atau Password tidak boleh mengandung karakter \' " ! ? =';
        header('Location: login.php');
        exit();
    }

    $sql = "SELECT * FROM AKUN WHERE email='$username' OR username='$username'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $username = $result->fetch_assoc();
        if ($password == $username['password']) {
            $_SESSION['username'] = $username['username'];
            header('Location: dashboard.php');
            exit();

        } else {
            $_SESSION['message'] = 'Username atau password salah!';
            header('Location: login.php');
            exit();

        }
    } else {
        $_SESSION['message'] = 'Akun tidak ditemukan!';
        header('Location: login.php');
        exit();
    }
}
?>
