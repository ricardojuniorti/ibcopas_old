<?php
include_once("conexao.php");
include_once("funcoes.php");


if(   isset($_GET["pessoa"]) &&  isset($_GET["ministerio"])

 )

{
	$agora = date('Y/m/d H:i'); 
	
	try {
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		echo $sql = 'UPDATE tb_pessoa_ministerios set DT_SAIDA = :agora WHERE ID_PESSOA = :pessoa AND ID_MINISTERIO = :ministerio';
							   	
		$stmt = $dbh->prepare($sql); 
							   	
		$stmt->execute(array(
		':pessoa' 						=> ''.$_GET["pessoa"].'',
		':ministerio'					=> ''.$_GET["ministerio"].'',
		':agora'						=> ''.$agora.'' 
		
		));		
		echo $stmt->rowCount();
		echo "<script>alert('Cadastro deletado com sucesso!');window.location.href = 'listar_pessoa_ministerio.php';</script>";	
		
	} 
	catch(PDOException $e) {
		echo 'Error: ' . $e->getMessage();

	}
}
else{
		echo "<script>alert('Erro Desconhecido!');window.location.href = 'listar_pessoa_ministerio.php';</script>";	
	
}

