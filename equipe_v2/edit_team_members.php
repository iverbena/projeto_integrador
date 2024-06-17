<?php
include 'conexao.php';
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];
$id_equipe = $_GET['id_equipe'];

// Obter detalhes da equipe
$sql = "SELECT * FROM equipes WHERE id = :id_equipe";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_equipe', $id_equipe);
$stmt->execute();
$equipe = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar se o usuário é o criador da equipe
if ($equipe['criado_por'] != $id) {
    $_SESSION['message'] = "Você não tem permissão para editar esta equipe.";
    header("Location: view_team.php?team_id=" . $id);
    exit();
}

// Add member
if (isset($_POST['adicionar_membro'])) {
    $novo_usuario_id = $_POST['id'];
    $sql = "INSERT INTO membros (id_equipe, id) VALUES (:id_equipe, :id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_equipe', $id_equipe);
    $stmt->bindParam(':id', $novo_usuario_id);
    $stmt->execute();
}

// Remove member
if (isset($_POST['remover_membro'])) {
    $novo_usuario_id = $_POST['id'];
    $sql = "DELETE FROM membros WHERE id_equipe = :id_equipe AND id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_equipe', $id_equipe);
    $stmt->bindParam(':id', $novo_usuario_id);
    $stmt->execute();
}

header("Location: view_team.php?id_equipe=" . $id_equipe);
exit();
?>
