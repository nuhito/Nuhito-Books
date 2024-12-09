<?php
$conn = new mysqli("localhost", "root", "", "nuhito_books");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Data buku tidak ditemukan.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $category = $_POST['category'];

    if (!empty($_FILES['cover']['name'])) {
        $cover = $_FILES['cover']['name'];
        $cover_tmp = $_FILES['cover']['tmp_name'];
        move_uploaded_file($cover_tmp, "uploads/" . $cover);

        unlink("uploads/" . $_POST['old_cover']);
    } else {
        $cover = $_POST['old_cover'];
    }

    if (!empty($_FILES['file']['name'])) {
        $file = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        move_uploaded_file($file_tmp, "uploads/" . $file);

        unlink("uploads/" . $_POST['old_file']);
    } else {
        $file = $_POST['old_file'];
    }

    $sql = "UPDATE books SET 
                title = '$title', 
                cover = '$cover', 
                author = '$author', 
                year = '$year', 
                category = '$category', 
                file = '$file' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Buku</h2>
    <form action="edit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $book['id']; ?>">
        <input type="hidden" name="old_cover" value="<?= $book['cover']; ?>">
        <input type="hidden" name="old_file" value="<?= $book['file']; ?>">

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($book['title']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">Upload Cover (Biarkan kosong jika tidak diubah)</label>
            <input type="file" class="form-control" id="cover" name="cover" accept=".jpg,.jpeg,.png">
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Pengarang</label>
            <input type="text" class="form-control" id="author" name="author" value="<?= htmlspecialchars($book['author']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Tahun Terbit</label>
            <input type="number" class="form-control" id="year" name="year" value="<?= $book['year']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Golongan</label><br>
            <input type="radio" id="su" name="category" value="SU" <?= $book['category'] === 'SU' ? 'checked' : ''; ?> required>
            <label for="su">SU</label>
            <input type="radio" id="13+" name="category" value="13+" <?= $book['category'] === '13+' ? 'checked' : ''; ?>>
            <label for="13+">13+</label>
            <input type="radio" id="18+" name="category" value="18+" <?= $book['category'] === '18+' ? 'checked' : ''; ?>>
            <label for="18+">18+</label>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Upload File PDF (Biarkan kosong jika tidak diubah)</label>
            <input type="file" class="form-control" id="file" name="file" accept=".pdf">
        </div>

        <div class="mt-4">
            <a href="index.php" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
