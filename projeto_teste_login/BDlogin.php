<?php
session_start();

include 'login.php'; // incluir o arquivo de conexão

// Obter os dados do formulário de login
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta para verificar se o usuário existe
$sql = "SELECT * FROM usuarios WHERE nome='$username' AND senha='$password'";
$result = mysqli_query($conn, $sql);

// Verificar se a consulta retornou algum resultado
if (mysqli_num_rows($result) == 1) {
    // Login bem-sucedido
    $_SESSION['username'] = $username; // salvar o nome de usuário na sessão
    header('Location: ../pagina_teste_pagina_inicial/pagina_inicial.php'); // redirecionar para a página do painel de controle
} else {
    // Login falhou
    echo "Nome de usuário ou senha incorretos.";
}

mysqli_close($conn); // fechar a conexão
?>
