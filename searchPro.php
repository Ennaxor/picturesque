<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Search pictures - Picturesque</title>

		<link href="css/accesible.css" rel="alternate stylesheet" type="text/css" title="Estilo Accesible"/>
		<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css" title="Estilo Principal"/>

		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" title="Estilo Principal" />
		<link href="css/print.css" rel="stylesheet" type="text/css" media="print" title="Estilo Para Impresión"/>

		<script src="js/fillDate.js"></script>
		<script src="js/style.js"></script>
		<script src="js/loginPopUp.js"></script>

	</head>

	<body onLoad="cargarPagina(), fillDate()">
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
				<h1>What are you looking for?</h1>				
			</div>						
		</header>

		<section>
			<div class="boxPics"> <a class="back" href="index.php"><h2><i class="fa fa-arrow-left"></i>  Go back</h2></a></div>
			<div class="wrapper ASWrapper">
                <div class="login WSadvanced">				
					<form autocomplete="on" enctype="multipart/form-data" method="get" action="searchresults.php"> 
						<div class="wrapperSearch">
							<span class="titleh1">Look for images with... </span> 
							<div class="usuRegistro"> 
								<p>     
									<label for="title"><b>TITLE: </b> </label>                      
									<input type="text" name="title" id="title" placeholder="E.G: landscape"/>                         
								</p>   
								<p id="dateFields">     
									<label for="dateFrom" id="dateTitle"><b>DATE TIME: </b> </label> <br>  <br>                
									From: <select id="dayfrom" name="dayfrom" onchange="reseting(this)">
											</select>
											<select id="monthfrom" name="monthfrom" onchange="reseting(this)">
											</select>
											<select id="yearfrom" name="yearfrom" onchange="reseting(this)">
											</select> <br> 
									To:    <select id="dayto" name="dayto" onchange="reseting(this)">
											</select>
											<select id="monthto" name="monthto" onchange="reseting(this)">
											</select>
											<select id="yearto" name="yearto" onchange="reseting(this)">
											</select>              
								</p>   
								<p>     
									<label for="country"><b>COUNTRY: </b> </label>                      
									<input type="text" name="country" id="country" placeholder="E.G: ireland..."/>             
								</p>                     
								<p class="button printOut"><input class="searchR" type="submit" value="Search!"/> </p>
								
								<button class="printIn">Search!</button>
													 
							</div> 
						</div>                      
					</form>
					</div>
                 
        		</div>
        	</div>
	
		</section>
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		<?php
			require_once("footer.php");
		?>	
		
	</body>	
</html>