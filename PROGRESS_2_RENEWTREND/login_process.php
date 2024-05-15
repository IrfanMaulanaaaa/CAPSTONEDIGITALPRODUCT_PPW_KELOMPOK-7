<?php
session_start();

$error_message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "config.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['user_id'] = $row['user_id'];
        if ($_SESSION['role'] == 'admin') {
            header("Location: admin.php");
            exit();
        } elseif ($_SESSION['role'] == 'blogger') {
            header("Location: blogger-dashboard.php");
            exit(); 
        } else {
            $error_message = "Unknown role!";
        }
    } else {
        $error_message = "Invalid username or password!";
    }

    $conn->close();
}

header("Location: login_form.php?error_message=" . urlencode($error_message));
exit();
?>
