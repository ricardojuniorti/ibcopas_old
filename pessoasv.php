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
  <BR><BR><?php  require_once ("cabecalho.php");?>
  <h3 class="page-header">Visualizar Pessoa</h3>
 
 <?php
 // recuperar o numero da ficha
	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	
	$sql = "  SELECT
			  ID_PESSOA,
			  NOME,
			  SOBRENOME,
			  ENDERECO,
			  NUMERO,
			  COMPLEMENTO,
			  BAIRRO,
			  CEP,
			  ID_CIDADE,
			  ID_ESTADO,
			  EMAIL,
			  TELRESIDENCIAL,
			  CELULAR,
			  TELCOMERCIAL,
			  PROFISSAO,
			  DATE_FORMAT( DT_NASCIMENTO, \"%d/%m/%Y\" ) AS DT_NASCIMENTO,
			  CPF,
			  IDENTIDADE,
			  MEMBROIGREJA,
			  ATIVO
			  FROM TB_PESSOA
			  WHERE ID_PESSOA = '$id' ";
	//pr($sql);
	$pessoas = $dbh->query($sql);
 ?>
  <form action="proc_edita_usuario.php" method="POST">
  	<div class="row">
	  <div class="form-group col-md-1">
  	  	<label for="exampleInput">*Ficha N°:</label>
<?php 
		foreach($pessoas as $pessoa ){

?> 
		
  	  	<input type="input" class="form-control" value="<?php echo $pessoa["ID_PESSOA"];?>"  name="ficha" id="ficha" disabled placeholder="" required>	
  	  </div>	
  	  <div class="form-group col-md-2">
  	  	<label for="exampleInputEmail1">*Nome:</label>
  	  	<input type="input" class="form-control" value="<?php echo $pessoa["NOME"];?>" name="nome" id="nome" disabled placeholder="Digite o primeiro Nome" required>
  	  </div>
	  <div class="form-group col-md-4">
  	  	<label for="exampleInputEmail1">*Sobrenome</label>
  	  	<input type="input" class="form-control" value="<?php echo $pessoa["SOBRENOME"];?>" name="sobrenome" id="sobrenome" disabled placeholder="Digite o sobrenome" required>
  	  </div> 
	</div>	
	<div class="row">
  	  <div class="form-group col-md-5">
  	  	<label for="exampleInputEmail1">Endereço:</label>
  	  	<input type="input" class="form-control" value="<?php echo $pessoa["ENDERECO"];?>" name="endereco" id="endereco" disabled placeholder="Digite o endereço" required>
  	  </div>
	  <div class="form-group col-md-1">
  	  	<label for="exampleInputEmail1">N°</label>
  	  	<input type="input" class="form-control" value="<?php echo $pessoa["NUMERO"];?>" name="numero" id="numero" disabled placeholder="Digite o numero" required>
  	  </div>
	  <div class="form-group col-md-2">
  	  	<label for="exampleInputEmail1">Complemento:</label>
  	  	<input type="input" class="form-control" value="<?php echo $pessoa["COMPLEMENTO"];?>" name="complemento" id="complemento" disabled placeholder="Digite o complemento">
  	  </div>
	</div>	
	<div class="row">
  	  <div class="form-group col-md-3">
  	  	<label for="exampleInputEmail1">Bairrooooo:</label>
  	  	<input type="input" class="form-control" value="<?php echo $pessoa["BAIRRO"];?>" name="bairro" id="bairro" disabled placeholder="Digite o bairro">
  	  </div>
	  <div class="form-group col-md-1">
  	  	<label for="exampleInputEmail1">Cep:</label>
  	  	<input type="input" class="form-control" value="<?php echo $pessoa["CEP"];?>" name="cep" id="cep" disabled placeholder="Digeite o CEP">
  	  </div> 
	  <div class="form-group col-md-1">
  	  	<label for="exampleInputEmail1">UF:</label></BR>

<?php
	$estados = $dbh->query("SELECT ID,UF FROM TB_ESTADOS ORDER BY NOME");
	$cidades = $dbh->query("SELECT ID,NOME FROM TB_CIDADES WHERE ESTADO = ". $pessoa["ID_ESTADO"] . " ORDER BY NOME");
								
?>		
  	  	<select name="estados" id="estados" class="form-control" style="width: 8rem; height:3.3rem;" disabled>
			<option value="">Selecione</option>
<?php
	$selected = "";
	foreach($estados as $estado){
		
?>
			<option value="<?php print_r($estado["ID"]);?>" <?php echo ($estado["ID"] == $pessoa["ID_ESTADO"]) ? "selected" : "" ?>> <?php print_r($estado["UF"]);?></option>
<?php
	}
?>
		</select>
  	  </div>		
	  <div class="form-group col-md-1">
  	  	<label for="exampleInputEmail1">Cidade:</label>
  	  	<select name="cidades" id="cidades" class="form-select" style="display:block;height:3.3rem;" disabled>
<?php
	foreach($cidades as $cidade){
?>
			<option value="<?php print_r($cidade["ID"]);?>" <?php echo ($cidade["ID"] == $pessoa["ID_CIDADE"]) ? "selected" : "" ?>> <?php print_r($cidade["NOME"]);?></option>
<?php
	}
?>
		</select>
  	  </div>	  
	</div>
		<div class="row">
		  <div class="form-group col-md-3">
			<label for="exampleInputEmail1">E-mail:</label>
			<input type="email" class="form-control" value="<?php echo $pessoa["EMAIL"];?>" name="email" id="email" disabled placeholder="Digite o e-mail">
		  </div>
		  <div class="form-group col-md-2">
			<label for="exampleInputEmail1">Tel Residencial:</label>
			<input type="input" class="form-control" value="<?php echo $pessoa["TELRESIDENCIAL"];?>" name="telResidencial" id="telResidencial" disabled placeholder="Digite o telefone residencial">
		  </div>
		  <div class="form-group col-md-2">
			<label for="exampleInputEmail1">Celular:</label>
			<input type="input" class="form-control" value="<?php echo $pessoa["CELULAR"];?>" name="celular" id="celular" disabled placeholder="Digite o celular">
		  </div>
		  <div class="form-group col-md-2">
			<label for="exampleInputEmail1">Tel Comercial:</label>
			<input type="input" class="form-control" value="<?php echo $pessoa["TELCOMERCIAL"];?>" name="telComercial" id="telComercial" disabled placeholder="Digite o tel comercial">
		  </div>
		</div>
	<div class="row">
		<div class="form-group col-md-3">
			<label for="exampleInputEmail1">Profissão:</label></BR>
			<input type="input" class="form-control" value="<?php echo $pessoa["PROFISSAO"];?>" name="profissao" id="profissao" disabled placeholder="Digite a profissão">
		</div>		
		<div class="form-group col-md-2">
			<label for="exampleInputEmail1">Data de Nascimento:</label>
			<input type="input" class="form-control" value="<?php echo $pessoa["DT_NASCIMENTO"];?>" name="dt_nascimento" id="dt_nascimento" disabled placeholder="Digite a data de nascimento">
		</div>
		<div class="form-group col-md-2">
			<label for="exampleInputEmail1">CPF:</label>
			<input type="input" class="form-control" value="<?php echo $pessoa["CPF"];?>" name="cpf" id="cpf" disabled placeholder="Digite o CPF">
			
		</div>
		<div class="form-group col-md-2">
			<label for="exampleInputEmail1">RG:</label>
			<input type="input" class="form-control" value="<?php echo $pessoa["IDENTIDADE"];?>" name="identidade" id="identidade" disabled placeholder="Digite o RG">
		</div>
	</div>
<?php
	$consulta = "SELECT 
								NOME,
								NOME_MINISTERIO
								FROM TB_PESSOA 
								JOIN TB_PESSOA_MINISTERIOS
								ON (TB_PESSOA.ID_PESSOA=TB_PESSOA_MINISTERIOS.ID_PESSOA)
								JOIN TB_MINISTERIOS
								ON (TB_PESSOA_MINISTERIOS.ID_MINISTERIO = TB_MINISTERIOS.ID_MINISTERIO)
								WHERE TB_PESSOA.ID_PESSOA = '$id' AND DT_SAIDA IS NULL ORDER BY NOME_MINISTERIO";
								
	$ministerios = $dbh->query($consulta);
?>
	
	<div class="row">
<?php
		if($ministerios->rowCount() > 0 ){
?>
		<div class="form-group col-md-3">
		 <label for="exampleFormControlTextarea1" class="form-label">Ministérios em que participa:</label></BR>
<?php 		
			foreach($ministerios as $ministerio){
				echo $ministerio["NOME_MINISTERIO"] . "</BR>";
			}
		}
?>	
	    </div>
		<div class="form-group col-md-2">
			<label for="exampleInputEmail1">Membro da igreja?</label></BR>
			<select name="membroIgreja" id="membroIgreja" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" disabled>
<?php 
	if($pessoa["MEMBROIGREJA"] == "S"){
		$membroIgreja = "Sim";	
	}
	else{
		$membroIgreja = "Não";	
	} 
?>
			  <option value="<?php print_r($pessoa["MEMBROIGREJA"]);?>"> <?php print_r($membroIgreja);?></option>
<?php         
	if($pessoa["MEMBROIGREJA"] == "S"){
?>	
			  <option value="N">Nao</option>
<?php
	}
	else{
?>			
			  <option value="S">Sim</option>
<?php
	}
?>			  
			</select>
		  </div>
		  <div class="form-group col-md-2">
			<label for="exampleInputEmail1">Cadastro Ativo?</label></BR>
			<select name="ativo" id="ativo" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" disabled>
<?php if($pessoa["ATIVO"] == "S"){
	$ativo = "Sim";	
}
else{
$ativo = "Não";	
} 
?>
			  <option value="<?php print_r($pessoa["ATIVO"]);?>"> <?php print_r($ativo);?></option>
<?php         if($ativo == "Sim"){
?>	
			  <option value="N">Nao</option>
<?php
}
			  else{
?>			
			  <option value="S">Sim</option>
<?php
			  }
?>			  
			</select>
		  </div>
		<div class="col-md-12"></BR></BR>
			<a href="listar_pessoas.php" class="btn btn-default">Voltar</a>
		</div>
	</div>
	
<?php 
} // fim do foreach
?>	
	<div class="row">
	 
	</div>

  </form>
 </div>

 <?php 
 require_once ("footer.php");
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