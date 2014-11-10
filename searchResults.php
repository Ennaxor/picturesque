<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Results of your search - Picturesque</title>
		<link href="css/accesible.css" rel="alternate stylesheet" type="text/css" title="Estilo Accesible"/>

		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" title="Estilo Principal" />
		<link href="css/print.css" rel="stylesheet" type="text/css" media="print" title="Estilo Para Impresión"/>
		<script src="js/style.js"></script>
		<script src="js/loginPopUp.js"></script>

	</head>

	<body onLoad="cargarPagina()">
		<div id="popUpLogin">
			<?php
      			include 'login.html';      			
    		?>
		</div>
		<div id="overlay-back"></div>

		<header class="specialHeader">				
			<a href="index.php"> 
				<img class="logoBox" src="Resources/Images/logo.png" alt="Logo"/> 
			</a>	
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
			<button class="btn btn-login " id="loginPopUp" onClick="showLogin()" >Login</button>
			<div class="padding headerContent searching">
				<h1>You searched for...</h1>	
				<ul class="searchRes">			
					<li><b>TITLE</b><br> Landscape</li>							
					<li><b>DATE TIME</b><br> From: 20/04/2013 - To: 05/08/2014</li>					
					<li><b>COUNTRY</b> <br>Ireland</li>
					<li><b>MATCHES</b> <br> 5 results</li>					
				</ul>			
			</div>						
		</header>
		<section>			
			<div class="boxPics"><a class="back" href="searchpro.php"><h2>&lt;- Other</h2></a></div>
			<br>
			<span class="orderText">
				Order by 
				<button class="btn btn-order" id="orderTitle" onclick="orderby(this)">Title ~</button> 
				<button class="btn btn-order" id="orderDate" onclick="orderby(this)">Date ~</button>
				<button class="btn btn-order country" id="orderCountry" onclick="orderby(this)">Country ~</button>
			</span>
			<br>
			<br>

			<ul id="searchResults">
				<li>
					<img src="Resources/Images/perro1.jpg" alt="Perro 1"/>
					<a href="detailpicture.html"><span class="titleImage">Boba</span></a>
					<p><b class="titlePrint">Title: Perro 1</b> <b>Date: </b><span class="dateField">20/05/2014</span><b> Country:</b> 
					<span class="countryField">Spain</span></p>
				</li>
				<li>
					<img src="Resources/Images/perro2.jpg" alt="Perro 2"/>
					<a href="detailpicture.html"><span class="titleImage">Bubita</span></a>
					<p><b class="titlePrint">Title: Perro 2</b> <b>Date: </b><span class="dateField">01/01/1993</span><b> Country:</b> 
					<span class="countryField">England</span> </p>
				</li>
				<li>
					<img src="Resources/Images/perro3.jpg" alt="Perro 3"/>
					<a href="detailpicture.html"><span class="titleImage">Salomón</span></a>
					
					<p><b class="titlePrint">Title: Perro 3 </b><b>Date: </b><span class="dateField">19/05/2014</span><b> Country:</b> 
					<span class="countryField">Mars</span> </p>
				</li>
				<li>
					<img src="Resources/Images/perro4.jpg" alt="Perro 4"/>
					<a href="detailpicture.html"><span class="titleImage">Cigüeña</span></a>
					<p><b class="titlePrint">Title: Perro 4 </b><b>Date: </b><span class="dateField">18/05/2014</span><b> Country:</b> 
					<span class="countryField">Spaniard</span></p>
				</li>
				<li>
					<img src="Resources/Images/perro5.jpg" alt="Perro 5"/>
					<a href="detailpicture.html"><span class="titleImage">Salmy</span></a>
					<p><b class="titlePrint">Title: Perro 5 </b> <b>Date: </b><span class="dateField">12/03/2014</span><b> Country:</b> 
					<span class="countryField">Canada</span> </p>
				</li>
			</ul>

					
		</section>

		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		<?php
			require_once("footer.php");
		?>

		<script src="js/order.js"></script>
		
	</body>	
</html>