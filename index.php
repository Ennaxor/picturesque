<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
	<?php	
		$webTitle = "Home Page - Picturesque";
		require_once 'head.php'; 		
 		$cookie_name = 'authenticated';
            
		if(isset($_GET["signout"])){
            $_SESSION = array();
            
			if(isset($_COOKIE[$cookie_name])) {
				setcookie($cookie_name, '', time() - 42000, '/');
			}

            session_destroy(); 
            echo "
            	<script> closePopUpAlbum(); </script>
            ";
        }
        if(isset($_GET["signin"])){
          	$_SESSION["authenticated"] = $_COOKIE[$cookie_name];     
             echo "
            	<script> closePopUpAlbum(); </script>
            ";
        }
	?>

	<body>
		<div id="popUpLogin">
			<?php
      			if (!isset($_COOKIE['authenticated']) && !isset($_SESSION['authenticated'])) include 'login.php';   
      			else if(isset($_COOKIE['authenticated']) && !isset($_SESSION['authenticated'])) include 'rememberlogin.php';
    		?>

		</div>

		<div id="overlay-back"></div>

		<header>		
			<a href="index.php"> 
				<img class="logoBox" src="Resources/Images/logo.png" alt="Logo"/> 
			</a>	
			<?php if (isset($_SESSION['authenticated'])) include 'logged.html';   ?>	

			<?php if (!isset($_SESSION['authenticated'])) 
			echo "<button id=\"loginPopUp\" onClick=\"showLogin();\"><i class=\"fa fa-sign-in\"></i> Sign in! </button>" ?>

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
							<input required="" class="search" type="text" name="searchInput" id="searchInput" placeholder="Search..." />

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
			
			<?php 
				$identificador = @mysqli_connect('localhost',$MYSQL_USER,$MYSQL_PASS,$MYSQL_DB);
				$i=0;
				if(!$identificador){
					echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
					echo "</p>";
					exit;
				}				
				$sentencia= "select * from fotos, paises where fotos.pais=paises.idPais order by fRegistro desc limit 4";
				
				if(!($resultado = @mysqli_query($identificador,$sentencia))){
					echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
					echo "</p>";
					exit;
				}
				$count=mysqli_num_rows($resultado);
				if($count > 0){				
					echo "<ul>";
					while ($fila = @mysqli_fetch_assoc($resultado)){
						echo "<li>";
							echo "<img src='$fila[Fichero]' alt='$fila[Fichero]'/>  ";
							echo "<a class='titleImage' href='detailpicture.php?id=$fila[idFoto]'><span class='titleImage'>Title: $fila[Titulo]</span></a> ";
							echo "<p><b class='titlePrint'><a href='detailpicture.php?id=$i'>Title: $fila[Titulo]</a></b>made on the $fila[Fecha] in $fila[NombrePais] </p>";
						echo "</li>";
					}
					echo "</ul>";
				}
				else{
					echo "<span class='noPhotos'>No pictures to show...</span>";
				}			
			?>

			<div class="boxSelectedPics"> <h2>Selected pic <i class="fa fa-trophy"></i></h2><div class="specialLine"></div> </div>	

			<?php
				 if(($fichero = @file("Resources/seleccion.txt")) == false){
			        echo "<span class='noPhotos'>No selection to show...</span>";
			     }
			     else{
			     	$random = mt_rand(0,sizeof($fichero)-1);
			     	$linea = $fichero[$random];
			     	$attElemento = split(';;', $linea);
		     		$imagenSeleccionada = "select * FROM fotos f LEFT JOIN paises p ON f.Pais = p.idPais WHERE f.idFoto = '$attElemento[0]'";			     	
			     	if(!($resultadoSelec = @mysqli_query($identificador,$imagenSeleccionada))){
						echo "<p>Error al ejecutar la sentencia <b>$imagenSeleccionada</b>: ". mysqli_error($identificador);
						echo "</p>";
						exit;
					}
					if(mysqli_num_rows($resultadoSelec) > 0){
						$filaSelec = @mysqli_fetch_assoc($resultadoSelec);
						$idSelecFoto = $filaSelec['idFoto'];
		                $titulo = $filaSelec['Titulo'];
		                $fecha = $filaSelec['Fecha'];
		                $pais = $filaSelec['NombrePais'];
		                $img = $filaSelec['Fichero'];
					}
					echo "<div class='selectedPhoto'>
						<img src='$img' alt='$img'/>
						<h2>$titulo</h2> <a class='selectedRef' href='detailpicture.php?id=$idSelecFoto'>(see in detail)</a><br>
						<span>$fecha - $pais</span><br>
						<span>Selected by <b>$attElemento[1]</b></span><br>
						<span class='selectedComment'>'$attElemento[2]'</span>

					</div>";
			     }

			?>						
		</section>
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		

		<?php
			mysqli_free_result($resultado);
			mysqli_close($identificador);
			require_once("footer.php");
		?>		
		
		<script src="js/login.js"></script>
	</body>	
</html>


