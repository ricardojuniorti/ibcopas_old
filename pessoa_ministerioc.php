<?php
require_once ("conexao.php");
require_once ("funcoes.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>CRUD com Bootstrap 3</title>

 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/styles.css" rel="stylesheet">
 <link rel="stylesheet" href="css/menu.css">
     
</head>
<body>
 
 <div id="menuprincipal"><?php require_once ("menu.php");?></div>
 
 <div id="main" class="container-fluid">
 <?php  require_once ("cabecalho.php");?>	 
  <h3 class="page-header">Associar membros a Ministérios (Somente membros ativos aparecem na lista)</h3>
  
  <form action="pessoa_ministerioc.php" method="POST">
  	<div class="row">
  	  <div class="form-group col-md-1">
  	  	<label for="exampleInputEmail1">Membro:</label></BR>

<?php
	$pessoas = $dbh->query("SELECT ID_PESSOA, NOME, SOBRENOME FROM TB_PESSOA WHERE ATIVO = 'S' ORDER BY NOME");
								
?>		
  	  	<select name="pessoa" id="pessoa" class="form-control" style="width: 35rem; height:3.3rem;" required>
			<option value="">Selecione</option>
<?php
	$selected = "";
	foreach($pessoas as $pessoa){
		
?>
			<option value="<?php print_r($pessoa["ID_PESSOA"]);?>"><?php print_r($pessoa["NOME"]) . print_r(" ") . print_r($pessoa["SOBRENOME"]);?></option>
<?php
	}
?>
		</select>
  	  </div>
	</div>
	<div class="row">
		 <div class="form-group col-md-1">
  	  	<label for="exampleInputEmail1">Para qual ministério?</label></BR>

<?php
	$ministerios = $dbh->query("SELECT ID_MINISTERIO, NOME_MINISTERIO FROM TB_MINISTERIOS ORDER BY NOME_MINISTERIO");
								
?>		
  	  	<select name="ministerio" id="ministerio" class="form-control" style="width: 35rem; height:3.3rem;" required>
			<option value="">Selecione</option>
<?php
	$selected = "";
	foreach($ministerios as $ministerio){
		
?>
			<option value="<?php print_r($ministerio["ID_MINISTERIO"]);?>"><?php print_r($ministerio["NOME_MINISTERIO"]);?></option>
<?php
	}
?>
		</select>
  	  </div>
	</div>

	<hr />
	
	<div class="row">
	  <div class="col-md-12">
	  	<button type="submit" class="btn btn-success">Salvar</button>
		<a href="listar_pessoa_ministerio.php" class="btn btn-default">Cancelar</a>
	  </div>
	</div>

  </form>
 </div>
 <script src="js/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <?php 
 require_once ("footer.php");
 require_once ("proc_cadastro_pessoa_ministerio.php");
 ?>
</body>
</html>
