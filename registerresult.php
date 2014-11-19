<!DOCTYPE html>
<html lang="es">
	<?php 
		$webTitle = "Successful Register - Picturesque";
		require_once 'head.php'; 
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
						if($_POST["username"]!="Pepe" && $_POST["username"]!="Pepa"){
					   ?>
		   	            	<span class="titleh1">Success on your registration!</span>						
							<p class="registerCorrect">
								<?php echo "Username: " ;	
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

								if($_POST["city"] != null) {
									echo "City: " ;	
									print_r($_POST["city"]);
									echo "<br>";
								}
								if($_POST["country"] != null){
									echo "Country: " ;	
									print_r($_POST["country"]);
									echo "<br>";
								}
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