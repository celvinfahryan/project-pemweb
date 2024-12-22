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
        header('Location: login_admin.php');
        exit();
    }


    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $username = $result->fetch_assoc();
        if ($password == $username['password']) {
            $_SESSION['username'] = $username['username'];
            $_SESSION['isAdmin'] = true;
            header('Location: dashboard_admin.php');
            exit();
        } else {
            $_SESSION['message'] = 'Username atau password salah!';
            header('Location: login_admin.php');
            exit();
            
        }
    } else {
        $_SESSION['message'] = 'Akun tidak ditemukan!';
        header('Location: login_admin.php');
        exit();
        
    }
}
?>
