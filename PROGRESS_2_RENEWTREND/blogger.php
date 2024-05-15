<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: index.html"); 
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

if ($role == 'blogger') {
} else {
    header("Location: index.html");
}

$user_id = $_SESSION['user_id']; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RenewTrends | Create Blog</title>
    <link rel="icon" type="image/png" href="assets/img/leaf.png">
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
</head>
<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px; 
            background-color: #f2f2f2;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 600px; 
            margin: 0 auto; 
            background-color: #fff; 
            padding: 20px;
            border-radius: 8px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        @media screen and (max-width: 600px) {
            form {
                padding: 10px;
            }

            input[type="text"],
            textarea,
            input[type="file"] {
                margin-bottom: 10px;
            }
        }
    </style>
<div class="container text-center" style="display: flex; justify-content: center;">
    <h2>Create a New Blog</h2>
</div>
<form action="save_blog.php" method="POST" enctype="multipart/form-data">
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title"><br>
    <label for="content">Content:</label><br>
    <textarea id="editor" name="content" style="resize:none;"></textarea>
    <label for="image">Upload Image:</label><br>
    <input type="file" id="image" name="image"><br><br>
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type="submit" value="Create Blog">
</form>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</body>
</html>
