<?php
include 'conexao.php';
session_start();

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['team_id'])) {
    echo "Team ID not specified.";
    exit();
}

$user_id = $_SESSION['user_id'];
$team_id = $_GET['team_id'];

// Obter detalhes da equipe
$sql = "SELECT * FROM equipe WHERE id_equipe = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $team_id);
$stmt->execute();
$result = $stmt->get_result();
$team = $result->fetch_assoc();

if (!$team) {
    echo "Team not found.";
    exit();
}

// Verificar se o usuário é o criador da equipe
$is_creator = $team['criador'] == $user_id;

// Obter membros da equipe
$sql = "SELECT usuario.id_usuario, usuario.nome FROM membro JOIN usuario ON membro.usuario = usuario.id_usuario WHERE membro.equipe = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $team_id);
$stmt->execute();
$result = $stmt->get_result();
$members = $result->fetch_all(MYSQLI_ASSOC);

// Verificar se o usuário já é membro da equipe
$is_member = false;
foreach ($members as $member) {
    if ($member['id_usuario'] == $user_id) {
        $is_member = true;
        break;
    }
}

// Processar pedidos de entrada/saída da equipe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['join_team']) && !$is_member) {
        $sql = "INSERT INTO membro (equipe, usuario) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $team_id, $user_id);
        $stmt->execute();
        $is_member = true;
    } elseif (isset($_POST['leave_team']) && $is_member) {
        $sql = "DELETE FROM membro WHERE equipe = ? AND usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $team_id, $user_id);
        $stmt->execute();
        $is_member = false;
    } elseif (isset($_POST['delete_team']) && $is_creator) {
        // Remover todos os membros da equipe
        $sql = "DELETE FROM membro WHERE equipe = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $team_id);
        $stmt->execute();
        // Remover a equipe
        $sql = "DELETE FROM equipe WHERE id_equipe = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $team_id);
        $stmt->execute();
        header("Location: pagina_inicial.php");
        exit();
    }
    // Atualizar a página após a ação
    header("Location: ver_equipe.php?team_id=" . $team_id);
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Imagens/logo.png" type="logo/x-icon">
    <title>Equipe</title>
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
            <h2><?php echo htmlspecialchars($team['nome_equipe']); ?></h2>
            <br>
            <h3>Membros:</h3>
            <br>
            <ul style="margin-left: 5%;">
                <?php foreach ($members as $member): ?>
                    <li><?php echo htmlspecialchars($member['nome']); ?></li>
                <?php endforeach; ?>
            </ul>
            <br><br>
            <?php if ($is_creator): ?>
                <h3>Adicionar ou Remover Membros</h3>
                <br>
                <form action="editar_membros.php?team_id=<?php echo $team_id; ?>" method="post">
                    <label for="user_id">User ID:</label>
                    <input type="number" id="user_id" name="user_id" required><br>
                    <br>
                    <input id="botao" type="submit" name="add_member" value="Adicionar Membro">
                    <input id="botao" type="submit" name="remove_member" value="Remover Membro">
                </form>
            <?php else: ?>
                <h3>Join or Leave Team</h3>
                <form action="ver_equipe.php?team_id=<?php echo $team_id; ?>" method="post">
                    <?php if ($is_member): ?>
                        <input id="botao" type="submit" name="leave_team" value="Leave Team">
                    <?php else: ?>
                        <input id="botao" type="submit" name="join_team" value="Join Team">
                    <?php endif; ?>
                </form>
            <?php endif; ?>
        <article></article>
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
        }

        body {
            font-family:  Arial, sans-serif;
            background-color: #b7cfda;
            list-style-type: none;
            background-color: #f4f4f4;
        }

        header {
            background-color: #4b116f;
            color: #fff;
            text-align: center;
        }
        header h1{
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

        button{
            margin-bottom: 10px;
            display: flex grid;
            padding:  8px;
            width: 150px;
            color: white;
            background-color: #4b116f;
            border-color: transparent;
            text-align: center;
        }

        a {
            color:rgb(255, 255, 255);
            text-align: center;
            text-decoration: none;
        }

        a:hover {

            color: rgb(255, 255, 255);
        }

        button:hover{
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

        #logo{
            width: 12%;
            position: absolute;
            top: 17%;
            left: 120px;
            flex-wrap: wrap;
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
            display: flex grid;
        }

        @media screen and (max-width: 768px) {

            .elemento {
                margin-top: 10%;
                display: flex;
                flex-wrap: wrap;
            }
            header h1{
                width: 250px;
                height: 120px;
                padding-top: 40px;
                letter-spacing: 2px;
                font-family: 'runtoe';
                text-align-last: center;
            }

            #logo{
                width: 17%;
                top: 10%;
                left: 350px;
                margin-top: 60px;
                flex-wrap: wrap;
                transform: translate(-50%, -50%);
            }
        }

    </style>