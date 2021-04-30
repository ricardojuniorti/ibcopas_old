<?php

if(  isset($_POST["nome"])            &&  isset($_POST["sobrenome"])     && 
	  isset($_POST["endereco"])        &&  isset($_POST["numero"])       &&
	  isset($_POST["complemento"])     &&  isset($_POST["bairro"]) 	     &&   
	  isset($_POST["cep"]) 		       &&  isset($_POST["estados"])	     &&
	  isset($_POST["cidades"]) 	       &&  isset($_POST["email"])	     &&
	  isset($_POST["telResidencial"])  &&  isset($_POST["celular"])	     &&
	  isset($_POST["telComercial"])    &&  isset($_POST["profissao"])    &&
	  isset($_POST["dt_nascimento"])   &&  isset($_POST["cpf"])	  	     &&
	  isset($_POST["identidade"]) 	   &&  isset($_POST["membroIgreja"]) &&
	  isset($_POST["estados"])
	  
 ){
	 $data_de_nascimento = implode('-', array_reverse(explode('/', $_POST["dt_nascimento"])));
	 $agora = date('Y/m/d H:i');
	 //pr($agora);
	 // exemplo de update delete e insert com PDO https://www.devmedia.com.br/crud-com-php-pdo/28873	 
	 try {
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $dbh->prepare('INSERT INTO tb_pessoa (nome,sobrenome,endereco,numero,complemento,bairro,cep,id_cidade,email,telResidencial,celular,telComercial,profissao,dt_nascimento,cpf,identidade,membroIgreja,dt_cadastro,id_estado,ativo) 
							   VALUES(:nome,:sobrenome,:endereco,:numero,:complemento,:bairro,:cep,:id_cidade,:email,:telResidencial,:celular,:telComercial,:profissao,:dt_nascimento,:cpf,:identidade,:membroIgreja,:dt_cadastro,:id_estado,:ativo)');
		$stmt->execute(array(
		':nome' 			=> ''.$_POST["nome"].'',
		':sobrenome' 		=> ''.$_POST["sobrenome"].'',
		':endereco' 		=> ''.$_POST["endereco"].'',
		':numero' 			=> ''.$_POST["numero"].'',
		':complemento' 		=> ''.$_POST["complemento"].'',
		':bairro' 			=> ''.$_POST["bairro"].'',
		':cep' 				=> ''.$_POST["cep"].'',
		':id_cidade' 		=> ''.$_POST["cidades"].'',
		':email' 			=> ''.$_POST["email"].'',
		':telResidencial' 	=> ''.$_POST["telResidencial"].'',
		':celular' 			=> ''.$_POST["celular"].'',
		':telComercial' 	=> ''.$_POST["telComercial"].'',
		':profissao' 		=> ''.$_POST["profissao"].'',
		':dt_nascimento' 	=> ''.$data_de_nascimento.'',
		':cpf' 				=> ''.$_POST["cpf"].'',
		':identidade' 		=> ''.$_POST["identidade"].'',
		':membroIgreja' 	=> ''.$_POST["membroIgreja"].'',
		':dt_cadastro' 		=> ''.$agora.'',
		':id_estado' 		=> ''.$_POST["estados"].'',
		':ativo' 		=> 'S'
	
		));
		//echo $stmt->rowCount();
		echo "<script>alert('Cadastro realizado com sucesso!');window.location.href = 'listar_pessoas.php';</script>";	
	} 
	catch(PDOException $e) {
		echo 'Error: ' . $e->getMessage();

	}
 }	
 ?>