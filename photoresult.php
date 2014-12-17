<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
	<?php 
		require_once 'head.php'; 
		$webTitle = "Successful photo creation- Picturesque";		
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
				<h1>Your photo is created!</h1>				
			</div>						
		</header>

		<section>
			<div class="boxPics"> <a class="back" href="profile.php"><h2><i class="fa fa-arrow-left"></i>  Go back</h2></a></div>
		<div class="wrapper loginR">
                <div class="login auxRS">                
					  <?php
						if(
							isset($_SESSION["photo_title"]) && 
							isset($_SESSION["photo_description"]) &&  
							isset($_SESSION["photo_date"]) &&  
							isset($_SESSION["photo_country"])
							){
					   ?>
		   	            	<span class="titleh1">Success on your creation!</span>						
							<p class="registerCorrect">
								<?php 
								$identificador = @mysqli_connect('localhost',$MYSQL_USER,$MYSQL_PASS,$MYSQL_DB);
							    if(!$identificador){
							        echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
							        echo "</p>";
							        exit;
							    }	
							    $sentencia = "select f.idFoto, p.NombrePais from fotos f, paises p where f.Titulo = '$_SESSION[photo_title]' and p.idPais = '$_SESSION[photo_country]'";
							    if( !($resultado = @mysqli_query($identificador,$sentencia)) ){
							            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
							            echo "</p>";
							            exit;
							    }
								echo "Title: ".($_SESSION["photo_title"]);
								echo "<br>";
								echo "Description: ".($_SESSION["photo_description"]);
								echo "<br>";								
								echo "Date: ".($_SESSION["photo_date"]);
								echo "<br>";
								while ($fila = @mysqli_fetch_assoc($resultado)){							
									echo "Country: "."$fila[NombrePais]";	
									echo "<br>";													
									echo "<a class='btn btn-login btnHome' href='detailpicture.php?id=$fila[idFoto]'> Go to my pic </a></p>";
								}
							?>
							
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