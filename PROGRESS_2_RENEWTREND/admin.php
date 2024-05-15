<?php
session_start();
include "check_session_expiry.php";
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: index.html");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

if ($role == 'admin') {
} else {
    header("Location: index.html");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>RenewTrends | Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
        }
        .pending-blogs, .published-blogs {
            flex: 1;
            padding: 20px;
            border-right: 1px solid #ccc;
            max-width: 300px;
        }
        .blog-content {
            flex: 2;
            padding: 20px;
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
        
        .blog-content-container {
    padding: 20px;
    border: 1px solid #ccc;
    background-color: #fff;
    max-width: 900px;
    width: 100%;
    overflow: auto; 
}

.blog-content-container p {
    word-wrap: break-word; 
}

        .action-buttons {
            margin-top: 10px;
        }
        .action-buttons button {
            margin-right: 10px;
        }
        .floating-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 50px;
            text-decoration: none;
            z-index: 1000; 
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .floating-button:hover {
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
    .container {
        flex-direction: column; 
    }
    .pending-blogs, .published-blogs, .rejected-blogs {
        max-width: 100%; 
        border-right: none; 
        margin-bottom: 20px; 
    }
    .blog-list {
        margin-top: 20px; 
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
        <div class="pending-blogs">
            <h2>Pending Blogs</h2>
            <div class="blog-list">
                <?php
                include "config.php";

                $sql = "SELECT b.blog_id, b.title, b.content, b.image_path, b.created_at, b.user_id, b.status, b.rejection_notes, u.nama AS creator_name
                FROM blogs b 
                INNER JOIN user u 
                ON b.user_id = u.user_id 
                WHERE b.status = 'pending'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="blog-item pending" data-blog-id="' . $row["blog_id"] . '">';
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
        <div class="published-blogs">
            <h2>Published blogs</h2>
            <div class="blog-list">
                <?php
                include "config.php";


                $sql = "SELECT b.blog_id, b.title, b.content, b.image_path, b.created_at, b.user_id, b.status, b.rejection_notes, u.nama AS creator_name
                FROM blogs b 
                INNER JOIN user u 
                ON b.user_id = u.user_id 
                WHERE b.status = 'approved'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="blog-item published" data-blog-id="' . $row["blog_id"] . '">';
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
        
        <div class="blog-content">
            <h2>Blog Content</h2>
            <div class="blog-content-container"></div>
            <div class="action-buttons">
                <button id="approve-btn">Approve</button>
                <button id="reject-btn">Reject</button>
                <div id="rejection-note" style="display: none;">
                    <textarea id="rejection-note-input" rows="4" cols="50" placeholder="Rejection Note"></textarea>
                    <button id="reject-submit">Submit Rejection</button>
                </div>
            </div>
            <button id="delete-btn">Delete</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/admin.js"></script>

<a href="logout.php" class="logout-button">Logout</a>
</body>
</html>
