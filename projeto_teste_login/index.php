
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="/Imagens/linha3.png" alt="" id="linha">
        <img src="/Imagens/logo.png" alt="" id="logo">
        <h1 id="subtitulo"><b>ENCONTRE SUA ALCATEIA</b></h1>
    </header>
    <section style="background-color: lightgrey;">
        <h1>LOGIN</h1>
        <form action="BDlogin.php" method="post">
            <label for="usuario">Usuario: </label>
            <input type="text" name="username" id="nome">
            <br>
            <label for="senha">Senha:</label>
            <input type="password" name="password" id="senha">
            <br>
            <input type="submit" name="login" value="Login" style="width: 21%;">
        </form>
        <form action="../pagina_de_cadastro/cadastro.php" method="post">
        <input type="submit" name="cadastro" value="cadastro" style ='width: 28%;'>
        </form>
    </section>
</body>
</html>
