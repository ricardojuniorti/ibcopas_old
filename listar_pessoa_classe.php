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
  	  	<label for="exampleInputEmail1">Aluno:</label>
  	  	<input type="input" class="form-control" name="nome" id="nome" placeholder="Digite o primeiro Nome">
  	  </div>
	  <div class="form-group col-md-3">
  	  	<label for="exampleInputEmail1">Classe</label>
  	  	<input type="input" class="form-control" name="classe" id="classe" placeholder="Digite a Classe">
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
		<a href="pessoa_classec.php"><img src="images/cadastrarPessoa.jpg"></a>
		<label for="input">Incluir aluno na Classe</label>	
	  </div>
	 
	</div>
	
	<?php

	(isset($_POST["nome"]))			? $nome 		= $_POST["nome"] 		: $nome = '';
	(isset($_POST["classe"]))	    ? $ebd 	        = $_POST["classe"] 	    : $ebd = '';
		
	$pessoas_classes = $dbh->query("SELECT
								TB_PESSOA_EBD.ID_PESSOA AS PESSOA,
								TB_PESSOA_EBD.ID_EBD AS EBD,
								NOME,
								NOME_CLASSE
								FROM TB_PESSOA 
								JOIN TB_PESSOA_EBD
								ON (TB_PESSOA.ID_PESSOA=TB_PESSOA_EBD.ID_PESSOA)
                                JOIN TB_EBD 
                                ON (TB_PESSOA_EBD.ID_EBD=TB_EBD.ID_EBD)
								WHERE NOME like '".$nome."%' 
								AND NOME_CLASSE like '%".$ebd."%'
								AND DT_SAIDA IS NULL
								ORDER BY NOME");
	
	if ($pessoas_classes->rowCount() > 0 ) {
	?>
	<div class="row">
		<div class="form-group col-md-7">
			<table class="table table-striped table-hover">
				<tr>
					<td><b>Nome</b></td>
					<td><b>Classe</b></td>
					<td><b></b></td>
				</tr>
	<?php
	
	    foreach ( $pessoas_classes as $pessoa_classe ) {
		
	?>	
				<tr>
					<td><?php print($pessoa_classe["NOME"]);?></td>				
					<td><?php print($pessoa_classe["NOME_CLASSE"]);?></td>
<?php
					echo "<td><a href='proc_apagar_pessoa_classe.php?pessoa=" . $pessoa_classe['PESSOA'] . "&classe=" . $pessoa_classe['EBD'] . " ' data-confirm='Tem certeza de que deseja excluir o item selecionado?'><img src=\"images/btn-deletar.png\"></a></td>";
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
