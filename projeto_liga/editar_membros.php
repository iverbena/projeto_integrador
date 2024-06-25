<?php
include 'conexao.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$team_id = $_GET['team_id'];

// Verificar se o usuário é o criador da equipe
$sql = "SELECT criador FROM equipe WHERE id_equipe = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $team_id);
$stmt->execute();
$result = $stmt->get_result();
$team = $result->fetch_assoc();

if ($team['criador'] != $user_id) {
    header("Location: ver_equipe.php?team_id=" . $team_id);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_user_id = $_POST['user_id'];
    
    if (isset($_POST['add_member'])) {
        // Adicionar membro à equipe
        $sql = "INSERT INTO membro (equipe, usuario) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $team_id, $member_user_id);
        $stmt->execute();
    } elseif (isset($_POST['remove_member'])) {
        // Remover membro da equipe
        $sql = "DELETE FROM membro WHERE equipe = ? AND usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $team_id, $member_user_id);
        $stmt->execute();
    }
    header("Location: ver_equipe.php?team_id=" . $team_id);
    exit();
}
?>
