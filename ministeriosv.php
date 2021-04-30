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
 <title>Cadastro de ministerio</title>
 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/styles.css" rel="stylesheet"> 
 <link rel="stylesheet" href="css/menu.css">   
</head>
<body>
 <div id="menuprincipal"><?php require_once ("menu.php");?></div>
 <div id="main" class="container-fluid">
  <BR><BR><?php  require_once ("cabecalho.php");?>
  <h3 class="page-header">Visualizar Ministério</h3>
 <?php
 // recuperar o numero da ficha
	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	
	$sql = "SELECT
			ID_MINISTERIO,
			NOME_MINISTERIO,
			DESCRICAO_MINISTERIO,
			ID_PESSOA
			FROM TB_MINISTERIOS
			WHERE ID_MINISTERIO = '$id' ";
	
	$ministerios = $dbh->query($sql);
	foreach($ministerios as $ministerio){
 ?>
  <form action="proc_edita_ministerio.php" method="POST">
  	<div class="row">
	  <input type="hidden" value="<?php echo $ministerio["ID_MINISTERIO"];?>" name="id_ministerio" id="id_ministerio" disabled>
  	  <div class="form-group col-md-2">
  	  	<label for="exampleInputEmail1">Ministério:</label>
  	  	<input type="input" class="form-control" value="<?php echo $ministerio["NOME_MINISTERIO"];?>" name="nome_ministerio" id="nome_ministerio" placeholder="Digite o Ministério" disabled>
  	  </div>
	</div>
	<div class="row">
		<div class="form-group col-md-3">
		 <label for="exampleFormControlTextarea1" class="form-label">Descrição:</label>
		 <textarea class="form-control" name="descricao_ministerio" id="descricao_ministerio" rows="5" disabled><?php echo $ministerio["DESCRICAO_MINISTERIO"];?></textarea>
	    </div>		
	</div>
	<div class="row">
		<div class="form-group col-md-3">
			<label for="Input">Responsável:</label></BR>
<?php
	$pessoas = $dbh->query("SELECT ID_PESSOA, NOME FROM TB_PESSOA WHERE ATIVO = 'S' ORDER BY NOME");	
?>		
		<select name="responsavel" id="responsavel" class="form-select" style="width: 25rem; height:4.3rem;" disabled>
			<option value="">Selecione o responsável</option>
<?php
		foreach($pessoas as $pessoa){
?>
			<option value="<?php print_r($pessoa["ID_PESSOA"]);?>" <?php echo ($ministerio["ID_PESSOA"] == $pessoa["ID_PESSOA"]) ? "selected" : "" ?>> <?php print_r($pessoa["NOME"]);?></option>
<?php
		}
?>
		</select>
	    </div>
	</div>
<?php 
	} // fim do foreach
?>	
	<div class="row">
	  <div class="col-md-12">
		<a href="listar_ministerios.php" class="btn btn-default">Voltar</a>
	  </div>
	</div>
  </form>
 </div>
 <?php 
 require_once ("footer.php");
 ?>
</body>
</html>