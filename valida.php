<?php
require_once ("conexao.php");
require_once ("funcoes.php");

session_start();

$_SESSION['logged'] = $_SESSION['logged'] ?? NULL;

// banco de dados (inserir)
$usuario_db = 'ricardojuniorti@gmail.com';
$senha_db   = 'abc123';

$p_usuario = $_POST['login'];
$p_senha = $_POST['senha'];

if($usuario_db == $p_usuario && $p_senha == $senha_db){
    $_SESSION['usuario'] = $usuario_db;
    $_SESSION['nome'] = 'Ricardo';
    $_SESSION['senha'] = $senha_db;
    $_SESSION['logged'] = true;
    header("Location: index.php");
}
else{
    echo "<script>alert('Falha no login!'); window.location.href = 'login.php';</script>";
}
