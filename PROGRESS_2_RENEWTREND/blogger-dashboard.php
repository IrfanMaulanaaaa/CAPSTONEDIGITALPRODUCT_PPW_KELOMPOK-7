<?php
session_start();
include "check_session_expiry.php";
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: index.html");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

if ($role == 'blogger') {
    echo "Welcome, $username! You are a blogger.";
} else {
    header("Location: index.html");
}

$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>RenewTrends | Dashboard</title>
    <link rel="icon" type="image/png" href="assets/img/leaf.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
        }
        .panel {
            padding: 20px;
            margin-right: 20px;
            border: 1px solid #ccc;
            max-width: 300px;
        }
        .blog-item {
            cursor: pointer;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
        }
        .blog-item:hover {
            background-color: #eaeaea;
        }
        .blog-item img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .blog-item span {
            flex: 1;
        }
        .blog-content {
            padding: 60px;
            border: 1px solid #ccc;
            background-color: #fff;
            max-width: 600px;
            width: 100%;
        }
        .blog-content-container {
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            max-width: 600px;
            width: 100%;
            overflow: auto;
        }
        .blog-content-container p {
            word-wrap: break-word;
        }
        .rejection-note-container {
            margin-top: 20px;
            padding: 10px;
            background-color: #fdd;
            border: 1px solid #f00;
        }
        .float-button {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #007bff;
            color: #fff;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            text-align: center;
            font-size: 24px;
            line-height: 50px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            text-decoration: none;
        }
        .float-button:hover {
            background-color: #0056b3;
        }
        .logout-button {
            position: fixed;
            bottom: 20px;
            left: 90px;
            background-color: #dc3545;
            color: #fff;
            width: 90px;
            height: 50px;
            border-radius:50px;
            text-align: center;
            font-size: 18px;
            line-height: 50px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            text-decoration: none;
            margin-left: 10px;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
        @media screen and (max-width: 768px) {
            .float-button {
                font-size: 20px;
                width: 40px;
                height: 40px;
                line-height: 40px;
                display: block;
            }
            .container {
                flex-direction: column;
            }
            .panel {
                margin-right: 0;
                margin-bottom: 20px;
                max-width: 100%;
            }
            .blog-content {
                padding: 20px;
                max-width: calc(100vw - 40px);
                margin-left: auto;
                margin-right: auto;
            }
            .blog-content img {
                max-width: 100%;
                height: auto;
            }
            .blog-content-container {
                padding: 10px;
                margin: 5px;
                max-width: calc(100vw - 70px);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="panel">
            <h2>Pending Blogs</h2>
            <div class="blog-list">
                <?php
                include "config.php";
                $sql = "SELECT b.blog_id, b.title, b.content, b.image_path, b.created_at, b.user_id, b.status, b.rejection_notes, u.nama AS creator_name FROM blogs b INNER JOIN user u ON b.user_id = u.user_id WHERE b.status = 'pending'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="blog-item" data-blog-id="' . $row["blog_id"] . '">';
                        echo '<img src="' . $row["image_path"] . '" alt="Blogger Image">';
                        echo '<span>' . $row["creator_name"] . '</span>';
                        echo '<span>' . $row["title"] . ' - ' . $row["created_at"] . '</span>';
                        echo '</div>';
                    }
                } else {
                    echo "Tidak ada blog yang masih dalam status pending";
                }
                $conn->close();
                ?>
            </div>
        </div>
        <div class="panel">
            <h2>Rejected Blogs</h2>
            <div class="blog-list">
                <?php
                include "config.php";
                $sql = "SELECT b.blog_id, b.title, b.content, b.image_path, b.created_at, b.user_id, b.status, b.rejection_notes, u.nama AS creator_name FROM blogs b INNER JOIN user u ON b.user_id = u.user_id WHERE b.status = 'rejected'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="blog-item" data-blog-id="' . $row["blog_id"] . '">';
                        echo '<img src="' . $row["image_path"] . '" alt="Blogger Image">';
                        echo '<span>' . $row["creator_name"] . '</span>';
                        echo '<span>' . $row["title"] . ' - ' . $row["created_at"] . '</span>';
                        echo '</div>';
                    }
                } else {
                    echo "Tidak ada blog yang ditolak";
                }
                $conn->close();
                ?>
            </div>
        </div>
        <div class="panel">
            <h2>Approved Blogs</h2>
            <div class="blog-list">
                <?php
                include 'config.php';
                $sql = "SELECT b.blog_id, b.title, b.content, b.image_path, b.created_at, b.user_id, b.status, u.nama AS creator_name FROM blogs b INNER JOIN user u ON b.user_id = u.user_id WHERE b.status = 'approved'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="blog-item" data-blog-id="' . $row["blog_id"] . '">';
                        echo '<img src="' . $row["image_path"] . '" alt="Blogger Image">';
                        echo '<span>' . $row["creator_name"] . '</span>';
                        echo '<span>' . $row["title"] . ' - ' . $row["created_at"] . '</span>';
                        echo '</div>';
                    }
                } else {
                    echo "Tidak ada blog yang disetujui";
                }
                $conn->close();
                ?>
            </div>
        </div>
        <div class="blog-content">
            <h2>Blog Content</h2>
            <div class="blog-content-container">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
                    $blog_id = $_GET["id"];
                    include 'config.php';                
                    $sql = "SELECT title, content FROM blogs WHERE blog_id = $blog_id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo "<h3>" . $row["title"] . "</h3>";
                        echo "<p>" . $row["content"] . "</p>";
                    } else {
                        echo "Blog not found";
                    }
                    $conn->close();
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/blogger.js"></script>
    <a href="blogger.php" class="float-button">+</a>
    <a href="logout.php" class="logout-button">Logout</a>
</body>
</html>
