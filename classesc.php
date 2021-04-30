<?php
require_once ("conexao.php");
require_once ("funcoes.php");
header("Content-type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
 <script src="js/jquery.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <script src="js/jquery-ui.js"></script>
 <script src="js/mask.min.js"></script>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Classes</title>
 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/styles.css" rel="stylesheet"> 
 <link rel="stylesheet" href="css/menu.css">   
</head>
<body>
 <div id="menuprincipal"><?php require_once ("menu.php");?></div>
 <div id="main" class="container-fluid">
  <BR><BR><?php  require_once ("cabecalho.php");?>
  <h3 class="page-header">Cadastrar Classe</h3>
 
 <?php
 // recuperar o numero da ficha
	$result = $dbh->query("SELECT MAX(ID_EBD) as FICHA  FROM TB_EBD"); 
 ?>
  <form action="classesc.php" method="POST">
  	<div class="row">
  	  <div class="form-group col-md-2">
  	  	<label for="exampleInputEmail1">*Nome:</label>
  	  	<input type="input" value="" class="form-control" name="nome_classe" id="nome_classe" placeholder="Digite a Classe" required>
  	  </div>	  		  
	</div>
	<div class="row">
		<div class="form-group col-md-3">
			<label for="exampleFormControlTextarea1" class="form-label">Faixa Etária:</label>
			<textarea class="form-control" name="faixa_etaria" id="faixa_etaria" rows="5"></textarea>
		</div>
		<div class="form-group col-md-10">
  	  	<label for="Input">Professor:  (Somente membros da Igreja)</label></BR>
<?php
	$pessoas = $dbh->query("SELECT ID_PESSOA, NOME FROM TB_PESSOA WHERE ATIVO = 'S' AND MEMBROIGREJA = 'S' ORDER BY NOME");	
?>		
		<select name="professor" id="professor" class="form-select" style="width: 25rem; height:4.3rem;" required> 
			<option value="">Professor(a)</option>
<?php
	foreach($pessoas as $pessoa){
?>
			<option value="<?php print_r($pessoa["ID_PESSOA"]);?>"> <?php print_r($pessoa["NOME"]);?></option>
<?php
	}
?>
		</select>
	</div>
	</div>
	
	<div class="row">
	  <div class="col-md-12">
	  	<button type="submit" class="btn btn-success">Cadastrar</button>
		<a href="listar_classes.php" class="btn btn-default">Cancelar</a>
	  </div>
	</div>
   </form>
  </div>
</div>
 <?php 
 require_once ("footer.php");
 require_once ("proc_cadastro_classes.php");
 ?>
</body>
</html>