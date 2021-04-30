<?php

if(  isset($_POST["nome_ministerio"]) &&  isset($_POST["descricao_ministerio"])	&& 
	 isset($_POST["responsavel"])
	  
 ){
	 $agora = date('Y/m/d H:i');
	 //pr($agora);
	 // exemplo de update delete e insert com PDO https://www.devmedia.com.br/crud-com-php-pdo/28873	 
	 try {
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $dbh->prepare('INSERT INTO tb_ministerios (nome_ministerio,descricao_ministerio,id_pessoa) 
							   VALUES(:nome_ministerio,:descricao_ministerio,:id_pessoa)');
		$stmt->execute(array(
		':nome_ministerio' 				=> ''.$_POST["nome_ministerio"].'',
		':descricao_ministerio' 		=> ''.$_POST["descricao_ministerio"].'',
		':id_pessoa' 					=> ''.$_POST["responsavel"].''
	
		));
		//echo $stmt->rowCount();
		echo "<script>alert('Cadastro realizado com sucesso!');window.location.href = 'listar_ministerios.php';</script>";	
	} 
	catch(PDOException $e) {
		echo 'Error: ' . $e->getMessage();

	}
 }
 ?>