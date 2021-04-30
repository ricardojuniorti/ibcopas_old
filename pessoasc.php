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
 <title>Cadastro de Pessoa</title>
 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/styles.css" rel="stylesheet">
 <link rel="stylesheet" href="css/menu.css">    
</head>
<body>
 <div id="menuprincipal"><?php require_once ("menu.php");?></div>
 <div id="main" class="container-fluid">
  <?php  require_once ("cabecalho.php");?>
  <h3 class="page-header">Cadastrar Pessoa</h3>
 <?php
 // recuperar o numero da ficha
	$result = $dbh->query("SELECT MAX(ID_PESSOA) as FICHA  FROM TB_PESSOA"); 
 ?>
  <form action="pessoasc.php" method="POST">
	<div class="row">
		<div class="form-group col-md-1">
  	  	<img src="images/avatar.jpg" alt="..." class="img-thumbnail">
  	  </div>
	</div>
  	<div class="row">	
	  <div class="form-group col-md-1">
  	  	<label for="exampleInput">*Ficha N°:</label>
<?php foreach($result as $proximaFicha ){?> 
  	  	<input type="input" class="form-control" value="000<?php print($proximaFicha["FICHA"]+1);?>" name="ficha" id="ficha" placeholder="" required>
<?php }?>	
  	  </div>	
  	  <div class="form-group col-md-2">
  	  	<label for="exampleInputEmail1">*Nome:</label>
  	  	<input type="input" value="" class="form-control" name="nome" id="nome" placeholder="Digite o primeiro Nome" required>
  	  </div>
	  <div class="form-group col-md-4">
  	  	<label for="exampleInputEmail1">*Sobrenome</label>
  	  	<input type="input" class="form-control" name="sobrenome" id="sobrenome" placeholder="Digite o sobrenome" required>
  	  </div> 
	</div>	
	<div class="row">
  	  <div class="form-group col-md-5">
  	  	<label for="exampleInputEmail1">Endereço:</label>
  	  	<input type="input" class="form-control" name="endereco" id="endereco" placeholder="Digite o endereço" required>
  	  </div>
	  <div class="form-group col-md-1">
  	  	<label for="exampleInputEmail1">N°</label>
  	  	<input type="input" class="form-control" name="numero" id="numero" placeholder="Digite o numero" required>
  	  </div>
	  <div class="form-group col-md-2">
  	  	<label for="exampleInputEmail1">Complemento:</label>
  	  	<input type="input" class="form-control" name="complemento" id="complemento" placeholder="Digite o complemento">
  	  </div>
	</div>	
	<div class="row">
  	  <div class="form-group col-md-3">
  	  	<label for="exampleInputEmail1">Bairro:</label>
  	  	<input type="input" class="form-control" name="bairro" id="bairro" placeholder="Digite o bairro">
  	  </div>
	  <div class="form-group col-md-1">
  	  	<label for="exampleInputEmail1">Cep:</label>
  	  	<input type="input" class="form-control" name="cep" id="cep" placeholder="Digite o CEP">
  	  </div> 
	  <div class="form-group col-md-1">
  	  	<label for="exampleInputEmail1">UF:</label></BR>

<?php
	$estados = $dbh->query("SELECT ID,UF FROM TB_ESTADOS ORDER BY NOME");
	
?>		
  	  	<select name="estados" id="estados" class="form-control" style="width: 8rem; height:3.3rem;" required>
			<option value="">Selecione</option>
<?php
	foreach($estados as $estado){
?>
			<option value="<?php print_r($estado["ID"]);?>"> <?php print_r($estado["UF"]);?></option>
<?php
	}
?>
		</select>
  	  </div>		
	  <div class="form-group col-md-1">
  	  	<label for="exampleInputEmail1">Cidade:</label>
  	  	<select name="cidades" id="cidades" class="form-select" style="display:none;height:3.3rem;" required>
		</select>
  	  </div>	  
	</div>
		<div class="row">
		  <div class="form-group col-md-3">
			<label for="exampleInputEmail1">E-mail:</label>
			<input type="email" class="form-control" name="email" id="email" placeholder="Digite o e-mail">
		  </div>
		  <div class="form-group col-md-2">
			<label for="exampleInputEmail1">Tel Residencial:</label>
			<input type="input" class="form-control" name="telResidencial" id="telResidencial" placeholder="Digite o telefone residencial">
		  </div>
		  <div class="form-group col-md-2">
			<label for="exampleInputEmail1">Celular:</label>
			<input type="input" class="form-control" name="celular" id="celular" placeholder="Digite o celular">
		  </div>
		  <div class="form-group col-md-2">
			<label for="exampleInputEmail1">Tel Comercial:</label>
			<input type="input" class="form-control" name="telComercial" id="telComercial" placeholder="Digite o tel comercial">
		  </div>
		</div>
	<div class="row">
		<div class="form-group col-md-3">
			<label for="exampleInputEmail1">Profissão:</label></BR>
			<input type="input" class="form-control" name="profissao" id="profissao" placeholder="Digite a profissão">
		</div>
		<div class="form-group col-md-2">
			<label for="exampleInputEmail1">Data de Nascimento:</label>
			<input type="input" class="form-control" name="dt_nascimento" id="dt_nascimento" placeholder="Digite a data de nascimento">
		</div>
		<div class="form-group col-md-2">
			<label for="exampleInputEmail1">CPF:</label>
			<input type="input" class="form-control" name="cpf" id="cpf" placeholder="Digite o CPF">
			
		</div>
		<div class="form-group col-md-2">
			<label for="exampleInputEmail1">RG:</label>
			<input type="input" class="form-control" name="identidade" id="identidade" placeholder="Digite o RG">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-2">
			<label for="exampleInputEmail1">Membro da igreja?</label></BR>
			<select name="membroIgreja" id="membroIgreja" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
			  <option value="S">Sim</option>
			  <option value="N">Nao</option>
			</select>
		  </div>
	</div>
	
	<div class="row">
	  <div class="col-md-12">
	  	<button type="submit" class="btn btn-success">Cadastrar</button>
		<a href="listar_pessoas.php" class="btn btn-default">Cancelar</a>
	  </div>
	</div>

  </form>
 </div>

 <?php 
 require_once ("footer.php");
 require_once ("proc_cadastro_usuario.php");
 ?>
</body>
</html>
 <script type="text/javascript">
	// Aplica as mascaras nos campos
	$("#cpf").mask("000.000.000-00");	
	$("#numero").mask("0000000000");
    $("#telResidencial, #telComercial").mask("(00) 0000-0000");
	$("#cep").mask("00000-000");
	$("#celular").mask("(00) 00000-0000");
	$("#dt_nascimento").mask("00/00/0000");
	
</script>
<script>
$("#estados").on("change",function(){	
		var idEstado = $("#estados").val();
		//alert(idEstado);
		$.ajax({
			url: 'pega_cidades.php',
			type: 'POST',
			data:{id:idEstado},
			beforeSend: function(){	
				
				$("#cidades").css({'display':'block'});
				$("#cidades").html("Carregando...");
			},
			success: function (data)
			{
				$("#cidades").css({'display':'block'});
				$("#cidades").html(data);
			},
			error: function (data)
			{
				$("#cidades").css({'display':'block'});
				$("#cidades").html("Houve um erro ao carregar");
			}
		});
});	

</script>