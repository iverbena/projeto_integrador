<?php
include 'conexao.php';
session_start();

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $created_by = $_SESSION['user_id'];

    $sql = "INSERT INTO equipe (nome_equipe, criador) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $name, $created_by);

    if ($stmt->execute()) {
        $team_id = $stmt->insert_id;
        // Adicionar o criador como membro da equipe
        $sql = "INSERT INTO membro (equipe, usuario) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $team_id, $created_by);
        $stmt->execute();

        $_SESSION['message'] = "Team created successfully.";
        header("Location: ver_equipe.php?team_id=" . $team_id);
        exit();
    } else {
        $_SESSION['message'] = "Error creating team: " . $stmt->error;
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Imagens/logo.png" type="logo/x-icon">
    <title>Criar Equipe</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
            <h1>ENCONTRE A SUA ALCATEIA</h1>
            <img id="logo" src="Imagens/logo.png" alt="">
        <br><br><br>
        <nav>
            <li>
                <ul>
                    <div class="elemento"><button><a href="sair.php">SAIR</a></button></div>
                </ul>
            </li>
        </nav>
    </header>
    <section id="barra_lateral">
        <!--Imagem de perfil-->
        <img src="Imagens/foto_perfil.png" alt="" width="100%">
        <p style="margin-left: 25%;"><?php echo htmlspecialchars($user_name); ?></p>
        <p style="margin-left: 25%">ID: #<?php echo htmlspecialchars($user_id); ?></p>
        <button><a href="pagina_inicial.php">HOME</a></button>
        <form action="perfil_usuario.php" method="get">
            <button type="submit" name="id" value=<?php echo htmlspecialchars($user_id); ?>>PERFIL</button>
        </form>
    </section>
    <section id="conteudo_principal">
        <article>
            <h3>Criar Equipe</h3>
            <br><br>
            <form action="criar_equipe.php" method="post">
                <label for="name">Nome da Equipe:</label>
                <input type="text" id="name" name="name" required><br>
                <br><br>
                <input id="botao" type="submit" value="Criar Equipe">
            </form>
    </section>
</body>
</html>

<style>
        /* Reset CSS   inicial  */

        @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap');

        * {
            margin-top: 3px;
            margin: 2;
            padding: 0;
            box-sizing: border-box;
        }

        h2 {
            padding-top: 25px;
            padding-left: 280px;
            font-size: 50px;
            font-family: "Caveat", cursive;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #b7cfda;
            list-style-type: none;
            background-color: #f4f4f4;
        }

        header {
            background-color: #4b116f;
            color: #fff;
            text-align: center;
        }

        header h1 {
            font-family: 'runtoe';
            padding-top: 80px;
            padding-right: 5px;
            text-align: center;
        }

        #botao{
            margin-bottom: 10px;
            display: flex grid;
            padding: 8px;
            width: 150px;
            color: white;
            background-color: #4b116f;
            border-color: transparent;
            text-align: center;
        }

        button {
            margin-bottom: 10px;
            display: flex grid;
            padding: 8px;
            width: 150px;
            color: white;
            background-color: #4b116f;
            border-color: transparent;
            text-align: center;
        }

        a {
            color: rgb(255, 255, 255);
            text-align: center;
            text-decoration: none;
        }

        a:hover {
            color: rgb(255, 255, 255);
        }

        button:hover {
            background-color: #834cb1;
        }

        nav.sinza {
            background-color: lightgray;
            padding: 40px;
            border-radius: 15px;
            position: relative;
        }

        .sinza button {
            display: flex inline;
            margin-top: 10px;
            margin-bottom: 20px;
            margin-left: 60px;
            margin-right: 75px;
            border-radius: 5px;
        }

        .zinsa p {
            align-items: center;
        }

        #barra {
            width: 250px;
            height: 35px;
            border-radius: 5px;
            font-size: 16px;
        }

        nav {
            background-color: lightgray;
            padding: 15px;
        }

        nav ul {
            list-style-type: none;
            display: inline-block;
            margin-right: 30px;
        }

        nav ul li:last-child {
            margin-right: 0;
            border-radius: 15px;
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
            min-width: 147px;
            border-radius: 10px;
        }

        #barra_lateral img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
            margin-left: 15%;
        }

        #barra_lateral p {
            font-weight: bold;
            margin-bottom: 10px;
            margin-left: 5%;
        }

        ul {
            list-style-type: none;
            margin-bottom: 10px;
        }

        #conteudo_principal {
            float: right;
            width: 80%;
            padding: 10px;
            background-color: #fff;
        }

        article {
            margin-bottom: 10px;
        }

        #logo {
            width: 12%;
            position: absolute;
            top: 17%;
            left: 120px;
            flex-wrap: wrap;
            transform: translate(-50%, -50%);
        }

        #equipe {
            background-color: lightgrey;
            width: 100%;
            height: 100px;
            margin-top: 10px;
            padding: 30px;
            border-radius: 10px;
            display: block;
            position: flex;
            text-align: center;
        }

        #equipe button {
            margin-right: 10%;
            display: flex grid;
        }

        @media screen and (max-width: 768px) {

            .elemento {
                margin-top: 10%;
                display: flex;
                flex-wrap: wrap;
            }

            header h1 {
                width: 250px;
                height: 120px;
                padding-top: 40px;
                letter-spacing: 2px;
                font-family: 'runtoe';
                text-align-last: center;
            }

            #logo {
                width: 17%;
                top: 10%;
                left: 350px;
                margin-top: 60px;
                flex-wrap: wrap;
                transform: translate(-50%, -50%);
            }
        }

    </style>