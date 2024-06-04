<?php

session_start();

// Incluir o arquivo de conexão
include 'conexao.php';

$user_id = $_SESSION['user_id'];

// Inicializar variáveis para mensagens de erro e sucesso
$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];

    // Verificar se os campos estão preenchidos
    if (empty($titulo) || empty($conteudo)) {
        $erro = 'Por favor, preencha todos os campos.';
    } else {
        // Preparar a consulta SQL para inserir os dados
        $sql = $conn->prepare("INSERT INTO artigos (titulo, conteudo, idUsuario) VALUES (?, ?, ?)");
        $sql->bind_param("ssi", $titulo, $conteudo, $user_id);

        // Executar a consulta e verificar o resultado
        if ($sql->execute()) {
            $sucesso = 'Artigo criado com sucesso!';
        } else {
            $erro = 'Erro ao criar o artigo: ' . $conn->error;
        }
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Artigo</title>
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .success {
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<h1>Criar Novo Artigo</h1>

<?php if (!empty($erro)): ?>
    <div class="error"><?php echo $erro; ?></div>
<?php endif; ?>

<?php if (!empty($sucesso)): ?>
    <div class="success"><?php echo $sucesso; ?></div>
<?php endif; ?>

<form action="criar_artigo.php" method="post">
    <div class="form-group">
        <label for="titulo">Título do Artigo:</label>
        <input type="text" id="titulo" name="titulo" required>
    </div>
    <div class="form-group">
        <label for="conteudo">Conteúdo do Artigo:</label>
        <textarea id="conteudo" name="conteudo" required></textarea>
    </div>
    <button type="submit">Criar Artigo</button>
</form>

</body>
</html>