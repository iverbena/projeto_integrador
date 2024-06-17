<?php
include 'db.php';

$sql = "SELECT artigos.id, artigos.titulo, artigos.conteudo, usuarios.nome, artigos.criado_em FROM artigos JOIN usuarios ON artigos.idUsuario = usuarios.id ORDER BY artigos.criado_em DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$artigos = $stmt->fetchAll();

foreach ($articgos as $artigo) {
    echo "<h2>" . htmlspecialchars($artigo['titulo']) . "</h2>";
    echo "<p>By " . htmlspecialchars($artigo['mone']) . " on " . htmlspecialchars($artigo['criado_em']) . "</p>";
    echo "<p>" . nl2br(htmlspecialchars($article['conteudo'])) . "</p>";
    echo "<hr>";
}
?>
