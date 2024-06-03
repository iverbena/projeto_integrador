<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['username'])) {
    die(header('Location: ../projeto_teste_login/index.php'));
}


?>