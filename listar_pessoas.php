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
 <BR><BR><?php  require_once ("cabecalho.php");?>
 <h3 class="page-header">Pesquisar Pessoa</h3>
  <form action="listar_pessoas.php" method="POST">
  	<div class="row">
  	  <div class="form-group col-md-2">
  	  	<label for="exampleInputEmail1">Nome:</label>
  	  	<input type="input" class="form-control" name="nome" id="nome" placeholder="Digite o primeiro Nome">
  	  </div>
	  <div class="form-group col-md-3">
  	  	<label for="exampleInputEmail1">Sobrenome</label>
  	  	<input type="input" class="form-control" name="sobrenome" id="sobrenome" placeholder="Digite o sobrenome">
  	  </div>
	  <div class="form-group col-md-2">
		<label for="exampleInputEmail1">CPF:</label>
		<input type="input" class="form-control" name="cpf" id="cpf" placeholder="Somente numeros">
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
		<a href="pessoasc.php"><img src="images/cadastrarPessoa.jpg"></a>
		<label for="input">CADASTRAR</label>	
	  </div>
	 
	</div>
	
	<?php

	(isset($_POST["nome"]))? $nome = $_POST["nome"] : $nome = '';
	(isset($_POST["sobrenome"]))? $sobrenome = $_POST["sobrenome"] : $sobrenome = '';
	(isset($_POST["cpf"]))? $cpf = $_POST["cpf"] : $cpf = "";
	
	
	$pessoas = $dbh->query("SELECT
							  ID_PESSOA,
							  NOME,
							  SOBRENOME,
							  CPF,
							  ID_CIDADE							  
							  FROM TB_PESSOA
							  WHERE NOME like '".$nome."%' 
							  AND SOBRENOME like '%".$sobrenome."%'
							  AND CPF like '%".$cpf."%'
							  ORDER BY NOME LIMIT 10");
							  
	if ($pessoas->rowCount() > 0 ) {
	?>
	<div class="row">
		<div class="form-group col-md-7">
			<table class="table table-striped table-hover">
				<tr>
					<td><b>N Ficha</b></td>
					<td><b>Nome</b></td>
					<td><b>Sobrenome</b></td>
					<td><b>CPF</b></td>
					<td><b></b></td>
					<td><b></b></td>
				</tr>
	<?php
	
	foreach ( $pessoas as $pessoa ) {		
		
	?>	
				<tr>
<?php				
					echo "<td><a href='pessoase.php?id=" . $pessoa['ID_PESSOA'] . " ' target='_blank'> " . $pessoa['ID_PESSOA'] . "</a></td> ";
?>
					<td><?php print($pessoa["NOME"]);?></td>				
					<td><?php print($pessoa["SOBRENOME"]);?></td>
					<td><?php print($pessoa["CPF"]);?></td>
					<td><a href='pessoasv.php?id=<?php echo $pessoa['ID_PESSOA']; ?>'><img src="images/btn-visualizar.png" placeholder="Visualizar"></a></td>
<?php
					echo "<td><a href='proc_apagar_usuario.php?id=" . $pessoa['ID_PESSOA'] . "' data-confirm='Tem certeza de que deseja excluir o item selecionado?'><img src=\"images/btn-deletar.png\"></a></td>";
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
