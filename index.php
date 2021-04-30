<?php
require_once ("conexao.php");
require_once ("funcoes.php");
header("Content-type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>IBCOPAS-INDEX</title>
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<link rel="stylesheet" href="slider/css/bootstra.css">
		<link rel="stylesheet" href="slider/css/slider.css">
		<link rel="stylesheet" href="css/menu.css">
	</head>
	<body>
	<div id="menuprincipal"><?php  require_once ("menu.php");?></div>
	    <BR>
		<?php  require_once ("cabecalho.php");?>
		
		<div class="container">
			<!-- INICIO DO SLIDER -->
			<section class="slider">
				<div class="slider_box">
					<article class="slider_item active" data-slider-bg="slider/images/slide1.jpg">
						<div class="slider_content">
							<h2>Semeie o que voce quer colher.</h2>
							<p>Tudo o que você faz hoje tem um impacto amanhã! Se você cuidar da sua saúde e se você plantar tempo de intimidade com Deus, colherá conhecimento, maturidade e sabedoria.</p>
							</div>
					</article>

					<article class="slider_item" data-slider-bg="slider/images/slide2.jpg">
						<div class="slider_content">
							<h2>Tudo está fechado, menos o CÉU. Ore!</h2>
							<p>As portas do céu sempre estarão abertas ao nosso clamor!</p>
						</div>
					</article>

					<article class="slider_item" data-slider-bg="slider/images/slide3.jpg">
						<div class="slider_content">
							<h2>O que Cristo oferece, ele é</h2>
							<p>No deserto de quem eu fui, eu tinha sede e Veio Cristo e tudo se fez diferente</p>
						</div>
					</article>

				</div>
				<div class="slider-prev">&lt;</div>
				<div class="slider-next">&gt;</div>
			</section>
			<!-- FIM DO SLIDER -->

		</div>
		<?php require_once ("footer.php"); ?>
		<script src="slider/js/jquery.js"></script>
		<script src="slider/js/slider.js"></script>
	</body>
</html>


