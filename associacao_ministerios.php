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
  <BR><BR>
  <h3 class="page-header">Associar membros a Ministérios</h3>
  
  <form action="proprietarios.php">
  	<div class="row">
  	  <div class="form-group col-md-3">
			<label for="exampleInputEmail1">Membro:</label></BR>
			<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
			  <option selected>Selecione</option>
			  <option value="1">Ricardo Junior</option>
			  <option value="2">Vanessa</option>
			  <option value="2">Julia</option>
			  <option value="2">Carol</option>
			</select>
	  </div> 
	</div>
	<div class="row">
		<div class="form-group col-md-3">
			<label for="exampleInputEmail1">Para qual Ministério?</label></BR>
			<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
			  <option selected>Selecione</option>
			  <option value="1">Louvor</option>
			  <option value="2">Financeiro</option>
			</select>
	  </div> 
	</div>

	<hr />
	
	<div class="row">
	  <div class="col-md-12">
	  	<button type="submit" class="btn btn-success">Salvar</button>
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
