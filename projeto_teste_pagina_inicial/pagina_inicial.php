<?php

include('protect.php')

//http://localhost/integrador/projeto_teste_login/index.php
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/logo.png" type="logo/x-icon">
    <title>Home</title>
    <link rel="stylesheet" href="inicial.css">
    <style>
        body {
            background-color: #f4f4f4;
        }
    </style>

</head>
<body>
    <header>
        <h1>ENCONTRE A SUA ALCATEIA</h1>
        <img id="logo" src="../Imagens/logo.png" alt="">
        <br><br><br>        
            <nav>           
                <li>                                          
                    <ul><div class="elemento"><button><a href="../logout/sair.php">sair</a></button></div></ul>                  
                </li>
            </nav>                          
    </header>
    <section id="barra_lateral">
        <!--Imagem de perfil-->
        <img src="../imagens\jogador.jpeg" alt="" width="100%">
        <p>Nome de usuario</p>
    </section>
    <section id="conteudo_principal">
        <article>
            <h3>EQUIPES</h3>
            <nav class="sinza">
                    <button><a href="../menu_do_site/equipes.html">Criar Equipe</a></button>
                    <form action="pesquisa_equipe.php" method="get">
                    <input type="text" name="query" placeholder="Digite sua pesquisa..." required>
                     <button type="submit">Pesquisar</button>
                    </form>
            </nav>
        </article>
        <br><br>
        <article>
            <article>
                <h3>ARTIGOS</h3>
                <nav class="sinza">
                <button><a href="../menu_do_site/artigos.html">Criar Artigo</a></button>
                <form action="pesquisa_artigo.php" method="get">
                    <input type="text" name="query" placeholder="Digite sua pesquisa..." required>
                     <button type="submit">Pesquisar</button>
                    </form>
            </nav>
        </article>
        <article>
            <article>
                <h3>PESQUISA USUARIO</h3>
                <nav class="sinza">
                <form action="pesquisa_usuario.php" method="get">
                    <input type="text" name="query" placeholder="Digite sua pesquisa..." required>
                     <button type="submit">Pesquisar</button>
                    </form>
            </nav>
        </article>
    </section>
</body>
</html>
