<?php
// Incluir o arquivo de conexão
include 'conexao.php';

// Obter o termo de pesquisa
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Preparar a consulta para Equipes
 $sql_equipes = $conn->prepare("SELECT * FROM equipes WHERE nome LIKE ? OR descricao LIKE ?");
$sql_equipes->bind_param("ss", $search_equipe, $search_equipe);
$sql_equipes->execute();
$result_equipes = $sql_equipes->get_result();
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
    <h2>Equipes</h2>
    <?php if ($result_equipes->num_rows > 0): ?>
        <?php while ($row = $result_equipes->fetch_assoc()): ?>
            <div class="result-item">
                <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
                <p><?php echo htmlspecialchars($row['descricao']); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Nenhuma equipe encontrada.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>