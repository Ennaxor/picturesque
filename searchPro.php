<!DOCTYPE html>
<html lang="es">
	<?php 
		require_once 'head.php'; 
		$webTitle = "Search Pictures - Picturesque";		
	?>

	<body onLoad="fillDate()">
		<div id="popUpLogin">
			<?php
      			if (!isset($_COOKIE['authenticated']) || !isset($_SESSION['authenticated'])) include 'login.php';       			     			
    		?>
		</div>
		<div id="overlay-back"></div>
		<header>				
			<a href="index.php"> 
				<img class="logoBox" src="Resources/Images/logo.png" alt="Logo"/> 
			</a>	
			<?php if (isset($_COOKIE['authenticated']) || isset($_SESSION['authenticated'])) include 'logged.html';   ?>	

			<?php if (!isset($_COOKIE['authenticated']) && !isset($_SESSION['authenticated'])) 
			echo "<button id=\"loginPopUp\" onClick=\"showLogin();\"><i class=\"fa fa-sign-in\"></i> Sign in! </button>" ?>

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
									<select id="country" name="country" onchange="reseting(this)"></select>                 
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