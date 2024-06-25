
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Imagens/logo.png" type="logo/x-icon">
    <title>Login</title>
</head>
<body>
<?php
// Verificar se houve um erro de login
$login_falhou = isset($_GET['login_falhou']) ? $_GET['login_falhou'] : false;

if ($login_falhou) {
    echo '<script>alert("Email ou senha incorretos.");</script>';
}
?>
    <header>
        <img src="Imagens/linha3.png" alt="" id="linha">
        <img src="Imagens/logo.png" alt="" id="logo">
        <h1 id="subtitulo"><b>ENCONTRE SUA ALCATEIA</b></h1>
    </header>
    <section>
        <h1>LOGIN</h1>
        <form action="BDlogin.php" method="post">
            <label for="e-mail">E-mail: </label>
            <input type="text" name="email" id="email">
            <br>
            <label for="senha">Senha:</label>
            <input type="password" name="password" id="senha">
            <br>
            <input type="submit" name="action" value="Login" style="width: 21%;">
            <input type="submit" name="action" value="Cadastro" style ='width: 28%;'>
        </form>

    </section>
</body>
</html>
<style>
    /* style.css */

/* Resetando estilos padrão */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Estilizando o corpo da página */
body {
    background-image: url('Imagens/background.jpg'); /* Adicione o caminho para sua imagem de fundo */
    background-size: cover;
    font-family: Arial, sans-serif;
}

/* Estilizando a seção de login */
section {
    background-color: lightgrey;
    width: 300px; /* Definindo a largura da seção */
    padding: 20px;
    border-radius: 10px;
    position: absolute;
    top: 62.5%;
    left: 50%;
    transform: translate(-50%, -50%);
}

/* Estilizando o formulário de login */
form {
    text-align: center;
}

/* Estilizando o título do formulário */
h1 {
    margin-bottom: 20px;
}

/* Estilizando os campos de entrada */
input[type="text"],
input[type="password"],
input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Estilizando o botão de login */
input[type="submit"] {
    background-color: #834cb1;
    color: white;
    cursor: pointer;
}

/* Estilizando o botão de login quando hover */
input[type="submit"]:hover {
    background-color: #4b116f;
}

#logo{
    width: 20%;
    padding: 20px;
    position: absolute;
    top: 17.5%;
    left: 30%;
    transform: translate(-50%, -50%);
}

#subtitulo{
    position: absolute;
    top: 25%;
    left: 55%;
    transform: translate(-50%, -50%);
    color: white;
    font-family: 'runtoe';
    font-size: xx-large;
}

#linha{
    position: absolute;
    top: 29%;
    left: 60%;
    transform: translate(-50%, -50%);
    width: 70%;
}
</style>
