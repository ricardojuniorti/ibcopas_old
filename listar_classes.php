<?php
require_once ("conexao.php");
require_once ("funcoes.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
 <script src="js/jquery.js"></script>
 <script src="js/mask.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <script src="js/mask.min.js"></script>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Classes</title>
 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/styles.css" rel="stylesheet">
 <link href="css/jquery-ui.css" rel="stylesheet"/>
 <link rel="stylesheet" href="css/menu.css">
</head>

<body>

 <div id="menuprincipal"><?php require_once ("menu.php");?></div>
 <div id="main" class="container-fluid">
 <?php  require_once ("cabecalho.php");?>
 <h3 class="page-header">Pesquisar Classes</h3>
  <form action="listar_classes.php" method="POST">
  	<div class="row">
  	  <div class="form-group col-md-2">
  	  	<label for="exampleInputEmail1">Nome:</label>
  	  	<input type="input" class="form-control" name="nome_classe" id="nome_classe" placeholder="Digite o Nome da Classe">
  	  </div>
	  <div class="form-group col-md-3">
  	  	<label for="exampleInputEmail1">Faixa Etária</label>
  	  	<input type="input" class="form-control" name="faixa_etaria" id="faixa_etaria" placeholder="Digite a Faixa Etária">
  	  </div>
    </div>
	<div class="row">
	  <div class="col-md-8">
		<button type="submit" class="btn btn-success">Pesquisar</button>
		<h3 class="page-header"></h3>
	  </div>	  
	</div>
	<div class="row">
		<div class="form-group col-md-5">
		<a href="classesc.php"><img src="images/cadastrarPessoa.jpg"></a>
		<label for="input">CADASTRAR CLASSES</label>	
	  </div>
	 
	</div>
	
	<?php

	(isset($_POST["nome_classe"]))			? $nome_classe 				= 	$_POST["nome_classe"] 			: 	$nome_classe = '';
	(isset($_POST["faixa_etaria"]))			? $faixa_etaria 			= 	$_POST["faixa_etaria"] 			: 	$faixa_etaria = '';

		
	$classes = $dbh->query("SELECT
								ID_EBD,
								NOME_CLASSE,
								FAIXA_ETARIA							  
								FROM TB_EBD
								WHERE NOME_CLASSE 	like '" . $nome_classe . "%' 
								AND FAIXA_ETARIA    like '%" . $faixa_etaria . "%'
								ORDER BY NOME_CLASSE LIMIT 10");
								
	if ($classes->rowCount() > 0 ) {
	?>
	<div class="row">
		<div class="form-group col-md-7">
			<table class="table table-striped table-hover">
				<tr>
					<td><b>Id</b></td>
					<td><b>Nome</b></td>
					<td><b>Faixa Etária</b></td>
					<td></td>
					<td></td>
					
				</tr>
	<?php
	
		foreach ( $classes as $classe ) {				
	?>	
				<tr>
<?php				
					echo "<td><a href='classese.php?id=" . $classe['ID_EBD'] . " ' target='_blank'> " . $classe['ID_EBD'] . "</a></td> ";
?>
					<td><?php print($classe["NOME_CLASSE"]);?></td>				
					<td><?php print($classe["FAIXA_ETARIA"]);?></td>
					<td><a href='classesv.php?id=<?php echo $classe['ID_EBD']; ?>'><img src="images/btn-visualizar.png" placeholder="Visualizar"></a></td>
<?php
					echo "<td><a href='proc_apagar_classe.php?id=" . $classe['ID_EBD'] . "' data-confirm='Tem certeza de que deseja excluir o item selecionado?'><img src=\"images/btn-deletar.png\"></a></td>";
?>									
				</tr>
<?php		
		}
?>		
			</table>
		</div>
	</div>
<?php
	}
	else{
		echo "Não foram encontrados resultados para a pesquisa informada!";
	}
?>
  </form>
 </div>
 

 <?php require_once ("footer.php");?>
</body>
</html>
<script type="text/javascript">
	// Aplica as mascaras nos campos
	$("#cpf").mask("000.000.000-00");	
</script>

<script src="js/personalizado.js"></script>
