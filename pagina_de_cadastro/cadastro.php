<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body">
    <header style="text-align: center;">
        <img src="../Imagens/logo.png" alt="" id="logo">
        <p id="subtitulo">ENCONTRE SUA ALCATEIA</p>
    </header>
    <section style="background-color: lightgrey;">
        <h1>Registre-se</h1>
        <form action="cadastrar_usuario.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>
        <input type="submit" value="Cadastrar">
    </form>
    </section>
    <div id="imagem">
        <img id= 'boneco' src="../Imagens/fortnite_boneco.png" alt="">
    </div>
</body>
</html>