<?php
$host = 'localhost';
$db   = 'pemweb';
$user = 'user1'; // sesuaikan dengan user database Anda
$pass = '';     // sesuaikan dengan password database Anda

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
