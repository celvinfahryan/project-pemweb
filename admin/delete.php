<?php
include 'config.php';

session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Periksa apakah ada konfirmasi penghapusan
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        // Lanjutkan dengan penghapusan data
        $sql = "DELETE FROM akun WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        
        // Set pesan sukses dan arahkan kembali ke halaman admin
        $_SESSION['success'] = 'Data berhasil dihapus.';
        header('Location: dashboard_admin.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #3b3f4c;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .container h1 {
            margin-top: 0;
        }
        .container p {
            margin: 20px 0;
        }
        .buttons {
            display: flex;
            justify-content: center;
        }
        .buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .cancel-btn {
            background-color: #e0e0e0;
            color: black;
            margin-right: 10px;
        }
        .delete-btn {
            background-color: #ff5c5c;
            color: white;
        }
        .cancel-btn:hover, .delete-btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete Account</h1>
        <p>Are you sure you want to delete your account?</p>
        <div class="buttons">
            <button class="cancel-btn" onclick="window.location.href='dashboard_admin.php'">Cancel</button>
            <button class="delete-btn" onclick="window.location.href='delete.php?id=<?php echo $id; ?>&confirm=yes'">Delete</button>
        </div>
    </div>
</body>
</html>