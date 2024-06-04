<?php
// arquivo: /public/criar_equipe.php

// Incluir o arquivo de conexão
include 'conexao.php';

// Inicializar variáveis para mensagens de erro e sucesso
$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    // Verificar se os campos estão preenchidos
    if (empty($nome) || empty($descricao)) {
        $erro = 'Por favor, preencha todos os campos.';
    } else {
        // Preparar a consulta SQL para inserir os dados
        $sql = $conn->prepare("INSERT INTO equipes (nome, descricao) VALUES (?, ?)");
        $sql->bind_param("ss", $nome, $descricao);

        // Executar a consulta e verificar o resultado
        if ($sql->execute()) {
            $sucesso =  header('Location: ../projeto_sucesso_cadastro/sucesso_cadastro.php');
        } else {
            $erro = 'Erro ao criar a equipe: ' . $conn->error;
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
    <title>Criar Equipe</title>
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

<h1>Criar Nova Equipe</h1>

<?php if (!empty($erro)): ?>
    <div class="error"><?php echo $erro; ?></div>
<?php endif; ?>

<?php if (!empty($sucesso)): ?>
    <div class="success"><?php echo $sucesso; ?></div>
<?php endif; ?>

<form action="criar_equipes.php" method="post">
    <div class="form-group">
        <label for="nome">Nome da Equipe:</label>
        <input type="text" id="nome" name="nome" required>
    </div>
    <div class="form-group">
        <label for="descricao">Descrição da Equipe:</label>
        <textarea id="descricao" name="descricao" required></textarea>
    </div>
    <button type="submit">Criar Equipe</button>
</form>

</body>
</html>