<?php
include_once("conexao.php");
include_once("funcoes.php");

if(   isset($_POST["nome_ministerio"])	&&  isset($_POST["descricao_ministerio"])	&& 
	  isset($_POST["responsavel"])   

 )
{

	try {
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		echo $sql = 'UPDATE    tb_ministerios 
							   set nome_ministerio 		= :nome_ministerio,
							   descricao_ministerio 	= :descricao_ministerio,
							   id_pessoa 				= :id_pessoa							   
							   WHERE ID_MINISTERIO 		= :id';
							   
		
		$stmt = $dbh->prepare($sql); 
							   	
		$stmt->execute(array(
		':id' 						=> ''.$_POST["id_ministerio"].'',
		':nome_ministerio'			=> ''.$_POST["nome_ministerio"].'',
		':descricao_ministerio' 	=> ''.$_POST["descricao_ministerio"].'',
		':id_pessoa' 				=> ''.$_POST["responsavel"].''
		
		));		
		echo $stmt->rowCount();
		echo "<script>alert('Cadastro Atualizado com sucesso!');window.location.href = 'listar_ministerios.php';</script>";	
		
	} 
	catch(PDOException $e) {
		echo 'Error: ' . $e->getMessage();

	}

}
else{
		echo "<script>alert('Erro Desconhecido!');window.location.href = 'listar_ministerios.php';</script>";		
}
	 
	 







