
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
// Verificar se houve um erro de login
$login_falhou = isset($_GET['login_falhou']) ? $_GET['login_falhou'] : false;

if ($login_falhou) {
    echo '<script>alert("Nome de usuário ou senha incorretos.");</script>';
}
?>
    <header>
        <img src="../Imagens/linha3.png" alt="" id="linha">
        <img src="../Imagens/logo.png" alt="" id="logo">
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
