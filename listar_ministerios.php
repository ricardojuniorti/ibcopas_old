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
 <title>Ministérios</title>
 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/styles.css" rel="stylesheet">
 <link href="css/jquery-ui.css" rel="stylesheet"/>
 <link rel="stylesheet" href="css/menu.css">
</head>

<body>

 <div id="menuprincipal"><?php require_once ("menu.php");?></div>
 <div id="main" class="container-fluid">
 <?php  require_once ("cabecalho.php");?>
 <h3 class="page-header">Pesquisar Ministérios</h3>
  <form action="listar_ministerios.php" method="POST">
  	<div class="row">
  	  <div class="form-group col-md-2">
  	  	<label for="exampleInputEmail1">Nome:</label>
  	  	<input type="input" class="form-control" name="nome_ministerio" id="nome_ministerio" placeholder="Digite o Ministério">
  	  </div>
	  <div class="form-group col-md-3">
  	  	<label for="exampleInputEmail1">Descrição</label>
  	  	<input type="input" class="form-control" name="descricao_ministerio" id="descricao_ministerio" placeholder="Digite o sobrenome">
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
		<a href="ministeriosc.php"><img src="images/cadastrarPessoa.jpg"></a>
		<label for="input">CADASTRAR</label>	
	  </div>
	 
	</div>
	
	<?php

	(isset($_POST["nome_ministerio"]))			? $nome_ministerio 			= 	$_POST["nome_ministerio"] 		: 	$nome_ministerio = '';
	(isset($_POST["descricao_ministerio"]))		? $descricao_ministerio 	= 	$_POST["descricao_ministerio"] 	: 	$descricao_ministerio = '';

		
	$ministerios = $dbh->query("SELECT
								ID_MINISTERIO,
								NOME_MINISTERIO,
								DESCRICAO_MINISTERIO							  
								FROM TB_MINISTERIOS
								WHERE NOME_MINISTERIO 	like '" . $nome_ministerio . "%' 
								AND DESCRICAO_MINISTERIO  like '%" . $descricao_ministerio . "%'
								ORDER BY NOME_MINISTERIO LIMIT 10");
								
	if ($ministerios->rowCount() > 0 ) {
	?>
	<div class="row">
		<div class="form-group col-md-7">
			<table class="table table-striped table-hover">
				<tr>
					<td><b>Id</b></td>
					<td><b>Nome</b></td>
					<td><b>Descrição</b></td>
					<td></td>
					<td></td>
					
				</tr>
	<?php
	
		foreach ( $ministerios as $ministerio ) {				
	?>	
				<tr>
<?php				
					echo "<td><a href='ministeriose.php?id=" . $ministerio['ID_MINISTERIO'] . " ' target='_blank'> " . $ministerio['ID_MINISTERIO'] . "</a></td> ";
?>
					<td><?php print($ministerio["NOME_MINISTERIO"]);?></td>				
					<td><?php print($ministerio["DESCRICAO_MINISTERIO"]);?></td>
					<td><a href='ministeriosv.php?id=<?php echo $ministerio['ID_MINISTERIO']; ?>'><img src="images/btn-visualizar.png" placeholder="Visualizar"></a></td>
<?php
					echo "<td><a href='proc_apagar_ministerio.php?id=" . $ministerio['ID_MINISTERIO'] . "' data-confirm='Tem certeza de que deseja excluir o item selecionado?'><img src=\"images/btn-deletar.png\"></a></td>";
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
