<?php
$servername = "localhost"; // ou o endereço do servidor MySQL
$username = "root"; // seu nome de usuário do MySQL
$password = ""; // sua senha do MySQL (se não houver senha, deixe vazio)
$dbname = "projetoIntegrador"; // nome do banco de dados criado no XAMPP

// Estabelecer a conexão
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar a conexão
if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}
?>