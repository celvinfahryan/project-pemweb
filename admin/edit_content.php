<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    echo '<script>window.location.href = "login.php";</script>';
    exit();
}
$username = $_SESSION['username'];

if (!isset($_GET['id'])) {
    echo '<script>alert("ID konten tidak ditemukan!"); window.location.href = "../user/dashboard.php";</script>';
    exit();
}
$content_id = intval($_GET['id']);

// Connect to the database
include 'config.php';

try {
    // Fetch content from database based on ID
    $stmt = $pdo->prepare('SELECT * FROM museums WHERE id = :id');
    $stmt->execute(['id' => $content_id]);
    $content = $stmt->fetch();

    if (!$content) {
        echo '<script>alert("Konten tidak ditemukan!"); window.location.href = "../user/dashboard.php";</script>';
        exit();
    }

    // Handle form submission to update content
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image_url = $_POST['image_url'];

        $updateStmt = $pdo->prepare('UPDATE museums SET title = :title, description = :description, image_url = :image_url WHERE id = :id');
        $updateStmt->execute([
            'title' => $title,
            'description' => $description,
            'image_url' => $image_url,
            'id' => $content_id
        ]);

        echo '<script>alert("Konten berhasil diperbarui!"); window.location.href = "dashboard.php";</script>';
        exit();
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Konten</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Edit Konten</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="title">Judul:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($content['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi:</label>
                <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($content['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="image_url">URL Gambar:</label>
                <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo htmlspecialchars($content['image_url']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="dashboard.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
