<?php
session_start();
unset($_SESSION['usuario'], $_SESSION['senha'], $_SESSION['logged']);

$_SESSION['msg'] = "Deslogado com sucesso";
session_destroy();
header("Location: login.php");