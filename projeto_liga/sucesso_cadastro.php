<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Imagens/logo.png" type="logo/x-icon">
    <title>Sucesso!</title>
</head>
<body">
    <section style="background-color: lightgrey;">
        <h1>CADASTRO REALIZADO COM SUCESSO!</h1>
        <div id="imagem">
            <img src="Imagens/joinha.png" alt="" width="60%">
        </div>
        <button><a href="index.php">Fazer Login</a></button>
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
    background-color: #834cb1;
    background-image: url(Imagens/background_cadastro.jpg); /* Adicione o caminho para sua imagem de fundo */
    background-size: cover;
    font-family: Arial, sans-serif;
}

/* Estilizando a seção*/
section {
    width: 600px; /* Definindo a largura da seção */
    padding: 20px;
    border-radius: 10px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}

/* Estilizando o título*/
h1 {
    margin-bottom: 20px;
}

/* Estilizando o botão de redirecionamento */
button {
    background-color: #834cb1;
    color: white;
    cursor: pointer;
    width: 150px;
    padding: 15px;
    border-radius: 10px;
    font-size: large;
}

button:hover {
    background-color: #4b116f;
}

a:link {
    color: white;
    background-color: transparent;
    text-decoration: none;
  }
  a:visited {
    color: white;
    background-color: transparent;
    text-decoration: none;
  }
  a:hover {
    color: white;
    background-color: transparent;
    text-decoration: none;
  }
  a:active {
    color: white;
    background-color: transparent;
    text-decoration: none;
  }

  #logo{
    width: 20%;
    padding: 20px;
    position: absolute;
    top: 17.5%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>