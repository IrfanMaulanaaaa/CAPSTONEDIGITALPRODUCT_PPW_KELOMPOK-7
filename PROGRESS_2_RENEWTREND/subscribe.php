<?php
include "config.php";

$email = $_POST['email'];
$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql_check = "SELECT * FROM subscribers WHERE email='$email'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    echo "Alamat email sudah terdaftar.";
    echo "<script>setTimeout(function(){window.location.href='index.html';}, 2000);</script>";
} else {
    $sql_insert = "INSERT INTO subscribers (email, password) VALUES ('$email', '$hashed_password')";
    if ($conn->query($sql_insert) === TRUE) {
        echo "Berlangganan berhasil!";
        echo "<script>setTimeout(function(){window.location.href='index.html';}, 2000);</script>";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

$conn->close();
?>
