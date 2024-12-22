<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header('Location: login_admin.php');
    exit();
}
$username = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style_admin.css">
</head>
<body>
    <div class="body-admin container mt-5">
        <h2>Admin Dashboard</h2>
        <h4>Selamat datang, <?php echo $username ?></h4>
        <br>
        <div class="container-link mb-3">
            <div class="link mb-2">
                <a href="create.php" class="btn btn-primary">Tambah Akun</a>
            </div>
            <div class="link mb-2">
                <a href="logout_admin.php" class="btn btn-danger">Keluar</a>
            </div>
            <div class="link mb-2">
                <a href="../user/dashboard.php" class="btn btn-info">Kelola Data</a>
            </div>
            <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="alert alert-warning">' . $_SESSION['message'] . '</div>';
                unset($_SESSION['message']);
            }
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            ?>
        </div>
        <div class="table_data">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $stmt = $pdo->query('SELECT * FROM akun');
                while ($row = $stmt->fetch()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>
                            <div class='container-link'>
                                <div class='link-table'>
                                    <a href='update.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a>
                                </div>
                            </div>
                          </td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>