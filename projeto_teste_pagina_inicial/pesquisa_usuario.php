<?php
// Incluir o arquivo de conexão
include 'conexao.php';

// Obter o termo de pesquisa
$query = isset($_GET['query']) ? $_GET['query'] : '';


// Preparar a consulta para Perfis de Usuário
$sql_perfis = $conn->prepare("SELECT * FROM usuarios WHERE nome LIKE ?");
$search_query = "%$query%";
$sql_perfis->bind_param("s", $search_query);
$sql_perfis->execute();
$result_perfis = $sql_perfis->get_result();

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
    <h2>Perfis de Usuário</h2>
    <?php if ($result_perfis->num_rows > 0): ?>
        <?php while ($row = $result_perfis->fetch_assoc()): ?>
            <div class="result-item">
                <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
                <p><?php echo htmlspecialchars($row['id']); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Nenhum perfil encontrado.</p>
    <?php endif; ?>
</div>


</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>