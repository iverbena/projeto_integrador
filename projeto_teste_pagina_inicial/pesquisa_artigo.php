<?php
// Incluir o arquivo de conexão
include 'conexao.php';

// Obter o termo de pesquisa
$query = isset($_GET['query']) ? $_GET['query'] : '';


// Preparar a consulta para Artigos
 $sql_artigos = $conn->prepare("SELECT * FROM artigos WHERE titulo LIKE ? OR conteudo LIKE ?");
 $search_query = "%$query%";
 $sql_artigos->bind_param("ss", $search_query, $search_query);
 $sql_artigos->execute();
 $result_artigos = $sql_artigos->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Pesquisa</title>
    <style>
        .result-section {
            margin-bottom: 20px;
        }
        .result-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1>Resultados da Pesquisa para "<?php echo htmlspecialchars($query); ?>"</h1>


<div class="result-section">
    <h2>Artigos</h2>
    <?php if ($result_artigos->num_rows > 0): ?>
        <?php while ($row = $result_artigos->fetch_assoc()): ?>
            <div class="result-item">
                <h3><?php echo htmlspecialchars($row['titulo']); ?></h3>
                <p><?php echo htmlspecialchars($row['conteudo']); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Nenhum artigo encontrado.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>