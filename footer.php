<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">	
				#myFooter {
				background-color: #000;
				color: white;
				position: fixed;
				bottom: 0;
				width: 100%;
				height: 67px;
			}
			
			#myFooter .row {
				margin-bottom: 60px;
			}

			#myFooter .navbar-brand {
				margin-top: 45px;
				height: 65px;
			}

			#myFooter .footer-copyright p {
				margin: 10px;
				color: #ccc;
			}

			#myFooter a {
				color: #d2d1d1;
				text-decoration: none;
			}

			#myFooter a:hover,
			#myFooter a:focus {
				text-decoration: none;
				color: white;
			}
			.logo{	
				margin: 0 auto;
				top: -40px;
				width: 101px;
				height: 320px;
			}
			/* resolucao de celular*/
			@media(max-width: 576px){
				#myFooter {
					width: 0px;

				}
				.logo{
					display: none;
						
				}
			}

	</style>	
</head>
	<footer id="myFooter">
		<div class="container">
			<div class="row">
				<div id="banner">
					<h2 class="logo">
					<img src="images/IBCOPAS.jpg" alt="IBRC" >
				</div>
			</div> 
		</div>    
	</footer>
    
</html>
