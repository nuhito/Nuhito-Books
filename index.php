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
    <title>Data Buku</title>
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
    <div class="d-flex justify-content-between mb-3">
        <h2>Daftar Buku</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBookModal">Tambah Buku</button>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Cover</th>
            <th>Pengarang</th>
            <th>Tahun Terbit</th>
            <th>Golongan</th>
            <th>File PDF</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= htmlspecialchars($row['title']); ?></td>
                    <td><img src="uploads/<?= htmlspecialchars($row['cover']); ?>" alt="Cover" width="50"></td>
                    <td><?= htmlspecialchars($row['author']); ?></td>
                    <td><?= htmlspecialchars($row['year']); ?></td>
                    <td><?= htmlspecialchars($row['category']); ?></td>
                    <td><a href="uploads/<?= htmlspecialchars($row['file']); ?>" class="btn btn-primary btn-sm" target="_blank">Lihat</a></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" class="text-center">Belum ada data buku.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="add.php" method="POST" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBookModalLabel">Tambah Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="cover" class="form-label">Upload Cover</label>
                    <input type="file" class="form-control" id="cover" name="cover" accept=".jpg,.jpeg,.png" required>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Pengarang</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Tahun Terbit</label>
                    <input type="number" class="form-control" id="year" name="year" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Golongan</label><br>
                    <input type="radio" id="su" name="category" value="SU" required>
                    <label for="su">SU</label>
                    <input type="radio" id="13+" name="category" value="13+">
                    <label for="13+">13+</label>
                    <input type="radio" id="18+" name="category" value="18+">
                    <label for="18+">18+</label>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Upload File PDF</label>
                    <input type="file" class="form-control" id="file" name="file" accept=".pdf" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
