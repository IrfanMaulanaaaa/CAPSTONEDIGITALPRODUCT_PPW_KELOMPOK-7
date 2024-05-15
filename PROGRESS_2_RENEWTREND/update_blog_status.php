<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "renewtrend";

$blogId = $_POST['id'];
$status = $_POST['status'];
$note = isset($_POST['note']) ? $_POST['note'] : ''; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE blogs SET status = '$status', rejection_notes = '$note' WHERE blog_id = $blogId"; 

if ($conn->query($sql) === TRUE) {
    echo "Status blog berhasil diperbarui";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
