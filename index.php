<?php 
	session_start();
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Tienda de productos</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

		<link rel="stylesheet" href="style.css">

	</head>
	<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<img src="img/carro.png" width="50px;">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Tienda de celulares</a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
				<a class="nav-link active" aria-current="page" href="#">Inicio</a>
				</li>
			
		
			</ul>
			</div>
		</div>
		</nav>


		<div class="container">
			<div>
				<h3>Productos disponibles</h3>
			
			</div>
			

			<div class="container">
				<div class="row row-cols-1 row-cols-md-3 g-4">
		
					<?php
					$productos=simplexml_load_file("products.xml");
					
					foreach ($productos as $Producto) {
						
						echo "<div class=\"col\">";
						echo "<form action=\"agregar_al_carrito.php\" method=\"POST\">";
						echo "<input name=\"nombre\" type=\"hidden\" value=\"$Producto->nombre\">";
						echo "<input name=\"descripcion\" type=\"hidden\" value=\"$Producto->descripcion\">";
						echo "<input name=\"precio\" type=\"hidden\" value=\"$Producto->precio\">";
						echo "<input name=\"imagen\" type=\"hidden\" value=\"$Producto->imagen\">";
						echo "<div class=\"card shadow-sm\">";


						echo "<img src=\"".$Producto->imagen."\" class=\"card-img-top\">";

						echo "<div class=\"card-body\">";
						echo "<h5 class=\"card-title\">" . $Producto->nombre . "</h5>";
						echo "<p class=\"card-text\">" . $Producto->modelo . "</p>";
						echo "<p class=\"card-text\">" . $Producto->precio . "</p>";
						echo "<p class=\"card-text\">" . $Producto->color . "</p>";
						echo "<p class=\"card-text\">" . $Producto->sistemaOperativo . "</p>";
						echo "<p class=\"card-text\">" . $Producto->RAM . "</p>";
						echo "<p class=\"card-text\">" . $Producto->descripcion . "</p>";
						echo "<div class=\"d-flex justify-content-between align-items-center\">";
						echo "<div class=\"btn-group btn-container\">";
						echo "<input type=\"submit\" value=\"Agregar al carrito\" name=\"Agregar\" class=\"btn btn-primary btn-custom\">";
						echo "</div>";
						echo "</div>";
						
						echo "</div>";
						echo "</div>";
						echo "</form>";
						echo "</div>";
					}
					?>
				</div>


	</body>
	</html>
