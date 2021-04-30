<?php

if(  isset($_POST["nome_classe"]) &&  isset($_POST["faixa_etaria"])	&& 
	 isset($_POST["professor"])
	  
 ){
	 $agora = date('Y/m/d H:i');
	 //pr($agora);
	 // exemplo de update delete e insert com PDO https://www.devmedia.com.br/crud-com-php-pdo/28873	 
	 try {
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $dbh->prepare('INSERT INTO tb_ebd (nome_classe,faixa_etaria,id_pessoa) 
							   VALUES(:nome_classe,:faixa_etaria,:id_pessoa)');
		$stmt->execute(array(
		':nome_classe' 				=> ''.$_POST["nome_classe"].'',
		':faixa_etaria' 			=> ''.$_POST["faixa_etaria"].'',
		':id_pessoa' 				=> ''.$_POST["professor"].''
	
		));
		//echo $stmt->rowCount();
		echo "<script>alert('Cadastro realizado com sucesso!');window.location.href = 'listar_ebd.php';</script>";	
	} 
	catch(PDOException $e) {
		echo 'Error: ' . $e->getMessage();

	}
 }
 ?>