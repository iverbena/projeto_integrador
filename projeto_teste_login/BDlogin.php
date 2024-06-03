<?php
session_start();

include 'login.php'; // Incluir o arquivo de conexão

// Obter a ação (botão pressionado)
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action == 'Login') {
    // Processar Login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para verificar se o usuário existe
    $sql = "SELECT * FROM usuarios WHERE nome='$username' AND senha='$password'";
    $result = mysqli_query($conn, $sql);

    // Verificar se a consulta retornou algum resultado
    if (mysqli_num_rows($result) == 1) {
        // Login bem-sucedido
        $_SESSION['username'] = $username; // Salvar o nome de usuário na sessão
        header('Location: ../projeto_teste_pagina_inicial/pagina_inicial.php'); // Redirecionar para a página do painel de controle
    } else {
        // Login falhou, redirecionar de volta com parâmetro de erro
        header('Location: ../projeto_teste_login/index.php?login_falhou=true');
    }
} elseif ($action == 'Cadastro') {
    // Redirecionar para a página de registro
    header('Location: ../pagina_de_cadastro/cadastro.php');

    
}

mysqli_close($conn); // Fechar a conexão
?>