<?php
session_start();
include_once("conexao.php");
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if(!empty($id)){
	
	try {
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $dbh->prepare('DELETE FROM tb_pessoa WHERE id_pessoa = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		echo "<script>alert('Cadastro deletado com sucesso!'); window.location.href = 'listar_pessoas.php';</script>";
		//header("Location: listar_pessoas.php");
		//echo $stmt->rowCount();
	} 
	catch(PDOException $e) {
		echo 'Error: ' . $e->getMessage();
	}			
}
else{
		header("Location: index.php");	
}

