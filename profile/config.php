<?php
$servername = "localhost";
$db_username = "user1";
$db_password = "";
$dbname = "pemweb";

// Membuat koneksi
$conn = new mysqli($servername, $db_username, $db_password, $dbname, 3306);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
