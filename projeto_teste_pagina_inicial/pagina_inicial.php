<?php

//http://localhost/integrador/projeto_teste_login/index.php

session_start();

// Recuperar o user_id e o user_name da sessão
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
?>



<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/logo.png" type="logo/x-icon">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
                <p><?php echo htmlspecialchars($user_name); ?></p>
        </section>
    </section>
    <section id="conteudo_principal">
        <article>
            <h3>EQUIPES:</h3>
            <nav class="sinza">                        
                    <p>Informe o nome da equipe ou insira espaço:</p>
                            <i class="bi bi-search"></i>
                            <input  id="barra" type="text" name="query" placeholder="informe o nome da equipe ou aperte espaço" required>
                    <button type="submit">Pesquisar</button>   
                    <button><a href="criar_equipes.php">Criar Equipe</a></button>                    
                    <form action="pesquisa_equipe.php" method="get"></form>
            </nav>
        </article>
        <br><br>
        <article>
            <article>
                <h3>ARTIGOS:</h3>
                <nav class="sinza">
                    <p>Informe o nome do Artigo ou insira espaço</p>
                    <i class="bi bi-search"></i>
                    <input  id="barra" type="text" name="query" placeholder="informe o nome do Artigo ou aperte espaço" required> 
                    <button type="submit">Pesquisar</button>
                    <button><a href="criar_artigo.php">Criar Artigo</a></button>
                    <form action="pesquisa_artigo.php" method="get"></form>                
                </nav>
        </article>
        <article>
            <article>
                <h3>PESQUISA USUARIO:</h3>
                <nav class="sinza">
                    <p>Informe o nome do(a) USUARIO(a)ou insira espaço:</p>
                    <i class="bi bi-search"></i>
                    <input  id="barra" type="text" name="query" placeholder="informe o nome do(a) Usuario(a) ou aperte espaço" required>   
                    <button type="submit">Pesquisar</button>
                    <form action="pesquisa_usuario.php" method="get"></form>
                </nav>
        </article>
    </section>
</body>
</html>

