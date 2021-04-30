<?php
include_once("conexao.php");
include_once("funcoes.php");

if(   isset($_POST["nome"])            &&  isset($_POST["sobrenome"])    && 
	  isset($_POST["endereco"])        &&  isset($_POST["numero"])       &&
	  isset($_POST["complemento"])     &&  isset($_POST["bairro"]) 	     &&   
	  isset($_POST["cep"]) 		       &&  isset($_POST["membroIgreja"]) &&
	  isset($_POST["email"])	  	   &&  isset($_POST["identidade"])   &&
	  isset($_POST["telResidencial"])  &&  isset($_POST["celular"])	     &&
	  isset($_POST["telComercial"])    &&  isset($_POST["profissao"])    &&
	  isset($_POST["dt_nascimento"])   &&  isset($_POST["cidades"]) 	 &&  
	  isset($_POST["estados"])		   &&  isset($_POST["cpf"])			 &&	
	  isset($_POST["ativo"])
 )
{
	$data_de_nascimento_nao_br = implode('-', array_reverse(explode('/', $_POST["dt_nascimento"])));
	$dt_atualizacao_cadastro = date('Y/m/d H:i');

	try {
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		echo $sql = 'UPDATE tb_pessoa 
							   set nome 				= :nome,
							   sobrenome 				= :sobrenome,
							   endereco 				= :endereco,
							   numero 					= :numero,
							   complemento 				= :complemento,
							   bairro 					= :bairro,
							   cep 						= :cep,
							   email 					= :email,
							   telResidencial 			= :telResidencial,
							   celular 					= :celular,
							   telComercial 			= :telComercial,
							   profissao			 	= :profissao,
							   dt_nascimento 			= :dt_nascimento,
							   id_cidade			 	= :id_cidade,
							   id_estado 				= :id_estado,
						       cpf 						= :cpf,
							   identidade 				= :identidade,
							   membroIgreja 			= :membroIgreja,
							   dt_atualizacao_cadastro  = :dt_atualizacao_cadastro,
							   ativo 					= :ativo 
							   WHERE ID_PESSOA = :id';
							   
		$stmt = $dbh->prepare($sql); 
							   	
		$stmt->execute(array(
		':id' 							=> ''.$_POST["ficha"].'',
		':nome' 						=> ''.$_POST["nome"].'',
		':sobrenome' 					=> ''.$_POST["sobrenome"].'',
		':endereco' 					=> ''.$_POST["endereco"].'',
		':numero' 						=> ''.$_POST["numero"].'',
		':complemento' 					=> ''.$_POST["complemento"].'',
		':bairro' 						=> ''.$_POST["bairro"].'',
		':cep' 							=> ''.$_POST["cep"].'',
		':email' 						=> ''.$_POST["email"].'',
		':telResidencial' 				=> ''.$_POST["telResidencial"].'',
		':celular' 						=> ''.$_POST["celular"].'',
		':telComercial' 				=> ''.$_POST["telComercial"].'',
		':profissao' 					=> ''.$_POST["profissao"].'',
		':dt_nascimento' 				=> ''.$data_de_nascimento_nao_br.'',
		':id_cidade' 					=> ''.$_POST["cidades"].'',
		':id_estado' 					=> ''.$_POST["estados"].'',
		':cpf' 							=> ''.$_POST["cpf"].'',
		':identidade' 					=> ''.$_POST["identidade"].'',
		':membroIgreja' 				=> ''.$_POST["membroIgreja"].'',
		':dt_atualizacao_cadastro' 		=> ''.$dt_atualizacao_cadastro.'',
		':ativo' 						=> ''.$_POST["ativo"].''	
		));
		
		echo $stmt->rowCount();
		echo "<script>alert('Cadastro Atualizado com sucesso!');window.location.href = 'listar_pessoas.php';</script>";	
	} 
	catch(PDOException $e) {
		echo 'Error: ' . $e->getMessage();

	}

}
else{
		echo "<script>alert('Erro Desconhecido!');window.location.href = 'listar_pessoas.php';</script>";		
}
	 
	 







