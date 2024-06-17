<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_POST['user_id'];

    $sql = "INSERT INTO articles (user_id, title, content) VALUES (:user_id, :title, :content)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);

    if ($stmt->execute()) {
        echo "Article created successfully.";
        header("Location: view_articles.php");
    } else {
        echo "Error creating article.";
    }
}
?>