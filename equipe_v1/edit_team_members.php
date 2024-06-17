<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$team_id = $_GET['team_id'];

// Obter detalhes da equipe
$sql = "SELECT * FROM teams WHERE id = :team_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':team_id', $team_id);
$stmt->execute();
$team = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar se o usuário é o criador da equipe
if ($team['created_by'] != $user_id) {
    $_SESSION['message'] = "Você não tem permissão para editar esta equipe.";
    header("Location: view_team.php?team_id=" . $team_id);
    exit();
}

// Add member
if (isset($_POST['add_member'])) {
    $new_user_id = $_POST['user_id'];
    $sql = "INSERT INTO team_members (team_id, user_id) VALUES (:team_id, :user_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':team_id', $team_id);
    $stmt->bindParam(':user_id', $new_user_id);
    $stmt->execute();
}

// Remove member
if (isset($_POST['remove_member'])) {
    $new_user_id = $_POST['user_id'];
    $sql = "DELETE FROM team_members WHERE team_id = :team_id AND user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':team_id', $team_id);
    $stmt->bindParam(':user_id', $new_user_id);
    $stmt->execute();
}

header("Location: view_team.php?team_id=" . $team_id);
exit();
?>
