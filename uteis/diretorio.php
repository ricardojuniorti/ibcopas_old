<?php
	require_once ("menu.php");
	require_once ("funcoes.php");

set_time_limit( 0 );
ini_set ( 'max_execution_time', 600 );
error_reporting(0);
?>

<script language="JavaScript">
	function Verificar()
	{
		var tecla=window.event.keyCode;
		if (tecla==116) {
			event.keyCode=0;
			event.returnValue=false;
		}
	}
</script>

<body onKeyDown="javascript:Verificar()"></body>

<!DOCTYPE html>
<html>
	<head>
		<title>Diretório Temporário do GPE4</title>
	</head>

	<style type="text/css">
		#papel span{
				font-size: 1vw;
				font-family:Tahoma;
				font-weight: 700;
		}

		#div span{
				font-size: 2vw;
				font-family:Tahoma; 
				font-weight: 700;
		}
            
		#subir{
			position:fixed;
			left:50%;
			right: 0;
			bottom:0px;
			right:0px;
			weight:15px;
			color: #000000;
		}
	</style>

	<?php echo "<br/>"."<br/>"."<br/>"."<br/>"."<br/>"."<br/>";
	
	if ( is_file (DIRETORIO.$arquivoExecucao) ) { ?>
		<div id="papel">
			<span> &nbsp;Diretório Temporário do GPE4</span>
		</div>
	
	<?php }

	echo "<br/>";?>

	<body>
		<?php
			$path = DIRETORIO;
			$diretorio = dir($path);

			$arquivoExecucao = "controle_execucao_script.txt";

			while ($arquivo = $diretorio -> read()) {
				if (is_file($path.$arquivo))
				echo "<a href='".$path.$arquivo."'>".$arquivo."</a><br />";
			}
			$diretorio->close();
		?>
		
	</body>

	<?php echo "<br/>";?>
	
	<?php
		function deleta($arquivoExecucao) {
			unlink(DIRETORIO.$arquivoExecucao);
			location.reload();
			window.location.reload(true);
			document.location.reload(true);
		};
		
		// if ( isset ($_POST["excluir"]) ) {
			if ( is_file (DIRETORIO.$arquivoExecucao) ) { ?>
			<form action="" method="post">
				<input type="submit" value="<b>Excluir arquivo de execução</b>" name="excluir">
			</form>
			<?php deleta($arquivoExecucao);?>
		 <?php }
		// }
	?>

	<div>
		<?php require_once("footer.php");?>
	</div>

</html>