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
$is_creator = $team['created_by'] == $user_id;

// Obter membros da equipe
$sql = "SELECT users.id, users.username FROM team_members JOIN users ON team_members.user_id = users.id WHERE team_members.team_id = :team_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':team_id', $team_id);
$stmt->execute();
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verificar se o usuário já é membro da equipe
$is_member = false;
foreach ($members as $member) {
    if ($member['id'] == $user_id) {
        $is_member = true;
        break;
    }
}

// Processar pedidos de entrada/saída da equipe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['join_team']) && !$is_member) {
        $sql = "INSERT INTO team_members (team_id, user_id) VALUES (:team_id, :user_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':team_id', $team_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $is_member = true;
    } elseif (isset($_POST['leave_team']) && $is_member) {
        $sql = "DELETE FROM team_members WHERE team_id = :team_id AND user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':team_id', $team_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $is_member = false;
    }
    // Atualizar a página após a ação
    header("Location: view_team.php?team_id=" . $team_id);
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>ENCONTRE A SUA ALCATEIA</h1>
        <img id="logo" src="../Imagens/logo.png" alt="">
        <br><br><br>
        <nav>
            <li>
                <ul><button>SAIR</button></ul>
            </li>
        </nav>
    </header>
    <section id="barra_lateral">
        <!--Imagem de perfil-->
        <img src="../Imagens/perfil.png" alt="" width="100%">
        <p style="font-size: larger;">Nome de usuario</p>
        <br><br><br>
        <p>Alterar Perfil</p>
    </section>
    <section id="conteudo_principal">
        <article>
            <h2>Team: <?php echo htmlspecialchars($team['name']); ?></h2>
            <br>
            <h3>Membros:</h3>
            <ul>
                <?php foreach ($members as $member): ?>
                    <li><?php echo htmlspecialchars($member['username']); ?></li>
                <?php endforeach; ?>
            </ul>
            <br><br>
            <?php if ($is_creator): ?>
                <h3>Adicionar ou Remover Membros</h3>
                <br>
                <form action="edit_team_members.php?team_id=<?php echo $team_id; ?>" method="post">
                    <label for="user_id">User ID:</label>
                    <input type="number" id="user_id" name="user_id" required><br>
                    <br>
                    <input type="submit" name="add_member" value="Add Member">
                    <input type="submit" name="remove_member" value="Remove Member">
                </form>
            <?php else: ?>
                <h3>Join or Leave Team</h3>
                <form action="view_team.php?team_id=<?php echo $team_id; ?>" method="post">
                    <?php if ($is_member): ?>
                        <input type="submit" name="leave_team" value="Leave Team">
                    <?php else: ?>
                        <input type="submit" name="join_team" value="Join Team">
                    <?php endif; ?>
                </form>
            <?php endif; ?>
        <article></article>
    </section>
</body>
</html>

<style>
    /* Reset CSS */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    list-style-type: none;
}

header {
    background-color: #4b116f;
    color: #fff;
    text-align: center;
}

header h1{
    font-family: 'runtoe';
    padding: 30px;
    text-align: center;
}

button{
    padding:  10px;
    width: 150px;
    color: white;
    background-color: #4b116f;
    border-color: transparent;
    text-align: center;
}

button:hover{
    background-color: #834cb1;
}

nav {
    background-color: lightgray;
    padding: 10px;
}

nav ul {
    list-style-type: none;
    display: inline-block;
    margin-right: 30px;
}

nav ul li:last-child {
    margin-right: 0;
}

nav ul li ul {
    display: inline-block;
    margin-right: 10px;
}

#barra_lateral {
    background-color: #f4f4f4;
    float: left;
    width: 20%;
    padding: 20px;
}

#barra_lateral img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 10px;
    margin-left: 25%;
}

#barra_lateral p {
    font-weight: bold;
    margin-bottom: 20px;
    margin-left: 20%;
}

#barra_lateral ul {
    list-style-type: none;
    margin-bottom: 10px;
}

#conteudo_principal {
    float: right;
    width: 80%;
    padding: 20px;
    background-color: #fff;
}

article {
    margin-bottom: 20px;
}

#logo{
    width: 10%;
    position: absolute;
    top: 10%;
    left: 15%;
    transform: translate(-50%, -50%);
}

#equipe{
    background-color: lightgrey;
    width: 100%; /* Definindo a largura da seção */
    height: 100px;
    margin-top: 10px;
    padding: 30px;
    border-radius: 10px;
    display: block;
    position: flex;
    text-align: center;
}

#equipe button{
    margin-right: 10%;
}

#capa{
    margin: 0%;
    float: right;
    width: 80%;
    background-color: #fff;
    height: 250px;
}
</style>
