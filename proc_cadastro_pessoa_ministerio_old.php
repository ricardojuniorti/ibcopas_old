<?php

if(  isset($_POST["pessoa"]) &&  isset($_POST["ministerio"])	
 ){
		 $agora = date('Y/m/d H:i');
		 //pr($agora);
		 // exemplo de update delete e insert com PDO https://www.devmedia.com.br/crud-com-php-pdo/28873	 
		 try {
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $dbh->prepare('INSERT INTO tb_pessoa_ministerios (id_pessoa,id_ministerio,dt_inclusao) 
								   VALUES(:id_pessoa,:id_ministerio,:dt_inclusao)');
			$stmt->execute(array(
			':id_pessoa' 			=> ''.$_POST["pessoa"].'',
			':id_ministerio' 		=> ''.$_POST["ministerio"].'',
			':dt_inclusao' 			=> ''.$agora.''
		
			));
			//echo $stmt->rowCount();
			echo "<script>alert('Cadastro realizado com sucesso!');window.location.href = 'listar_pessoa_ministerio.php';</script>";	
		} 
		catch(PDOException $e) {
			echo 'Error: ' . $e->getMessage();
			echo "<script>alert('Erro: Esta pessoa já esta neste ministerio.Por favor selecione novamente!')</script>";

		} 
 }

 ?>