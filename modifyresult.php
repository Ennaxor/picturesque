<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
	<?php 	
		$webTitle = "Successful profile- Picturesque";
		require_once 'head.php'; 		
	?>

	<body onLoad="fillAlbumDate()">		
		<header>				
			<a href="index.php"> 
				<img class="logoBox" src="Resources/Images/logo.png" alt="Logo"/> 
			</a>	
			<?php if (isset($_COOKIE['authenticated']) || isset($_SESSION['authenticated'])) include 'logged.html';   ?>

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
				<h1>Your profile is updated!</h1>				
			</div>						
		</header>

		<section>
			<div class="boxPics"> <a class="back" href="profile.php"><h2><i class="fa fa-arrow-left"></i>  Go back</h2></a></div>
		<div class="wrapper loginR">
                <div class="login auxRS">                
					  <?php
						if(
							isset($_SESSION["modified_username"]) && 
							isset($_SESSION["modified_pass"]) &&  
							isset($_SESSION["modified_email"]) && 
							isset($_SESSION["modified_date"]) &&
							isset($_SESSION["modified_city"]) &&
							isset($_SESSION["modified_country"])
							){
					   ?>
		   	            	<span class="titleh1">Correctly modified!</span>						
							<p class="registerCorrect">
								<?php 
								$identificador = @mysqli_connect('localhost',$MYSQL_USER,$MYSQL_PASS,$MYSQL_DB);
							    if(!$identificador){
							        echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
							        echo "</p>";
							        exit;
							    }	
							    $sentencia = "select p.NombrePais from usuarios u, paises p where u.Pais = '$_SESSION[modified_country]' and p.idPais = u.Pais ";
							    if( !($resultado = @mysqli_query($identificador,$sentencia)) ){
							            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
							            echo "</p>";
							            exit;
							    }
								echo "Username: ".($_SESSION["modified_username"]);
								echo "<br>";
								echo "Password: ".($_SESSION["modified_pass"]);
								echo "<br>";								
								echo "Email: ".($_SESSION["modified_email"]);
								echo "<br>";								
								echo "Birth date: ".($_SESSION["modified_date"]);	
								echo "<br>";
								echo "City: ".($_SESSION["modified_city"]);	
								echo "<br>";
								$fila = @mysqli_fetch_assoc($resultado);							
									echo "Country: "."$fila[NombrePais]";	
									echo "<br>";		
								
							?>
							<a class='btn btn-login btnModifyProfile' href='profile.php'> Go to my profile </a></p>;
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
		
	</body>	
</html>