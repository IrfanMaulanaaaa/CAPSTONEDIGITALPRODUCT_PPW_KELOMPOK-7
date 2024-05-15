<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Blog Content</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .navbar-nav {
        margin-left: auto;
    }

    .container {
        margin-top: 50px;
    }

    img {
        max-width: 100%;
        height: auto;
        margin: 0 auto;
    }

    p {
        text-align: justify;
    }

    @media screen and (min-width: 768px) {
        img {
            max-width: 50%; 
        }
    }

    @media screen and (max-width: 768px) {
        .container {
            margin-top: 50px;
        }

        h1 {
            font-size: 24px;
        }
    }

    @media screen and (max-width: 576px) {
        h1 {
            font-size: 20px;
        }
    }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
    <a class="navbar-brand" href="index.html">RenewTrends</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.html">Beranda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="insight.html">Insights</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="news.php">Berita</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.html">Tentang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.html">Kontak</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container mt-5 pt-5">
<?php
include "config.php";

$decodedSlug = urldecode(key($_GET));

$sql = "SELECT blogs.*, user.nama AS pembuat FROM blogs JOIN user ON blogs.user_id = user.user_id WHERE slug = '$decodedSlug'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<h1>" . $row["title"] . "</h1>";
        echo "<div class='container text-center'>";
        echo "<img src='" . $row["image_path"] . "' alt='Blog Image'>";
        echo "</div><br>";
        echo "<p style='font-size:13px;'>Oleh ".$row["pembuat"].", ".$row["created_at"]."</p>";
        echo "<hr>";
        echo "<p>" . nl2br($row["content"]) . "</p>";
    }
} else {
    echo "Blog not found.";
}

$conn->close();
?>
</div>
<footer class="footer mt-auto py-3 bg-dark"> 
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-white">
                <p>&copy; 2024 RenewTrends. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-right">
                <a href="about.html" class="text-white">Tentang Kami</a> |
                <a href="contact.php" class="text-white">Kontak</a>
            </div>
        </div>
    </div> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</footer>

</body>
</html>
