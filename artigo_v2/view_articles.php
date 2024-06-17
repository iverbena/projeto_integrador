<?php
include 'db.php';

$sql = "SELECT articles.id, articles.title, articles.content, users.username, articles.created_at FROM articles JOIN users ON articles.user_id = users.id ORDER BY articles.created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$articles = $stmt->fetchAll();

foreach ($articles as $article) {
    echo "<h2>" . htmlspecialchars($article['title']) . "</h2>";
    echo "<p>By " . htmlspecialchars($article['username']) . " on " . htmlspecialchars($article['created_at']) . "</p>";
    echo "<p>" . nl2br(htmlspecialchars($article['content'])) . "</p>";
    echo "<hr>";
}
?>
