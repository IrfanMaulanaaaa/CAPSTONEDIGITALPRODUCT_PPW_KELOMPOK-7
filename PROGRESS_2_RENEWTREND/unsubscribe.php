<?php
include "config.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql_check = "SELECT * FROM subscribers WHERE email='$email'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    $row = $result_check->fetch_assoc();
    $hashed_password = $row['password']; 

    if (password_verify($password, $hashed_password)) {
        $sql_delete = "DELETE FROM subscribers WHERE email='$email'";
        if ($conn->query($sql_delete) === TRUE) {
            echo "Berhenti berlangganan berhasil!";
            echo "<script>setTimeout(function(){window.location.href='index.html';}, 2000);</script>";
            exit(); 
        } else {
            echo "Error: " . $sql_delete . "<br>" . $conn->error;
        }
    } else {
        echo "Password salah. Silakan coba lagi.";
        echo "<script>setTimeout(function(){window.location.href='index.html';}, 2000);</script>";
    }
} else {
    echo "Alamat email tidak ditemukan.";
    echo "<script>setTimeout(function(){window.location.href='index.html';}, 2000);</script>";
}

$conn->close();
?>
