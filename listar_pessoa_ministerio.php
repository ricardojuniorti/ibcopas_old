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
 <title>Cadastro de Pessoa</title>
 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/styles.css" rel="stylesheet">
 <link href="css/jquery-ui.css" rel="stylesheet"/>
 <link rel="stylesheet" href="css/menu.css">
</head>

<body>

 <div id="menuprincipal"><?php require_once ("menu.php");?></div>
 <div id="main" class="container-fluid">
 <?php  require_once ("cabecalho.php");?>
 <h3 class="page-header">Pesquisar Pessoa</h3>
  <form action="listar_pessoa_ministerio.php" method="POST">
  	<div class="row">
  	  <div class="form-group col-md-2">
  	  	<label for="exampleInputEmail1">Nome:</label>
  	  	<input type="input" class="form-control" name="nome" id="nome" placeholder="Digite o primeiro Nome">
  	  </div>
	  <div class="form-group col-md-3">
  	  	<label for="exampleInputEmail1">Ministério</label>
  	  	<input type="input" class="form-control" name="ministerio" id="ministerio" placeholder="Digite o sobrenome">
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
		<a href="pessoa_ministerioc.php"><img src="images/cadastrarPessoa.jpg"></a>
		<label for="input">Incluir Pessoa no ministério</label>	
	  </div>
	 
	</div>
	
	<?php

	(isset($_POST["nome"]))			? $nome 		= $_POST["nome"] 		: $nome = '';
	(isset($_POST["ministerio"]))	? $ministerio 	= $_POST["ministerio"] 	: $ministerio = '';
		
	$pessoas_ministerios = $dbh->query("SELECT
								TB_PESSOA_MINISTERIOS.ID_PESSOA AS PESSOA,
								TB_PESSOA_MINISTERIOS.ID_MINISTERIO AS MINISTERIO,
								NOME,
								NOME_MINISTERIO
								FROM TB_PESSOA 
								JOIN TB_PESSOA_MINISTERIOS
								ON (TB_PESSOA.ID_PESSOA=TB_PESSOA_MINISTERIOS.ID_PESSOA)
								JOIN TB_MINISTERIOS
								ON (TB_PESSOA_MINISTERIOS.ID_MINISTERIO = TB_MINISTERIOS.ID_MINISTERIO)
								WHERE NOME like '".$nome."%' 
								AND NOME_MINISTERIO like '%".$ministerio."%'
								AND DT_SAIDA IS NULL
								ORDER BY NOME");
	
	if ($pessoas_ministerios->rowCount() > 0 ) {
	?>
	<div class="row">
		<div class="form-group col-md-7">
			<table class="table table-striped table-hover">
				<tr>
					<td><b>Nome</b></td>
					<td><b>Ministério</b></td>
					<td><b></b></td>
				</tr>
	<?php
	
	foreach ( $pessoas_ministerios as $pessoa_ministerio ) {
		
	?>	
				<tr>
					<td><?php print($pessoa_ministerio["NOME"]);?></td>				
					<td><?php print($pessoa_ministerio["NOME_MINISTERIO"]);?></td>
<?php
					echo "<td><a href='proc_apagar_pessoa_ministerio.php?pessoa=" . $pessoa_ministerio['PESSOA'] . "&ministerio=" . $pessoa_ministerio['MINISTERIO'] . " ' data-confirm='Tem certeza de que deseja excluir o item selecionado?'><img src=\"images/btn-deletar.png\"></a></td>";
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
