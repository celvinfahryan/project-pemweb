<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

include 'config.php';

$username = $_SESSION['username'];
$new_username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validasi karakter terlarang pada username dan password
$invalid_characters = "/['\"!?=]/";
if (preg_match($invalid_characters, $new_username) || preg_match($invalid_characters, $password)) {
    $_SESSION['message'] = 'Username dan Password tidak boleh mengandung karakter \' " ! ? =';
    header('Location: profile.php');
    exit();
}

// Periksa apakah username atau email yang baru sudah ada
$check_query = "SELECT * FROM AKUN WHERE (username = ? OR email = ?) AND username != ?";
$stmt = $conn->prepare($check_query);
$stmt->bind_param("sss", $new_username, $email, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['message'] = 'Username atau Email sudah ada, silakan gunakan yang lain!';
    header('Location: profile.php');
    exit();
}

// Lakukan pembaruan data
$update_query = "UPDATE AKUN SET username = ?, email = ?, password = ? WHERE username = ?";
$stmt = $conn->prepare($update_query);

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("ssss", $new_username, $email, $password, $username);
$stmt->execute();


$_SESSION['username'] = $new_username;
$_SESSION['success'] = "Profile updated successfully!";
header("Location: profile.php");

$stmt->close();
$conn->close();
?>
