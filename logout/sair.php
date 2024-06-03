<?php

if(!isset($_SESSION)) {
    session_start();
}

session_destroy();

header('Location: ../projeto_teste_login/index.php'); // redirecionar para a página do painel de controle