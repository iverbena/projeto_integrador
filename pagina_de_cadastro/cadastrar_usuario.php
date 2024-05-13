<?php
// Dados de conexão ao banco de dados
$host = "localhost";
$user = "root";
$pass = ""; // Senha vazia se você não configurou uma
$dbname = "projetoIntegrador";

// Conectar ao banco de dados
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Dados do formulário
$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"]; // Lembre-se de utilizar técnicas seguras para armazenar senhas, como hashing.

// Verificar se o email já está cadastrado
$sql_verificar_email = "SELECT * FROM usuarios WHERE email='$email'";
$result_verificar_email = $conn->query($sql_verificar_email);

if ($result_verificar_email->num_rows > 0) {
    echo "Este email já está cadastrado.";
} else {
    // Inserir dados na tabela
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    if ($conn->query($sql) === TRUE) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . $conn->error;
    }
}

// Fechar a conexão
$conn->close();
?>