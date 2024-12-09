<?php
$conn = new mysqli("localhost", "root", "", "nuhito_books");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div>
        <nav class="navbar bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="assets/Asset 7.png" alt="Logo" width="100" height="35" class="d-inline-block align-text-top">
                </a>
            </div>
        </nav>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Daftar Buku</h2>
        <div class="row g-4">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="uploads/<?= htmlspecialchars($row['cover']); ?>" class="card-img-top" alt="Cover Buku" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['title']); ?></h5>
                                <p class="card-text">
                                    <strong>Pengarang:</strong> <?= htmlspecialchars($row['author']); ?><br>
                                    <strong>Tahun:</strong> <?= htmlspecialchars($row['year']); ?><br>
                                    <strong>Kategori:</strong> <?= htmlspecialchars($row['category']); ?>
                                </p>
                                <a href="uploads/<?= htmlspecialchars($row['file']); ?>" class="btn btn-dark" target="_blank">Lihat</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada data buku.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

