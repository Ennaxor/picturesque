<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Home Page - Picturesque</title>
		<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css" title="Estilo Principal"/>
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" title="Estilo Principal" />
		<link href="css/accesible.css" rel="alternate stylesheet" type="text/css" title="Estilo Accesible"  />
		<link href="css/print.css" rel="stylesheet" type="text/css" media="print" />
		<script src="js/style.js"></script>
		<script src="js/loginPopUp.js"></script>
		<script>cargarPagina();</script>
	</head>

	<body>
		<div id="popUpLogin">
			<?php
      			include 'login.php';      			
    		?>
		</div>
		<div id="overlay-back"></div>


		<header>				
			<a href="index.php"> 
				<img class="logoBox" src="Resources/Images/logo.png" alt="Logo"/> 
			</a>	
			
			<button id="loginPopUp" onClick="showLogin();"><i class="fa fa-sign-in"></i> Sign in! </button>
			
			

			<div class="currentAccesibleStyle">
				<p> Pick the Style: </p>
				<button class="btn btn-login btnStyle" id="principalA" onclick="getStringFromObject(this)" >Principal </button>
				<button class="btn btn-login btnStyle" id="accesibleA" onclick="getStringFromObject(this)" >Accesible </button>
			</div>
			
			<div class="padding headerContent">				
					<h1>DISCOVER &amp; SHARE </h1>	

					<form enctype="multipart/form-data" method="get" action="searchresults.php">					
						<div class="searchContainer">							
							<img class="lupa" src="Resources/Images/search-icon.png" alt="search icon" />
							<input class="search" type="search" name="searchInput" placeholder="Search..." />

							<input class="btn btn-login" type="submit" value="Go!"/>
							<a class= "btn btn-login searchAdvanced" href="searchpro.php">
								<img src="Resources/Images/gear.png" alt="gear icon" />
							</a>
						</div>						
					</form>	
			</div>	

			<div class="currentStyle">
				<button class="btn btn-login btnStyle" id="cangestyle">Style</button>
				<ul id="webstyle">
					<li id="principal" onclick="getStringFromObject(this)"> <p>Principal</p></li>
					<li id="accesible" onclick="getStringFromObject(this)"> <p>Accesible</p></li>			
				</ul>
			</div>					
		</header>	
	
		<section>			
			<div class="boxPics"> <h2>Last pics <i class="fa fa-camera-retro"></i></h2> </div>	
			
			<ul>
				<li>
					<img src="Resources/Images/perro1.jpg" alt="Perro 1"/>
					<a class="titleImage" href="detailpicture.html"><span class="titleImage">Title: Perro 1</span></a>
					<p><b class="titlePrint"><a href="detailpicture.html">Title: Perro 1</a></b> <b>Date:</b> 20/05/2014 <b>Country:</b> Spain </p>
				</li>
				<li>
					<img src="Resources/Images/perro2.jpg" alt="Perro 2"/>
					<a class="titleImage" href="detailpicture.html"><span class="titleImage">Title: Perro 2</span></a>
					<p><b class="titlePrint"><a href="detailpicture.html">Title: Perro 2</a></b> <b>Date:</b> 20/05/2014 <b>Country:</b> Spain </p>
				</li>
				<li>
					<img src="Resources/Images/perro3.jpg" alt="Perro 3"/>
					<a class="titleImage" href="detailpicture.html"><span class="titleImage">Title: Perro 3</span></a>
					
					<p><b class="titlePrint"><a href="detailpicture.html">Title: Perro 3</a></b> <b>Date:</b> 20/05/2014 <b>Country:</b> Spain </p>
				</li>
				<li>
					<img src="Resources/Images/perro4.jpg" alt="Perro 4"/>
					<a class="titleImage" href="detailpicture.html"><span class="titleImage">Title: Perro 4</span></a>
					<p><b class="titlePrint"><a href="detailpicture.html">Title: Perro 4</a></b> <b>Date:</b> 20/05/2014 <b>Country:</b> Spain </p>
				</li>
				<li>
					<img src="Resources/Images/perro5.jpg" alt="Perro 5"/>
					<a class="titleImage" href="detailpicture.html"><span class="titleImage">Title: Perro 5</span></a>
					<p><b class="titlePrint"><a href="detailpicture.html">Title: Perro 5</a></b> <b>Date:</b> 20/05/2014 <b>Country:</b> Spain </p>
				</li>
			</ul>

						
		</section>
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		

		<?php
			require_once("footer.php");
		?>		
		
		<script src="js/login.js"></script>
	</body>	
</html>


