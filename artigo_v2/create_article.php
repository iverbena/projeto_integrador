<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $idUsuario = $_POST['idUsuario'];

    $sql = "INSERT INTO artigos (idUsuario, titulo, conteudo) VALUES (:idUsuario, :titulo, :conteudo)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':conteudo', $conteudo);

    if ($stmt->execute()) {
        echo "Article created successfully.";
        header("Location: view_articles.php?titulo=" . $titulo);
    } else {
        echo "Error creating article.";
    }
}
?>