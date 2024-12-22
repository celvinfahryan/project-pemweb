<?php
session_start();
$db = new mysqli('localhost', 'user1', '', 'pemweb', 3306);

if ($db->connect_error) {
    die('Koneksi ke database gagal: ' . $db->connect_error);
}

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match("/^[a-zA-Z0-9._%+-]+@gmail\.com$/", $email)) {
        $_SESSION['message'] = 'Email harus valid dan menggunakan domain @gmail.com!';
        header('Location: register.php');
        exit();
    }

    $invalid_characters = "/['\\" . '"' . "!?=]/";
    if (preg_match($invalid_characters, $username) || preg_match($invalid_characters, $password)) {
        $_SESSION['message'] = 'Username atau Password tidak boleh mengandung karakter \' " ! ? =';
        header('Location: register.php');
        exit();
    }

    // Pemeriksaan apakah username sudah ada
    $check_query = "SELECT * FROM AKUN WHERE email = '$email' or username = '$username'";
    $result = $db->query($check_query);
    if ($result->num_rows > 0) {
        // Jika username sudah ada, tampilkan pesan kesalahan
        $_SESSION['message'] = 'Email atau Username sudah ada, silakan gunakan yang lain!';
        header('Location: register.php');
        exit();
    }

    $sql = "INSERT INTO AKUN (email, username, password) VALUES ('$email', '$username', '$password')";
    if ($db->query($sql) === TRUE) {
        $_SESSION['success'] = 'Registrasi berhasil!';
        header('Location: login.php');
    } else {
        $_SESSION['message'] = 'Terjadi kesalahan saat registrasi. Silakan coba lagi!';
        header('Location: register.php');
    }
    exit();
}
?>
