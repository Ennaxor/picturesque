<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Picture Detail - Picturesque</title>		
		<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css" title="Estilo Principal"/>

		<link href="css/accesible.css" rel="alternate stylesheet" type="text/css" title="Estilo Accesible"/>
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" title="Estilo Principal" />
		<link href="css/print.css" rel="stylesheet" type="text/css" media="print" title="Estilo Para Impresión"/>

		<script src="js/main.js"></script>
		<script src="js/style.js"></script>
		<script src="js/loginPopUp.js"></script>
	</head>

	<body onLoad="cargarPagina()">
		<header>				
			<a href="index.php"> 
				<img class="logoBox" src="Resources/Images/logo.png" alt="Logo"/> 
			</a>	

			<?php
  				include 'logged.html';      			
			?>	
			
			<div class="currentStyle">
				<button class="btn btn-login btnStyle" id="cangestyle">Style</button>
				<ul id="webstyle">
					<li id="principal" onclick="getStringFromObject(this)"> <p>Principal</p></li>
					<li id="accesible" onclick="getStringFromObject(this)"> <p>Accesible</p></li>			
				</ul>
			</div>
			
			<div class="currentAccesibleStyle">
				<p> Pick the Style: </p>
				<button class="btn btn-login btnStyle" id="principalA" onclick="getStringFromObject(this)" >Principal </button>
				<button class="btn btn-login btnStyle" id="accesibleA" onclick="getStringFromObject(this)" >Accesible </button>
			</div>


			<div class="padding headerContent">
				<h1>DISCOVER &amp; SHARE</h1>				
				<form enctype="multipart/form-data" method="get" action="searchresults.html">					
						<div class="searchContainer">							
							<img class="lupa" src="Resources/Images/search-icon.png" alt="search icon" />
							<input class="search" type="search" name="searchInput" placeholder="Search..." />

							<input class="btn btn-login" type="submit" value="Go!"/>
							<a class= "btn btn-login searchAdvanced" href="searchpro.html">
								<img src="Resources/Images/gear.png" alt="gear icon" />
							</a>
						</div>						
					</form>				
				
			</div>						
		</header>

		<section>
			<div class="boxPics"> <a class="back" href="index.php"><h2>&lt;- Go back</h2></a></div>
			<div class="padding picDet">
				<img class="detailPicture" src="Resources/Images/perro1.jpg" alt="Perro 1"/>			
				<span class="info"><b>Title:</b> Perro 1 <b>Date:</b> 20/05/2014 <b>Country:</b> Spain </span>
				<span class="authors">
					<b>From the album:</b> <a href="#" class="detailAhref"> Pets</a> <br>
					<b>From the user:</b> <a href="#" class="detailAhref"> Pepito</a> 	
				</span>
							
			</div>			
		</section>
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>

		<footer id="FootDetailPicture">
			
			<div class="padding">
				<h3>Main pages</h3>
				<ul>
					<li><a href="index.php">Home Page</a></li>
					<li><a href="register.html">Register now</a></li>
					<li><a href="searchpro.html">Advanced Search</a></li>
				</ul>
				<span class="rights printOut">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		
			</div>	
		</footer>
		
	</body>	
</html>