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
 $sql = "SELECT id, nome FROM usuarios WHERE nome=? AND senha=?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("ss", $username, $password);
 $stmt->execute();
 $result = $stmt->get_result();

 // Verificar se a consulta retornou algum resultado
 if ($result->num_rows == 1) {
     $row = $result->fetch_assoc();
     // Login bem-sucedido
     $_SESSION['user_id'] = $row['id'];
     $_SESSION['user_name'] = $row['nome']; // Salvar o ID do usuário na sessão
     header('Location: ../projeto_teste_pagina_inicial/pagina_inicial.php'); // Redirecionar para a página do painel de controle
     exit();
 } else {
     // Login falhou, redirecionar de volta com parâmetro de erro
     header('Location: ../projeto_teste_login/index.php?login_falhou=true');
     exit();
 }
} elseif ($action == 'Cadastro') {
 // Redirecionar para a página de registro
 header('Location: ../pagina_de_cadastro/cadastro.php');
 exit();
}
?>