<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

include "config.php";

$blogId = $_POST['blogId'];
$sql = "SELECT title, slug FROM blogs WHERE blog_id = $blogId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $blogTitle = $row['title'];
    $blogSlug = $row['slug'];
}

$subscriberEmails = [];
$sql = "SELECT email FROM subscribers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $subscriberEmails[] = $row['email'];
    }
}

foreach ($subscriberEmails as $email) {
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'im4283986@gmail.com'; 
        $mail->Password = 'gtnfmwfmfbjrfvch'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('im4283986@gmail.com', 'irfan maulana'); 
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'New Blog Published!';
        $encodedSlug = urlencode($blogSlug);

        $mail->Body = '<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f2f2f2;">
    <h2 style="color: #007bff;">Blog baru telah dipublish!!!</h2>
    <p style="font-size: 16px;">' . $blogTitle . '</p><br>
    <p style="font-size: 16px;">Lihat lengkapnya di <a href="https://renewtrend.000webhostapp.com/blog_content.php?' . $encodedSlug . '" style="color: #007bff; text-decoration: none;">Klik di sini</a></p>
</div>';
        

        $mail->send();
    } catch (Exception $e) {
        echo "Email gagal dikirim: {$mail->ErrorInfo}";
    }
}

$conn->close();
?>
