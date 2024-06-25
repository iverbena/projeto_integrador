<?php
// Verificar se o parâmetro ID foi passado na URL
if (!isset($_GET['id'])) {
    echo "ID do usuário não especificado.";
    exit();
}

$id_usuario = intval($_GET['id']); // Converter para inteiro para segurança

// Incluir o arquivo de conexão com o banco de dados
include 'conexao.php';

// Consultar o banco de dados para obter as informações do usuário
$sql = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Usuário não encontrado.";
    exit();
}

$user = $result->fetch_assoc();

// Fechar a consulta e a conexão com o banco de dados
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Imagens/logo.png" type="logo/x-icon">
    <title>Perfil</title>
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

        #capa{
            margin: 0%;
            float: right;
            width: 80%;
            background-color: #fff;
            height: 250px;
        }
    </style>
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
    <img src="Imagens/Capa_01.jpg" alt="capa" id="capa" width="100%">
    <section id="barra_lateral">
        <!--Imagem de perfil-->
        <img src="Imagens/foto_perfil.png" alt="" width="100%">
        <p style="margin-left: 25%"><?php echo htmlspecialchars($user['nome']); ?></p>
        <p style="margin-left: 25%">ID: #<?php echo htmlspecialchars($id_usuario); ?></p>
        <button><a href="pagina_inicial.php">HOME</a></button>
    </section>
    <section id="conteudo_principal">
        <article>
            <h3>Conquistas</h3>
            <div id="equipe">
                <p>[Vazio]</p>
            </div>
        </article>
        <article>
            <h3>Amigos</h3>
            <div id="equipe">
                <p>[Vazio]</p>
            </div>
        </article>
    </section>
</body>
</html>
