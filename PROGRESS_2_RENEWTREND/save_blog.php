<?php
ob_start(); 
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); 
    exit();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

$user_id = $_SESSION['user_id'];

$title = mysqli_real_escape_string($conn, $_POST['title']);
$content = mysqli_real_escape_string($conn, $_POST['content']);

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    exit;
}
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    exit;
}

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
    exit;
}

$image_path = $target_file;

$created_at = date('Y-m-d H:i:s');

$user_id = $_POST['user_id'];

$title = $_POST['title'];
$slug = generateSlug($conn, $title);

$query = "INSERT INTO blogs (title, content, image_path, user_id, created_at, slug) 
          VALUES ('$title', '$content', '$image_path', '$user_id', '$created_at', '$slug')";

if (mysqli_query($conn, $query)) {
    echo "Blog has been created successfully.";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
header("Location: blogger-dashboard.php");
exit();
ob_end_flush(); 

function generateSlug($conn, $title) {
    $slug = strtolower(str_replace(' ', '-', $title));

    $sql = "SELECT slug FROM blogs WHERE slug = '$slug'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $counter = 1;
        while ($result->num_rows > 0) {
            $newSlug = $slug . '-' . $counter;
            $sql = "SELECT slug FROM blogs WHERE slug = '$newSlug'";
            $result = $conn->query($sql);
            $counter++;
        }
        $slug = $newSlug;
    }

    return $slug;
}
?>
