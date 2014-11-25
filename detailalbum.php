<!DOCTYPE html>
<html lang="es">
	<?php 
		require_once 'head.php'; 
		$webTitle = "Picture Detail - Picturesque";	
		if (!isset($_COOKIE['authenticated']) && !isset($_SESSION['authenticated'])){
			$host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'index.php';
            header("Location: http://$host$uri/$extra");
		}	
	?>

	<body>
		<header>				
			<a href="index.php"> 
				<img class="logoBox" src="Resources/Images/logo.png" alt="Logo"/> 
			</a>	

			<?php
			 if (isset($_COOKIE['authenticated']) || isset($_SESSION['authenticated'])) include 'logged.html'; 
			?>	
			
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
				<h1>DISCOVER &amp; SHARE</h1>				
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
		</header>

		<section>
			
			<div class="albumMenu">
				<div class="goBack"> <a class="back" href="profile.php"><h2>&lt;- Go back</h2></a></div>
				
				<div class="addPhoto"> <a class="back" href="addphoto.php"><h2>Add Photo</h2></a></div>
			</div>
			
			<div class="padding picDet">
		
				<?php 
					$identificador = @mysqli_connect('localhost','web','','pibd');
					$i=0;
					if(!$identificador){
						echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
						echo "</p>";
						exit;
					}
					
					$sentencia= "select * from fotos, paises,albumes where fotos.pais=paises.idPais and fotos.album=albumes.idAlbum and fotos.album=$_GET[id]";
					
					if(!($resultado = @mysqli_query($identificador,$sentencia))){
						echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". mysqli_error($identificador);
						echo "</p>";
						exit;
					}
					
					echo "<ul>";
					while ($fila = @mysqli_fetch_assoc($resultado)){
						echo "<li>";
							echo "<img src='$fila[Fichero]' alt='Perro 1'/>  ";
							echo "<a class='titleImage' href='detailpicture.php?id=$fila[idFoto]'><span class='titleImage'>Title: $fila[Titulo]</span></a> ";
							echo "<p><b class='titlePrint'><a href='detailpicture.php?id=$i'>Title: $fila[Titulo]</a></b> <b>Date:</b> $fila[Fecha] <b>Country:</b> $fila[NombrePais] </p>";
						echo "</li>";
					}
					echo "</ul>";
			
			
				?>
				
			
							
				<!--<span class="info"><b>Title:</b> <?php $t='fotos.'.'Titulo';echo "$fila[Titulo] ";?><b>Date:</b> <?php echo "$fila[Fecha] ";?> <b>Country:</b> <?php echo "$fila[NombrePais] ";?> </span>
				<span class="authors">
					<b>From the album:</b> <a href="#" class="detailAhref"> <?php echo "$fila[TituloAlbum] ";?></a> <br>
					<b>From the user:</b> <a href="#" class="detailAhref"> <?php echo "$fila[NomUsuario] ";?></a> 	
				</span>-->
							
			</div>			
		</section>
		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>

		<footer id="FootDetailPicture">
			
			<div class="padding">
				<h3>Main pages</h3>
				<ul>
					<li><a href="index.php">Home Page</a></li>
					<li><a href="register.html">Register now</a></li>
					<li><a href="searchpro.html">Advanced Search</a></li>
				</ul>
				<span class="rights printOut">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		
			</div>	
		</footer>
		
	</body>	
</html>