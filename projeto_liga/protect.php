<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['username'])) {
    die(header('index.php'));
}


?>