<!DOCTYPE html>
<html lang="es">
	<?php 
		require_once 'head.php'; 
		$webTitle = "Successful Register - Picturesque";
		
	?>
	<body onload="fillDate();">

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
					<h1>DISCOVER &amp; SHARE</h1>				
			</div>						
		</header>
		<section>
			<div class="wrapper loginR">
                <div class="login auxRS">
                
					  <?php
						if(
							isset($_SESSION["registered_username"]) && 
							isset($_SESSION["registered_pass"]) &&  
							isset($_SESSION["registered_email"]) &&  
							isset($_SESSION["registered_gender"]) &&
							isset($_SESSION["registered_date"]) &&
							isset($_SESSION["registered_city"]) &&
							isset($_SESSION["registered_country"])
							){
					   ?>
		   	            	<span class="titleh1">Success on your registration!</span>						
							<p class="registerCorrect">
								<?php echo "Username: ".($_SESSION["registered_username"]);
								echo "<br>";
								echo "Password: ".($_SESSION["registered_pass"]);
								echo "<br>";
								
								echo "Email: ".($_SESSION["registered_email"]);
								echo "<br>";
								
								echo "Birth date: ".($_SESSION["registered_date"]);	
								echo "<br>";
								
								/*echo "Gender: ".($_SESSION["registered_gender"]);
								echo "<br>";*/							
								
							?>
							<a class="btn btn-login btnHome" href="index.php"> Go to Home Page </a></p>



						<?php 
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