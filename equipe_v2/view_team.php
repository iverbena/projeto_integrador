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
$criador = $equipe['criado_por'] == $id;

// Obter membros da equipe
$sql = "SELECT usuarios.id, usuarios.nome FROM membros JOIN usuarios ON membros.id = usuarios.id WHERE membros.id_equipe = :id_equipe";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_equipe', $id_equipe);
$stmt->execute();
$membros = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verificar se o usuário já é membro da equipe
$membro = false;
foreach ($membros as $membro) {
    if ($membro['id'] == $id) {
        $eh_membro = true;
        break;
    }
}

// Processar pedidos de entrada/saída da equipe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['entrar_equipe']) && !$eh_membro) {
        $sql = "INSERT INTO membros (id_equipe, id) VALUES (:id_equipe, :id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_equipe', $id_equipe);
        $stmt->bindParam(':user_id', $id);
        $stmt->execute();
        $eh_membro = true;
    } elseif (isset($_POST['deixar_equipe']) && $eh_membro) {
        $sql = "DELETE FROM membros WHERE id_equipe = :id_equipe AND id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_equipe', $id);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $eh_member = false;
    }
    // Atualizar a página após a ação
    header("Location: view_team.php?team_id=" . $id_equipe);
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
            <h2>Team: <?php echo htmlspecialchars($equipe['nome']); ?></h2>
            <br>
            <h3>Membros:</h3>
            <ul>
                <?php foreach ($membros as $membro): ?>
                    <li><?php echo htmlspecialchars($membro['nome']); ?></li>
                <?php endforeach; ?>
            </ul>
            <br><br>
            <?php if ($criador): ?>
                <h3>Adicionar ou Remover Membros</h3>
                <br>
                <form action="edit_team_members.php?id_equipe=<?php echo $id_equipe; ?>" method="post">
                    <label for="id">User ID:</label>
                    <input type="number" id="id" name="id" required><br>
                    <br>
                    <input type="submit" name="adicionar_membro" value="Adicionar Membro">
                    <input type="submit" name="remover_membro" value="Remover Membro">
                </form>
            <?php else: ?>
                <h3>Join or Leave Team</h3>
                <form action="view_team.php?id_equipe=<?php echo $id_equipe; ?>" method="post">
                    <?php if ($eh_membro): ?>
                        <input type="submit" name="deixar_equipe" value="Deixar Equipe">
                    <?php else: ?>
                        <input type="submit" name="entrar_equipe" value="Entrar">
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
