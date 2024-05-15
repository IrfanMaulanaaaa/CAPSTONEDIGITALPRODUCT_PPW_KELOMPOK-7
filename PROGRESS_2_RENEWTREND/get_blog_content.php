<?php
include "config.php";

$blogId = $_GET['id'];

$sql = "SELECT b.title, b.content, b.image_path, b.user_id, b.rejection_notes, b.status, u.nama AS creator_name
        FROM blogs b
        INNER JOIN user u ON b.user_id = u.user_id
        WHERE b.blog_id = $blogId";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $blogData = $result->fetch_assoc();

    $response = array(
        "title" => $blogData['title'],
        "content" => nl2br($blogData['content']),
        "image_path" => $blogData['image_path'],
        "rejection_notes" => $blogData['rejection_notes'],
        "creator_name" => $blogData['creator_name'],
        "status" => $blogData['status'] 

    );
    

    echo json_encode($response);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Blog not found."));
}

$conn->close();
?>
