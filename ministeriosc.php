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
 <title>Ministérios</title>
 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/styles.css" rel="stylesheet">  
 <link rel="stylesheet" href="css/menu.css">  
</head>
<body>
 <div id="menuprincipal"><?php require_once ("menu.php");?></div>
 <div id="main" class="container-fluid">
  <BR><BR><?php  require_once ("cabecalho.php");?>
  <h3 class="page-header">Cadastrar Ministério</h3>
 
 <?php
 // recuperar o numero da ficha
	$result = $dbh->query("SELECT MAX(ID_MINISTERIO) as FICHA  FROM TB_MINISTERIOS"); 
 ?>
  <form action="ministeriosc.php" method="POST">
  	<div class="row">
  	  <div class="form-group col-md-2">
  	  	<label for="exampleInputEmail1">*Nome:</label>
  	  	<input type="input" value="" class="form-control" name="nome_ministerio" id="nome_ministerio" placeholder="Digite o primeiro Nome" required>
  	  </div>	  		  
	</div>
	<div class="row">
		<div class="form-group col-md-3">
			<label for="exampleFormControlTextarea1" class="form-label">Descrição:</label>
			<textarea class="form-control" name="descricao_ministerio" id="descricao_ministerio" rows="5"></textarea>
		</div>
		<div class="form-group col-md-10">
  	  	<label for="Input">Responsável:  (Somente membros da Igreja)</label></BR>
<?php
	$pessoas = $dbh->query("SELECT ID_PESSOA, NOME FROM TB_PESSOA WHERE ATIVO = 'S' AND MEMBROIGREJA = 'S' ORDER BY NOME");	
?>		
		<select name="responsavel" id="responsavel" class="form-select" style="width: 25rem; height:4.3rem;" required> 
			<option value="">Selecione o responsável</option>
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
		<a href="listar_ministerios.php" class="btn btn-default">Cancelar</a>
	  </div>
	</div>
   </form>
  </div>
</div>
 <?php 
 require_once ("footer.php");
 require_once ("proc_cadastro_ministerio.php");
 ?>
</body>
</html>