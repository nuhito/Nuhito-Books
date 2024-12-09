<?php
$conn = new mysqli("localhost", "root", "", "nuhito_books");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $category = $_POST['category'];

    $cover = $_FILES['cover']['name'];
    $cover_tmp = $_FILES['cover']['tmp_name'];
    move_uploaded_file($cover_tmp, "uploads/" . $cover);

    $file = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    move_uploaded_file($file_tmp, "uploads/" . $file);

    $sql = "INSERT INTO books (title, cover, author, year, category, file) 
            VALUES ('$title', '$cover', '$author', '$year', '$category', '$file')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
