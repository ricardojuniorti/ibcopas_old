<?php
if (isset($_POST['login'])){
	require_once ("valida.php");
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrapmin.css">
	<link rel="stylesheet" href="css/styles.css">
    <title>Login</title>
  </head>
  <body id="fundo">
	<div class="card" id="telalogin">
		<!-- <img src="..." class="card-img-top" alt="..."> -->
		<div class="card-body">
			<form method="post" action="login.php">
				<div class="mb-3">
					<img src="images/login_ibcopas.png" class="card-img-top">
					<label>Login</label>
					<input  type="email" class="form-control" name='login' id="login"  placeholder="Informe o email" required>
				</div>
				<div class="mb-3">
					<label>Senha</label>
					<input type="password" class="form-control" name='senha' id="senha" placeholder="Insira sua senha" required>
				</div>
				<button type="submit" class="btn btn-success btn-lg ">Entrar</button>
			</form>    		
		</div>
	</div>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

  </body>
</html>