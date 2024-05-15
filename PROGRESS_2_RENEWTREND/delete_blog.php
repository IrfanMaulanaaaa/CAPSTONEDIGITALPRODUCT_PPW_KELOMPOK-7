<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: index.html"); 
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: index.html");
    exit();
}

if (!isset($_POST['id'])) {
    echo "ID blog tidak tersedia.";
    exit();
}

$blogId = $_POST['id'];

include "config.php";

$sql_delete = "DELETE FROM blogs WHERE blog_id = $blogId";

if ($conn->query($sql_delete) === TRUE) {
    echo "Blog telah berhasil dihapus.";
} else {
    echo "Error: " . $sql_delete . "<br>" . $conn->error;
}

$conn->close();
?>
