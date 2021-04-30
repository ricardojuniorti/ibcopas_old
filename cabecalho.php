<?php
session_start();
if(!empty($_SESSION['nome'])){

	echo "<DIV align='right'><B>Deus te abençoe</B>  " . $_SESSION['nome'] . "&nbsp;&nbsp;&nbsp;&nbsp;<a href='sair.php'>SAIR</a> </DIV>";
}else{
	$_SESSION['msg'] = "Área restrita";
	header("Location: login.php");	
}