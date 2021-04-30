<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Cadastro de Pessoa</title>

 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/styles.css" rel="stylesheet">
     
</head>
<body>
 
 <div id="menuprincipal"><?php require_once ("menu.php");?></div>
 
 <div id="main" class="container-fluid">
  <BR><BR>
  <h3 class="page-header">Cadastrar Pessoa</h3>
  
  <form action="proprietarios.php">
  	<div class="row">
  	  <div class="form-group col-md-2">
  	  	<label for="exampleInputEmail1">Nome:</label>
  	  	<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite o primeiro Nome">
  	  </div>
	  <div class="form-group col-md-4">
  	  	<label for="exampleInputEmail1">Sobrenome</label>
  	  	<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite o sobrenome">
  	  </div>
	 
	</div>
	
	<div class="row">
  	  <div class="form-group col-md-5">
  	  	<label for="exampleInputEmail1">Endereço:</label>
  	  	<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite o endereço">
  	  </div>
	  <div class="form-group col-md-1">
  	  	<label for="exampleInputEmail1">N°</label>
  	  	<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite o numero">
  	  </div>
	  <div class="form-group col-md-2">
  	  	<label for="exampleInputEmail1">Complemento:</label>
  	  	<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite o complemento">
  	  </div>
	</div>	
	<div class="row">
  	  <div class="form-group col-md-3">
  	  	<label for="exampleInputEmail1">Bairro:</label>
  	  	<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite o bairro">
  	  </div>
	  <div class="form-group col-md-3">
  	  	<label for="exampleInputEmail1">Cidade:</label>
  	  	<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Cidade">
  	  </div>
	  <div class="form-group col-md-1">
  	  	<label for="exampleInputEmail1">Cep:</label>
  	  	<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Cidade">
  	  </div>
	  <div class="form-group col-md-1">
  	  	<label for="exampleInputEmail1">UF:</label></BR>
  	  	<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
			<option value="">Selecione o Estado</option>
			<option value="AC">Acre</option>
			<option value="AL">Alagoas</option>
			<option value="AP">Amapá</option>
			<option value="AM">Amazonas</option>
			<option value="BA">Bahia</option>
			<option value="CE">Ceará</option>
			<option value="DF">Distrito Federal</option>
			<option value="ES">Espírito Santo</option>
			<option value="GO">Goiás</option>
			<option value="MA">Maranhão</option>
			<option value="MT">Mato Grosso</option>
			<option value="MS">Mato Grosso do Sul</option>
			<option value="MG">Minas Gerais</option>
			<option value="PA">Pará</option>
			<option value="PB">Paraíba</option>
			<option value="PR">Paraná</option>
			<option value="PE">Pernambuco</option>
			<option value="PI">Piauí</option>
			<option value="RJ">Rio de Janeiro</option>
			<option value="RN">Rio Grande do Norte</option>
			<option value="RS">Rio Grande do Sul</option>
			<option value="RO">Rondônia</option>
			<option value="RR">Roraima</option>
			<option value="SC">Santa Catarina</option>
			<option value="SP">São Paulo</option>
			<option value="SE">Sergipe</option>
			<option value="TO">Tocantins</option>
		</select>
  	  </div>
	</div>
		<div class="row">
		  <div class="form-group col-md-3">
			<label for="exampleInputEmail1">E-mail:</label>
			<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite o e-mail">
		  </div>
		  <div class="form-group col-md-2">
			<label for="exampleInputEmail1">Tel Residencial:</label>
			<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite o telefone residencial">
		  </div>
		  <div class="form-group col-md-2">
			<label for="exampleInputEmail1">Celular:</label>
			<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite o celular">
		  </div>
		  <div class="form-group col-md-2">
			<label for="exampleInputEmail1">Tel Comercial:</label>
			<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite o tel comercial">
		  </div>
		</div>
	<div class="row">
		<div class="form-group col-md-3">
			<label for="exampleInputEmail1">Profissão:</label></BR>
			<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
			  <option selected>Selecione</option>
			  <option value="1">Analista de Sistemas</option>
			  <option value="2">Programador</option>
			  <option value="3">Contador</option>
			</select>
		</div>
		<div class="form-group col-md-2">
			<label for="exampleInputEmail1">Data de Nascimento:</label>
			<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite a data de nascimento">
		</div>
		<div class="form-group col-md-2">
			<label for="exampleInputEmail1">CPF:</label>
			<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite o CPF">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-2">
			<label for="exampleInputEmail1">Membro da igreja?</label></BR>
			<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
			  <option value="1">Sim</option>
			  <option value="2">Não</option>
			</select>
		  </div>
	</div>
	
	<div class="row">
	  <div class="col-md-12">
	  	<button type="submit" class="btn btn-green">Salvar</button>
		<a href="template.html" class="btn btn-default">Cancelar</a>
	  </div>
	</div>

  </form>
 </div>
 <script src="js/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <?php require_once ("footer.php");?>
</body>
</html>