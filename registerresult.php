<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Register a new user - Picturesque</title>

		<link href="css/accesible.css" rel="alternate stylesheet" type="text/css" title="Estilo Accesible"/>
		<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css" title="Estilo Principal"/>

		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" title="Estilo Principal" />
		<link href="css/print.css" rel="stylesheet" type="text/css" media="print" title="Estilo Para Impresión"/>		
		<script src="js/style.js"></script>
		<script src="js/loginPopUp.js"></script>
	</head>
	<body onload="fillDate(); cargarPagina()">

		<div id="popUpLogin">
			<?php
      			include 'login.html';      			
    		?>
		</div>
		<div id="overlay-back"></div>

		<header>				
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
			<button id="loginPopUp" onClick="showLogin();"><i class="fa fa-sign-in"></i> Sign in! </button>
			<div class="padding headerContent">				
					<h1>DISCOVER &amp; SHARE</h1>				
			</div>						
		</header>
		<section>
			<div class="wrapper loginR">
                <div class="login auxRS">
                    <!--<span class="titleh1">Success on your registration</span> -->
                      
					  <?php
						if($_POST["username"]!="Pepe" || $_POST["username"]!="Pepa"){

							echo "Success on your registration <br>";
							echo "<br>";
							
							echo "Username: " ;	
							print_r($_POST["username"]);
							echo "<br>";
							
							echo "Email: " ;	
							print_r($_POST["email"]);
							echo "<br>";
							
							echo "Birth date: " ;	
							print_r($_POST["day"]);
							echo "/";
							print_r($_POST["month"]);
							echo "/";
							print_r($_POST["year"]);
							echo "<br>";
							
							echo "Gender: " ;	
							print_r($_POST["genderType"]);
							echo "<br>";
							
							echo "City: " ;	
							print_r($_POST["city"]);
							echo "<br>";
							
							echo "Country: " ;	
							print_r($_POST["country"]);
							echo "<br>";
						}
						else{
							require_once("registroerroneo.html");
						}
						
						
					?>

						
                    
        		</div>
        	</div>
		</section>
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		<?php
			require_once("footer.php");
		?>
		<script src="js/register.js"></script>
		
	</body>
	</html>