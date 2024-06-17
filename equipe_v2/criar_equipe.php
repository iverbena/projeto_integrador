<?php
include 'conexao.php';
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $criado_por = $_SESSION['id'];

    $sql = "INSERT INTO equipes (nome, criado_por) VALUES (:nome, :criado_por)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $name);
    $stmt->bindParam(':criado_por', $criado_por);

    if ($stmt->execute()) {
        $team_id = $conn->lastInsertId();
        // Add the creator as a member of the team
        $sql = "INSERT INTO membros (id_equipe, id) VALUES (:id_equipe, :id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_equipe', $id_equipe);
        $stmt->bindParam(':id', $criado_por);
        $stmt->execute();

        $_SESSION['message'] = "Team created successfully.";
        header("Location: view_team.php?id_equipe=" . $id_equipe);
        exit();
    } else {
        $_SESSION['message'] = "Error creating team.";
    }
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
                <ul><a href="logout.php"><button>SAIR</button></a></ul>
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
            <h3>Criar Equipe</h3>
            <br><br>
            <form action="criar_equipe.php" method="post">
                <label for="nome">Nome da Equipe:</label>
                <input type="text" id="nome" name="nome" required><br>
                <br><br>
                <input type="submit" value="Criar Equipe">
            </form>
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