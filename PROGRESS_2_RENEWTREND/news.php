<?php
        include "config.php";

$sql = "SELECT * FROM blogs WHERE status = 'approved'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
    <title>RenewTrends | News</title>
        <link rel="icon" type="image/png" href="assets/img/leaf.png">

    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <style>
body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .news-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
        }

        .news-item {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
        }

        .news-image {
            max-width: 100%;
            height: auto;
        }

        .news-info {
            padding: 20px;
        }

        .news-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .news-date {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .news-preview {
            font-size: 16px;
        }
        .read-more-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
        display: inline-block;
            
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        cursor: pointer;
        transition: opacity 0.3s ease;


        }
        

    .read-more-btn:hover {
        opacity: 0.7;
    }

        /* Responsif */
        @media screen and (min-width: 768px) {
            .news-item {
                flex-direction: row;
            }

            .news-image {
                width: 40%;
            }

            .news-info {
                width: 100%;
                padding: 20px;
            }
            .news-container{
                margin-right: 120px;
                margin-left: 120px;
            }
        }    
        </style>
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
<div class="container mt-5 pt-5 mb-5 text-center">
        <h2 style="font-weight:bold;">Blog Terkait</h2>

    </div>

<div class="news-container">
    <?php
   include "config.php";
   
   $sql = "SELECT * FROM blogs WHERE status = 'approved' ORDER BY created_at DESC";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
           $encodedSlug = urlencode($row["slug"]); // Encode slug sebelum dimasukkan ke dalam URL
           echo "<div class='news-item'>";
           echo "<img src='" . $row["image_path"] . "' alt='News Image' class='news-image'>";
           echo "<div class='news-info'>";
           echo "<a href='blog_content.php?" . $encodedSlug . "'>";
           echo "<div class='news-title'>" . $row["title"] . "</div>";
           echo "</a>";
           echo "<div class='news-date'>" . $row["created_at"] . "</div>";
           echo "<div class='news-preview'>" . $row["content"] . "</div>";
           echo "<a href='blog_content.php?" . $encodedSlug . "' class='read-more-btn'>Read More</a>";
           echo "</div>";
           echo "</div>";
           echo "<br>";
       }
   } else {
       echo "No blogs found.";
   }
   
   $conn->close();
   
    ?>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var previews = document.querySelectorAll(".news-preview");
        var maxChars = 200; 
        var maxLines = 5; 

        previews.forEach(function(preview) {
            var lines = preview.textContent.split("\n");
            lines = lines.filter(function(line) {
                return line.trim() !== "";
            });
            var trimmedText = lines.slice(0, maxLines).join("\n");
            if (trimmedText.length > maxChars) {
                trimmedText = trimmedText.substring(0, maxChars) + "...";
            }
            preview.textContent = trimmedText;
        });
    });
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="assets/js/typeit.js"></script>
</footer>
</body>
</html>


