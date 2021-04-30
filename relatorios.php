<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Relatórios</title>

 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/styles.css" rel="stylesheet">
 <link rel="stylesheet" href="css/menu.css">
     
</head>
<body>
 
 <div id="menuprincipal"><?php require_once ("menu.php");?></div>
 
 <div id="main" class="container-fluid">
  <BR><BR><?php  require_once ("cabecalho.php");?>
  <h3 class="page-header">Painel de Relatórios</h3>
  
  <form action="">
  	<div class="row">
  	 <h2>Listagem de alunos por classe EBD</h2>
     <h2>Listagem de membros por ministerio</h2>
     <h2>Aniversariantes filtrar por mes ou por ano</h2>
     <h2>Ficha de registro (Exportar para PDF)</h2>

	</div>
		
  </form>
 </div>
 <script src="js/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <?php require_once ("footer.php");?>
</body>
</html>
